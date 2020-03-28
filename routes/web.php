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
    abort(403);
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
        Route::post('/attachment/change_position/{id}', 'Admin\AttachmentsController@change_position')->name('attachment.change_position');
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

        //news
        Route::get('/new/add/{page_block?}', "Admin\NewsController@add")->name('new.add');
        Route::get('/new/edit/{id}/{page_block?}', 'Admin\NewsController@edit')->name('new.edit')->where('id', '[0-9]+');
        Route::get('/new/show/{id}', 'Admin\NewsController@show')->name('new.show')->where('id', '[0-9]+');
        Route::post('/new', 'Admin\NewsController@store')->name('new.store');
        Route::put('/new/update/{id}', 'Admin\NewsController@update')->name('new.update')->where('id', '[0-9]+');
        Route::delete('/new/delete/{id}', 'Admin\NewsController@destroy')->name('new.delete')->where('id', '[0-9]+');
        Route::get('/new/{page_block?}', 'Admin\NewsController@index')->name('new');

        //contacts
        Route::get('/contact/add/{page_block?}', "Admin\ContactsController@add")->name('contact.add');
        Route::get('/contact/edit/{id}/{page_block?}', 'Admin\ContactsController@edit')->name('contact.edit')->where('id', '[0-9]+');
        Route::get('/contact/show/{id}', 'Admin\ContactsController@show')->name('contact.show')->where('id', '[0-9]+');
        Route::post('/contact', 'Admin\ContactsController@store')->name('contact.store');
        Route::put('/contact/update/{id}', 'Admin\ContactsController@update')->name('contact.update')->where('id', '[0-9]+');
        Route::delete('/contact/delete/{id}', 'Admin\ContactsController@destroy')->name('contact.delete')->where('id', '[0-9]+');
        Route::get('/contact/{page_block?}', 'Admin\ContactsController@index')->name('contact');

        //our works
        Route::get('/our_work/add/{page_block?}', "Admin\OurWorksController@add")->name('our_work.add');
        Route::get('/our_work/edit/{id}/{page_block?}', 'Admin\OurWorksController@edit')->name('our_work.edit')->where('id', '[0-9]+');
        Route::get('/our_work/show/{id}', 'Admin\OurWorksController@show')->name('our_work.show')->where('id', '[0-9]+');
        Route::post('/our_work', 'Admin\OurWorksController@store')->name('our_work.store');
        Route::put('/our_work/update/{id}', 'Admin\OurWorksController@update')->name('our_work.update')->where('id', '[0-9]+');
        Route::delete('/our_work/delete/{id}', 'Admin\OurWorksController@destroy')->name('our_work.delete')->where('id', '[0-9]+');
        Route::get('/our_work/{page_block?}', 'Admin\OurWorksController@index')->name('our_work');

        //our works
        Route::get('/job/add/{page_block?}', "Admin\JobsController@add")->name('job.add');
        Route::get('/job/edit/{id}/{page_block?}', 'Admin\JobsController@edit')->name('job.edit')->where('id', '[0-9]+');
        Route::get('/job/show/{id}', 'Admin\JobsController@show')->name('job.show')->where('id', '[0-9]+');
        Route::post('/job', 'Admin\JobsController@store')->name('job.store');
        Route::put('/job/update/{id}', 'Admin\JobsController@update')->name('job.update')->where('id', '[0-9]+');
        Route::delete('/job/delete/{id}', 'Admin\JobsController@destroy')->name('job.delete')->where('id', '[0-9]+');
        Route::get('/job/{page_block?}', 'Admin\JobsController@index')->name('job');

        Route::post('/menu_item/position', 'Admin\ApiMenuItemsController@changeMenuPosition')->name('change_menu_position');
        Route::get('/menu_item/{page_block?}', 'Admin\ApiMenuItemsController@index')->name('menu_item');


        //our works
        Route::get('/static_content/add/{page_block?}', "Admin\StaticContentController@add")->name('static_content.add');
        Route::get('/static_content/edit/{id}/{page_block?}', 'Admin\StaticContentController@edit')->name('static_content.edit')->where('id', '[0-9]+');
        Route::get('/static_content/show/{id}', 'Admin\StaticContentController@show')->name('static_content.show')->where('id', '[0-9]+');
        Route::post('/static_content', 'Admin\StaticContentController@store')->name('static_content.store');
        Route::put('/static_content/update/{id}', 'Admin\StaticContentController@update')->name('static_content.update')->where('id', '[0-9]+');
        Route::delete('/static_content/delete/{id}', 'Admin\StaticContentController@destroy')->name('static_content.delete')->where('id', '[0-9]+');
        Route::get('/static_content/{page_block?}', 'Admin\StaticContentController@index')->name('static_content');
    });
});
