<?php

use Illuminate\Support\Facades\Route;
use Modules\Backup\Http\Controllers\BackupController;

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


/*Route::middleware(['auth'])->group(function () {
    Route::resource('backups', BackupController::class);
    
    // Additional non-CRUD actions
    Route::get('/backups/{backup}/download', [BackupController::class, 'download'])->name('backups.download');
    Route::post('/backups/{backup}/restore', [BackupController::class, 'restore'])->name('backups.restore');
    Route::post('/backups/upload', [BackupController::class, 'upload'])->name('backups.upload');
});
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('backups', 'BackupController');
    
    // Additional non-CRUD actions
    Route::get('/backups/{backup}/download', 'BackupController@download')->name('backups.download');
    Route::post('/backups/{backup}/restore', 'BackupController@restore')->name('backups.restore');
    Route::post('/backups/upload', 'BackupController@upload')->name('backups.upload');
});