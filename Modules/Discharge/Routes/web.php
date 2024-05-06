<?php

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
    Route::get('/discharges/pdf/{id}', function ($id) {
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

    //discharges
    Route::resource('discharges', 'DischargeController');

    //Payments
    Route::get('/discharge-payments/{discharge_id}', 'dischargePaymentsController@index')->name('discharge-payments.index');
    Route::get('/discharge-payments/{discharge_id}/create', 'dischargePaymentsController@create')->name('discharge-payments.create');
    Route::post('/discharge-payments/store', 'dischargePaymentsController@store')->name('discharge-payments.store');
    Route::get('/discharge-payments/{discharge_id}/edit/{dischargePayment}', 'dischargePaymentsController@edit')->name('discharge-payments.edit');
    Route::patch('/discharge-payments/update/{dischargePayment}', 'dischargePaymentsController@update')->name('discharge-payments.update');
    Route::delete('/discharge-payments/destroy/{dischargePayment}', 'dischargePaymentsController@destroy')->name('discharge-payments.destroy');
});
