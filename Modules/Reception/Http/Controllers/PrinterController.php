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
use \PDF;
class PrinterController extends Controller

{

    public function printerReceptiona4(Int $id)
    {
        
        
        $reception = Reception::where('id', $id)->first();

        $receptionDetails = receptionDetails::with('product')
            ->where('reception_id', $reception->id)
            ->orderBy('id', 'DESC')
            ->get()->first();

        $institute = Institute::all()->first();
      
       

        $pdf = PDF::loadView('reception::receptions.print', [
            'reception' => $reception,
            'receptionDetails' => $receptionDetails,
            'institute' => $institute,
          ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif']);
          
          return $pdf->stream('receptions.pdf');
     
    }

    public function printerReceptionticket(Int $id)
    {
        
        
        $reception = Reception::where('id', $id)->first();

        $receptionDetails = receptionDetails::with('product')
            ->where('reception_id', $reception->id)
            ->orderBy('id', 'DESC')
            ->get()->first();

        $institute = Institute::all()->first();
       /*  CONFIURAR EL TAMAÑO DE LA ETIQUETA.
        producto 60x100 mm
         1 inch = 72 point
         1 inch = 2.54 cm
         70 mm ==  60/25.4*72 = 170.07874
         35 mm ==  100/25.4*72 = 200.929134
        s*/ 
         
        $customPaper = array(0,0,170.07874,400.929134);
       

        $pdf = PDF::loadView('reception::receptions.printticket', [
            'reception' => $reception,
            'receptionDetails' => $receptionDetails,
            'institute' => $institute,
          ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif'])->setpaper($customPaper, 'portrait');

          
          return $pdf->stream('receptiontickets.pdf');
     
    }
}
