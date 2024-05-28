<?php

namespace Modules\Reception\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;

use Modules\Reception\Entities\Reception;
use Modules\Reception\Http\Requests\StoreReceptionRequest;

class ReceptionPreparationController extends Controller

{

    public function __invoke(Reception $reception)
    {
        abort_if(Gate::denies('create_reception_preparations'), 403);

        $reception_details = $reception->receptionDetails;

        Cart::instance('preparation')->destroy();

        $cart = Cart::instance('preparation');

        foreach ($reception_details as $reception_detail) {
            $cart->add([
                'id'      => $reception_detail->product_id,
                'name'    => $reception_detail->product_name,
                'qty'     => 1,
                'price'   => 1,
                'weight'  => 1,
                'options' => [
                    'code'     => $reception_detail->product_code,
                    'product_type_process'     => $reception_detail->product_type_process,
                    'product_state_preparation'   => 'Disponible',
                    'product_coming_zone'   => 'Recepcion',
                    
                ]
            ]);
        }

        return view('reception::reception-preparations.create', [
            'reception_id' => $reception->id,
            'preparation' => $reception
        ]);
    }
}
