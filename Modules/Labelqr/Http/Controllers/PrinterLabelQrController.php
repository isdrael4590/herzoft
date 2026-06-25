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

    public function previewQrLabelqr(Int $id)
    {
        $labelqr = Labelqr::where('id', $id)->firstOrFail();
        $dataqr  = $labelqr->reference . "/" . $labelqr->lote_machine . "/";

        // Pre-generar QR PNG una sola vez por código único (no por cada copia)
        $qrCodes = [];
        foreach ($labelqr->labelqrDetails as $item) {
            if (!isset($qrCodes[$item->product_code])) {
                $qrCodes[$item->product_code] = 'data:image/png;base64,' . base64_encode(
                    \QrCode::format('png')->size(80)->margin(0)->generate($dataqr . $item->product_code)
                );
            }
        }

        $pdf = PDF::loadView('labelqr::labelqrs.print', [
            'labelqr' => $labelqr,
            'dataqr'  => $dataqr,
            'qrCodes' => $qrCodes,
        ])->setOptions([
            'dpi'                   => 96,
            'defaultFont'           => 'sans-serif',
            'isHtml5ParserEnabled'  => true,
            'isRemoteEnabled'       => false,
            'enable_font_subsetting'=> true,
        ])->setpaper($this->customPaper, 'landscape');

        return $pdf->stream('Labelqr-QR.pdf');
    }


    public $barcodes;

    private function generar_imagen(Int $id)
    {
        $labelqr  = Labelqr::where('id', $id)->firstOrFail();
        $details  = $labelqr->labelqrDetails;
        $symbology = Product::value('product_barcode_symbology') ?? 'C128';

        // Pre-generar barcode SVG una sola vez por código único
        $barcodeSvgs = [];
        foreach ($details as $item) {
            if (!isset($barcodeSvgs[$item->product_code])) {
                // factor=1.5, height=15 → barcode compacto, se auto-centra en la etiqueta
                $png = \Milon\Barcode\Facades\DNS1DFacade::getBarCodePNG($item->product_code, $symbology, 1.5, 15, [0,0,0]);
                $barcodeSvgs[$item->product_code] = 'data:image/png;base64,' . $png;
            }
        }

        $pdf = PDF::loadView('labelqr::labelqrs.print3', [
            'labelqr'     => $labelqr,
            'details'     => $details,
            'barcodeSvgs' => $barcodeSvgs,
        ])->setOptions([
            'dpi'                    => 96,
            'defaultFont'            => 'sans-serif',
            'isHtml5ParserEnabled'   => true,
            'isRemoteEnabled'        => false,
            'enable_font_subsetting' => true,
        ])->setpaper($this->customPaper, 'landscape');

        return $pdf;
    }

    public function browserBarcodeLabelqr(Int $id)
    {
        $labelqr = Labelqr::where('id', $id)->firstOrFail();
        $barcode = Product::first();
        return view('labelqr::labelqrs.print2', compact('labelqr', 'barcode'));
    }

    public function simpleLabelqr(Int $id)
    {
        $pdf_simple = $this->generar_imagensimple($id);
        return $pdf_simple->stream('Labelqr-simple.pdf');
    }

    private function generar_imagensimple(Int $id)
    {
        $labelqr   = Labelqr::where('id', $id)->firstOrFail();
        $details   = $labelqr->labelqrDetails;

        // Pre-fetch product areas para no hacer queries dentro de la vista
        $productAreas = \Modules\Product\Entities\Product::whereIn('product_code', $details->pluck('product_code'))
            ->pluck('area', 'product_code');

        $pdf_simple = PDF::loadView('labelqr::labelqrs.printsimple', [
            'labelqr'      => $labelqr,
            'details'      => $details,
            'productAreas' => $productAreas,
        ])->setOptions([
            'dpi'                    => 96,
            'defaultFont'            => 'sans-serif',
            'isHtml5ParserEnabled'   => true,
            'isRemoteEnabled'        => false,
            'enable_font_subsetting' => true,
        ])->setpaper($this->customPaper, 'landscape');

        return $pdf_simple;
    }
}
