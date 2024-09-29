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
       
        $dataqr="/".$labelqr->reference."/".$labelqr->lote_machine;
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
        // Guardar el archivo en el Disco
        $rutaArchivo = storage_path('app/public') . '/output.pdf';
        $pdf->save($rutaArchivo);
        // Enviar el PDF al servidor local para impirmir
        $this->enviarPDFaImpresion($rutaArchivo);
        //return $pdf->stream('Labelqr.pdf');
    }
    private function enviarPDFaImpresion($filePath)
    {
        // Obtiene la dirección IP del cliente
        $clienteIP = request()->ip();
        // Definir la dirección del servidor local hacia a donde mandar la imagen
        $clientServerUrl = "http://$clienteIP:3000/";
        // Envia el request hacia el servidor y procesa la respuesta
        $fileData = file_get_contents($filePath);

        $response = \Http::attach('file', $fileData, 'output.pdf')
                         ->post($clientServerUrl);

        if ($response->successful()) {
            dd($response);
            return true;
        } else {
            return false;
        }
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
