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

    Route::get('/expeditions/pdf/{id}', [PrinterExpeditionController::class, 'printerExpeditionA4'])->name('expeditions.pdf');

    //expeditions
    Route::resource('expeditions', 'ExpeditionController');
});
