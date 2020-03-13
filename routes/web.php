<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// student routes
Route::middleware(['auth', 'isStudent'])->group(function () {
    Route::get('/student', 'StudentsController@index')->name('show');
    Route::post('/student', 'StudentsController@store')->name('reserve');
    Route::delete('/student/{order}', 'StudentsController@destroy')->name('delete');
});
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    // Student Routes
    Route::get('students', 'AdminController@students')->name('students');
    Route::get('user/{user}/edit', 'AdminController@edit')->name('edit');
    Route::patch('user/{user}', 'AdminController@update')->name('update');
    Route::delete('user/{user}', 'AdminController@delete')->name('delete');
    Route::put('user/{user}', 'AdminController@activate')->name('activate');

    // Moderator Routes
    Route::get('moderators', 'AdminController@moderators')->name('moderators');

    // Add Users Routes
    Route::get('add-user', 'AdminController@addUser')->name('add-user');
    Route::post('store-user', 'AdminController@storeUser')->name('store-user');

    // Import and Export Users
    Route::get('export', 'AdminController@export')->name('export');
    Route::post('import', 'AdminController@import')->name('import');
});

Route::prefix('orders')->name('orders.')->middleware(['auth', 'isAdminModerator'])->group(function () {
    // Orders Routes
    Route::get('/', 'AdminController@showOrders')->name('show');
    Route::put('order/time/{reservingTime}', 'AdminController@updateTime')->name('updateTime');
    Route::post('order/time', 'AdminController@createTime')->name('createTime');
    Route::put('order/cancel/{order}', 'AdminController@cancelOrder')->name('cancelOrder');
    // Route::delete('order/delete/{order}', 'AdminController@deleteOrder')->name('deleteOrder');
});
