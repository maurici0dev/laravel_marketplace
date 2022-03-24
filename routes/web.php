<?php

Route::get('/', function () {
    return view('welcome', ['hello' => 'Bem vindo']);
})->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    });
});

Auth::routes();
