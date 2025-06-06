<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductCarttoQRHPO extends Component
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
    public $unit_price;
    public $quantity;
    public $check_quantity;
    public $item_patient;
    public $item_outside_company;
    public $item_area;
    public $item_product_info;
    public $operator_package;
    public $expiration_data = 270; // Default value



    private $preparation_detail;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;
        if ($data) {
            $this->data = $data;
            $cart_items = Cart::instance($this->cart_instance)->content();

            foreach ($cart_items as $cart_item) {
                $this->check_quantity[$cart_item->id] = [$cart_item->options->stock];
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->unit_price[$cart_item->id] = $cart_item->price; // se añade
                $this->item_patient[$cart_item->id] = $cart_item->options->product_patient;
                $this->package_wrap[$cart_item->id] = $cart_item->options->product_package_wrap;
                $this->ref_qr[$cart_item->id] = $cart_item->options->product_ref_qr;
                $this->eval_package[$cart_item->id] = $cart_item->options->product_eval_package;
                $this->eval_indicator[$cart_item->id] = $cart_item->options->product_eval_indicator;
                // $this->expiration[$cart_item->id] = $cart_item->options->product_expiration;
                $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
                $this->item_outside_company[$cart_item->id] = $cart_item->options->product_outside_company; // se añade
                $this->item_area[$cart_item->id] = $cart_item->options->product_area; // se añade
                $this->item_product_info[$cart_item->id] = $cart_item->options->product_info;
                $this->operator_package[$cart_item->id] = $cart_item->options->product_operator_package;
            }
        } else {

            $this->package_wrap = [];
            $this->ref_qr = [];
            $this->eval_package = [];
            $this->eval_indicator = [];
            // $this->expiration = [];
            $this->type_process = [];
            $this->check_quantity = [];
            $this->quantity = [];
            $this->item_patient = [];
            $this->unit_price = []; // se añade
            $this->item_outside_company = []; // se añade
            $this->item_area = []; // se añade
            $this->item_product_info = [];
            $this->operator_package = [];
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoQRHPO', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($preparation_detail)
    {
        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem, $rowId) use ($preparation_detail) {
            return $cartItem->id == $preparation_detail['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');

            return;
        }

        $this->preparation_detail = $preparation_detail;
        // if ($preparation_detail['product_type_process'] == 'Alta Temperatura') {
        //     $this->expiration_data = 14;
        // } else {
        //     $this->expiration_data = 270;
        // }


        $cart->add([
            'id'      => $preparation_detail['id'],
            'name'    => $preparation_detail['product_name'],
            'qty'     => 1,
            'price'     => $this->calculate($preparation_detail)['price'],
            'weight'     => 1,

            'options' => [
                'sub_total'             => $this->calculate($preparation_detail)['sub_total'], // se añade
                'unit_price'            => $this->calculate($preparation_detail)['unit_price'], // se añade
                'product_id'            => $preparation_detail['product_id'],
                'code'                  => $preparation_detail['product_code'],
                'stock'                 => $preparation_detail['product_quantity'],
                'product_patient'       => $preparation_detail['product_patient'],
                'product_outside_company'  => $preparation_detail['product_outside_company'],
                'product_info'    => $preparation_detail['product_info'],
                'product_area'           => $preparation_detail['product_area'],
                'product_type_process'           => $preparation_detail['product_type_process'],
                'product_package_wrap'  =>  'Papel Tyvek',
                'product_ref_qr'        =>  'Cargado',
                'product_eval_package'   => "OK",
                'product_eval_indicator' =>  '4',
                'product_operator_package'    => 'N/A',
                'product_expiration' =>  '270',
            ]
        ]);
        $this->item_patient[$preparation_detail['id']] = $preparation_detail['product_patient'];
        $this->item_product_info[$preparation_detail['id']] = $preparation_detail['product_info'];

        $this->check_quantity[$preparation_detail['id']] = $preparation_detail['product_quantity'];
        $this->quantity[$preparation_detail['id']] = 1;

        $this->item_area[$preparation_detail['id']] = $preparation_detail['product_area'];
        $this->item_outside_company[$preparation_detail['id']] = $preparation_detail['product_outside_company'];

        $this->package_wrap[$preparation_detail['id']] = 'Papel Tyvek';
        $this->ref_qr[$preparation_detail['id']] = 'Cargado';

        $this->eval_package[$preparation_detail['id']] = 'OK';
        $this->eval_indicator[$preparation_detail['id']] = '4';
        // $this->expiration[$preparation_detail['id']] = '270';
        $this->operator_package[$preparation_detail['id']] = 'N/A';
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }

    public function updateQuantity($row_id, $product_id)
    {
        if ($this->cart_instance == 'labelqr') {
            //| dd("prunea",$this->quantity[$product_id]);

            $array = $this->check_quantity[$product_id];
            if (is_array($array)) {
                if (implode('', $this->check_quantity[$product_id]) < $this->quantity[$product_id]) {
                    session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . implode('', $this->check_quantity[$product_id]) . ' en STOCK PREPARACIÓN');
                    return;
                }
            } else {
                if ($this->check_quantity[$product_id] < $this->quantity[$product_id]) {
                    session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . $this->check_quantity[$product_id] . ' en STOCK PREPARACIÓN');
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
                'preparation_detail_id'      => $cart_item->options->preparation_detail_id,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,
                'product_info'    => $cart_item->options->product_info,
                'product_operator_package'    => $cart_item->options->product_operator_package,

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



    public function InputWrap_package($preparation_detail_id, $row_id)
    { // se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);
        if ($cart_item->options->product_package_wrap == "Papel Tyvek") {
            $this->expiration = '270';
        } elseif ($cart_item->options->product_package_wrap == "Tela Tejida") {
            $this->expiration = '180';
        }

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'sub_total'             => $cart_item->price * $cart_item->qty, // se añade
                'code'                   => $cart_item->options->code,
                'product_id'      => $cart_item->options->product_id,
                'stock'                 => $cart_item->options->stock,
                'preparation_detail_id'      => $cart_item->options->preparation_detail_id,
                'unit_price'            => $cart_item->options->unit_price, // se añade
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,
                'product_expiration'    => $this->expiration,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_patient'    => $cart_item->options->product_patient,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,
                'product_info'    => $cart_item->options->product_info,
                'product_operator_package'    => $cart_item->options->product_operator_package,

            ]
        ]);
    } // se añade



    public function setProductoptions($row_id, $preparation_detail_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $preparation_detail_id, $cart_item);


        session()->flash('message_InputWrap_package' . $preparation_detail_id, 'Observaciones añadidos...!');
    }

    public function updateCartOptions($row_id, $preparation_detail_id, $cart_item)
    {

        if ($this->package_wrap[$preparation_detail_id] == "Papel Tyvek") {
            $this->expiration = '270';
        } elseif ($this->package_wrap[$preparation_detail_id] == "Tela Tejida") {
            $this->expiration = '270';
        }
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [

            'sub_total'             => $cart_item->price * $cart_item->qty, // se añade
            'code'                  => $cart_item->options->code,
            'product_id'            => $cart_item->options->product_id,
            'stock'                 => $cart_item->options->stock,
            'preparation_detail_id'      => $cart_item->options->preparation_detail_id,
            'product_type_process'  => $cart_item->options->product_type_process,
            'product_package_wrap'  => $this->package_wrap[$preparation_detail_id],
            'product_ref_qr'        => $this->ref_qr[$preparation_detail_id],
            'unit_price'        => $this->unit_price[$preparation_detail_id],
            'product_eval_package'  => $this->eval_package[$preparation_detail_id],
            'product_eval_indicator' => $this->eval_indicator[$preparation_detail_id],
            'product_expiration'   =>  $this->expiration,
            'product_patient'   => $this->item_patient[$preparation_detail_id],
            'product_area'   => $this->item_area[$preparation_detail_id],
            'product_outside_company'   => $this->item_outside_company[$preparation_detail_id],
            'product_info'   => $this->item_product_info[$preparation_detail_id],
            'product_operator_package'   => $this->operator_package[$preparation_detail_id],

        ]]);
    }
}
