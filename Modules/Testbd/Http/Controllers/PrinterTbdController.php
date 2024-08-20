<?php

namespace Modules\Testbd\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

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

        return view('testbd::testbds.print', [
            'testbd' => $testbd,
            'institute' => $institute,
        ]);
    }

    public function printerTestvacuumA4(Int $id)
    {
        $testvacuum = Testvacuum::where('id', $id)->first();
        $institute = Institute::all()->first();

        return view('testbd::testvacuums.print', [
            'testvacuum' => $testvacuum,
            'institute' => $institute,
        ]);
    }
}
