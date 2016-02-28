<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'GuestController@index');

	Route::get('shares', 'AccountController@listings');
	Route::get('shares/post/create', 'AccountController@post_listing');
	Route::get('shares/post', 'AccountController@create_listing');
	Route::get('shares/remove', 'AccountController@remove_listing');

	Route::post('accounts/assign_user', 'AccountController@assign_user');
	Route::get('accounts/{id}/assign', 'AccountController@assign');
	Route::get('users.json', 'UserController@json');
	Route::resource('accounts', 'AccountController');

	Route::get('groups.json', 'GroupController@json');
	Route::resource('groups', 'GroupController');

	Route::resource('memberships', 'MembershipSlotController');

	Route::get('review/{id}', 'ComplaintController@create');
	Route::resource('complaints', 'ComplaintController');

	Route::get('users.json', 'UserController@json');
	Route::resource('users', 'UserController');

	Route::resource('events', 'EventController');

	Route::post('/resources/renting', 'ResourceController@store_rent');
	Route::get('/resources/rent', 'ResourceController@rent');

	Route::get('resources.json', 'ResourceController@json');
	Route::resource('resources', 'ResourceController');


	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
