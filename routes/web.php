<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@singleProduct')->name('single.product');
Route::get('/category/{slug}', 'CategoryController@index')->name('single.category');
Route::get('/store/{slug}', 'StoreController@index')->name('single.store');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'CartController@index')->name('index');

    Route::post('add', 'CartController@add')->name('add');

    Route::get('cancel', 'CartController@cancel')->name('cancel');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
});

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');

    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
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
