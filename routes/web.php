<?php

Auth::routes();

Route::get('/', 'KickStartController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{	

	Route::get('user/resetpassword/{id}', array(
		'as' => 'user.resetpassword',
		'uses' => 'UserController@resetpassword'
	));
	Route::any('user/saveresetpassword', array(
		'as' => 'user.saveresetpassword',
		'uses' => 'UserController@saveresetpassword'
	));
	Route::resource('users', 'UserController');
	Route::get('message/list/{type}', 'MessageController@index')->name('messages');
	Route::resource('message', 'MessageController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');	
	Route::get('staff/new/{type}', 'StaffController@form');
	
	Route::get('staff/list/{type}', 'StaffController@index');
	
	Route::resource('staff', 'StaffController');
	
	Route::resource('sampletransporters', 'SampleTransporterController');
	
	Route::get("/sampletracking/statistics", "SampleTrackingController@packageStatistics");
	Route::get("/sampletracking/outbreak", "SampleTrackingController@outbreak");
	Route::resource('sampletracking', 'SampleTrackingController');
	
	Route::get('equipment/down/hubid/{hubid?}/id/{id?}', array(
		'as' => 'equipment.breakdown',
		'uses' => 'EquipmentController@breakdownform'
	));
	Route::get('results/tracking', array(
		'as' => 'results.tracking',
		'uses' => 'SampleTrackingController@results'
	));
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
	Route::get('download/hubinfo/{hubid}/type/{id?}', array(
		'as' => 'download.hubinfo',
		'uses' => 'DownloadController@hubinfo'
	));
	Route::post("/hub/massassignfacilities", array(
        "as"   => "hub.massassignfacilities",
        "uses" => "HubController@massassignfacilities"
    ));
	
	Route::resource('hub', 'HubController');
	
	Route::get('healthunit/new/{type}', 'FacilityController@form');
	
	Route::get('healthunit/view/{type}', 'FacilityController@show');
	
	Route::get("facility/printqr/{id}", array(
        "as"   => "facility.printqr",
        "uses" => "FacilityController@printQr"
    ));
	
	Route::resource('facility', 'FacilityController');
	
	Route::get('routingschedule/create/{hubid}', 'RoutingScheduleController@createform')->name('routingschedulecreate');
	Route::resource('routingschedule', 'RoutingScheduleController');
	
	Route::get("/dailyrouting/view/{date}/hubid/{hubid}", array(
        "as"   => "dailyrouting.view",
        "uses" => "DailyRoutingController@view"
    ));
	Route::any("/dailyrouting/notvisited/status/{date}/", array(
        "as"   => "dailyrouting.notvisited",
        "uses" => "DailyRoutingController@notVisited"
    ));
	Route::post("/dailyrouting/checkdatedata", array(
        "as"   => "dailyrouting.checkdatedata",
        "uses" => "DailyRoutingController@checkDateData"
    ));
	Route::post("/dailyrouting/facilitiesforhub", "DailyRoutingController@facilitiesForHub"
    );
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
	Route::resource('labequipment', 'LabequipmentController');
	Route::get("/labequipment/list/status/{status}/", array(
        "as"   => "labequipment.list",
        "uses" => "LabequipmentController@elist"
    ));
	Route::get('labequipment/down/hubid/{hubid?}/id/{id?}', array(
		'as' => 'labequipment.breakdown',
		'uses' => 'LabequipmentController@breakdownform'
	));
	Route::any("/samples/all/status/{status?}", array(
        "as"   => "samples.all",
        "uses" => "SampleTrackingController@all"
    ));
	Route::any("/samples/processreceipt/p/{packageid?}/pm/{packagemovementid?}", array(
        "as"   => "samples.processreceipt",
        "uses" => "SampleTrackingController@processReceipt"
    ));
	Route::any("/samples/cphl/status/{status?}", array(
        "as"   => "samples.cphl",
        "uses" => "SampleTrackingController@cphl"
    ));
	
	Route::post('/sampletracking/savereferral', array(
		'as' => 'sampletracking.savereferral',
		"uses" => "SampleTrackingController@saveReferral"
	));
	Route::get('/sampletracking/receivesample/{id}', array(
		'as' => 'sampletracking.receivesample',
		"uses" => "SampleTrackingController@receiveRample"
	));
	Route::resource('dailyrouting', 'DailyRoutingController');
	//contact routes
	Route::get('contact/new/category/{category}/type/{type}/obj/{obj?}', 'ContactController@form');
	Route::resource('contact', 'ContactController');
	//custom logout - redirect user to the login page - see controller for more
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::resource('infrastructure', 'InfrastructureController');
	Route::resource('meetingreport', 'MeetingReportController');
	Route::get('qr-code', function () 
	{
	  //echo  QrCode::generate(2);
	  echo QrCode::size(399)->generate(50); 
	 // echo QrCode::size(399)->color(150,90,10)->backgroundColor(10,14,244)->generate(50);
	  exit; 
	});
	Route::get('test/{hubid?}', function($hubid){
		//$bikes = \App\Models\Equipment::where('hubid',$hubid)->whereDoesntHave('bikerider')->pluck("numberplate","id");
		//	print_r($bikes);
		//print_r(getUnassignedBikesforHub($hubid));
		//$bike_objects = \App\Models\Equipment::where('hubid',$hubid)->whereDoesntHave('bikerider')->pluck("numberplate","id");
		/*$facilities_objects = \App\Models\Facility::where('parentid', $hubid)->pluck("name","id");
    		//$html_options = getGenerateHtmlforAjaxSelect($facilities);
			$bikes = [];
			if(!empty($facilities_objects)){
				foreach($facilities_objects as $key => $value){
					array_push($bikes, ['id' => $key, 'plate' => $value]);
				}
			}
			print_r($bikes);*/
			$destinedforcphl = packageStats(5,2);
		$receivedatcphl = packageStats(7,2);
		$hubpackages = packageStats(1,1);
		print_r(['destinedforcphl' => $destinedforcphl,'receivedatcphl' => $receivedatcphl,'hubpackages' => $hubpackages]);
			exit;
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
	Route::get("/samples/receive", array(
        "as"   => "samples.receive",
        "uses" => "SamplesController@recevieSample"
    ));
	Route::post("/samples/processreceipt", array(
        "as"   => "samples.processreceipt",
        "uses" => "SamplesController@processReceipt"
    ));
	Route::get("/notification/facilitiesnotvisited", array(
        "as"   => "notification.facilitiesnotvisited",
        "uses" => "NotificationsController@facilitiesNotVisited"
    ));
    Route::post("/samples/saveunscannedbarcode", array(
        "as"   => "samples.saveunscannedbarcode",
        "uses" => "SamplesController@saveunscannedbarcode"
    ));
    Route::post("/samples/receivesmallpackage", array(
        "as"   => "samples.receivesmallpackage",
        "uses" => "SamplesController@receiveSmallPackage"
    ));
});
Route::get('/settings', 'SettingsController@index')->name('settings');
Route::resource('signup', 'SignupController');
//Route::get('/samples/events/start_date/{start_date?}/end_date/{end_date?}','eidrController@events');