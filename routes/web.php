<?php

Auth::routes();

Route::get('/', 'KickStartController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');
Route::group(['middleware' => 'auth'], function()
{	
	Route::resource('posts', 'PostController');
	
	Route::get('staff/new/{type}', 'StaffController@form');
	
	Route::get('staff/list/{type}', 'StaffController@index');
	
	Route::resource('staff', 'StaffController');
	
	Route::resource('sampletransporters', 'SampleTransporterController');
	
	Route::resource('equipment', 'EquipmentController');
	
	Route::resource('organization', 'OrganizationController');
	
	Route::resource('dashboard', 'DashboardController');
	
	Route::resource('hub', 'HubController');
	
	Route::get('healthunit/new/{type}', 'FacilityController@form');
	
	Route::get('healthunit/view/{type}', 'FacilityController@show');
	
	Route::resource('facility', 'FacilityController');
	Route::resource('routingschedule', 'RoutingScheduleController');
	Route::resource('dailyrouting', 'DailyRoutingController');
	//contact routes
	Route::get('contact/new/category/{category}/type/{type}/obj/{obj?}', 'ContactController@form');
	Route::resource('contact', 'ContactController');
	//custom logout - redirect user to the login page - see controller for more
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});