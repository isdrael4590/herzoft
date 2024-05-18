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

    Route::get('/receptions/pdf/{id}', function ($id) {
        $reception = \Modules\Reception\Entities\Reception::findOrFail($id);
        $institute = \Modules\Informat\Entities\Institute::findOrFail($id);

        $pdf = \PDF::loadView('reception::receptions.print', [
            'reception' => $reception,
            'institute' => $institute,
        ])->setPaper('a4');

        return $pdf->stream('reception-'. $reception->reference .'.pdf');
    })->name('receptions.pdf');

    //Send reception Mail
   // Route::get('/reception/mail/{reception}', 'SendreceptionEmailController')->name('reception.email');

    //Sales Form reception
   // Route::get('/reception-sales/{reception}', 'receptionSalesController')->name('reception-sales.create');

    //receptions
    Route::resource('receptions', 'ReceptionController');
    
        //preparacion desde Form reception
        Route::get('/reception-preparations/{reception}', 'ReceptionPreparationController')->name('reception-preparations.create');

});


