<?php

use Modules\Discharge\Entities\Discharge;
use Modules\Expedition\Entities\Expedition;
use Modules\Informat\Entities\Institute;
use Modules\Setting\Entities\Setting;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    Route::get('/testbd-report', 'ReportsController@testbdReport')->name('testbd-report.index');
    
    Route::get('/reception-report', 'ReportsController@receptionReport')->name('reception-report.index');
    

    Route::get('/discharge-report', 'ReportsController@dischargeReport')->name('discharge-report.index');

    Route::get('/expedition-report', 'ReportsController@expeditionReport')->name('expedition-report.index');

});

Route::get('/print-data/{items}', function ($items) {
    $itemIds = explode(',', $items);
    $data = Expedition::whereIn('id', $itemIds)->get();
    $institute = Institute ::all()->first();

    $setting = Setting::all()->first();
    $urlLogoHerz = null;
    if ($setting && $setting->getFirstMedia('settings')) {
        $urlLogoHerz = $setting->getFirstMedia('settings')->getPath();
        $imageLogo = file_get_contents($urlLogoHerz);
        $base64Logo = base64_encode($imageLogo);
        $dataUrlLogo = 'data:image/jpeg;base64,' . $base64Logo;
    } else {
        // Provide a fallback for when the logo isn't available
        $dataUrlLogo = ''; // Or path to a default image
    }


    return view('reports::expedition.print', compact('data', 'institute', 'dataUrlLogo'));
})->name('print.data');

Route::get('/print-data/{items}', function ($items) {
    $itemIds = explode(',', $items);
    $data = Discharge::whereIn('id', $itemIds)->get();
    $institute = Institute ::all()->first();

    $setting = Setting::all()->first();
    $urlLogoHerz = null;
    if ($setting && $setting->getFirstMedia('settings')) {
        $urlLogoHerz = $setting->getFirstMedia('settings')->getPath();
        $imageLogo = file_get_contents($urlLogoHerz);
        $base64Logo = base64_encode($imageLogo);
        $dataUrlLogo = 'data:image/jpeg;base64,' . $base64Logo;
    } else {
        // Provide a fallback for when the logo isn't available
        $dataUrlLogo = ''; // Or path to a default image
    }


    return view('reports::discharge.print-discharge', compact('data', 'institute', 'dataUrlLogo'));
})->name('print.data');