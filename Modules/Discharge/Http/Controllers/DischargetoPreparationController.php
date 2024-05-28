<?php

namespace Modules\Discharge\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;

use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Http\Requests\StoreDischargeRequest;
use Carbon\Carbon;


class DischargetoPreparationController extends Controller

{

    public function __invoke(Discharge $discharge)
    {
        abort_if(Gate::denies('create_discharge_preparations'), 403);

        $discharge_details = $discharge->dischargeDetails;

        Cart::instance('preparation')->destroy();

        $cart = Cart::instance('preparation');

        foreach ($discharge_details as $discharge_detail) {
            $cart->add([
                'id'      => $discharge_detail->product_id,
                'name'    => $discharge_detail->product_name,
                'qty'     => 1,
                'price'   => 1,
                'weight'  => 1,
                'options' => [
                    'code'     => $discharge_detail->product_code,
                    'product_type_process'   => $discharge_detail->product_type_process,
                    'product_state_preparation'   => 'Disponible',
                    'product_coming_zone'   => 'Rechazado_ZE',
                ]
            ]);
        }

        return view('discharge::discharges-preparation.create', [
            'discharge_id' => $discharge->id,
            'preparation' => $discharge
        ]);
    }
}
