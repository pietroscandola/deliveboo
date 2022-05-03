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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/home', 'RestaurantController@show')->name('restaurant.home');

        // GRUPPO CESTINO PRODOTTI
        Route::prefix('products')->name('products.trash.')->group(function () {
            Route::get('/trash', 'ProductTrashController@index')->name('index');
            Route::patch('/{product}/trash', 'ProductTrashController@restore')->name('restore');
            Route::delete('/{product}/destroy', 'ProductTrashController@destroy')->name('destroy');
        });

        Route::resource('restaurants', 'RestaurantController');
        Route::resource('products', 'ProductController');
        Route::resource('orders', 'OrderController');
    });

Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
