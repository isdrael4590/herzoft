<?php

use Illuminate\Support\Facades\Route;
use Modules\Lavado\Http\Controllers\DescargaLavadoController;
use Modules\Lavado\Http\Controllers\LavadoController;
use Modules\Lavado\Http\Controllers\LavadotoDescargaController;
use Modules\Lavado\Http\Controllers\DescLavadotoPreparationController;
use Modules\Lavado\Http\Controllers\PrelavadoController;

/*
|--------------------------------------------------------------------------
| Web Routes - Módulo Lavado
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {
    // Prelavado: instrumental pendiente de lavar (viene de Recepción)
    Route::get('prelavado', [PrelavadoController::class, 'index'])->name('prelavado.index');
    Route::get('prelavado/create', [PrelavadoController::class, 'create'])->name('prelavado.create');
    Route::post('prelavado', [PrelavadoController::class, 'store'])->name('prelavado.store');
    Route::get('prelavado/{reception_id}/edit', [PrelavadoController::class, 'edit'])->name('prelavado.edit');
    Route::put('prelavado/{reception_id}', [PrelavadoController::class, 'update'])->name('prelavado.update');
    Route::get('prelavado/{reception}', [PrelavadoController::class, 'show'])->name('prelavado.show');
    Route::get('prelavado-historial/{product_code}', [PrelavadoController::class, 'historial'])->name('prelavado.historial');

    // Lavados: registro de ciclos de lavado
    Route::resource('lavados', LavadoController::class);

    // Lavado → Preparación
    Route::get('lavados/{descargalavado}/preparation', DescLavadotoPreparationController::class)->name('lavado-preparations.create');

    // Lavado → Descarga Lavado
    Route::get('lavados/{lavado}/descarga', LavadotoDescargaController::class)->name('lavado-descarga.create');

    // Descarga Lavado: CRUD
    Route::post('descarga-lavado', [DescargaLavadoController::class, 'store'])->name('descarga-lavado.store');
    Route::get('descarga-lavado', [DescargaLavadoController::class, 'index'])->name('descarga-lavado.index');
    Route::get('descarga-lavado/{descargaLavado}', [DescargaLavadoController::class, 'show'])->name('descarga-lavado.show');
    Route::get('descarga-lavado/{descargaLavado}/edit', [DescargaLavadoController::class, 'edit'])->name('descarga-lavado.edit');
    Route::put('descarga-lavado/{descargaLavado}', [DescargaLavadoController::class, 'update'])->name('descarga-lavado.update');
    Route::delete('descarga-lavado/{descargaLavado}', [DescargaLavadoController::class, 'destroy'])->name('descarga-lavado.destroy');
});
