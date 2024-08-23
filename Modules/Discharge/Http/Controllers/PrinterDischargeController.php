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
use \Modules\Informat\Entities\Institute;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Discharge\Http\Requests\StoreReceptionRequest;
use Modules\Labelqr\Entities\Labelqr;

class PrinterDischargeController extends Controller

{

    public function printerDischargea4(Int $id)
    {

        $discharge = Discharge::where('id', $id)->first();
        $labelqr = Labelqr::findorfail( $discharge->labelqr_id);
        $dischargeDetails = DischargeDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
     //   dd($labelqrfisrt, $labelqr);
        return view('discharge::discharges.print', [
            'discharge' => $discharge,
            'dischargeDetails' => $dischargeDetails,
            'institute' => $institute,
            'labelqr' => $labelqr,

        ]);
    }
}
