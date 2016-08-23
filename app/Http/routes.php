<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'guest'],function(){
	Route::get('login','AuthController@getlogin');
	Route::post('login','AuthController@postlogin');
});

Route::group(['middleware' => 'auth'],function(){
	Route::get('profile','UploadController@profile');
	Route::get('logout','AuthController@logout');
});
Route::get('/register',['as'=>'user-register','uses'=>'UploadController@register']);
Route::post('/register',['as' => 'user-postregister','uses'=>'UploadController@postregister']);

Route::get('/uploads/{folder?}','UploadController@uplds');
Route::post('/uploads','UploadController@postuplds');
Route::get('/folder','UploadController@getfolder');
Route::post('/folder','UploadController@postfolder');
Route::get('/delete/{id}/{name}/{dir?}','UploadController@destroy');

