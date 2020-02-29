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

        //attachments routes
        Route::post('/attachment/insert', 'Admin\AttachmentsController@upload_from_editor')->name('attachment.insert');
        Route::delete('/attachment/delete/{id}', 'Admin\AttachmentsController@destroy')->name('attachment.delete')->where('id', '[0-9]+');

        //pages
        Route::get('/page/add/{page_block?}', 'Admin\PageController@add')->name('page.add');
        Route::get('/page/edit/{id}/{page_block?}', 'Admin\PageController@edit')->name('page.edit')->where('id', '[0-9]+');
        Route::get('/page/show/{id}', 'Admin\PageController@show')->name('page.show')->where('id', '[0-9]+');
        Route::post('/page', 'Admin\PageController@store')->name('page.store');
        Route::put('/page/update/{id}', 'Admin\PageController@update')->name('page.update')->where('id', '[0-9]+');
        Route::delete('/page/delete/{id}', 'Admin\PageController@destroy')->name('page.delete')->where('id', '[0-9]+');
        Route::get('/page/{page_block?}', 'Admin\PageController@index')->name('page');


        //projects
        Route::get('/project/add/{page_block?}', "Admin\ProjectsController@add")->name('project.add');
        Route::get('/project/edit/{id}/{page_block?}', 'Admin\ProjectsController@edit')->name('project.edit')->where('id', '[0-9]+');
        Route::get('/project/show/{id}', 'Admin\ProjectsController@show')->name('project.show')->where('id', '[0-9]+');
        Route::post('/project', 'Admin\ProjectsController@store')->name('project.store');
        Route::put('/project/update/{id}', 'Admin\ProjectsController@update')->name('project.update')->where('id', '[0-9]+');
        Route::delete('/project/delete/{id}', 'Admin\ProjectsController@destroy')->name('project.delete')->where('id', '[0-9]+');
        Route::get('/project/{page_block?}', 'Admin\ProjectsController@index')->name('project');
    });
});
