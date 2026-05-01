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
    Route::get('/stocks/pdf/{id}', function ($id) {
        $stock = \Modules\stock\Entities\Stock::findOrFail($id);

        $pdf = \PDF::loadView('stock::print', [
            'stock' => $stock,
        ]);

        return $pdf->stream('stock-'. $stock->reference .'.pdf');
    })->name('stocks.pdf');

    //Send stock Mail
   // Route::get('/stock/mail/{stock}', 'SendstockEmailController')->name('stock.email');

  

    //stocks
    Route::resource('stocks', 'StockController');
    Route::get('/stockDetails/history/{code}', 'StockDetailsController@codeHistory')->name('stockDetails.codeHistory');
    Route::post('/stockDetails/reset-quantities', 'StockDetailsController@resetQuantities')->name('stockDetails.resetQuantities');
    Route::get('/stockDetails/reset-history', 'StockDetailsController@resetHistory')->name('stockDetails.resetHistory');
    Route::resource('stockDetails', 'StockDetailsController');

});