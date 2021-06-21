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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user');

Route::get('/email/verify', [App\Http\Controllers\Auth\PasswordResetController::class, 'verify_email'])->name('verify');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/password/reset', App\Http\Controllers\Auth\PasswordResetController::class);
Route::view('customers','customers');
Route::view('cars','cars')->middleware('admin','auth');
Route::view('master','layouts/master');
