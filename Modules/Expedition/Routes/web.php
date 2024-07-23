<?php
use Illuminate\Support\Facades\Route;
use Modules\Expedition\Http\Controllers\PrinterExpeditionController;

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


    //Generate PDF
 /*
 Route::get('/expeditions/pdf/{id}', function ($id) {
        $expedition = \Modules\Expedition\Entities\Expedition::findOrFail($id);
        $institute=\Modules\Informat\Entities\Institute::all()->first();
       

        $pdf = \PDF::loadView('expedition::expeditions.print', [
            'expedition' => $expedition,
            'institute' => $institute,
           
        ])->setPaper('a4');

        return $pdf->stream('expedition-'. $expedition->reference .'.pdf');
    })->name('expeditions.pdf');

    Route::get('/expeditions/pos/pdf/{id}', function ($id) {
        $expedition = \Modules\Expedition\Entities\Expedition::findOrFail($id);

        $pdf = \PDF::loadView('expedition::print-pos', [
            'expedition' => $expedition,
        ])->setPaper('a7')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom', 8)
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 5);

        return $pdf->stream('expedition-'. $expedition->reference .'.pdf');
    })->name('expeditions.pos.pdf');
*/
    //expeditions
    Route::resource('expeditions', 'ExpeditionController');

   Route::get('/expeditions/pdf/{id}', [PrinterExpeditionController::class, 'printerExpeditionA4'])->name('expeditions.pdf');
    //expeditions

});
