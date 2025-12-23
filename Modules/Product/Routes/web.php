<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use Modules\Product\Http\Controllers\ImportCategoryController;

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    Route::get('/products/print-barcode', 'BarcodeController@printBarcode')->name('barcode.print');
    //Product
    Route::resource('products', 'ProductController');
    //ins
    Route::resource('instrumental', 'InstrumentalController');
    //Product Category
    Route::resource('product-categories', 'CategoriesController')->except('create', 'show');
    Route::resource('import-categories', 'ImportCategoryController');

     //Product
     Route::resource('import-products', 'ImportProductController');
     //Route::post('import-categories',[ ImportProductController::class, 'import-categories' ]);
     Route::post('import-categories',[ ImportCategoryController::class, 'import' ])->name('import-categories');

});

