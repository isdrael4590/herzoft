<?php

namespace Modules\Labelqr\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Entities\Product;
use Modules\Informat\Entities\Institute;
use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Labelqr\Http\Requests\StoreReceptionRequest;
use \PDF;

class PrinterLabelQrController extends Controller
{

   public function printerLabelqr(Int $id)
    {
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
       
        $dataqr=$labelqr->reference."/".$labelqr->lote_machine."/";
       /*  CONFIURAR EL TAMAÑO DE LA ETIQUETA.
        producto 70x35 mm
         1 inch = 72 point
         1 inch = 2.54 cm
         70 mm ==  70/25.4*72 = 198.4251968
         35 mm ==  35/25.4*72 = 99.2125984248
        s*/ 
         
        $customPaper = array(0,0,99.2125984248,198.4251968);
            $pdf = PDF::loadView('labelqr::labelqrs.print', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
            'dataqr'  =>  $dataqr,
          ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif'])->setpaper($customPaper, 'landscape');
          
          return $pdf->stream('Labelqr.pdf');
    
    }


    /* 
    public function printerLabelqr(Int $id)
    {
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
            $institute = Institute::all()->first();
     
            $dataqr="/".$labelqr->reference."/".$labelqr->lote_machine;
        return view('labelqr::labelqrs.print2', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
            'dataqr'  =>  $dataqr,
        ]);

     
    }
    */
}
