<?php

use Illuminate\Support\Facades\Route;
use Modules\Reception\Http\Controllers\PrinterController;

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




    //receptions

    Route::get('/receptions/pdf/{id}', [PrinterController::class, 'printerReceptiona4'])->name('receptions.pdf');

    Route::resource('receptions', 'ReceptionController');
    Route::resource('RecepReprocess', 'ReceptionReprocessController');

    //preparacion desde Form reception
    Route::get('/reception-preparations/{reception}', 'ReceptionPreparationController')->name('reception-preparations.create');
});
