<?php

namespace Modules\Testbd\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use \PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Modules\Informat\Entities\Institute;
use Modules\Setting\Entities\Setting;
use Modules\Testbd\Entities\Testbd;
use Modules\Testbd\Entities\Testvacuum;

class PrinterTbdController extends Controller

{

  public function printerTestbdA4(Int $id)
  {
    $testbd = Testbd::where('id', $id)->first();
    $institute = Institute::all()->first();
    $dataUrl = null;
    $instituteMedia = $institute->getFirstMedia('institutes');
    if ($instituteMedia && file_exists($instituteMedia->getPath())) {
        $dataUrl = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($instituteMedia->getPath()));
    }

    $setting = Setting::all()->first();
    $dataUrlogo = null;
    $settingMedia = $setting->getFirstMedia('settings');
    if ($settingMedia && file_exists($settingMedia->getPath())) {
        $dataUrlogo = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($settingMedia->getPath()));
    }

    $PdfOptions = ['dpi' => 150, 'defaultFont' => 'sans-serif', 'isPhpEnabled' => true];


    $pdf = PDF::loadView('testbd::testbds.print',  [
      'testbd' => $testbd,
      'institute' => $institute,
      'dataUrl' => $dataUrl,
      'dataUrlogo' => $dataUrlogo,
    ])->setOptions($PdfOptions)->setWarnings(false);

    return $pdf->stream('testbds.pdf');
  }

  public function printerTestvacuumA4(Int $id)
  {
    $testvacuum = Testvacuum::where('id', $id)->first();
    $institute = Institute::all()->first();
    $dataUrl = null;
    $instituteMedia = $institute->getFirstMedia('institutes');
    if ($instituteMedia && file_exists($instituteMedia->getPath())) {
        $dataUrl = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($instituteMedia->getPath()));
    }

    $setting = Setting::all()->first();
    $dataUrlogo = null;
    $settingMedia = $setting->getFirstMedia('settings');
    if ($settingMedia && file_exists($settingMedia->getPath())) {
        $dataUrlogo = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($settingMedia->getPath()));
    }

    $PdfOptions = ['dpi' => 150, 'defaultFont' => 'sans-serif', 'isPhpEnabled' => true];

    $pdf = PDF::loadView('testbd::testvacuums.print', [
      'testvacuum' => $testvacuum,
      'institute' => $institute,
      'dataUrl' => $dataUrl,
      'dataUrlogo' => $dataUrlogo,
      ])->setOptions($PdfOptions)->setWarnings(false);

    return $pdf->stream('testvacuums.pdf');
  }
}
