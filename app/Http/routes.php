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
	Route::get('shares/reports', 'AccountController@report_listings');

	Route::post('accounts/assign_user', 'AccountController@assign_user');
	Route::get('accounts/{id}/assign', 'AccountController@assign');
	Route::get('accounts/inactives', 'ReportController@inactives');
	Route::get('accounts/{id}/accept', 'AccountController@accept');
	Route::resource('accounts', 'AccountController');

	Route::get('groups.json', 'GroupController@json');
	Route::resource('groups', 'GroupController');

	Route::resource('memberships', 'MembershipSlotController');

	Route::get('review/{id}', 'ComplaintController@create');
	Route::resource('complaints', 'ComplaintController');
	
	Route::get('users.json', 'UserController@json');
	Route::resource('users', 'UserController');

	Route::get('events.json', 'EventController@json');
	Route::resource('events', 'EventController');

	Route::post('/resources/renting', 'ResourceController@store_rent');
	Route::get('/resources/rent', 'ResourceController@rent');

	
	Route::get('resource_types.json', 'ResourceController@type_json');


	Route::group(['prefix' => 'config'], function ()
	{
		Route::get('resources.json', 'ResourceController@json');
		Route::resource('resources', 'ResourceController');

		Route::get('slots.json', 'MembershipSlotController@json');
		Route::resource('membership_slots', 'MembershipSlotController');
	});

	Route::get('graph_options.json', 'ReportController@graph_options');
	Route::group(['prefix' => 'reports'], function () {
    	Route::get('newusers', 'ReportController@newusers');
    	Route::post('newusers', 'ReportController@newusers');
    	Route::get('newusers.tsv/{start}/{end}/{graph_interval}', 'ReportController@newusers_data');

    	Route::get('inactive_members', 'ReportController@inactives');

    	Route::get('user_activity_of_group', 'ReportController@user_activity_of_group');
    	Route::post('user_activity_of_group', 'ReportController@user_activity_of_group');
    	Route::get('user_activity_of_group.tsv/{start}/{end}/{group_id}', 'ReportController@user_activity_of_group_data');

    	Route::get('club_share_transfers', 'ReportController@club_share_transfers');

    	Route::get('facility_usage', 'ReportController@facility_usage');
    	Route::post('facility_usage', 'ReportController@facility_usage');
    	Route::get('facility_usage.tsv/{start}/{end}/{facility_type}', 'ReportController@facility_usage_data');
    	Route::get('facility_usage.tsv/{start}/{end}', 'ReportController@facility_usage_data');

    	Route::get('user_activity_within_event', 'ReportController@user_activity_within_event');
    	Route::post('user_activity_within_event', 'ReportController@user_activity_within_event');
    	Route::get('user_activity_within_event.tsv/{start}/{end}/{graph_interval}/{facility_type}', 'ReportController@user_activity_within_event_data');
	});

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
