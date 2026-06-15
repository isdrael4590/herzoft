<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductCartWasher extends Component
{
    public $listeners = ['productSelected', 'inputDyrtState'];

    public $cart_instance;
    public $data;

    public array $type_dirt          = [];
    public array $state_rumed        = [];
    public array $type_process       = [];
    public array $quantity           = [];
    public array $check_quantity     = [];
    public array $item_patient       = [];
    public array $item_product_info  = [];
    public array $item_outside_company = [];
    public array $item_area          = [];
    public array $unit_price         = [];

    public $reception_id = null;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
        }

        foreach (Cart::instance($this->cart_instance)->content() as $cart_item) {
            $id = $cart_item->id;
            $this->quantity[$id]              = $cart_item->qty;
            $this->unit_price[$id]            = $cart_item->price;
            $this->check_quantity[$id]        = $cart_item->options->product_quantity ?? 999;
            $this->item_outside_company[$id]  = $cart_item->options->product_outside_company;
            $this->item_area[$id]             = $cart_item->options->product_area;
            $this->item_patient[$id]          = $cart_item->options->product_patient;
            $this->item_product_info[$id]     = $cart_item->options->product_info;
            $this->type_dirt[$id]             = $cart_item->options->product_type_dirt;
            $this->state_rumed[$id]           = $cart_item->options->product_state_rumed;
            $this->type_process[$id]          = $cart_item->options->product_type_process;
        }
    }

    public function render()
    {
        return view('livewire.product-cart-washer', [
            'cart_items' => Cart::instance($this->cart_instance)->content(),
        ]);
    }

    public function productSelected($product)
    {
        $cart = Cart::instance($this->cart_instance);
        $id   = $product['id'];

        $productQuantity = 1;

        $exists = $cart->search(fn ($cartItem) => $cartItem->id == $id);

        if ($exists->isNotEmpty()) {
            $rowId    = $exists->keys()->first();
            $cartItem = $cart->get($rowId);
            $newQty   = $cartItem->qty + $productQuantity;

            $cart->update($rowId, [
                'qty'     => $newQty,
                'options' => array_merge($this->baseOptions($cartItem), [
                    'product_quantity' => $newQty,
                    'sub_total'        => $cartItem->price * $newQty,
                    'unit'             => $cartItem->options->unit ?? ($product['product_unit'] ?? ''),
                    'code'             => $cartItem->options->code ?? ($product['product_code'] ?? ''),
                    'product_type_process'    => $cartItem->options->product_type_process ?? ($product['product_type_process'] ?? ''),
                    'product_patient'         => $cartItem->options->product_patient ?? ($product['product_patient'] ?? ''),
                    'product_info'            => $cartItem->options->product_info ?? ($product['product_info'] ?? ''),
                    'product_area'            => $cartItem->options->product_area ?? ($product['area'] ?? ''),
                    'product_type_dirt'       => $cartItem->options->product_type_dirt ?? 'CRITICO',
                    'product_state_rumed'     => $cartItem->options->product_state_rumed ?? 'BUENO',
                    'product_outside_company' => $cartItem->options->product_outside_company ?? '',
                ]),
            ]);

            $this->quantity[$id] = $newQty;
            session()->flash('message', 'Cantidad actualizada: ' . $newQty);
            return;
        }

        $calculated = $this->calculate($product);

        $maxQuantity = (int) ($product['product_quantity'] ?? 999);

        $cart->add([
            'id'     => $id,
            'name'   => $product['product_name'],
            'qty'    => $productQuantity,
            'price'  => $calculated['price'],
            'weight' => 1,
            'options' => [
                'sub_total'               => $calculated['sub_total'],
                'unit_price'              => $calculated['unit_price'],
                'product_id'              => $product['product_id'] ?? null,
                'unit'                    => $product['product_unit'] ?? '',
                'code'                    => $product['product_code'] ?? '',
                'product_quantity'        => $maxQuantity,
                'product_type_process'    => $product['product_type_process'] ?? '',
                'product_patient'         => $product['product_patient'] ?? '',
                'product_info'            => $product['product_info'] ?? '',
                'product_area'            => $product['product_area'] ?? '',
                'product_type_dirt'       => 'CRITICO',
                'product_state_rumed'     => 'BUENO',
                'product_outside_company' => $product['product_outside_company'] ?? '',
            ],
        ]);

        $this->check_quantity[$id]        = $maxQuantity;
        $this->item_patient[$id]          = $product['product_patient'] ?? '';
        $this->item_product_info[$id]     = $product['product_info'] ?? '';
        $this->item_area[$id]             = $product['product_area'] ?? '';
        $this->item_outside_company[$id]  = '';
        $this->quantity[$id]              = $productQuantity;
        $this->type_dirt[$id]             = 'CRITICO';
        $this->state_rumed[$id]           = 'BUENO';

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
            'product_type_process'    => $cart_item->options->product_type_process,
            'product_type_dirt'       => $this->type_dirt[$product_id],
            'product_state_rumed'     => $this->state_rumed[$product_id],
            'product_patient'         => $this->item_patient[$product_id],
            'product_info'            => $this->item_product_info[$product_id],
            'product_area'            => $this->item_area[$product_id],
            'product_outside_company' => $this->item_outside_company[$product_id],
            'sub_total'               => $cart_item->price * $cart_item->qty,
            'unit_price'              => $cart_item->options->unit_price,
            'unit'                    => $cart_item->options->unit,
        ]]);
    }

    private function calculate($product, $new_price = null): array
    {
        if ($new_price) {
            $product_price    = $new_price;
            $product_quantity = $this->quantity[$product['id']] ?? 1;
        } else {
            $product_price    = $product['product_price'] ?? 0;
            $product_quantity = $product['product_quantity'] ?? 1;
            $this->unit_price[$product['id']] = $product_price;
            $this->quantity[$product['id']]   = $product_quantity;
        }

        return [
            'price'      => $product_price,
            'unit_price' => $product_price,
            'sub_total'  => $product_quantity,
        ];
    }

    private function baseOptions($cart_item): array
    {
        return [
            'product_id'              => $cart_item->options->product_id,
            'unit'                    => $cart_item->options->unit,
            'unit_price'              => $cart_item->options->unit_price,
            'code'                    => $cart_item->options->code,
            'product_type_dirt'       => $cart_item->options->product_type_dirt,
            'product_state_rumed'     => $cart_item->options->product_state_rumed,
            'product_type_process'    => $cart_item->options->product_type_process,
            'product_patient'         => $cart_item->options->product_patient,
            'product_info'            => $cart_item->options->product_info,
            'product_outside_company' => $cart_item->options->product_outside_company,
            'product_area'            => $cart_item->options->product_area,
        ];
    }
}
