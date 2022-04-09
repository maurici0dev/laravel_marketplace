<?php

// Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('product/{slug}', 'HomeController@singleProduct')->name('single.product');
Route::get('category/{slug}', 'CategoryController@index')->name('single.category');
Route::get('store/{slug}', 'StoreController@index')->name('single.store');

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'CartController@index')->name('index');

    Route::post('add', 'CartController@add')->name('add');

    Route::get('cancel', 'CartController@cancel')->name('cancel');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
});

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::get('thanks', 'CheckoutController@thanks')->name('thanks');

    Route::post('proccess', 'CheckoutController@proccess')->name('proccess');
    Route::post('notification', 'CheckoutController@notification')->name('notification');
});

// Orders
Route::get('orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

// Admin
Route::group(['middleware' => ['auth', 'access.control.admin']], function () {

    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::get('notifications', 'NotificationController@index')->name('notifications.index');
        Route::get('my-orders', 'OrdersController@index')->name('orders.index');

        Route::get('notifications/read/{id}', 'NotificationController@read')->name('notifications.read');
        Route::get('notifications/read-all', 'NotificationController@readall')->name('notifications.read.all');
        Route::get('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    });
});

Auth::routes();
