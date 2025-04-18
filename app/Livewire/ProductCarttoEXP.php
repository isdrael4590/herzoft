<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\StockDetails;

class ProductCarttoEXP extends Component
{

    public $listeners = ['productSelected'];
    public $cart_instance;
    public $data;
    public $package_wrap;
    public $ref_qr;

    public $expiration;
    public $type_process;

    public $quantity;
    public $check_quantity;
    public $item_patient;
    public $item_product_info;
    public $item_outside_company;
    public $item_area;

    public $unit_price;

    private $stock_detail;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;
        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->check_quantity[$cart_item->id] = [$cart_item->options->stock];
                $this->unit_price[$cart_item->id] = $cart_item->price; // se añade
                $this->item_outside_company[$cart_item->id] = $cart_item->options->product_outside_company; // se añade
                $this->item_area[$cart_item->id] = $cart_item->options->product_area; // se añade
                $this->item_patient[$cart_item->id] = $cart_item->options->product_patient;
                $this->package_wrap[$cart_item->id] = $cart_item->options->product_package_wrap;
                $this->ref_qr[$cart_item->id] = $cart_item->options->product_ref_qr;

                $this->expiration[$cart_item->id] = $cart_item->options->product_expiration;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
                $this->item_product_info[$cart_item->id] = $cart_item->options->product_info;
            }
        } else {

            $this->package_wrap = [];
            $this->ref_qr = [];
            $this->expiration = [];
            $this->type_process = [];
            $this->check_quantity = [];
            $this->quantity = [];
            $this->item_patient = [];
            $this->unit_price = []; // se añade
            $this->item_outside_company = []; // se añade
            $this->item_area = []; // se añade
            $this->item_product_info = [];
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoEXP', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($stock_detail)
    {
        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem, $rowId) use ($stock_detail) {
            return $cartItem->id == $stock_detail['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');

            return;
        }

        $this->stock_detail = $stock_detail;

        $cart->add([
            'id'      => $stock_detail['id'],
            'name'    => $stock_detail['product_name'],
            'qty'     => 1,
            'price'     => $this->calculate($stock_detail)['price'],
            'weight'     => 1,

            'options' => [
                'sub_total'             => $this->calculate($stock_detail)['sub_total'], // se añade
                'unit_price'            => $this->calculate($stock_detail)['unit_price'], // se añade
                'product_id'            => $stock_detail['product_id'],
                'code'                  => $stock_detail['product_code'],
                'stock'                 => $stock_detail['product_quantity'],
                'product_patient'       => $stock_detail['product_patient'],
                'product_type_process'  => $stock_detail['product_type_process'],
                'product_package_wrap'  => $stock_detail['product_package_wrap'],
                'product_ref_qr'        => $stock_detail['product_ref_qr'],
                'product_expiration'    => $stock_detail['product_expiration'],
                'product_outside_company'    => $stock_detail['product_outside_company'],
                'product_area'    => $stock_detail['product_area'],
                'product_info'         => $stock_detail['product_info'],
            ]
        ]);
        $this->item_patient[$stock_detail['id']] = $stock_detail['product_patient'];
        $this->item_product_info[$stock_detail['id']] = $stock_detail['product_info'];

        // $this->quantity[$stock_detail['id']] = $stock_detail['product_quantity'];
        $this->item_area[$stock_detail['id']] = $stock_detail['product_area'];
        $this->item_outside_company[$stock_detail['id']] = $stock_detail['product_outside_company'];

        $this->check_quantity[$stock_detail['id']] = $stock_detail['product_quantity'];
        $this->quantity[$stock_detail['id']] = 1;
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }


    public function updateQuantity($row_id, $product_id)
    {

        if ($this->cart_instance == 'expedition') {
            $array = $this->check_quantity[$product_id];
            if (is_array($array)) {
                if (implode('', $this->check_quantity[$product_id]) < $this->quantity[$product_id]) {
                    session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . implode('', $this->check_quantity[$product_id]) . ' en STOCK ALMACEN');
                    return;
                }
            } else {
                if ($this->check_quantity[$product_id] < $this->quantity[$product_id]) {
                    session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . $this->check_quantity[$product_id] . ' en STOCK ALMACEN');
                    return;
                }
            }
        }
        Cart::instance($this->cart_instance)->update($row_id, $this->quantity[$product_id]);

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'sub_total'             => $cart_item->price * $cart_item->qty, // se añade
                'product_id'      => $cart_item->options->product_id,
                'code'                   => $cart_item->options->code,
                'unit_price'            => $cart_item->options->unit_price, // se añade
                'stock'                 => $cart_item->options->stock,
                'product_patient'    => $cart_item->options->product_patient,
                'stock_detail_id'      => $cart_item->options->stock_detail_id,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,
                'product_info'    => $cart_item->options->product_info,

            ]
        ]);
    }
    public function calculate($product, $new_price = null)
    {
        if ($new_price) {
            $product_price = $new_price;
        } else {
            $this->unit_price[$product['id']] = $product['price'];
            $product_price = $this->unit_price[$product['id']];
            $this->quantity[$product['id']] = $product['product_quantity'];
            $product_quantity =  $this->quantity[$product['id']];
        }

        $price = 0;
        $unit_price = 0;
        $sub_total = 0;

        $price = $product_price;
        $unit_price = $product_price;
        $sub_total = $product_quantity;

        return ['price' => $price, 'unit_price' => $unit_price, 'sub_total' => $sub_total];
    }
}
