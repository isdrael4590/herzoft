<?php

namespace Modules\Labelqr\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;

use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\Http\Requests\StoreLabelqrRequest;
use Modules\Preparation\Entities\PreparationDetails;

class LabelqrDischargeController extends Controller

{

    public function __invoke(Labelqr $labelqr)
    {
        abort_if(Gate::denies('create_labelqr_discharges'), 403);

        $labelqr_details = $labelqr->labelqrDetails;

        Cart::instance('discharge')->destroy();

        $cart = Cart::instance('discharge');

        foreach ($labelqr_details as $labelqr_detail) {
            $cart->add([
                'id'      => $labelqr_detail->id,
                'name'    => $labelqr_detail->product_name,
                'qty'     => $labelqr_detail->product_quantity,
                'price'   => $labelqr_detail->price,
                'weight'  => 1,
                'options' => [
                    'code'     => $labelqr_detail->product_code,
                    'stock'       => PreparationDetails::findOrFail($labelqr_detail->preparation_detail_id)->product_quantity,
                    'product_id'   => $labelqr_detail->product_id,
                    'sub_total'   => $labelqr_detail->sub_total,
                    'product_type_process'   => $labelqr_detail->product_type_process,
                    'product_patient'   => $labelqr_detail->product_patient,
                    'product_info'   => $labelqr_detail->product_info,
                    'product_operator_package'   => $labelqr_detail->product_operator_package,
                    'product_package_wrap'   => $labelqr_detail->product_package_wrap,
                    'product_ref_qr'   => $labelqr_detail->product_ref_qr,
                    'product_eval_package' => $labelqr_detail->product_eval_package,
                    'product_eval_indicator' => $labelqr_detail->product_eval_indicator,
                    'product_expiration' => $labelqr_detail->product_expiration,
                    'unit_price'  => $labelqr_detail->unit_price,
                    'product_outside_company' => $labelqr_detail->product_outside_company,
                    'product_area'  => $labelqr_detail->product_area
                ]
            ]);
        }

        return view('labelqr::labelqr-discharges.create', [
            'labelqr_id' => $labelqr->id,
            'discharge' => $labelqr
        ]);
    }
}
