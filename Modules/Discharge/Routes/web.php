<?php
use Illuminate\Support\Facades\Route;
use Modules\Discharge\Http\Controllers\PrinterDischargeController;
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

    //POS
    //Route::get('/app/pos', 'PosController@index')->name('app.pos.index');
    //Route::post('/app/pos', 'PosController@store')->name('app.pos.store');

    //Generate PDF
   /* Route::get('/discharges/pdf/{id}', function ($id) {
        $discharge = \Modules\Discharge\Entities\Discharge::findOrFail($id);
       

        $pdf = \PDF::loadView('discharge::discharges.print', [
            'discharge' => $discharge,
           
        ])->setPaper('a4');

        return $pdf->stream('discharge-'. $discharge->reference .'.pdf');
    })->name('discharges.pdf');

    Route::get('/discharges/pos/pdf/{id}', function ($id) {
        $discharge = \Modules\discharge\Entities\Discharge::findOrFail($id);

        $pdf = \PDF::loadView('discharge::print-pos', [
            'discharge' => $discharge,
        ])->setPaper('a7')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom', 8)
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 5);

        return $pdf->stream('discharge-'. $discharge->reference .'.pdf');
    })->name('discharges.pos.pdf');
*/

    Route::get('/discharges/pdf/{id}', [PrinterDischargeController::class, 'printerDischargea4'])->name('discharges.pdf');
    //discharges
    Route::resource('discharges', 'DischargeController');

    // Almacen desde Descargas
    Route::get('/discharges-stock/{discharge}', 'DischargetoStockController')->name('discharges-stock.create');
    
    
    // Almacen desde preparacion
   // Route::get('/discharges-preparation/{discharge}', 'DischargetoPreparationController')->name('discharges-preparation.create');

});
