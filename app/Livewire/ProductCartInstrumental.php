<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductCartInstrumental extends Component
{
    public $listeners = ['instrumentalSelected', 'inputDyrtState'];

    public $cart_instance;
    public $data;

    public array $type_dirt           = [];
    public array $state_rumed         = [];
    public array $quantity            = [];
    public array $item_patient        = [];
    public array $item_product_info   = [];
    public array $item_outside_company = [];
    public array $item_area           = [];
    public array $unit_price          = [];

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
        }

        foreach (Cart::instance($this->cart_instance)->content() as $cart_item) {
            $id = $cart_item->id;
            $this->quantity[$id]               = $cart_item->qty;
            $this->unit_price[$id]             = $cart_item->price;
            $this->item_outside_company[$id]   = $cart_item->options->product_outside_company ?? '';
            $this->item_area[$id]              = $cart_item->options->product_area ?? '';
            $this->item_patient[$id]           = $cart_item->options->product_patient ?? '';
            $this->item_product_info[$id]      = $cart_item->options->product_info ?? '';
            $this->type_dirt[$id]              = $cart_item->options->product_type_dirt ?? 'CRITICO';
            $this->state_rumed[$id]            = $cart_item->options->product_state_rumed ?? 'BUENO';
        }
    }

    public function render()
    {
        return view('livewire.product-cart-instrumental', [
            'cart_items' => Cart::instance($this->cart_instance)->content(),
        ]);
    }

    public function instrumentalSelected($instrumental)
    {
        $cart = Cart::instance($this->cart_instance);
        $id   = $instrumental['id'];

        $exists = $cart->search(fn ($cartItem) => $cartItem->id == $id);

        if ($exists->isNotEmpty()) {
            $rowId    = $exists->keys()->first();
            $cartItem = $cart->get($rowId);
            $newQty   = $cartItem->qty + 1;

            $cart->update($rowId, [
                'qty'     => $newQty,
                'options' => array_merge($this->baseOptions($cartItem), [
                    'product_quantity' => $newQty,
                    'sub_total'        => $cartItem->price * $newQty,
                ]),
            ]);

            $this->quantity[$id] = $newQty;
            session()->flash('message', 'Cantidad actualizada: ' . $newQty);
            return;
        }

        $cart->add([
            'id'     => $id,
            'name'   => $instrumental['nombre_generico'],
            'qty'    => 1,
            'price'  => 0,
            'weight' => 1,
            'options' => [
                'sub_total'               => 1,
                'unit_price'              => 0,
                'unit'                    => 'UND',
                'code'                    => $instrumental['codigo_unico_ud'],
                'product_quantity'        => 1,
                'tipo_familia'            => $instrumental['tipo_familia'] ?? '',
                'marca_fabricante'        => $instrumental['marca_fabricante'] ?? '',
                'product_patient'         => '',
                'product_info'            => '',
                'product_area'            => '',
                'product_type_dirt'       => 'CRITICO',
                'product_state_rumed'     => 'BUENO',
                'product_outside_company' => '',
                'product_id'              => $instrumental['product_id'] ?? null,
            ],
        ]);

        $this->item_patient[$id]           = '';
        $this->item_product_info[$id]      = '';
        $this->item_area[$id]              = '';
        $this->item_outside_company[$id]   = '';
        $this->quantity[$id]               = 1;
        $this->type_dirt[$id]              = 'CRITICO';
        $this->state_rumed[$id]            = 'BUENO';

        $this->dispatch('focusQuantity', productId: $id);
    }

    public function incrementQuantity($row_id, $product_id)
    {
        $this->quantity[$product_id] = ($this->quantity[$product_id] ?? 0) + 1;
        $this->updateQuantity($row_id, $product_id);
    }

    public function decrementQuantity($row_id, $product_id)
    {
        if (($this->quantity[$product_id] ?? 1) > 1) {
            $this->quantity[$product_id]--;
            $this->updateQuantity($row_id, $product_id);
        }
    }

    public function setAndUpdateQuantity(string $row_id, int $product_id, int $qty): void
    {
        $this->quantity[$product_id] = max(1, $qty);
        $this->updateQuantity($row_id, $product_id);
    }

    public function updateQuantity($row_id, $product_id)
    {
        $cart      = Cart::instance($this->cart_instance);
        $cart_item = $cart->get($row_id);

        if (!$cart_item) {
            return;
        }

        $newQty = max(1, (int) ($this->quantity[$product_id] ?? 1));
        $this->quantity[$product_id] = $newQty;

        $cart->update($row_id, [
            'qty'     => $newQty,
            'options' => array_merge($this->baseOptions($cart_item), [
                'product_quantity' => $newQty,
                'sub_total'        => $cart_item->price * $newQty,
            ]),
        ]);

        $this->dispatch('qty-confirmed-' . $product_id, qty: $newQty);
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function inputDyrtState($_product_id, $row_id)
    {
        $this->updateDataInput($row_id);
    }

    public function updateDataInput(string $row_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => array_merge($this->baseOptions($cart_item), [
                'product_quantity' => $cart_item->qty,
                'sub_total'        => $cart_item->price * $cart_item->qty,
            ]),
        ]);
    }

    public function setProductoptions($row_id, $product_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);
        $this->updateCartOptions($row_id, $product_id, $cart_item);
        $this->dispatch('closeProductModal', productId: $product_id);
    }

    public function updateCartOptions($row_id, $product_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code'                    => $cart_item->options->code,
            'product_quantity'        => $cart_item->qty,
            'tipo_familia'            => $cart_item->options->tipo_familia,
            'marca_fabricante'        => $cart_item->options->marca_fabricante,
            'product_type_dirt'       => $this->type_dirt[$product_id],
            'product_state_rumed'     => $this->state_rumed[$product_id],
            'product_patient'         => $this->item_patient[$product_id],
            'product_info'            => $this->item_product_info[$product_id],
            'product_area'            => $this->item_area[$product_id],
            'product_outside_company' => $this->item_outside_company[$product_id],
            'sub_total'               => $cart_item->price * $cart_item->qty,
            'unit_price'              => $cart_item->options->unit_price,
            'unit'                    => $cart_item->options->unit,
            'product_id'              => $cart_item->options->product_id,
        ]]);
    }

    private function baseOptions($cart_item): array
    {
        return [
            'product_id'              => $cart_item->options->product_id,
            'unit'                    => $cart_item->options->unit,
            'unit_price'              => $cart_item->options->unit_price,
            'code'                    => $cart_item->options->code,
            'tipo_familia'            => $cart_item->options->tipo_familia,
            'marca_fabricante'        => $cart_item->options->marca_fabricante,
            'product_type_dirt'       => $cart_item->options->product_type_dirt,
            'product_state_rumed'     => $cart_item->options->product_state_rumed,
            'product_patient'         => $cart_item->options->product_patient,
            'product_info'            => $cart_item->options->product_info,
            'product_outside_company' => $cart_item->options->product_outside_company,
            'product_area'            => $cart_item->options->product_area,
        ];
    }
}
