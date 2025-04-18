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
use Modules\Discharge\Entities\DischargeDetails;

class DischargetoStockController extends Controller

{

    public function __invoke(Discharge $discharge)
    {
        abort_if(Gate::denies('create_discharges_stock'), 403);

        $discharge_details = $discharge->dischargeDetails;

        Cart::instance('stock')->destroy();

        $cart = Cart::instance('stock');

        foreach ($discharge_details as $discharge_detail) {
            $expiration = Carbon::parse($discharge_detail->updated_at)->addDays($discharge_detail->product_expiration);
            $cart->add([
                'id'      => $discharge_detail->id,
                'name'    => $discharge_detail->product_name,
                'qty'     => $discharge_detail->product_quantity,
                'price'   =>  $discharge_detail->price,
                'weight'  => 1,
                'options' => [
                    'code'     => $discharge_detail->product_code,
                    'sub_total'   => $discharge_detail->sub_total,
                    'product_id'   => $discharge_detail->product_id,
                    'product_patient'   => $discharge_detail->product_patient,
                    'product_info'   => $discharge_detail->product_info,
                    'product_type_process'   => $discharge_detail->product_type_process,
                    'product_package_wrap'   => $discharge_detail->product_package_wrap,
                    'product_ref_qr'   => $discharge_detail->product_ref_qr,
                    'product_expiration'   =>  $expiration,
                    'product_date_sterilized'   =>  $discharge_detail->updated_at,
                    'product_status_stock'   => 'Disponible',
                    'unit_price'  => $discharge_detail->unit_price,
                    'product_outside_company'   => $discharge_detail->product_outside_company,
                    'product_area'   => $discharge_detail->product_area,

                ]
            ]);
        }

        return view('discharge::discharges-stock.create', [
            'discharge_id' => $discharge->id,
            'stock' => $discharge
        ]);
    }
}
