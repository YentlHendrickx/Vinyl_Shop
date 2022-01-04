<?php

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

Route::view('/', 'home');
Route::get('shop', 'ShopController@index');
Route::get('shop/{id}', 'ShopController@show');
Route::view('contact-us', 'contact');
Route::get('shop_alt', 'ShopController@alt');
Route::get('itunes', 'ItunesController@index');
Route::prefix('admin')->group(function () {
    Route::get('records','Admin\RecordController@index');
});

