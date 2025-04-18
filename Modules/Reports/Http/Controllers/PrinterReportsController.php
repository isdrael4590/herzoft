<?php

namespace Modules\Reports\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Product;
use \Modules\Informat\Entities\Institute;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Discharge\Http\Requests\StoreReceptionRequest;
use Modules\Labelqr\Entities\Labelqr;
use Modules\Setting\Entities\Setting;
use \PDF;

class PrinterReportsController extends Controller

{

    public function printerReportDischargea4(Int $id)
    {

        $discharge = Discharge::where('id', $id)->first();
        $labelqr = Labelqr::findorfail( $discharge->labelqr_id);
        $dischargeDetails = DischargeDetails::with('product')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $institute = Institute::all()->first();
        $urlImage = $institute->getFirstMedia('institutes')->getPath();

        $Image = file_get_contents($urlImage);
        $base64 = base64_encode($Image);
        $dataUrl = 'data:image/jpeg;base64,' . $base64;
        $PdfOptions = ['dpi' => 150, 'defaultFont' => 'sans-serif', 'isPhpEnabled' => true];

        $setting = Setting::all()->first();
        $urllogoHerz = $setting->getFirstMedia('settings')->getPath();
        $Imagelogo =  file_get_contents($urllogoHerz);
        $base64Logo = base64_encode($Imagelogo);
        $dataUrlogo = 'data:image/jpeg;base64,' . $base64Logo;

        $data = $labelqr->reference."/".$discharge->reference."/".$discharge->machine_name."/".$discharge->lote_machine."/".$discharge->updated_at->format('d M, Y'); 
        $pdf = PDF::loadView('discharge::discharges.print', [
          'discharge' => $discharge,
            'dischargeDetails' => $dischargeDetails,
            'institute' => $institute,
            'labelqr' => $labelqr,
            'data'=> $data,
            'dataUrl' => $dataUrl,
            'dataUrlogo' => $dataUrlogo,
        ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif']);
        
        return $pdf->stream('reports.pdf');
    }


}
