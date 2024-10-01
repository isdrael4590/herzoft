<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ProductCarttoSUB2 extends Component
{

    public $listeners = ['selectSubProduct'];

    public $cart_instance;

    public $data;
    public $subcode;
    public $quantity;

    
    private $subproduct;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->subcode[$cart_item->id] = $cart_item->options->product_subcode;
                $this->quantity[$cart_item->id] = $cart_item->options->qty;

            }
        } else {
            
            $this->subcode = [];
            $this->quantity = [];

        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoSUB', [
            'cart_items' => $cart_items
        ]);
    }

    public function selectSubProduct($subproduct)
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
            'name'    => $subproduct['subproduct_name'],
            'qty'     => 1,
            'price'     => 1,
            'weight'     => 1,

            'options' => [
                'subcode'    => $subproduct['subproduct_code'],
            ]

        ]);
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }
  

    
    public function updateDataInput($row_id, $subproduct_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'subcode'                 => $cart_item->options->subcode,

            ]
        ]);
    }

    public function setProductoptions($row_id, $subproduct_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $subproduct_id, $cart_item);
  

        session()->flash('message_inputsubproduct' . $subproduct_id, 'Observaciones añadidos...!');
    }


    public function updateCartOptions($row_id, $subproduct_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'subcode'                  => $cart_item->options->subcode,
            'qty'                      => $this->quantity[$subproduct_id],
        ]]);
    }
}
