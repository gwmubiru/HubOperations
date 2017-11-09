<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use \App\Models\LookupType as LookupType;
use \App\Models\Staff as Staff;

class StaffController extends Controller {

    public function __construct() {
        //$this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($pagetype) {
		if(Auth::user()->hasRole('In_charge')){
			$staff = Staff::where('hubid',Auth::user()->hubid)->Orderby('id', 'desc')->where('type', $pagetype)->paginate(10);
		}else{
        	$staff = Staff::Orderby('id', 'desc')->where('type', $pagetype)->paginate(10);
		}
		return view('staff.index', compact('staff', 'pagetype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
	public function form($pagetype){
		$lt = new LookupType();
		$lt->name = 'DESIGNATIONS';
		$hubsdropdown = getAllHubs();
		$bikes = array_merge_maintain_keys(array('' => 'Select one'),getAllUnAssignedBikes());
		$designation = array_merge_maintain_keys(array('' => 'Select one'),$lt->getOptionValuesAndDescription());
		//$pagetype = $type;
		return view('staff.create', compact('pagetype','designation', 'hubsdropdown','bikes'));
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
		$staff = new Staff;
		try {
			$staff->facilityid = $request->facilityid;
			if(Auth::user()->hasRole('In_charge')){
				$staff->hubid = Auth::user()->hubid;
			}else{
				$staff->hubid = $request->facilityid;
			}
			$staff->type = $request->type;
			$staff->firstname = $request->firstname;
			$staff->lastname = $request->lastname;
			$staff->othernames = $request->othernames;
			$staff->emailaddress = $request->emailaddress;
			$staff->telephonenumber = $request->telephonenumber;
			$staff->nationalid = $request->nationalid;
			
			$staff->motorbikeid = $request->motorbikeid;
			if($request->type == 1){
				$staff->drivingpermit = $request->drivingpermit;
			}else{
				$staff->designation = $request->designation;
			}
			$staff->save();
			return redirect()->route('staff.show', array('id' => $staff->id));

		}catch (\Exception $e) {
			
			print_r('faild to save'.$e);
			return redirect()->url('staff/new/'.$request->type)
            ->with('flash_message', 'failed');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		$staff = Staff::findOrFail($id); //Find post of id = $id
        return view ('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
		$staff = Staff::findOrFail($id); 
		$pagetype = $staff->type;
		$lt = new LookupType();
		$lt->name = 'DESIGNATIONS';
		$hubsdropdown = getAllHubs();
		$designation = array_merge_maintain_keys(array('' => 'Select one'),$lt->getOptionValuesAndDescription());
		//$pagetype = $type;
		return view('staff.edit', compact('staff','pagetype','designation', 'hubsdropdown'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
		$staff = Staff::findOrFail($id);
		try {
			$staff->facilityid = $request->facilityid;
			$staff->hubid = $request->facilityid;
			$staff->type = $request->type;
			$staff->firstname = $request->firstname;
			$staff->lastname = $request->lastname;
			$staff->othernames = $request->othernames;
			$staff->emailaddress = $request->emailaddress;
			$staff->telephonenumber = $request->telephonenumber;
			$staff->nationalid = $request->nationalid;
			if($request->type == 1){
				$staff->drivingpermit = $request->drivingpermit;
			}else{
				$staff->designation = $request->designation;
			}
			$staff->save();
			return redirect()->route('staff.show', array('id' => $staff->id));

		}catch (\Exception $e) {
			
			print_r('faild to save'.$e);
			return redirect()->url('staff/new/'.$request->type)
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
       
    }
}