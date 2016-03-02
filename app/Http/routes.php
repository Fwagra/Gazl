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

// Projects routes
Route::get('search/project', ['as' => 'project.search', 'uses' => 'ProjectController@searchProject']);
Route::resource('project', 'ProjectController');

// Checklist routes
Route::resource('project.checklist','ChecklistAnswerController', ['except' => ['show','store', 'edit', 'delete', 'create']]);

// Bug reporting routes
Route::post('project/{project}/bug/search', ['as' => 'bug.search', 'uses' => 'BugController@search']);
Route::post('project/{project}/bug/{bug}/add/image', ['as' => 'bug.image.add', 'uses' => 'BugController@addImage']);
Route::post('project/{project}/bug/{bug}/delete/image', ['as' => 'bug.image.delete', 'uses' => 'BugController@deleteImage']);
Route::post('project/{project}/bug/{bug}/state/change', ['as' => 'bug.state.change', 'uses' => 'BugController@stateChange']);
Route::resource('project.bug', 'BugController');
// Bug comments
Route::resource('project.bug.comment', 'BugCommentController', ['only' => ['store','update', 'destroy']]);

// Accesses Routes
Route::resource('project.access', 'AccessesController', ['except' => ['show','index']]);
Route::get('key/set', ['as' => 'key.set', 'uses' => 'AccessesController@setKey']);
Route::post('key/set', ['as' => 'key.save', 'uses' => 'AccessesController@saveKey']);

// Admin routes
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::group(array('prefix'=>'admin', 'middleware' => 'auth'), function(){
	Route::resource('checklist-category', 'ChecklistCategoryController', ['except' => ['show', 'create']]);
	Route::resource('checklist-point', 'ChecklistPointController', ['except' => ['show', 'create']]);
	Route::post('checklist-category/sort',['as' => 'sort.categories','uses' => 'ChecklistCategoryController@order']);
	Route::post('checklist-point/sort',['as' => 'sort.checklist','uses' => 'ChecklistPointController@order']);
	Route::get('key', ['as' => 'admin.key', 'uses' => 'AccessesController@setGlobalKey']);
	Route::post('key', ['as' => 'admin.key.save', 'uses' => 'AccessesController@saveGlobalKey']);
});

//**** Authentication routes...****//
/////////////////////////////////////

// Guest users
Route::post('guest/login', ['as' => 'guest.login', 'uses' => 'Auth\AuthController@postGuestLogin']);
Route::get('guest/logout', ['as' => 'guest.logout', 'uses' => 'Auth\AuthController@getGuestLogout']);

// Authenticated users
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' => 'post.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');