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
        Route::get('/page/add/{page_block?}', 'Admin\PageController@add')->name('page.add');
        Route::get('/page/edit/{id}/{page_block?}', 'Admin\PageController@edit')->name('page.edit')->where('id', '[0-9]+');
        Route::get('/page/show/{id}', 'Admin\PageController@show')->name('page.show')->where('id', '[0-9]+');
        Route::post('/page', 'Admin\PageController@store')->name('page.store');
        Route::put('/page/update/{id}', 'Admin\PageController@update')->name('page.update')->where('id', '[0-9]+');
        Route::delete('/page/delete/{id}', 'Admin\PageController@destroy')->name('page.delete')->where('id', '[0-9]+');
        Route::get('/page/{page_block?}', 'Admin\PageController@index')->name('page');


        //pages
        Route::get('/inline_block/add/{page_block?}', "Admin\InlineBlockController@add")->name('inline_block.add');
        Route::get('/inline_block/edit/{id}/{page_block?}', 'Admin\InlineBlockController@edit')->name('inline_block.edit')->where('id', '[0-9]+');
        Route::get('/inline_block/show/{id}', 'Admin\InlineBlockController@show')->name('inline_block.show')->where('id', '[0-9]+');
        Route::post('/inline_block', 'Admin\InlineBlockController@store')->name('inline_block.store');
        Route::put('/inline_block/update/{id}', 'Admin\InlineBlockController@update')->name('inline_block.update')->where('id', '[0-9]+');
        Route::delete('/inline_block/delete/{id}', 'Admin\InlineBlockController@destroy')->name('inline_block.delete')->where('id', '[0-9]+');
        Route::get('/inline_block/{page_block?}', 'Admin\InlineBlockController@index')->name('inline_block');
    });
});
