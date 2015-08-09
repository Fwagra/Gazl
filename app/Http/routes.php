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
Route::resource('project', 'ProjectController');
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('guest/login', ['as' => 'guest.login', 'uses' => 'Auth\AuthController@postGuestLogin']);
Route::post('auth/login', ['as' => 'post.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');