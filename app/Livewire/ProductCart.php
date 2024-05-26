<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCart extends Component
{

    public $listeners = ['productSelected', 'inputDyrtState'];

    public $cart_instance;

    public $data;
    public $type_dirt;
    public $state_rumed;
    public $type_process;

    
    private $product;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->type_dirt[$cart_item->id] = $cart_item->options->product_type_dirt;
                $this->state_rumed[$cart_item->id] = $cart_item->options->product_state_rumed;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;

            }
        } else {
            
            $this->type_dirt = [];
            $this->state_rumed = [];
            $this->type_process = [];

        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-cart', [
            'cart_items' => $cart_items
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
            'qty'     => 1,
            'price'     => 1,
            'weight'     => 1,

            'options' => [
                'code'    => $product['product_code'],
                'product_type_process'    => $product['product_type_process'],
                'product_type_dirt' => 'CRITICO', //ESTE ES EL DATO A MODIFICAR
                'product_state_rumed' => 'BUENO' //ESTE ES EL DATO A MODIFICAR
            ]

        ]);
        $this->type_dirt[$product['id']] = 'CRITICO';
        $this->state_rumed[$product['id']] = 'BUENO';
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }
  
    public function inputDyrtState($product_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $product_id); // se añade
    } // se añade

    
    public function updateDataInput($row_id, $product_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'code'                   => $cart_item->options->code,
                'product_type_dirt'      => $cart_item->options->product_type_dirt,
                'product_state_rumed'    => $cart_item->options->product_state_rumed,
                'product_type_process'    => $cart_item->options->product_type_process,

            ]
        ]);
    }

    public function setProductoptions($row_id, $product_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $product_id, $cart_item);
  

        session()->flash('message_inputDyrtState' . $product_id, 'Observaciones añadidos...!');
    }


    public function updateCartOptions($row_id, $product_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code'                  => $cart_item->options->code,
            'product_type_process'=> $cart_item->options->product_type_process,
            'product_type_dirt'     => $this->type_dirt[$product_id],
            'product_state_rumed'   => $this->state_rumed[$product_id],
        ]]);
    }
}
