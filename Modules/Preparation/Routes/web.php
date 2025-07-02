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
    Route::get('/preparations/pdf/{id}', function ($id) {
        $preparation = \Modules\Preparation\Entities\Preparation::findOrFail($id);

        $pdf = \PDF::loadView('preparation::print', [
            'preparation' => $preparation,
        ]);

        return $pdf->stream('preparation-'. $preparation->reference .'.pdf');
    })->name('preparations.pdf');

    //Send preparation Mail
   // Route::get('/preparation/mail/{preparation}', 'SendpreparationEmailController')->name('preparation.email');

  

    //preparations
    Route::resource('preparations', 'PreparationController');
   // Route::resource('preparationzes', 'PreparationfromZEController');
    Route::resource('preparationDetails', 'PreparationDetailsController');


});