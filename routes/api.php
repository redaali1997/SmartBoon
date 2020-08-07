<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\MobileController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'Api\MobileController@userData');
    Route::post('/create-order', 'Api\MobileController@createOrder');
    Route::post('/cancel-order', 'Api\MobileController@cancelOrder');
    Route::post('/order-done', 'Api\MobileController@orderDone');
});

Route::get('reserving-time', 'Api\MobileController@reservingTime');
