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
    $urlImage = $institute->getFirstMedia('institutes')->getPath();

    $Image = file_get_contents($urlImage);
    $base64 = base64_encode($Image);
    $dataUrl = 'data:image/jpeg;base64,' . $base64;

    $setting = Setting::all()->first();
    $urllogoHerz = $setting->getFirstMedia('settings')->getPath();
    $Imagelogo =  file_get_contents($urllogoHerz);
    $base64Logo = base64_encode($Imagelogo);
    $dataUrlogo = 'data:image/jpeg;base64,' . $base64Logo;

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
    $urlImage = $institute->getFirstMedia('institutes')->getPath();

    $Image = file_get_contents($urlImage);
    $base64 = base64_encode($Image);
    $dataUrl = 'data:image/jpeg;base64,' . $base64;

    $setting = Setting::all()->first();
    $urllogoHerz = $setting->getFirstMedia('settings')->getPath();
    $Imagelogo =  file_get_contents($urllogoHerz);
    $base64Logo = base64_encode($Imagelogo);
    $dataUrlogo = 'data:image/jpeg;base64,' . $base64Logo;

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
