<?php

Auth::routes();

Route::get('/', 'KickStartController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::group(['middleware' => 'auth'], function()
{	
	Route::resource('posts', 'PostController');
	
	Route::get('staff/new/{type}', 'StaffController@form');
	
	Route::get('staff/list/{type}', 'StaffController@index');
	
	Route::resource('staff', 'StaffController');
	
	Route::resource('sampletransporters', 'SampleTransporterController');
	
	Route::get('equipment/down/hubid/{hubid}/id/{id?}', 'EquipmentController@breakdownform');
	Route::get('equipment/list/status/{id?}/', 'EquipmentController@elist');
	Route::post('equipment/bikesforhub', 'EquipmentController@bikesforhub');
	Route::post('staff/bikewithoutrider', 'StaffController@bikeWithoutRider');
	Route::post('equipment/hubbikes/hubid/{hubid}', 'EquipmentController@hubbikes');
	Route::get('equipment/list/service/{service?}/', 'EquipmentController@servicecont');
	Route::post('equipment/savebreakdown', 'EquipmentController@savebreakdown');
	Route::post('equipment/updatebreakdownstatus', 'EquipmentController@updatebreakdownstatus');
	Route::resource('equipment', 'EquipmentController');
	
	Route::resource('organization', 'OrganizationController');
	
	Route::resource('dashboard', 'DashboardController');
	
	Route::resource('hub', 'HubController');
	
	Route::get('healthunit/new/{type}', 'FacilityController@form');
	
	Route::get('healthunit/view/{type}', 'FacilityController@show');
	
	Route::resource('facility', 'FacilityController');
	Route::resource('routingschedule', 'RoutingScheduleController');
	
	Route::post('dailyrouting/setweekendingdates', 'DailyRoutingController@setweekendingdates');
	
	Route::resource('dailyrouting', 'DailyRoutingController');
	//contact routes
	Route::get('contact/new/category/{category}/type/{type}/obj/{obj?}', 'ContactController@form');
	Route::resource('contact', 'ContactController');
	//custom logout - redirect user to the login page - see controller for more
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::get('test/{hubid}', function($hubid){
		//$bikes = \App\Models\Equipment::where('hubid',$hubid)->whereDoesntHave('bikerider')->pluck("numberplate","id");
		//	print_r($bikes);
		//print_r(getUnassignedBikesforHub($hubid));
		$bike_objects = \App\Models\Equipment::where('hubid',$hubid)->whereDoesntHave('bikerider')->pluck("numberplate","id");
			$bikes = [];
			if(!empty($bike_objects)){
				foreach($bike_objects as $key => $value){
					array_push($bikes, ['id' => $key, 'plate' => $value]);
				}
			}
			print_r($bikes);
	});
});