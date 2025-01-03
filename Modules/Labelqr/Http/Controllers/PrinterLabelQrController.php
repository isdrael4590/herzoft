<?php

namespace Modules\Labelqr\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Milon\Barcode\Facades\DNS1DFacade;
use Modules\Product\Entities\Product;
use \Modules\Informat\Entities\Institute;
use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Labelqr\Http\Requests\StoreReceptionRequest;
use \PDF;

class PrinterLabelQrController extends Controller

{
    /*  CONFIGURAR EL TAMAÑO DE LA ETIQUETA.         producto 70x35 mm
      1 inch = 72 point
      1 inch = 2.54 cm
      70 mm ==  70/25.4*72 = 198.4251968
      35 mm ==  35/25.4*72 = 99.2125984248
     s*/
    private $customPaper = array(0, 0, 99.2125984248, 198.4251968);


    public function printerLabelqr(Int $id)
    {
        $pdf = $this->generar_imagen($id);
        // Guardar el archivo en el Disco
        $rutaArchivo = storage_path('app/public') . '/output.pdf';
        $pdf->save($rutaArchivo);
        // Enviar el PDF al servidor local para impirmir
        // Obtiene la dirección IP del cliente
        $clienteIP = request()->ip();
        // Definir la dirección del servidor local hacia a donde mandar la imagen
        $clientServerUrl = "http://$clienteIP:3000/";
        // Envia el request hacia el servidor y procesa la respuesta
        $fileData = file_get_contents($rutaArchivo);


        $mensaje = "";
        $estado = 'error';
        try {
            $response = \Http::attach('file', $fileData, 'output.pdf')->post($clientServerUrl);
            $estado = ($response->status() == 200) ? 'exito' : 'advertencia';
            $mensaje = $response->body();
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            $mensaje = 'Error al imprimir la etiqueta, por favor revise que el programa esté activo y la impresora esté conectada';
        } catch (\Exception $e) {
            $mensaje = 'Error, por favor requiera asistencia, detalles: ' . $e->getMessage();
        }
        return redirect()->back()->with($estado, $mensaje);
    }

    public function checkLabelqr(Int $id)
    {
        $pdf = $this->generar_imagen($id);
        return $pdf->stream('Labelqr.pdf');
    }


    public $barcodes;

    private function generar_imagen(Int $id)
    {
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
        $barcode = Product::all()->first();
       
        
        $dataqr = $labelqr->reference . "/" . $labelqr->lote_machine . "/";

        $pdf = PDF::loadView('labelqr::labelqrs.print2', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
            'dataqr'  =>  $dataqr,
            'barcode' => $barcode,
        ])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setpaper($this->customPaper, 'landscape');
        return $pdf;
    }
}
