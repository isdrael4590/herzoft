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
use SnappyImage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

class PrinterLabelQrController extends Controller
{
    public function printerLabelqr(int $id)
    {
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')->where('id', $id)->orderBy('id', 'DESC')->get();
        $institute = Institute::all()->first();
        return view('labelqr::labelqrs.print', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
    }

    public function sendLabeltoPrinter(int $id)
    {
        # Permite guardar la imagen
        $img_filename = 'etiqueta_' . $id . '.png';
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')->where('id', $id)->orderBy('id', 'DESC')->get();
        $institute = Institute::all()->first();

        $image_view = SnappyImage::loadView('labelqr::labelqrs.print-only', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
        $image = $image_view->inline($img_filename);
        // Obtiene la dirección IP del cliente
        $clientIp = request()->ip();
        // Definir la dirección del servidor local hacia a donde mandar la imagen
        $clientServerUrl = "http://$clientIp:3000/";
        // Envia el request hacia el servidor y procesa la respuesta
        $response = Http::withBody(base64_encode($image->content()), 'text/plain')->post($clientServerUrl);
        if ($response->status() == 200) {
            return redirect()->route('labelqrs_label.pdf', $id)->with('exito', $response->body());
        } else {
            return redirect()->route('labelqrs_label.pdf', $id)->with('error', $response->body());
        }
    }
}
