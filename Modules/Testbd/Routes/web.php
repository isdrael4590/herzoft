<?php

use Illuminate\Support\Facades\Route;
use Modules\Testbd\Http\Controllers\PrinterTbdController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
   

    //testbd
    Route::resource('testbds', 'TestbdController');
    Route::resource('testvacuums', 'TestvacuumController');

    Route::get('/testbds/pdf/{id}', [PrinterTbdController::class, 'printerTestbdA4'])->name('testbds.pdf');
    Route::get('/testvacuums/pdf/{id}', [PrinterTbdController::class, 'printerTestvacuumA4'])->name('testvacuums.pdf');

});