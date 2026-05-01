<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductCarttoPRE extends Component
{

    public $listeners = ['productSelected'];

    public $cart_instance;
    public $readonly_qty = false;

    public $data;
    public $state_preparation;
    public $coming_zone ;
    public $type_process;
    public $quantity;
    public $check_quantity;
    public $item_patient;
    public $unit_price;
    public $item_product_info;




    private $product;

    public function mount($cartInstance, $data = null, $readonlyQty = false)
    {
        $this->cart_instance = $cartInstance;
        $this->readonly_qty = $readonlyQty;

        $this->state_preparation = [];
        $this->type_process = [];
        $this->coming_zone = [];
        $this->item_product_info = [];
        $this->check_quantity = [];
        $this->quantity = [];
        $this->item_patient = [];
        $this->unit_price = [];

        if ($data) {
            $this->data = $data;
        }

        foreach (Cart::instance($this->cart_instance)->content() as $cart_item) {
            $this->quantity[$cart_item->id]          = $cart_item->qty;
            $this->unit_price[$cart_item->id]        = $cart_item->price;
            $this->item_patient[$cart_item->id]      = $cart_item->options->product_patient;
            $this->state_preparation[$cart_item->id] = $cart_item->options->product_state_preparation;
            $this->type_process[$cart_item->id]      = $cart_item->options->product_type_process;
            $this->coming_zone[$cart_item->id]       = $cart_item->options->product_coming_zone;
            $this->item_product_info[$cart_item->id] = $cart_item->options->product_info;
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoPRE', [
            'cart_items'   => $cart_items,
            'readonly_qty' => $this->readonly_qty,
        ]);
    }

    public function productSelected($product)
    {
        $cart = Cart::instance($this->cart_instance);
       
        $exists = $cart->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id == $product['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');

            return;
        }

        $this->product = $product;
       
        $cart->add([
            'id'      => $product['id'],
            'name'    => $product['product_name'],
            'qty'     => $product['product_quantity'],
            'price'     => $this->calculate($product)['price'], // se añade
            'weight'     => 1,

            'options' => [
                'code'    => $product['product_code'],
                'sub_total'             => $this->calculate($product)['sub_total'], // se añade
                'unit_price'            => $this->calculate($product)['unit_price'], // se añade
                'unit'                  => $product['product_unit'], // se añade
                'product_type_process'    => $product['product_type_process'],
                'product_state_preparation'   => 'Disponible',
                'product_coming_zone'   => 'Recepcion',
                'product_patient'    => $product['product_patient'],
                'product_info'    => $product['product_info'],

            ]


        ]);
        $this->state_preparation[$product['id']] = 'Disponible';
        $this->item_patient[$product['id']]      = $product['product_patient'];
        $this->quantity[$product['id']]          = $product['product_quantity'];
        $this->item_product_info[$product['id']] = $product['product_info'];

        $this->dispatch('focusQuantity', productId: $product['id']);



    }

    public function calculate($product, $new_price = null)
    {
        if ($new_price) {
            $price = $new_price;
        } else {
            $this->unit_price[$product['id']] = $product['price'];
            $price = $this->unit_price[$product['id']];
            $this->quantity[$product['id']] = $product['product_quantity'];
            $product_quantity =  $this->quantity[$product['id']];
        }

        $price = 0;
        $unit_price = 0;
        $sub_total = 0;

        $price = $price;
        $unit_price = $price;
        $sub_total = $product_quantity;

        return ['price' => $price, 'unit_price' => $unit_price, 'sub_total' => $sub_total];
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
            'options' => [
                'code'                    => $cart_item->options->code,
                'product_quantity'        => $newQty,
                'sub_total'               => $cart_item->price * $newQty,
                'unit'                    => $cart_item->options->unit ?? '',
                'unit_price'              => $cart_item->options->unit_price ?? $cart_item->price,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_state_preparation' => $cart_item->options->product_state_preparation,
                'product_coming_zone'     => $cart_item->options->product_coming_zone,
                'product_patient'         => $cart_item->options->product_patient,
                'product_info'            => $cart_item->options->product_info,
            ],
        ]);

        $this->dispatch('qty-confirmed-' . $product_id, qty: $newQty);
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function inputPreparation($product_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $product_id); // se añade
    } // se añade

    public function updateDataInput($row_id, $product_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'product_quantity'             => $cart_item->qty,
                'code'                       => $cart_item->options->code,
                'product_state_preparation'  => $cart_item->options->product_state_preparation,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_coming_zone'    => $cart_item->options->product_coming_zone,
                'product_patient'    => $cart_item->options->product_patient,
                'product_info'    => $cart_item->options->product_info,

            ]
        ]);
    }

    public function setProductoptions($row_id, $product_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $product_id, $cart_item);
  

        session()->flash('message_inputPreparation' . $product_id, 'Observaciones añadidos...!');
    }
    public function updateCartOptions($row_id, $product_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code' => $cart_item->options->code,
            'product_quantity'             => $cart_item->qty,
            'product_type_process'=> $cart_item->options->product_type_process,
            'product_coming_zone'=> $cart_item->options->product_coming_zone,
            'product_state_preparation'     => $this->state_preparation[$product_id],
            'product_patient'   => $this->item_patient[$product_id],
            'product_info'   => $this->item_product_info[$product_id],

           

        ]]);
    }
}
