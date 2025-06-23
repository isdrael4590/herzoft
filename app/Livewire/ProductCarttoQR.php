<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCarttoQR extends Component
{
    public $listeners = ['productSelected'];
    public $cart_instance;
    public $data;
    public $package_wrap;
    public $ref_qr;
    public $eval_package;
    public $eval_indicator;
    public $expiration;
    public $type_process;
    public $unit_price;
    public $quantity;
    public $check_quantity;
    public $item_patient;
    public $item_outside_company;
    public $item_area;
    public $item_product_info;
    public $operator_package;
    public $expiration_data = 270; // Default value
    private $preparation_detail;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->check_quantity[$cart_item->id] = [$cart_item->options->stock];
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->unit_price[$cart_item->id] = $cart_item->price;
                $this->item_patient[$cart_item->id] = $cart_item->options->product_patient;
                $this->package_wrap[$cart_item->id] = $cart_item->options->product_package_wrap;
                $this->ref_qr[$cart_item->id] = $cart_item->options->product_ref_qr;
                $this->eval_package[$cart_item->id] = $cart_item->options->product_eval_package;
                $this->eval_indicator[$cart_item->id] = $cart_item->options->product_eval_indicator;
                $this->expiration[$cart_item->id] = $cart_item->options->product_expiration;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
                $this->item_outside_company[$cart_item->id] = $cart_item->options->product_outside_company;
                $this->item_area[$cart_item->id] = $cart_item->options->product_area;
                $this->item_product_info[$cart_item->id] = $cart_item->options->product_info;
                $this->operator_package[$cart_item->id] = $cart_item->options->product_operator_package;
            }
        } else {

            $this->package_wrap = [];
            $this->ref_qr = [];
            $this->eval_package = [];
            $this->eval_indicator = [];
            $this->expiration = [];
            $this->type_process = [];
            $this->check_quantity = [];
            $this->quantity = [];
            $this->item_patient = [];
            $this->unit_price = [];
            $this->item_outside_company = [];
            $this->item_area = [];
            $this->item_product_info = [];
            $this->operator_package = [];
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoQR', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($preparation_detail)
    {
        $cart = Cart::instance($this->cart_instance);

        // Debug: Agregar logging para identificar el problema
        \Log::info('ProductSelected called with:', [
            'product_id' => $preparation_detail['id'] ?? 'N/A',
            'product_name' => $preparation_detail['product_name'] ?? 'N/A',
            'product_code' => $preparation_detail['product_code'] ?? 'N/A',
            'cart_instance' => $this->cart_instance
        ]);

        $existingRowId = null;
        foreach ($cart->content() as $rowId => $cartItem) {
            if ($cartItem->id == $preparation_detail['product_code']) {
                $existingRowId = $rowId;
                break;
            }
        }

        \Log::info('Product search result:', [
            'found' => $existingRowId !== null,
            'existing_row_id' => $existingRowId
        ]);

        // Si el producto ya existe en el carrito, incrementar la cantidad
        if ($existingRowId !== null) {
            $cartItem = $cart->get($existingRowId);

            // Validar stock disponible antes de incrementar
            if ($this->cart_instance == 'labelqr') {
                $availableStock = $this->getAvailableStock($preparation_detail['product_code']);

                if (($cartItem->qty + 1) > $availableStock) {
                    session()->flash('message', 'No se puede añadir más cantidad. Stock disponible: ' . $availableStock);
                    return;
                }
            }

            // Incrementar la cantidad actual
            $newQuantity = $cartItem->qty + 1;

            // Solo actualizar la cantidad, manteniendo todas las opciones existentes
            $cart->update($existingRowId, $newQuantity);

            // Actualizar también las propiedades del componente
            $this->quantity[$preparation_detail['id']] = $newQuantity;

            session()->flash('message', 'Cantidad del producto actualizada en el carrito! Nueva cantidad: ' . $newQuantity);
            return;
        }

        $this->preparation_detail = $preparation_detail;
        if ($preparation_detail['product_type_process'] == 'Alta Temperatura') {
            $this->expiration_data = 14;
        } else {
            $this->expiration_data = 270;
        }
        $cart->add([
            'id'      => $preparation_detail['id'],
            'name'    => $preparation_detail['product_name'],
            'qty'     => 1,
            'price'     => $this->calculate($preparation_detail)['price'],
            'weight'     => 1,
            'options' => [
                'sub_total'             => $this->calculate($preparation_detail)['sub_total'],
                'unit_price'            => $this->calculate($preparation_detail)['unit_price'],
                'product_id'            => $preparation_detail['product_id'],
                'code'                  => $preparation_detail['product_code'],
                'stock'                 => $preparation_detail['product_quantity'],
                'product_patient'       => $preparation_detail['product_patient'],
                'product_outside_company'  => $preparation_detail['product_outside_company'],
                'product_info'    => $preparation_detail['product_info'],
                'product_area'           => $preparation_detail['product_area'],
                'product_type_process'           => $preparation_detail['product_type_process'],
                'product_package_wrap'  =>  'Tela Tejida',
                'product_ref_qr'        =>  'Cargado',
                'product_eval_package'   => "OK",
                'product_eval_indicator' =>  '4',
                'product_operator_package'    => 'N/A',
                'product_expiration' =>  $this->expiration_data,
            ]
        ]);

        // Inicializar propiedades del componente
        $this->item_patient[$preparation_detail['id']] = $preparation_detail['product_patient'];
        $this->item_product_info[$preparation_detail['id']] = $preparation_detail['product_info'];
        $this->check_quantity[$preparation_detail['id']] = $preparation_detail['product_quantity'];
        $this->quantity[$preparation_detail['id']] = 1;
        $this->item_area[$preparation_detail['id']] = $preparation_detail['product_area'];
        $this->item_outside_company[$preparation_detail['id']] = $preparation_detail['product_outside_company'];
        $this->package_wrap[$preparation_detail['id']] = 'Tela Tejida';
        $this->ref_qr[$preparation_detail['id']] = 'Cargado';
        $this->eval_package[$preparation_detail['id']] = 'OK';
        $this->eval_indicator[$preparation_detail['id']] = '4';
        $this->expiration[$preparation_detail['id']] = '14';
        $this->operator_package[$preparation_detail['id']] = 'N/A';
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function incrementQuantity($row_id, $product_id)
    {
        $currentQuantity = $this->quantity[$product_id] ?? 0;
        $newQuantity = $currentQuantity + 1;

        // Validar stock antes de incrementar (solo para labelqr)
        if ($this->cart_instance == 'labelqr') {
            $availableStock = $this->getAvailableStock($product_id);

            if ($newQuantity > $availableStock) {
                session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . $availableStock . ' en STOCK PREPARACIÓN');
                return;
            }
        }

        // Incrementar la cantidad en el array local
        $this->quantity[$product_id] = $newQuantity;

        // Actualizar el carrito automáticamente
        $this->updateQuantity($row_id, $product_id);
    }


    // Método para decrementar cantidad
    public function decrementQuantity($row_id, $product_id)
    {
        $currentQuantity = $this->quantity[$product_id] ?? 1;
        // Solo decrementar si la cantidad es mayor a 1
        if ($currentQuantity > 1) {
            $this->quantity[$product_id] = $currentQuantity - 1;

            // Actualizar el carrito automáticamente
            $this->updateQuantity($row_id, $product_id);
        }
    }

    // Método auxiliar para obtener el stock disponible
    private function getAvailableStock($product_id)
    {
        $stockData = $this->check_quantity[$product_id] ?? 0;

        if (is_array($stockData)) {
            return (int)implode('', $stockData);
        }

        return (int)$stockData;
    }


    public function updateQuantity($row_id, $product_id)
    {
        if ($this->cart_instance == 'labelqr') {
            $array = $this->check_quantity[$product_id];
            if (is_array($array)) {
                if (implode('', $this->check_quantity[$product_id]) < $this->quantity[$product_id]) {
                    session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . implode('', $this->check_quantity[$product_id]) . ' en STOCK PREPARACIÓN');

                    // Revertir la cantidad al valor anterior válido
                    $availableStock = (int)implode('', $this->check_quantity[$product_id]);
                    if ($this->quantity[$product_id] > $availableStock) {
                        $this->quantity[$product_id] = $availableStock;
                    }
                    return;
                }
            } else {
                if ($this->check_quantity[$product_id] < $this->quantity[$product_id]) {
                    session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . $this->check_quantity[$product_id] . ' en STOCK PREPARACIÓN');

                    // Revertir la cantidad al valor anterior válido
                    if ($this->quantity[$product_id] > $this->check_quantity[$product_id]) {
                        $this->quantity[$product_id] = $this->check_quantity[$product_id];
                    }
                    return;
                }
            }
        }

        Cart::instance($this->cart_instance)->update($row_id, $this->quantity[$product_id]);

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'sub_total'             => $cart_item->price * $cart_item->qty,
                'product_id'      => $cart_item->options->product_id,
                'code'                   => $cart_item->options->code,
                'unit_price'            => $cart_item->options->unit_price,
                'stock'                 => $cart_item->options->stock,
                'product_patient'    => $cart_item->options->product_patient,
                'preparation_detail_id'      => $cart_item->options->preparation_detail_id,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,
                'product_info'    => $cart_item->options->product_info,
                'product_operator_package'    => $cart_item->options->product_operator_package,

            ]
        ]);
    }

    public function calculate(
        $product,
        $new_price = null
    ) {
        if ($new_price) {
            $product_price = $new_price;
            $product_quantity = 1; // Para productos nuevos, siempre 1
        } else {
            $this->unit_price[$product['id']] = $product['price'];
            $product_price = $this->unit_price[$product['id']];

            // Para productos nuevos, la cantidad debe ser 1, no el stock total
            $this->quantity[$product['id']] = 1; // Cambio aquí: siempre 1 para productos nuevos
            $product_quantity = $this->quantity[$product['id']];
        }

        $price = $product_price;
        $unit_price = $product_price;
        $sub_total = $product_price * $product_quantity; // Corregido: multiplicar precio por cantidad


        return ['price' => $price, 'unit_price' => $unit_price, 'sub_total' => $sub_total];
    }



    public function InputWrap_package($preparation_detail_id, $row_id)
    {
        $this->updateDataInput($row_id, $preparation_detail_id);
    }

    public function updateDataInput($row_id, $preparation_detail_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'sub_total'                  => $cart_item->price * $cart_item->qty,
                'code'                       => $cart_item->options->code,
                'product_id'                 => $cart_item->options->product_id,
                'stock'                      => $cart_item->options->stock,
                'preparation_detail_id'      => $cart_item->options->preparation_detail_id,
                'unit_price'                 => $cart_item->options->unit_price,
                'product_package_wrap'       => $cart_item->options->product_package_wrap,
                'product_ref_qr'             => $cart_item->options->product_ref_qr,
                'product_eval_package'       => $cart_item->options->product_eval_package,
                'product_eval_indicator'     => $cart_item->options->product_eval_indicator,
                'product_expiration'         => $cart_item->options->product_expiration,
                'product_type_process'       => $cart_item->options->product_type_process,
                'product_patient'            => $cart_item->options->product_patient,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'               => $cart_item->options->product_area,
                'product_info'               => $cart_item->options->product_info,
                'product_operator_package'   => $cart_item->options->product_operator_package,

            ]
        ]);
    }

    public function setProductoptions($row_id, $preparation_detail_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $preparation_detail_id, $cart_item);


        session()->flash('message_InputWrap_package' . $preparation_detail_id, 'Observaciones añadidos...!');
    }

    public function updateCartOptions($row_id, $preparation_detail_id, $cart_item)
    {

        if ($this->package_wrap[$preparation_detail_id] == "Contenedor") {
            $this->expiration = '365';
            $this->eval_indicator = '5';
        } elseif ($this->package_wrap[$preparation_detail_id] == "Papel Mixto") {
            $this->expiration = '180';
            $this->eval_indicator = '5';
        } elseif ($this->package_wrap[$preparation_detail_id] == "Tela Tejida") {
            $this->expiration = '14';
            $this->eval_indicator = '4';
        } elseif ($this->package_wrap[$preparation_detail_id] == "Tela No Tejida") {
            $this->expiration = '180';
            $this->eval_indicator = '5';
        }

        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'sub_total'             => $cart_item->price * $cart_item->qty,
            'code'                  => $cart_item->options->code,
            'product_id'            => $cart_item->options->product_id,
            'stock'                 => $cart_item->options->stock,
            'preparation_detail_id'      => $cart_item->options->preparation_detail_id,
            'product_type_process'  => $cart_item->options->product_type_process,
            'product_package_wrap'  => $this->package_wrap[$preparation_detail_id],
            'product_ref_qr'        => $this->ref_qr[$preparation_detail_id],
            'unit_price'        => $this->unit_price[$preparation_detail_id],
            'product_eval_package'  => $this->eval_package[$preparation_detail_id],
            'product_eval_indicator' => $this->eval_indicator,
            'product_expiration'   =>  $this->expiration,
            'product_patient'   => $this->item_patient[$preparation_detail_id],
            'product_area'   => $this->item_area[$preparation_detail_id],
            'product_outside_company'   => $this->item_outside_company[$preparation_detail_id],
            'product_info'   => $this->item_product_info[$preparation_detail_id],
            'product_operator_package'   => $this->operator_package[$preparation_detail_id],

        ]]);
    }
}
