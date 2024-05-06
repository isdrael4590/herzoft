<?php

use Illuminate\Support\Facades\Route;


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
    Route::get('/labelqrs/pdf/{id}', function ($id) {
        $labelqr = \Modules\labelqr\Entities\Labelqr::findOrFail($id);

        $pdf = \PDF::loadView('labelqr::print', [
            'labelqr' => $labelqr,
        ]);

        return $pdf->stream('labelqr-'. $labelqr->reference .'.pdf');
    })->name('labelqrs.pdf');

    //Send labelqr Mail
   // Route::get('/labelqr/mail/{labelqr}', 'SendlabelqrEmailController')->name('labelqr.email');

    //Sales Form labelqr
    Route::get('/labelqr-discharges/{labelqr}', 'LabelqrDischargeController')->name('labelqr-discharges.create');

    //labelqrs
    Route::resource('labelqrs', 'LabelqrController');
});
