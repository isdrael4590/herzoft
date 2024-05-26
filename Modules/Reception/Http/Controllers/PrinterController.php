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
use \Modules\Informat\Entities\Institute;
use Modules\Reception\Entities\Reception;
use Modules\Reception\Entities\ReceptionDetails;
use Modules\Reception\Http\Requests\StoreReceptionRequest;

class PrinterController extends Controller

{

    public function printerReceptiona4(Int $id)
    {
        $reception = Reception::where('id', $id)->first();
        $receptionDetails = receptionDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::findOrFail($id);
      
        return view('reception::receptions.print', [
            'reception' => $reception,
            'receptionDetails' => $receptionDetails,
            'institute' => $institute,
        ]);

     
    }
}
