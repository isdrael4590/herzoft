<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController; // Added modern controller import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/testbowies/chart-data', [HomeController::class, 'testBowiesChart'])
        ->name('testbowies.chart');

    Route::get('/current-month/chart-data', [HomeController::class, 'currentMonthChart'])
        ->name('current-month.chart');

    Route::get('/currentProducMonth/chart-data', [HomeController::class, 'currentMonthProductionChart'])
        ->name('currentProduc-month.chart');

    Route::get('/productions/chart-data', [HomeController::class, 'ProductionsChart'])
        ->name('productions.chart');

    Route::get('/productionlabels/chart-data', [HomeController::class, 'ProductionlabelsChart'])
        ->name('productionlabels.chart');

    Route::get('/resultproductions/chart-data', [HomeController::class, 'ResultProductionChart'])
        ->name('resultproductions.chart');

    Route::get('/biologics/chart-data', [HomeController::class, 'BiologicChart'])
        ->name('biologics.chart');

    Route::get('/central/chart-data', [HomeController::class, 'CentralChart'])
        ->name('central.chart');

    Route::get('/equipment-semester/chart-data', [HomeController::class, 'EquipmentSemesterChart'])
        ->name('equipment-semester.chart');

    Route::get('/chart-years', [HomeController::class, 'chartYears'])
        ->name('chart.years');
});