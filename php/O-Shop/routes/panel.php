<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', 'PanelController@index')->name('panel');
Route::get('users', 'UserController@index')->name('users');
Route::put('users/admin/{user}', 'UserController@update')->name('users.admin');

Route::get('orders', 'ManageOrderController@index')->name('orders.update');
Route::resource('products', 'ProductController');


