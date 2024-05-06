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
                'id'      => $labelqr_detail->product_id,
                'name'    => $labelqr_detail->product_name,
                'qty'     => 1,
                'price'   => 1,
                'weight'  => 1,
                'options' => [
                    'code'     => $labelqr_detail->product_code,
                    'product_package_wrap'   => $labelqr_detail->product_package_wrap,
                    'product_ref_qr'   => $labelqr_detail->product_ref_qr,
                    'product_eval_package' => $labelqr_detail->product_eval_package,
                    'product_eval_indicator'=> $labelqr_detail->product_eval_indicator
                ]
            ]);
        }

        return view('labelqr::labelqr-discharges.create', [
            'labelqr_id' => $labelqr->id,
            'discharge' => $labelqr
        ]);
    }
}
