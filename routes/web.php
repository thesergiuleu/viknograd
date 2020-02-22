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
Route::get('/', 'HomeController@index');
Route::get('review/{review}', 'HomeController@singleReview');
Route::get('extension', 'HomeController@extension');

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);
    //Authenticated Routes
    Route::group(['middleware' => 'auth'], function () {

    });
});
