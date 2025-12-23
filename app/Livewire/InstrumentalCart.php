<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Instrumental;

class InstrumentalCart extends Component
{
    public $listeners = ['instrumentalSelected'];
    public $cart_instance;
    public $data;

    // Propiedades específicas de instrumental
    public $codigo_unico_ud = [];
    public $nombre_generico = [];
    public $tipo_familia = [];
    public $marca_fabricante = [];
    public $fecha_compra = [];
    public $estado_actual = [];
    public $quantity = [];

    private $instrumental;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;
        $this->data = $data;
        
        // Siempre sincronizar con el carrito existente
        $this->syncCartData();
    }

    /**
     * Sincroniza las propiedades del componente con los items del carrito
     */
    private function syncCartData()
    {
        // Reiniciar arrays
        $this->codigo_unico_ud = [];
        $this->nombre_generico = [];
        $this->tipo_familia = [];
        $this->marca_fabricante = [];
        $this->fecha_compra = [];
        $this->estado_actual = [];
        $this->quantity = [];

        $cart_items = Cart::instance($this->cart_instance)->content();

        foreach ($cart_items as $cart_item) {
            $this->quantity[$cart_item->id] = $cart_item->qty;
            $this->codigo_unico_ud[$cart_item->id] = $cart_item->options->codigo_unico_ud ?? '';
            $this->nombre_generico[$cart_item->id] = $cart_item->options->nombre_generico ?? '';
            $this->tipo_familia[$cart_item->id] = $cart_item->options->tipo_familia ?? '';
            $this->marca_fabricante[$cart_item->id] = $cart_item->options->marca_fabricante ?? '';
            $this->fecha_compra[$cart_item->id] = $cart_item->options->fecha_compra ?? now()->format('Y-m-d');
            
            // ✅ IMPORTANTE: Asegurarse de que el estado actual se cargue correctamente
            $this->estado_actual[$cart_item->id] = $cart_item->options->estado_actual ?? 'DISPONIBLE';
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.instrumental-cart', [
            'cart_items' => $cart_items,
            'cart_count' => $cart_items->count()
        ]);
    }

    public function instrumentalSelected($instrumental)
    {
        $cart = Cart::instance($this->cart_instance);

        // Buscar si el instrumental ya existe en el carrito por su ID
        $exists = $cart->search(function ($cartItem, $rowId) use ($instrumental) {
            return $cartItem->id == $instrumental['id'];
        });

        // Si el instrumental ya existe en el carrito, mostrar mensaje de error
        if ($exists->isNotEmpty()) {
            $instrumentalName = $instrumental['nombre_generico'] ?? 'Instrumental';
            $instrumentalCode = $instrumental['codigo_unico_ud'] ?? '';
            
            session()->flash('error', "El instrumental '{$instrumentalName}' (Código: {$instrumentalCode}) ya está en el carrito. No se puede agregar el mismo item dos veces.");
            
            // Emitir evento para notificar al frontend (opcional)
            $this->dispatch('itemDuplicado', [
                'id' => $instrumental['id'],
                'nombre' => $instrumentalName,
                'codigo' => $instrumentalCode
            ]);
            
            return;
        }

        // Validar y obtener la cantidad
        $instrumentalQuantity = isset($instrumental['quantity']) && is_numeric($instrumental['quantity'])
            ? (int)$instrumental['quantity']
            : 1;

        // Agregar nuevo instrumental al carrito
        $cart->add([
            'id'      => $instrumental['id'],
            'name'    => $instrumental['nombre_generico'] ?? 'Instrumental sin nombre',
            'qty'     => $instrumentalQuantity,
            'price'   => 0,
            'weight'  => 1,
            'options' => [
                'codigo_unico_ud' => $instrumental['codigo_unico_ud'] ?? '',
                'nombre_generico' => $instrumental['nombre_generico'] ?? '',
                'tipo_familia' => $instrumental['tipo_familia'] ?? '',
                'marca_fabricante' => $instrumental['marca_fabricante'] ?? '',
                'fecha_compra' => $instrumental['fecha_compra'] ?? now()->format('Y-m-d'),
                'estado_actual' => $instrumental['estado_actual'] ?? 'DISPONIBLE',
            ]
        ]);

        session()->flash('message', 'Instrumental agregado al carrito!');
        
        // Re-sincronizar después de agregar
        $this->syncCartData();
    }

    public function incrementQuantity($row_id, $instrumental_id)
    {
        $this->quantity[$instrumental_id] = ($this->quantity[$instrumental_id] ?? 0) + 1;
        $this->updateQuantity($row_id, $instrumental_id);
    }

    public function decrementQuantity($row_id, $instrumental_id)
    {
        if (($this->quantity[$instrumental_id] ?? 1) > 1) {
            $this->quantity[$instrumental_id] = $this->quantity[$instrumental_id] - 1;
            $this->updateQuantity($row_id, $instrumental_id);
        }
    }

    public function updateQuantity($row_id, $instrumental_id)
    {
        $newQuantity = max(1, (int)($this->quantity[$instrumental_id] ?? 1));
        $this->quantity[$instrumental_id] = $newQuantity;

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'qty' => $newQuantity,
            'options' => [
                'codigo_unico_ud' => $cart_item->options->codigo_unico_ud,
                'nombre_generico' => $cart_item->options->nombre_generico,
                'tipo_familia' => $cart_item->options->tipo_familia,
                'marca_fabricante' => $cart_item->options->marca_fabricante,
                'fecha_compra' => $cart_item->options->fecha_compra,
                'estado_actual' => $this->estado_actual[$instrumental_id] ?? $cart_item->options->estado_actual,
            ]
        ]);
        
        $this->syncCartData();
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
        session()->flash('message', 'Instrumental eliminado del carrito!');
        
        // Re-sincronizar después de eliminar
        $this->syncCartData();
    }

    public function updateInstrumentalData($row_id, $instrumental_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        // ✅ Actualizar con los valores actuales del componente
        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'codigo_unico_ud' => $this->codigo_unico_ud[$instrumental_id] ?? $cart_item->options->codigo_unico_ud,
                'nombre_generico' => $this->nombre_generico[$instrumental_id] ?? $cart_item->options->nombre_generico,
                'tipo_familia' => $this->tipo_familia[$instrumental_id] ?? $cart_item->options->tipo_familia,
                'marca_fabricante' => $this->marca_fabricante[$instrumental_id] ?? $cart_item->options->marca_fabricante,
                'fecha_compra' => $this->fecha_compra[$instrumental_id] ?? $cart_item->options->fecha_compra,
                'estado_actual' => $this->estado_actual[$instrumental_id] ?? $cart_item->options->estado_actual,
            ]
        ]);

        session()->flash('message_instrumental_' . $instrumental_id, 'Datos actualizados correctamente!');
        
        $this->syncCartData();
    }

    /**
     * Método para limpiar completamente el carrito
     */
    public function clearCart()
    {
        Cart::instance($this->cart_instance)->destroy();
        $this->syncCartData();
        session()->flash('message', 'Carrito vaciado correctamente!');
    }
}