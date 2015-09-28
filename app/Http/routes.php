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

Route::get('/', array('as' => 'home', 'uses' => 'ProjectController@home'));

//Projects routes
Route::get('search/project', ['as' => 'project.search', 'uses' => 'ProjectController@searchProject']);
Route::resource('project', 'ProjectController');

//Accesses Routes
Route::resource('project.access', 'AccessesController', ['except' => ['show','index']]);
Route::get('admin/key', ['as' => 'admin.key', 'uses' => 'AccessesController@setGlobalKey']);
Route::post('admin/key', ['as' => 'admin.key.save', 'uses' => 'AccessesController@saveGlobalKey']);
Route::get('key/set', ['as' => 'key.set', 'uses' => 'AccessesController@setKey']);
Route::post('key/set', ['as' => 'key.save', 'uses' => 'AccessesController@saveKey']);

//Checklist routes
Route::group(array('prefix'=>'admin'),function(){
	Route::resource('checklist-category', 'ChecklistCategoryController', ['except' => ['show']]);
});

//**** Authentication routes...****//
/////////////////////////////////////

///Guest users
Route::post('guest/login', ['as' => 'guest.login', 'uses' => 'Auth\AuthController@postGuestLogin']);
Route::get('guest/logout', ['as' => 'guest.logout', 'uses' => 'Auth\AuthController@getGuestLogout']);

/// Authenticated users
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' => 'post.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');