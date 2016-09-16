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
Route::model('project', 'App\Project');

// Checklist routes
Route::resource('project.checklist','ChecklistAnswerController', ['only' => ['index','update']]);

// Bug reporting routes
Route::post('project/{project}/bug/search', ['as' => 'bug.search', 'uses' => 'BugController@search']);
Route::post('project/{project}/bug/{bug}/add/image', ['as' => 'bug.image.add', 'uses' => 'BugController@addImage']);
Route::post('project/{project}/bug/{bug}/delete/image', ['as' => 'bug.image.delete', 'uses' => 'BugController@deleteImage']);
Route::post('project/{project}/bug/{bug}/state/change', ['as' => 'bug.state.change', 'uses' => 'BugController@stateChange']);
Route::resource('project.bug', 'BugController');
Route::model('bug', 'App\Bug');

// Bug comments
// TODO : Plan the edit and destroy features for comments
Route::post('project/{project}/bug/{bug}/comment',  ['as' => 'project.bug.comment.store', 'uses' => 'BugCommentController@store']);

// Notifications
Route::post('project/{project}/subscribe', ['as' => 'project.subscribe', 'uses' => 'NotificationController@switchNotification']);

// Mémos
Route::post('memo/sort',['as' => 'sort.memos','uses' => 'MemoController@order']);
Route::put('memo/{memo}', ['as' => 'memo.update', 'uses' => 'MemoController@update']);
Route::post('memo/check/{memo}', ['as' => 'memo.check', 'uses' => 'MemoController@check']);
Route::resource('project.memo', 'MemoController', ['except' => ['show', 'create']]);
Route::model('memo', 'App\Memo');

// Documentation
Route::get('project/{project}/doc/', ['as' => 'project.doc.index', 'uses' => 'DocumentationController@index']);
Route::get('project/{project}/doc/edit', ['as' => 'project.doc.edit', 'uses' => 'DocumentationController@edit']);
Route::get('project/{project}/doc/publish', ['as' => 'project.doc.publish', 'uses' => 'DocumentationController@publish']);
Route::get('project/{project}/doc/pdf', ['as' => 'project.doc.pdf', 'uses' => 'DocumentationController@generatePdf']);
Route::put('project/{project}/doc', ['as' => 'project.doc.update', 'uses' => 'DocumentationController@update']);
Route::delete('project/{project}/destroy', ['as' => 'project.doc.destroy', 'uses' => 'DocumentationController@destroy']);

// Internal Documentation
Route::get('project/{project}/internaldoc/', ['as' => 'project.internaldoc.index', 'uses' => 'InternalDocumentationController@index']);
Route::get('project/{project}/internaldoc/edit', ['as' => 'project.internaldoc.edit', 'uses' => 'InternalDocumentationController@edit']);
Route::put('project/{project}/internaldoc', ['as' => 'project.internaldoc.update', 'uses' => 'InternalDocumentationController@update']);
Route::delete('project/{project}/internaldoc/destroy', ['as' => 'project.internaldoc.destroy', 'uses' => 'InternalDocumentationController@destroy']);

// Mockups & mockup categories
Route::post('project/{project}/mockup/{mockup}/delete/{type}', ['as' => 'mockup.image.delete', 'uses' => 'MockupController@deleteImage']);
Route::resource('project.mockup', 'MockupController');
Route::post('mockup/sort',['as' => 'sort.mockup','uses' => 'MockupController@order']);
Route::model('mockup', 'App\Mockup');
Route::post('mockup-category/sort',['as' => 'sort.mockup-category','uses' => 'MockupCategoryController@order']);
Route::resource('project.mockup-category', 'MockupCategoryController', ['except' => ['store', 'create', 'index']]);
Route::model('mockup-category', 'App\MockupCategory');

// Contacts
Route::resource('project.contacts', 'ContactController');
Route::model('contacts', 'App\Contact');

// Accesses Routes
Route::resource('project.access', 'AccessesController', ['except' => ['show','index']]);
Route::get('key/set', ['as' => 'key.set', 'uses' => 'AccessesController@setKey']);
Route::post('key/set', ['as' => 'key.save', 'uses' => 'AccessesController@saveKey']);
Route::Model('access', 'App\Access');

// Admin routes
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::group(array('prefix'=>'admin', 'middleware' => 'auth'), function(){
	Route::resource('checklist-category', 'ChecklistCategoryController', ['except' => ['show', 'create']]);
	Route::post('checklist-category/sort',['as' => 'sort.categories','uses' => 'ChecklistCategoryController@order']);
	Route::model('checklist_category', 'App\ChecklistCategory');

	Route::resource('checklist-point', 'ChecklistPointController', ['except' => ['show', 'create']]);
	Route::post('checklist-point/sort',['as' => 'sort.checklist','uses' => 'ChecklistPointController@order']);
	Route::model('checklist_point', 'App\ChecklistPoint');

	Route::get('key', ['as' => 'admin.key', 'uses' => 'AccessesController@setGlobalKey']);
	Route::post('key', ['as' => 'admin.key.save', 'uses' => 'AccessesController@saveGlobalKey']);

    Route::resource('user', 'UserController', ['except' => ['create', 'store', 'show']]);
	Route::model('user', 'App\User');
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
