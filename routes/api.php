<?php

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
    $newFile = new UploadedFile( public_path() . '/assets/projects/1.jpg', '1.jpg', 'image/jpeg',null,null, true);

   dd($newFile);
});
Route::get('pages', 'ApiController@getPages');
Route::get('pages/{id}', 'ApiController@getPage');
Route::get('menu-items', 'ApiController@menuItems');
Route::get('inline-blocks', 'ApiController@inlineBlocks');
Route::get('attachments', 'ApiController@attachments');
Route::get('videos', 'ApiController@videos');
Route::get('static_content', 'ApiController@staticContent');
