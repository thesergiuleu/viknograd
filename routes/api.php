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
#Register/Login routes
Route::post('/register', 'Auth\AuthenticationController@register');
Route::post('/login', 'Auth\AuthenticationController@login');

Route::get('magic', function () {
   $items = \App\Page::all();
   file_put_contents('pages.json',  json_encode($items));
});
Route::get('pages', 'ApiController@getPages');
Route::get('pages/{id}', 'ApiController@getPage');
Route::get('menu-items', 'ApiController@menuItems');
