<?php

namespace Modules\Testbd\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use \PDF;
use App\Http\Controllers\Controller;
use \Modules\Informat\Entities\Institute;
use Modules\Testbd\Entities\Testbd;
use Modules\Testbd\Entities\Testvacuum;

class PrinterTbdController extends Controller

{

    public function printerTestbdA4(Int $id)
    {
        $testbd = Testbd::where('id', $id)->first();
        $institute = Institute::all()->first();

     

        $pdf = PDF::loadView('testbd::testbds.print', [
            'testbd' => $testbd,
            'institute' => $institute,
          ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif']);

          return $pdf->stream('testbds.pdf');
    }

    public function printerTestvacuumA4(Int $id)
    {
        $testvacuum = Testvacuum::where('id', $id)->first();
        $institute = Institute::all()->first();

        $pdf = PDF::loadView('testbd::testvacuums.print', [
          'testvacuum' => $testvacuum,
            'institute' => $institute,
          ])->setOptions(['dpi'=>150,'defaultFont' => 'sans-serif']);

          return $pdf->stream('testvacuums.pdf');
    }
}
