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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('admin', 'HomeController@adminHome')->middleware('admin');

Route::resource('movies', 'MovieController')->middleware('admin');
Route::resource('screenings', 'ScreeningController')->middleware('auth');
Route::resource('reservations', 'ReservationController')->middleware('auth');
