<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductCarttoREPROC extends Component
{

    public $listeners = ['productSelected'];

    public $cart_instance;

    public $data;
    public $type_dirt;
    public $state_rumed;
    public $type_process;
    public $quantity;

    private $discharge_detail;

    public function mount($cartInstance, $data = null)
    {
        $this->cart_instance = $cartInstance;

        $this->type_dirt    = [];
        $this->state_rumed  = [];
        $this->type_process = [];
        $this->quantity     = [];

        if ($data) {
            $this->data = $data;
        }

        foreach (Cart::instance($this->cart_instance)->content() as $cart_item) {
            $this->type_dirt[$cart_item->id]    = $cart_item->options->product_type_dirt;
            $this->state_rumed[$cart_item->id]  = $cart_item->options->product_state_rumed;
            $this->type_process[$cart_item->id] = $cart_item->options->product_type_process;
            $this->quantity[$cart_item->id]     = $cart_item->qty;
        }
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.product-carttoREPROC', [
            'cart_items' => $cart_items
        ]);
    }

    public function productSelected($discharge_detail)
    {
        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem, $rowId) use ($discharge_detail) {
            return $cartItem->id == $discharge_detail['id'];
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Product exists in the cart!');

            return;
        }

        $this->discharge_detail = $discharge_detail;

        $cart->add([
            'id'      => $discharge_detail['id'],
            'name'    => $discharge_detail['product_name'],
            'qty'     => 1,
            'price'     => 1,
            'weight'     => 1,

            'options' => [
                'code'    => $discharge_detail['product_code'],
                'product_id' =>$discharge_detail['product_id'],
                'product_type_process'    => $discharge_detail['product_type_process'],
                'product_type_dirt' => 'REPROCESADO', 
                'product_state_rumed' => 'BUENO' 
            ]

        ]);
        $this->type_dirt[$discharge_detail['id']]  = 'REPROCESADO';
        $this->state_rumed[$discharge_detail['id']] = 'BUENO';
        $this->quantity[$discharge_detail['id']]    = 1;

        $this->dispatch('focusQuantity', productId: $discharge_detail['id']);
    }

    public function incrementQuantity($row_id, $product_id)
    {
        $this->quantity[$product_id] = ($this->quantity[$product_id] ?? 0) + 1;
        $this->updateQuantity($row_id, $product_id);
    }

    public function decrementQuantity($row_id, $product_id)
    {
        if (($this->quantity[$product_id] ?? 1) > 1) {
            $this->quantity[$product_id]--;
            $this->updateQuantity($row_id, $product_id);
        }
    }

    public function setAndUpdateQuantity(string $row_id, int $product_id, int $qty): void
    {
        $this->quantity[$product_id] = max(1, $qty);
        $this->updateQuantity($row_id, $product_id);
    }

    public function updateQuantity($row_id, $product_id)
    {
        $cart      = Cart::instance($this->cart_instance);
        $cart_item = $cart->get($row_id);

        if (!$cart_item) {
            return;
        }

        $newQty = max(1, (int) ($this->quantity[$product_id] ?? 1));
        $this->quantity[$product_id] = $newQty;

        $cart->update($row_id, [
            'qty'     => $newQty,
            'options' => [
                'code'                 => $cart_item->options->code,
                'product_id'           => $cart_item->options->product_id,
                'product_type_process' => $cart_item->options->product_type_process,
                'product_type_dirt'    => $cart_item->options->product_type_dirt,
                'product_state_rumed'  => $cart_item->options->product_state_rumed,
            ],
        ]);

        $this->dispatch('qty-confirmed-' . $product_id, qty: $newQty);
    }

    public function removeItem($row_id)
    {
        Cart::instance($this->cart_instance)->remove($row_id);
    }
  
    public function inputDyrtState($discharge_detail_id, $row_id)
    { // se añade
        $this->updateDataInput($row_id, $discharge_detail_id); // se añade
    } // se añade

    
    public function updateDataInput($row_id, $discharge_detail_id) {// se añade
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);

        Cart::instance($this->cart_instance)->update($row_id, [
            'options' => [
                'code'                   => $cart_item->options->code,                'product_id'      => $cart_item->options->product_id,
                'product_type_dirt'      => $cart_item->options->product_type_dirt,
                'product_state_rumed'    => $cart_item->options->product_state_rumed,
                'product_type_process'    => $cart_item->options->product_type_process,

            ]
        ]);
    }

    public function setProductoptions($row_id, $discharge_detail) {
        $cart_item = Cart::instance($this->cart_instance)->get($row_id);
        $this->updateCartOptions($row_id, $discharge_detail, $cart_item);
        session()->flash('message_inputDyrtState' . $discharge_detail, 'Observaciones añadidos...!');
    }


    public function updateCartOptions($row_id, $discharge_detail, $cart_item)
    {
        Cart::instance($this->cart_instance)->update($row_id, ['options' => [

            'code'                  => $cart_item->options->code,                'product_id'      => $cart_item->options->product_id,
            'product_type_process'=> $cart_item->options->product_type_process,
            'product_type_dirt'     => $this->type_dirt[$discharge_detail],
            'product_state_rumed'   => $this->state_rumed[$discharge_detail],
        ]]);
    }
}
