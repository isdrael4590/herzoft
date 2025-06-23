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
    public $quantity;
    public $check_quantity;
    public $item_patient;

    public $item_outside_company;
    public $item_area;
    public $unit_price;
    public $global_steril;
    public $global_no_steril;

    private $labelqr_detail;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;
        if ($data) {
            $this->data = $data;

            $cart_items = Cart::instance($this->cart_instance)->content();



            $this->UpdatedGlobalSteril();
            $this->UpdatedGlobalNOSteril();


            foreach ($cart_items as $cart_item) {
                $this->check_quantity[$cart_item->id] = [$cart_item->options->stock];
                $this->quantity[$cart_item->id] = $cart_item->qty;
                $this->unit_price[$cart_item->id] = $cart_item->price; // se añade
                $this->item_patient[$cart_item->id] = $cart_item->options->product_patient;
                $this->item_outside_company[$cart_item->id] = $cart_item->options->product_outside_company; // se añade
                $this->item_area[$cart_item->id] = $cart_item->options->product_area; // se añade
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
            $this->check_quantity = [];
            $this->quantity = [];
            $this->item_patient = [];
            $this->unit_price = []; // se añade
            $this->item_outside_company = []; // se añade
            $this->item_area = []; // se añade
            $this->global_steril = 0;
            $this->global_no_steril = 0;
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
            'price'     => $this->calculate($labelqr_detail)['price'], // se añade
            'weight'     => 1,

            'options' => [
                'sub_total'             => $this->calculate($labelqr_detail)['sub_total'], // se añade
                'unit_price'            => $this->calculate($labelqr_detail)['unit_price'], // se añade
                'unit'                  => $labelqr_detail['product_unit'], // se añade
                'product_id'    => $labelqr_detail['product_id'],
                'code'          => $labelqr_detail['product_code'],
                'stock'     => $labelqr_detail['product_quantity'],
                'product_patient'    => $labelqr_detail['product_patient'],
                'product_type_process'    => $labelqr_detail['product_type_process'],
                'product_outside_company'    => $labelqr_detail['product_outside_company'],
                'product_area'    => $labelqr_detail['product_area'],
                'product_package_wrap' =>  'Contenedor',
                'product_ref_qr' =>  'PRUEBA',
                'product_eval_package' => 'OK',
                'product_eval_indicator' =>  '4',
                'product_expiration' =>  '6'
            ]


        ]);
        $this->item_patient[$labelqr_detail['id']] = $labelqr_detail['product_patient'];
        //$this->quantity[$labelqr_detail['id']] = $labelqr_detail['product_quantity'];
        $this->check_quantity[$labelqr_detail['id']] = $labelqr_detail['product_quantity'];

        $this->item_area[$labelqr_detail['id']] = $labelqr_detail['product_area'];
        $this->item_outside_company[$labelqr_detail['id']] = $labelqr_detail['product_outside_company'];
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

    public function incrementQuantity($row_id, $product_id)
    {
        $currentQuantity = $this->quantity[$product_id] ?? 0;
        $newQuantity = $currentQuantity + 1;

        // Validar stock antes de incrementar (solo para labelqr)
        if ($this->cart_instance == 'labelqr') {
            $availableStock = $this->getAvailableStock($product_id);

            if ($newQuantity > $availableStock) {
                session()->flash('message', 'La cantidad Requerida NO ESTA DISPONIBLE en el STOCK. Solo hay ' . $availableStock . ' en STOCK PREPARACIÓN');
                return;
            }
        }

        // Incrementar la cantidad en el array local
        $this->quantity[$product_id] = $newQuantity;

        // Actualizar el carrito automáticamente
        $this->updateQuantity($row_id, $product_id);
    }


    // Método para decrementar cantidad
    public function decrementQuantity($row_id, $product_id)
    {
        $currentQuantity = $this->quantity[$product_id] ?? 1;
        // Solo decrementar si la cantidad es mayor a 1
        if ($currentQuantity > 1) {
            $this->quantity[$product_id] = $currentQuantity - 1;

            // Actualizar el carrito automáticamente
            $this->updateQuantity($row_id, $product_id);
        }
    }

    // Método auxiliar para obtener el stock disponible
    private function getAvailableStock($product_id)
    {
        $stockData = $this->check_quantity[$product_id] ?? 0;

        if (is_array($stockData)) {
            return (int)implode('', $stockData);
        }

        return (int)$stockData;
    }


    public function UpdatedGlobalSteril()
    {
        Cart::instance($this->cart_instance)->count((int)$this->global_steril);
    }

    public function UpdatedGlobalNOSteril()
    {
        Cart::instance($this->cart_instance)->count((int)$this->global_no_steril);
    }

    public function updateQuantity($row_id, $product_id)
    {
        if ($this->cart_instance == 'discharge') {
            // dd(implode('',$this->check_quantity[$product_id]),$this->quantity[$product_id]);
            if (implode('', $this->check_quantity[$product_id]) < $this->quantity[$product_id]) {
                session()->flash('message', 'La Validación de la cantidad ES INCORRECTA, Solo Existe:  ' . implode('', $this->check_quantity[$product_id]) . '  Paquetes Procesados');
                return;
            }


            $array = $this->check_quantity[$product_id];
            if (is_array($array)) {
                if (implode('', $this->check_quantity[$product_id]) < $this->quantity[$product_id]) {
                    session()->flash('message', 'La Validación de la cantidad ES INCORRECTA, Solo Existe:  ' . implode('', $this->check_quantity[$product_id]) . '  Paquetes Procesados');
                    return;
                }
            } else {
                if ($this->check_quantity[$product_id] < $this->quantity[$product_id]) {
                    session()->flash('message', 'La Validación de la cantidad ES INCORRECTA, Solo Existe:  ' . $this->check_quantity[$product_id] . '  Paquetes Procesados');
                    return;
                }
            }
        }

        Cart::instance($this->cart_instance)->update($row_id, $this->quantity[$product_id]);

        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'product_id'      => $cart_item->options->product_id,
                'sub_total'             => $cart_item->price * $cart_item->qty, // se añade
                'unit'                  => $cart_item->options->unit, // se añade
                'unit_price'            => $cart_item->options->unit_price, // se añade
                'code'                   => $cart_item->options->code,
                'stock'                 => $cart_item->options->stock,
                'product_patient'    => $cart_item->options->product_patient,
                'labelqr_detail_id'      => $cart_item->options->labelqr_detail_id,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,


            ]
        ]);
    }

    public function calculate($product, $new_price = null)
    {
        if ($new_price) {
            $product_price = $new_price;
        } else {
            $this->unit_price[$product['id']] = $product['product_price'];
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



    public function OutputWrap_package($labelqr_detail_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $labelqr_detail_id); // se añade
    } // se añade

    public function updateDataInput($row_id, $labelqr_detail_id)
    { // se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'code'                   => $cart_item->options->code,
                'product_id'      => $cart_item->options->product_id,
                'stock'                 => $cart_item->options->stock,
                'labelqr_detail_id'      => $cart_item->options->labelqr_detail_id,
                'product_package_wrap'      => $cart_item->options->product_package_wrap,
                'product_ref_qr'    => $cart_item->options->product_ref_qr,
                'product_eval_package'      => $cart_item->options->product_eval_package,
                'product_eval_indicator'    => $cart_item->options->product_eval_indicator,
                'product_expiration'    => $cart_item->options->product_expiration,
                'product_type_process'    => $cart_item->options->product_type_process,
                'product_patient'    => $cart_item->options->product_patient,
                'product_outside_company'    => $cart_item->options->product_outside_company,
                'product_area'    => $cart_item->options->product_area,
                'unit_price'            => $cart_item->options->unit_price, // se añade
                'sub_total'             => $cart_item->price * $cart_item->qty, // se añade

            ]
        ]);
    }

    public function setProductoptions($row_id, $labelqr_detail_id)
    {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        $this->updateCartOptions($row_id, $labelqr_detail_id, $cart_item);


        session()->flash('message_OutputWrap_package' . $labelqr_detail_id, 'Observaciones añadidos...!');
    }
    public function updateCartOptions($row_id, $labelqr_detail_id, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [
            'sub_total'             => $cart_item->price * $cart_item->qty, // se añade
            'code'                      => $cart_item->options->code,
            'product_id'                => $cart_item->options->product_id,
            'stock'                     => $cart_item->options->stock,
            'labelqr_detail_id'         => $cart_item->options->labelqr_detail_id,
            'product_type_process'      => $cart_item->options->product_type_process,
            'product_package_wrap'      => $this->package_wrap[$labelqr_detail_id],
            'product_ref_qr'            => $this->ref_qr[$labelqr_detail_id],
            'product_eval_package'      => $this->eval_package[$labelqr_detail_id],
            'product_eval_indicator'    => $this->eval_indicator[$labelqr_detail_id],
            'product_expiration'        => $this->expiration[$labelqr_detail_id],
            'product_patient'           => $this->item_patient[$labelqr_detail_id],
            'product_area'              => $this->item_area[$labelqr_detail_id],
            'product_outside_company'   => $this->item_outside_company[$labelqr_detail_id],
            'unit_price'                => $this->unit_price[$labelqr_detail_id],

        ]]);
    }
}
