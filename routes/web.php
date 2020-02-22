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

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);
    //Authenticated Routes
    Route::group(['middleware' => 'auth'], function () {
        Route::match(['get', 'post'], '/logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/', 'Admin\DashboardController@index')->name('home');
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('home');

        //pages
        Route::get('/page', 'Admin\PageController@index')->name('page');
        Route::get('/page/add', 'Admin\PageController@add')->name('page.add');
        Route::get('/page/edit/{id}', 'Admin\PageController@edit')->name('page.edit')->where('id', '[0-9]+');
        Route::get('/page/show/{id}', 'Admin\PageController@show')->name('page.show')->where('id', '[0-9]+');
        Route::post('/page', 'Admin\PageController@store')->name('page.store');
        Route::put('/page/update/{id}', 'Admin\PageController@update')->name('page.update')->where('id', '[0-9]+');
        Route::delete('/page/delete/{id}', 'Admin\PageController@destroy')->name('page.delete')->where('id', '[0-9]+');
    });
});
