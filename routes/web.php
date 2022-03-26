<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@singleProduct')->name('single.product');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'CartController@index')->name('index');
    
    Route::post('add', 'CartController@add')->name('add');

    Route::get('cancel', 'CartController@cancel')->name('cancel');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
});

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    });
});

Auth::routes();
