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
use \Modules\Informat\Entities\Institute;
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
        $labelqrDetails = LabelqrDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
        return view('labelqr::labelqrs.print', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
    }

    public function return_label_html(int $id)
    {
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
        return view('labelqr::labelqrs.print-only', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
    }

    public function sendLabeltoPrinter(int $id)
    {
        $urlEtiqueta = route("labelqrs_label.html", $id);
        # Permite guardar la imagen
        $img_filename = 'etiqueta_' . $id . '.png';
        $labelqr = Labelqr::where('id', $id)->first();
        $labelqrDetails = LabelqrDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
        $label_qrs_print = view('labelqr::labelqrs.print-only', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
        $image_view = SnappyImage::loadView('labelqr::labelqrs.print-only', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
        $image = $image_view->inline($img_filename);
        // Get the client's IP address
        $clientIp = request()->ip();
        // Define the local server URL to send the image to
        $clientServerUrl = "http://$clientIp:3000/";

        $response = Http::attach(
            'attachment',
            $image->content(),
            $img_filename,
            ['Content-Type' => 'image/png']
        )->post($clientServerUrl);
        return redirect()->route('labelqrs_label.pdf', $id)->with('mensaje', $response->body());
    }
}
