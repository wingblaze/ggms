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
	Route::get('/about', 'GuestController@about');

	Route::get('shares', 'AccountController@listings');
	Route::get('shares/post/create', 'AccountController@post_listing');
	Route::get('shares/post', 'AccountController@create_listing');
	Route::get('shares/remove', 'AccountController@remove_listing');
	Route::get('shares/reports', 'AccountController@report_listings');

	Route::post('accounts/assign_user', 'AccountController@assign_user');
	Route::post('accounts/assign_slot', 'AccountController@assign_slot');
	Route::get('accounts/{id}/assign', 'AccountController@assign');
	Route::get('accounts/inactives', 'ReportController@inactives');
	Route::get('accounts/{id}/accept', 'AccountController@accept');
	Route::get('accounts/{id}/clear_payment', 'AccountController@clear_payment');
	Route::get('accounts/{id}/clear_account', 'AccountController@clear_account');
	Route::resource('accounts', 'AccountController');

	Route::get('groups.json', 'GroupController@json');
	Route::resource('groups', 'GroupController');

	Route::get('memberships/auction', 'MembershipSlotController@auction');
	Route::resource('memberships', 'MembershipSlotController');


	Route::get('review/{id}', 'ComplaintController@create');
	Route::resource('complaints', 'ComplaintController');
	
	Route::get('users.json', 'UserController@json');
	Route::post('users/update', 'UserController@update_user');
	Route::resource('users', 'UserController');

	Route::get('events.json', 'EventController@json');
	Route::get('events/mine/{id}', 'EventController@my_events');
	Route::resource('events', 'EventController');


	Route::get('billings.json', 'BillingController@json');
	Route::resource('billings', 'BillingController');
	Route::get('billings/{id}/delete', 'BillingController@destroy');

	Route::get('assets.json', 'AssetController@json');
	Route::resource('assets', 'AssetController');
	Route::get('assets/{id}/delete', 'AssetController@destroy');

	Route::get('auditings.json', 'AuditingController@json');
	Route::resource('auditings', 'AuditingController');
	Route::get('auditings/{id}/delete', 'AuditingController@destroy');

	Route::get('terminals.json', 'TerminalController@json');
	Route::resource('terminals', 'TerminalController');
	Route::get('terminals/{id}/delete', 'TerminalController@destroy');

	Route::get('vouchers.json', 'VoucherController@json');
	Route::resource('vouchers', 'VoucherController');
	Route::get('vouchers/{id}/delete', 'VoucherController@destroy');

	Route::get('products.json', 'ProductController@json');
	Route::resource('products', 'ProductController');
	Route::get('products/{id}/delete', 'ProductController@destroy');

	Route::get('purchases.json', 'PurchaseController@json');
	Route::resource('purchases', 'PurchaseController');
	Route::get('purchases/{id}/delete', 'PurchaseController@destroy');

	Route::get('applications.json', 'ApplicationController@json');
	Route::resource('applications', 'ApplicationController');
	Route::get('applications/{id}/delete', 'ApplicationController@destroy');
	
	Route::get('forms/{type?}', 'ApplicationController@index');
	Route::get('forms/create/{type}', 'ApplicationController@create');
	
	


	Route::post('/resources/renting', 'ResourceController@store_rent');
	Route::get('/resources/rent', 'ResourceController@rent');
	Route::get('/resources/unpaid_rent', 'ResourceController@unpaid_listing');
	Route::get('/resources/{id}/paid', 'ResourceController@paid_listing');
	Route::get('/resources/mylistings', 'ResourceController@my_listings');
	Route::get('/resources/golf', 'ResourceController@golf');
	Route::get('/resources/maintenance', 'ResourceController@maintenance');

	
	


	Route::group(['prefix' => 'config'], function ()
	{
		Route::get('resource_types.json', 'ResourceController@type_json');
		Route::get('resources_golf.json', 'ResourceController@golf_json');
		Route::get('resources.json', 'ResourceController@json');
		Route::resource('resources', 'ResourceController');

		Route::get('slots.json', 'MembershipSlotController@json');
		Route::post('slots/update', 'MembershipSlotController@update_slot');
		Route::resource('membership_slots', 'MembershipSlotController');
	});

	// ---- REPORTS ---- 

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
