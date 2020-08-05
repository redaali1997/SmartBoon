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

Route::post('login', 'Api\MobilController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'Api\MobilController@userData');
    Route::post('/create-order', 'Api\MobilController@createOrder');
    Route::post('/cancel-order', 'Api\MobilController@cancelOrder');
});

Route::get('reserving-time', 'Api\MobilController@reservingTime');
