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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/create-order','Api\OrderController@createOrder');
Route::get('/products', 'Api\ProductController@getProducts');
Route::get('/order/{id}', 'Api\OrderController@getSingleOrder');

Route::group(['middleware' => ['web']], function () {

    Route::middleware(['web', 'authenticate.user'])->group(function () {
        Route::get('/personal-info', 'Api\ClientController@getClientInfo');
        Route::get('/orders', 'Api\OrderController@getOrders');

    });
});


