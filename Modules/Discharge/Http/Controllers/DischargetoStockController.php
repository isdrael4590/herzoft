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

class DischargetoStockController extends Controller

{

    public function __invoke(Discharge $discharge)
    {
        abort_if(Gate::denies('create_discharge_discharges'), 403);

        $discharge_details = $discharge->dischargeDetails;

        Cart::instance('stock')->destroy();

        $cart = Cart::instance('stock');

        foreach ($discharge_details as $discharge_detail) {
            $cart->add([
                'id'      => $discharge_detail->product_id,
                'name'    => $discharge_detail->product_name,
                'qty'     => 1,
                'price'   => 1,
                'weight'  => 1,
                'options' => [
                    'code'     => $discharge_detail->product_code,
                    'product_package_wrap'   => $discharge_detail->product_package_wrap,
                    'product_ref_qr'   => $discharge_detail->product_ref_qr,
                    'product_expiration'   => '24',
                    'product_status_stock'   => 'Disponible',
                ]
            ]);
        }

        return view('discharge::discharges-stock.create', [
            'discharge_id' => $discharge->id,
            'stock' => $discharge
        ]);
    }
}
