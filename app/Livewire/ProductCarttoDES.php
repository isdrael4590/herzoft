<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCarttoDES extends Component
{

    public $listeners = ['productSelected'];

    public $cart_instance;
 
    public $data;
    public $package_wrap;
    public $ref_qr;
    public $eval_package;
    public $eval_indicator;

    private $product;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;
        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->package_wrap[$cart_item->id] = $cart_item->options->product_package_wrap;
                $this->ref_qr[$cart_item->id] = $cart_item->options->product_ref_qr;
                $this->eval_package[$cart_item->id] = $cart_item->options->product_eval_package;
                $this->eval_indicator[$cart_item->id] = $cart_item->options->product_eval_indicator;
            }
        } else {
            
            $this->package_wrap = [];
            $this->ref_qr = [];
            $this->eval_package = [];
            $this->eval_indicator = [];
        }
      
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoDES', [
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
                'product_package_wrap' =>  'Contenedor', //ESTE ES EL DATO A MODIFICAR
                'product_ref_qr' =>  'PRUEBA', //ESTE ES EL DATO A MODIFICAR
                'product_eval_package' => 'OK',//ESTE ES EL DATO A MODIFICAR
                'product_eval_indicator' =>  'OK'//ESTE ES EL DATO A MODIFICAR
            ]


        ]);
        $this->package_wrap[$product['id']] = 'Contenedor';
        $this->ref_qr[$product['id']] = 'PRUEBA';
        $this->eval_package[$product['id']] = 'OK';
        $this->eval_indicator[$product['id']] = 'OK';


    }

    

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function InputWrap_package($product_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $product_id); // se añade
    } // se añade

    public function updateDataInput($row_id, $product_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'code'                   => $cart_item->options->code,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,

            ]
        ]);
    }

    public function setProductoptions($row_id, $product_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $product_id, $cart_item);
  

        session()->flash('message_InputWrap_package' . $product_id, 'Observaciones añadidos...!');
    }
    public function updateCartOptions($row_id, $product_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code' => $cart_item->options->code,
            'product_package_wrap'     => $this->package_wrap[$product_id],
            'product_ref_qr'   => $this->ref_qr[$product_id],
            'product_eval_package'     => $this->eval_package[$product_id],
            'product_eval_indicator'   => $this->eval_indicator[$product_id],

        ]]);
    }
}
