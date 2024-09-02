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
    public $expiration;
    public $type_process;


    private $labelqr_detail;

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
                $this->expiration[$cart_item->id] = $cart_item->options->product_expiration;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;

            }
        } else {
            
            $this->package_wrap = [];
            $this->package_wrap = [];
            $this->ref_qr = [];
            $this->eval_package = [];
            $this->eval_indicator = [];
            $this->expiration = [];
            $this->type_process = [];

        }
      
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoDES', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($labelqr_detail)
    {
        $cart = Cart::instance($this->cart_instance);
       
        $exists = $cart->search(function ($cartItem, $rowId) use ($labelqr_detail) {
            return $cartItem->id == $labelqr_detail['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');

            return;
        }

        $this->labelqr_detail = $labelqr_detail;
       
        $cart->add([
            'id'      => $labelqr_detail['id'],
            'name'    => $labelqr_detail['product_name'],
            'qty'     => 1,
            'price'     => 1,
            'weight'     => 1,

            'options' => [
                'product_id' =>$labelqr_detail['product_id'],
                'code'    => $labelqr_detail['product_code'],
                'product_type_process'    => $labelqr_detail['product_type_process'],
                //'labelqr_detail_id'  => $labelqr_detail['labelqr_detail_id'],
                'product_package_wrap' =>  'Contenedor', //ESTE ES EL DATO A MODIFICAR
                'product_ref_qr' =>  'PRUEBA', //ESTE ES EL DATO A MODIFICAR
                'product_eval_package' => 'OK',//ESTE ES EL DATO A MODIFICAR
                'product_eval_indicator' =>  '4',//ESTE ES EL DATO A MODIFICAR
                'product_expiration' =>  '6'//ESTE ES EL DATO A MODIFICAR
            ]


        ]);
        $this->package_wrap[$labelqr_detail['id']] = 'Contenedor';
        $this->ref_qr[$labelqr_detail['id']] = 'PRUEBA';
        $this->eval_package[$labelqr_detail['id']] = 'OK';
        $this->eval_indicator[$labelqr_detail['id']] = '4';
        $this->expiration[$labelqr_detail['id']] = '6';


    }

    

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function inputPreparation($labelqr_detail_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $labelqr_detail_id); // se añade
    } // se añade

    public function updateDataInput($row_id, $labelqr_detail_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'code'                   => $cart_item->options->code,
                'product_id'      => $cart_item->options->product_id,
                'labelqr_detail_id'      => $cart_item->options->labelqr_detail_id,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_type_process'    => $cart_item->options->product_type_process,


            ]
        ]);
    }

    public function setProductoptions($row_id, $labelqr_detail_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $labelqr_detail_id, $cart_item);
  

        session()->flash('message_inputPreparation' . $labelqr_detail_id, 'Observaciones añadidos...!');
    }
    public function updateCartOptions($row_id, $labelqr_detail_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code' => $cart_item->options->code,
            'product_id'            => $cart_item->options->product_id,
            'labelqr_detail_id'      => $cart_item->options->labelqr_detail_id,
            'product_type_process'=> $cart_item->options->product_type_process,
            'product_package_wrap'     => $this->package_wrap[$labelqr_detail_id],
            'product_ref_qr'   => $this->ref_qr[$labelqr_detail_id],
            'product_eval_package'     => $this->eval_package[$labelqr_detail_id],
            'product_eval_indicator'   => $this->eval_indicator[$labelqr_detail_id],
            'product_expiration'   => $this->expiration[$labelqr_detail_id],


        ]]);
    }
}
