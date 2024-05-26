<?php

namespace Modules\Testbd\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use \Modules\Informat\Entities\Institute;
use Modules\Testbd\Entities\Testbd;

class PrinterTbdController extends Controller

{

    public function printerTestbdA4(Int $id)
    {
        $testbd = Testbd::where('id', $id)->first();
        $institute = Institute::findOrFail($id);
      
        return view('testbd::testbds.print', [
            'testbd' => $testbd,
            'institute' => $institute,
        ]);

     
    }
}
