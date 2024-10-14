<?php

namespace Modules\Expedition\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use \PDF;
use Modules\Product\Entities\Product;
use \Modules\Informat\Entities\Institute;
use Modules\Expedition\Entities\Expedition;
use Modules\Expedition\Entities\ExpeditionDetails;
use Modules\Discharge\Http\Requests\StoreReceptionRequest;
use Modules\Setting\Entities\Setting;

class PrinterExpeditionController extends Controller

{


    public function printerExpeditionA4(Int $id)
    {
       
        $expedition = Expedition::where('id', $id)->first();
        $expeditionDetails = ExpeditionDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
            $institute = Institute::all()->first();
            $urlImage = $institute->getFirstMedia('institutes')->getPath();

            $Image = file_get_contents($urlImage);
            $base64 = base64_encode($Image);
            $dataUrl = 'data:image/jpeg;base64,' . $base64;

            $setting = Setting::all()->first();
        $urllogoHerz = $setting->getFirstMedia('settings')->getPath();
        $Imagelogo =  file_get_contents($urllogoHerz);
        $base64Logo = base64_encode($Imagelogo);
        $dataUrlogo = 'data:image/jpeg;base64,' . $base64Logo;
       
        $pdf = PDF::loadView('expedition::expeditions.print', [
            'expedition' => $expedition,
            'expeditionDetails' => $expeditionDetails,
            'institute' => $institute,
            'dataUrl' => $dataUrl,
            'dataUrlogo' => $dataUrlogo,
        ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif']);
        
        return $pdf->stream('expeditions.pdf');


    }
}
