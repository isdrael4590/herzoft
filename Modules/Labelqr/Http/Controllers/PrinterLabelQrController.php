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
use Knp\Snappy\Image;
use Illuminate\Support\Facades\View;
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
        return view('labelqr::labelqrs.print', [
            'labelqr' => $labelqr,
            'labelqrDetails' => $labelqrDetails,
            'institute' => $institute,
        ]);
    }

    public function return_label_html(Int $id){
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

    public function sendLabeltoPrinter(Int $id)
    {   
        $publicUrl = route("labelqrs_label.html", $id);
        # Permite guardar la imagen
        $knpSnappyImage = new Image('/usr/bin/wkhtmltoimage');
        $knpSnappyImage->generate($publicUrl, storage_path('image.png'));
        echo("Generated label");
        return redirect()->route('labelqrs_label.pdf', $id);
    }
}
