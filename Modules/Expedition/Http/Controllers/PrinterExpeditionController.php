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
            $instituteMedia = $institute->getFirstMedia('institutes');
            $dataUrl = '';
            if ($instituteMedia && file_exists($instituteMedia->getPath())) {
                $dataUrl = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($instituteMedia->getPath()));
            }

            $setting = Setting::all()->first();
            $settingMedia = $setting->getFirstMedia('settings');
            $dataUrlogo = '';
            if ($settingMedia && file_exists($settingMedia->getPath())) {
                $dataUrlogo = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($settingMedia->getPath()));
            }
       
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
