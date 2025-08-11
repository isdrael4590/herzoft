<?php

use Modules\Discharge\Entities\Discharge;
use Modules\Expedition\Entities\Expedition;
use Modules\Informat\Entities\Institute;
use Modules\Reception\Entities\Reception;
use Modules\Reports\Http\Controllers\ReceptionPrintController;
use Modules\Reports\Http\Controllers\DischargePrintController;
use Modules\Reports\Http\Controllers\ExpeditionPrintController;
use Modules\Reports\Http\Controllers\TestbdPrintController;
use Modules\Setting\Entities\Setting;
use Modules\Testbd\Entities\Testbd;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    

    Route::get('/reception-report', 'ReportsController@receptionReport')->name('reception-report.index');

    // Ruta POST para imprimir recepciones
    Route::post('/print-reception-data', [ReceptionPrintController::class, 'printFromPost'])
        ->name('printreception.post')
        ->middleware(['auth']); // Agregar middleware según tu configuración

    // NUEVAS RUTAS - Agregar estas
    Route::get('/reports/reception/print-session', [ReceptionPrintController::class, 'printFromSession'])
        ->name('reports.reception.print-session');

    Route::get('/reports/reception/print-chunks', [ReceptionPrintController::class, 'printFromChunks'])
        ->name('reports.reception.print-chunks');



    Route::get('/discharge-report', 'ReportsController@dischargeReport')->name('discharge-report.index');

    // Para los nuevos métodos de impresión
    Route::post('/discharge/print', [DischargePrintController::class, 'printPost'])
        ->name('printdisch.post')
        ->middleware(['auth']); // Agregar middleware si es necesario

    // Rutas GET para descargas
    Route::get('/reports/discharge/print-session', [DischargePrintController::class, 'printFromSession'])
        ->name('reports.discharge.print-session');

    Route::get('/reports/discharge/print-chunks', [DischargePrintController::class, 'printFromChunks'])
        ->name('reports.discharge.print-chunks');


    Route::get('/expedition-report', 'ReportsController@expeditionReport')->name('expedition-report.index');



    // Para los nuevos métodos de impresión de Expedition
    Route::post('/expedition/print', [ExpeditionPrintController::class, 'printPost'])
        ->name('printexpedition.post')
        ->middleware(['auth']); // Agregar middleware si es necesario

    // Rutas GET para descargas de Expedition
    Route::get('/reports/expedition/print-session', [ExpeditionPrintController::class, 'printFromSession'])
        ->name('reports.expedition.print-session');

    Route::get('/reports/expedition/print-chunks', [ExpeditionPrintController::class, 'printFromChunks'])
        ->name('reports.expedition.print-chunks');

    // Ruta principal del reporte de expedición (ya existente)
    Route::get('/expedition-report', 'ReportsController@expeditionReport')->name('expedition-report.index');


    Route::get('/testbd-report', 'ReportsController@testbdReport')->name('testbd-report.index');

    // Para los nuevos métodos de impresión de Testbd
    Route::post('/testbd/print', [TestbdPrintController::class, 'printPost'])
        ->name('printtestbd.post')
        ->middleware(['auth']); // Agregar middleware si es necesario

    // Rutas GET para descargas de Testbd
    Route::get('/reports/testbd/print-session', [TestbdPrintController::class, 'printFromSession'])
        ->name('reports.testbd.print-session');

    Route::get('/reports/testbd/print-chunks', [TestbdPrintController::class, 'printFromChunks'])
        ->name('reports.testbd.print-chunks');

});




