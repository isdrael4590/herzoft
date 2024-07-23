<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCarttoStock extends Component
{

    public $listeners = ['productSelected'];

    public $cart_instance;
 
    public $data;
    public $package_wrap;
    public $ref_qr;
    public $status_stock;
    public $date_sterilized;
    public $expiration;
    public $type_process;



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
                $this->status_stock[$cart_item->id] = $cart_item->options->product_status_stock;
                $this->expiration[$cart_item->id] = $cart_item->options->product_expiration;
                $this->date_sterilized[$cart_item->id] = $cart_item->options->product_date_sterilized;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
      
    
            }
        } else {
            
            $this->package_wrap = [];
            $this->ref_qr = [];
            $this->status_stock = [];
            $this->date_sterilized = [];
            $this->expiration = [];
            $this->type_process = [];

        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();
        return view('livewire.product-carttoStock', [
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
                'product_package_wrap' =>  $product['product_package_wrap'], //ESTE ES EL DATO A MODIFICAR
                'product_ref_qr' =>  $product['product_ref_qr'], //ESTE ES EL DATO A MODIFICAR
                'product_expiration' =>  $product['product_expiration'], //ESTE ES EL DATO A MODIFICAR
                'product_status_stock' =>  'Disponible', //ESTE ES EL DATO A MODIFICAR
                'product_date_sterilized' =>  $product['updated_at'],
                
            ]


        ]);
        $this->package_wrap[$product['id']] = 'Contenedor';
        $this->ref_qr[$product['id']] = 'PRUEBA';
        $this->status_stock[$product['id']] = 'Disponible';
        $this->date_sterilized[$product['id']] = '';
        $this->expiration[$product['id']] = '6';
    }

    

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function OutputStateStock($product_id, $row_id)
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
                'product_status_stock'      => $cart_item->options->product_status_stock,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_date_sterilized'    => $cart_item->options->product_date_sterilized,
                'product_type_process'    => $cart_item->options->product_type_process,
            ]
        ]);
    }

    public function setProductoptions($row_id, $product_id) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $product_id, $cart_item);
        session()->flash('message_OutputStateStock' . $product_id, 'Observaciones añadidos...!');
    }
    public function updateCartOptions($row_id, $product_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'code' => $cart_item->options->code,
            'product_package_wrap'      => $this->package_wrap[$product_id],
            'product_status_stock'     => $this->status_stock[$product_id],
            'product_expiration'   => $this->expiration[$product_id],
            'product_date_sterilized'   => $this->date_sterilized[$product_id],
        ]]);
    }
}
