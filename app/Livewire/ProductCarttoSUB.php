<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCarttoSUB extends Component
{

    public $listeners = ['productSelected', 'updateSubproduct'];

    public $cart_instance;

    public $data;

    public $type_process;
    public $quantity;
    public $subname;
    public $check_quantity;

    private $subproduct;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
            }
        } else {
            $this->quantity = [];
            $this->type_process = [];
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoSUB', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($subproduct)
    {
        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem, $rowId) use ($subproduct) {
            return $cartItem->id == $subproduct['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');
            return;
        }

        $this->subproduct = $subproduct;

        $cart->add([
            'id'      => $subproduct['id'],
            'name'    => $subproduct['product_name'],
            'qty'     => 1,
            'price'     => 1,
            'weight'     => 1,
            'options' => [
                'code'    => $subproduct['product_code'],
                'product_type_process'    => $subproduct['product_type_process'],

            ]

        ]);

        $this->quantity[$subproduct['id']] = 1;
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }


    public function updateSubproduct($subproduct_id, $row_id)
    {
        $this->updateDataInput($row_id, $subproduct_id);
    }


    public function updateDataInput($row_id, $subproduct_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'name'                   => $cart_item->name,
            'options' => [
                'code'                   => $cart_item->options->code,
                'product_type_process'   => $cart_item->options->product_type_process,

            ]

        ]);
    }

    public function setSubProductoptions($row_id, $subproduct_id)
    {

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);
      
        $this->updateCartOptions($row_id, $subproduct_id, $cart_item);
        dd($cart_item);
        session()->flash('message_updateSubproduct' . $subproduct_id, 'Observaciones añadidos...!');
    }



    public function updateCartOptions($row_id, $subproduct_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, [
            'name'                   => $cart_item->name,
            'options' => [

                'qty'                   => $this->quantity[$subproduct_id],
                'code'                  => $cart_item->options->code,
                'product_type_process'  => $cart_item->options->product_type_process,

            ]
        ]);
    }

}
