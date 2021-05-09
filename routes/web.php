<?php

use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', 'HomeController@index')->name('home');
Route::get('menu', 'HomeController@menu')->name('menu');
Route::get('contact', 'HomeController@contact')->name('contact');

Route::get('cart', 'CartController@index')->name('cart');
Route::post('cart', 'CartController@add_to_cart')->name('add-to-cart');
Route::post('remove-from-cart', 'CartController@remove')->name('remove-from-cart');
Route::get('checkout', 'CartController@checkout')->name('checkout');
Route::get('success', 'CartController@success')->name('success');

Auth::routes();

//Rutas del administrador
Route::get('admin/login', 'Admin\HomeController@login')->name('admin.login');
Route::post('admin/authenticate', 'Admin\HomeController@authenticate')->name('admin.authenticate');
Route::prefix('admin')->middleware('auth:admin')->group(function() {
    Route::get('', 'Admin\HomeController@index')->name('dashboard');
    Route::get('profile', 'Admin\HomeController@profile')->name('admin.profile');
    Route::post('profile', 'Admin\HomeController@update_profile')->name('admin.update-profile');

    Route::get('orders', 'Admin\OrdersController@list')->name('admin.orders.list');
    Route::get('change-order-status', 'Admin\OrdersController@change_status')->name('admin.orders.change-status');
    Route::get('order-detail', 'Admin\OrdersController@detail')->name('admin.orders.detail');


    Route::get('categories/list', 'Admin\CategoriesController@list')->name('categories.list');
    Route::resource('categories', 'Admin\CategoriesController');

    Route::get('products/list', 'Admin\ProductsController@list')->name('products.list');
    Route::resource('products', 'Admin\ProductsController');

    Route::get('customers/list', 'Admin\CustomersController@list')->name('customers.list');
    Route::resource('customers', 'Admin\CustomersController');

});

//Rutas para un cliente registrado
Route::prefix('user')->middleware('auth')->group(function() {
    Route::get('profile', 'CustomerController@index')->name('profile');
    Route::post('profile', 'CustomerController@update_profile')->name('update-profile');
    Route::post('update-password', 'CustomerController@update_password')->name('update-password');
    Route::get('orders', 'CustomerController@orders')->name('orders');
    Route::get('order-detail', 'CustomerController@detail')->name('order-detail');
});
