<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {
        // Route::get('/', 'RestaurantController@index');
        Route::get('/home', 'RestaurantController@show')->name('restaurant.home');
        // Route::get('/edit/{id}', 'RestaurantController@edit')->name('restaurant.edit');
        // Route::post('/update/{id}', 'RestaurantController@update')->name('restaurant.update');

        Route::resource('restaurants', 'RestaurantController');
        Route::resource('products', 'ProductController');
        Route::resource('orders', 'OrderController');
    });
