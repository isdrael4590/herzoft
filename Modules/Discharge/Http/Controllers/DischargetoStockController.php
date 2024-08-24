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


class DischargetoStockController extends Controller

{

    public function __invoke(Discharge $discharge)
    {
        abort_if(Gate::denies('create_discharge_discharges'), 403);

        $discharge_details = $discharge->dischargeDetails;

        Cart::instance('stock')->destroy();

        $cart = Cart::instance('stock');

        foreach ($discharge_details as $discharge_detail) {
            $expiration = Carbon::parse($discharge_detail->updated_at)->addMonth($discharge_detail->product_expiration);
            $cart->add([
                'id'      => $discharge_detail->id,
                'name'    => $discharge_detail->product_name,
                'qty'     => 1,
                'price'   => 1,
                'weight'  => 1,
                'options' => [
                    'code'     => $discharge_detail->product_code,
                    'product_id'   => $discharge_detail->product_id,
                    'product_type_process'   => $discharge_detail->product_type_process,
                    'product_package_wrap'   => $discharge_detail->product_package_wrap,
                    'product_ref_qr'   => $discharge_detail->product_ref_qr,
                    'product_expiration'   =>  $expiration,
                    'product_date_sterilized'   =>  $discharge_detail->updated_at,
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
