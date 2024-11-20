<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCarttoPRE extends Component
{

    public $listeners = ['productSelected'];

    public $cart_instance;
 
    public $data;
    public $state_preparation;
    public $coming_zone ;
    public $type_process;
    public $quantity;
    public $check_quantity;
    public $item_patient;
    public $unit_price;



    private $product;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;
        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->unit_price[$cart_item->id] = $cart_item->price; // se añade

                $this->item_patient[$cart_item->id] = $cart_item->options->product_patient;
                $this->state_preparation[$cart_item->id] = $cart_item->options->product_state_preparation;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
                $this->coming_zone[$cart_item->id] = $cart_item->options->product_coming_zone;
            }
        } else {
            
            $this->state_preparation = [];
            $this->type_process = [];
            $this->coming_zone = [];
            $this->check_quantity = [];
            $this->quantity = [];
            $this->item_patient = [];
            $this->unit_price = []; // se añade

        }
      
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoPRE', [
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

            ]


        ]);
        $this->state_preparation[$product['id']] = 'Disponible';
        $this->item_patient[$product['id']] = $product['product_patient'];
        $this->quantity[$product['id']] = $product['product_quantity'];


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

           

        ]]);
    }
}
