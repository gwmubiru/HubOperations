<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use \App\Models\LookupType as LookupType;
use \App\Models\Equipment as Equipment;
class EquipmentController extends Controller {

    public function __construct() {
       // $this->middleware(['auth', 'clearance']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
		if(Auth::user()->hasRole('In_charge')){
			$equipment = Equipment::where('hubid',Auth::user()->hubid)->orderby('id', 'desc')->paginate(10);
		}else{
			$equipment = Equipment::orderby('id', 'desc')->paginate(10); 
		}
		//print_R($equipment);
		//exit;
        return view('equipment.list', compact('equipment'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		$hubsdropdown = getAllHubs();
		
		$lt = new LookupType();
		$lt->name = 'YES_NO';
		$yesnooptions = $lt->getOptionValuesAndDescription();
		
		$lt->name = 'SERVICE_FREQ_UNITS';
		$servicefreqdropdown = $lt->getOptionValuesAndDescription();
		
		$lt->name = 'WARRANTY_UNITS';
		$warrantyunitsdropdown = $lt->getOptionValuesAndDescription();
		
       return View('equipment.create', compact('hubsdropdown', 'yesnooptions', 'servicefreqdropdown', 'warrantyunitsdropdown'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
		
		//Validate all fields
         $equipment = new \App\Models\Equipment;
		try {
			$equipment->facilityid = $request->facilityid;
			$equipment->hubid = $request->facilityid;
			$equipment->type = 1;
			$equipment->createdby = 1;
			$equipment->enginenumber = $request->enginenumber;
			$equipment->chasisnumber = $request->chasisnumber;
			$equipment->modelnumber = $request->modelnumber;
			$equipment->yearofmanufacture = $request->yearofmanufacture;
			$equipment->brand = $request->brand;
			$equipment->enginecapacity = $request->enginecapacity;
			$equipment->insurance = $request->insurance;
			$equipment->numberplate = $request->numberplate;
			$equipment->color = $request->color;
			//save dates
			$equipment->purchasedon = date('Y-m-d H:s:i', strtotime($request->purchasedon));
			$equipment->deliveredtohubon = date('Y-m-d H:s:i', strtotime($request->deliveredtohubon)); 
			$equipment->warrantyperiod = $request->warrantyperiod;
			$equipment->warrantyperiodunits = $request->warrantyperiodunits;
			$equipment->recommendedservicefrequency = $request->recommendedservicefrequency;
			$equipment->servicefrequencyunits = $request->servicefrequencyunits;
			$equipment->hasservicecontract = $request->hasservicecontract;
			
			$equipment->save();
			
			return redirect()->route('equipment.show', array('id' => $equipment->id));

		}catch (\Exception $e) {
			print_r('faild to save'.$e);
			exit;
			return redirect()->route('equipment.create')
            ->with('flash_message', 'failed');
		}
    //Display a successful message upon save
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		$equipment = Equipment::findOrFail($id); //Find post of id = $id
		//$servd =  LookupType::getLookupValueDescription("YES_NO", $equipment->hasservicecontract);
        return view ('equipment.show', compact('equipment'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
		$equipment = Equipment::findOrFail($id);
		$hubsdropdown = getAllHubs();
		
		$lt = new LookupType();
		$lt->name = 'YES_NO';
		$yesnooptions = $lt->getOptionValuesAndDescription();
		
		$lt->name = 'SERVICE_FREQ_UNITS';
		$servicefreqdropdown = $lt->getOptionValuesAndDescription();
		
		$lt->name = 'WARRANTY_UNITS';
		$warrantyunitsdropdown = $lt->getOptionValuesAndDescription();
		
       return View('equipment.edit', compact('equipment','hubsdropdown', 'yesnooptions', 'servicefreqdropdown', 'warrantyunitsdropdown'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
		//Validate all fields
         $equipment = Equipment::findOrFail($id);
		try {
			$equipment->facilityid = $request->facilityid;
			$equipment->hubid = $request->facilityid;
			$equipment->type = 1;
			$equipment->createdby = 1;
			$equipment->enginenumber = $request->enginenumber;
			$equipment->chasisnumber = $request->chasisnumber;
			$equipment->modelnumber = $request->modelnumber;
			$equipment->yearofmanufacture = $request->yearofmanufacture;
			$equipment->brand = $request->brand;
			$equipment->enginecapacity = $request->enginecapacity;
			$equipment->insurance = $request->insurance;
			$equipment->numberplate = $request->numberplate;
			$equipment->color = $request->color;
			//save dates
			$equipment->purchasedon = date('Y-m-d H:s:i', strtotime($request->purchasedon));
			$equipment->deliveredtohubon = date('Y-m-d H:s:i', strtotime($request->deliveredtohubon)); 
			$equipment->warrantyperiod = $request->warrantyperiod;
			$equipment->warrantyperiodunits = $request->warrantyperiodunits;
			$equipment->recommendedservicefrequency = $request->recommendedservicefrequency;
			$equipment->servicefrequencyunits = $request->servicefrequencyunits;
			$equipment->hasservicecontract = $request->hasservicecontract;
			
			$equipment->save();
			
			return redirect()->route('equipment.show', array('id' => $equipment->id));

		}catch (\Exception $e) {
			print_r('faild to save'.$e);
			exit;
			return redirect()->route('equipment.create')
            ->with('flash_message', 'failed');
		}
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
       $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return redirect()->route('equipment.list')
            ->with('flash_message',
             'Equipment successfully deleted');
    }
}