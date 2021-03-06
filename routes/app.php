<?php

//Begin Route customer
Route::resource('customer', 'CustomerController');
//End Route customer
//Begin Route order
Route::resource('order', 'OrderController');
//End Route order
//Begin Route product
Route::resource('product', 'ProductController');
//End Route product

//Begin Route spkb
Route::prefix('spkb')->group(function() {
    Route::get('/generate', 'SpkbController@generate')->name('spkb.generate');
    Route::get('/print/{code_spkb}', 'SpkbController@print')->name('spkb.print');
});
Route::resource('spkb', 'SpkbController');

//End Route spkb

//Begin Route spkb
Route::resource('distribution_center', 'DistributionCenterController');
//End Route spkb

//Begin Route spkb
Route::resource('delivery', 'DeliveryController');
//End Route spkb

//Begin Route spkb
Route::prefix('report')->group(function() {
    Route::get('/print', 'ReportController@print')->name('report.print');
});
Route::resource('report', 'ReportController');
//End Route spkb