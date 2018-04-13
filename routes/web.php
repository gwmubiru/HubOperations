<?php

Auth::routes();

Route::get('/', 'KickStartController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{	Route::resource('users', 'UserController');
	Route::get('message/list/{type}', 'MessageController@index')->name('messages');
	Route::resource('message', 'MessageController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');	
	Route::get('staff/new/{type}', 'StaffController@form');
	
	Route::get('staff/list/{type}', 'StaffController@index');
	
	Route::resource('staff', 'StaffController');
	
	Route::resource('sampletransporters', 'SampleTransporterController');
	Route::resource('sampletracking', 'SampleTrackingController');
	
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
	Route::get('dashboard/coordinator', array(
		'as' => 'dashboard.coordinator',
		'uses' => 'DashboardController@coordinator'
	));
	Route::resource('dashboard', 'DashboardController');
	
	Route::get("/hub/assignfacility", array(
        "as"   => "hub.assignfacility",
        "uses" => "HubController@assignfacility"
    ));
	
	Route::post("/hub/massassignfacilities", array(
        "as"   => "hub.massassignfacilities",
        "uses" => "HubController@massassignfacilities"
    ));
	
	Route::resource('hub', 'HubController');
	
	Route::get('healthunit/new/{type}', 'FacilityController@form');
	
	Route::get('healthunit/view/{type}', 'FacilityController@show');
	
	Route::resource('facility', 'FacilityController');
	
	Route::get('routingschedule/create/{hubid}', 'RoutingScheduleController@createform')->name('routingschedulecreate');
	Route::resource('routingschedule', 'RoutingScheduleController');
	
	Route::get("/dailyrouting/view/{date}/hubid/{hubid}", array(
        "as"   => "dailyrouting.view",
        "uses" => "DailyRoutingController@view"
    ));
	Route::post("/dailyrouting/checkdatedata", array(
        "as"   => "dailyrouting.checkdatedata",
        "uses" => "DailyRoutingController@checkDateData"
    ));
	Route::get("/dailyrouting/create/thedate/{thedate}/facilityid/{facilityid}/bikeid/{bikeid}/transporterid/{transporterid}", array(
        "as"   => "dailyrouting.createform",
        "uses" => "DailyRoutingController@createform"
    ));	
	
	Route::any("/dailyrouting/samplelist", array(
        "as"   => "dailyrouting.samplelist",
        "uses" => "DailyRoutingController@sampleList"
    ));
	Route::any("/dailyrouting/resultlist", array(
        "as"   => "dailyrouting.resultlist",
        "uses" => "DailyRoutingController@resultList"
    ));
	Route::resource('dailyrouting', 'DailyRoutingController');
	//contact routes
	Route::get('contact/new/category/{category}/type/{type}/obj/{obj?}', 'ContactController@form');
	Route::resource('contact', 'ContactController');
	//custom logout - redirect user to the login page - see controller for more
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::resource('infrastructure', 'InfrastructureController');
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
	
	Route::get('testing/message', function(){
		//exit('in messages');
		//$receiver = \App\User::find(3); 
		//echo $receiver->id; exit;
		$messageData = [
			'content' => 'Another test33', // the content of the message
			'to_id' => 2, // Who should receive the message
			'from_id' => 3,
		];
	try{
		\App\Models\Message::createFromRequest($messageData);
		echo 'created';
		//exit;
	}catch (\Exception $e) {
			print_r($e);
			exit;
			
		}
	});
});