<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SampleTracking;
use Auth;
use Session;
use \App\Models\LookupType;

class SampleTrackingController extends Controller {

    public function __construct() {
        //$this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
		$hubid = Auth::getUser()->hubid;
		$query = "SELECT s.id, f.name as facility , s.patient, s.specimennumber, lv.lookupvaluedescription as specimentype, CONCAT(st.firstname,'',st.lastname) as transporter, s.sampletransported_at as time, lvs.lookupvaluedescription as status
		FROM sampletracking as s 
		INNER JOIN facility as f ON (s.facilityid = f.id) 
		INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.specimentype AND lv.lookuptypeid = 17)
		INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid)
		INNER JOIN lookuptypevalue lvs ON(lvs.lookuptypevalue = s.status AND lvs.lookuptypeid = 18)
		INNER JOIN lookuptype ls ON(ls.id = lvs.lookuptypeid)
		INNER JOIN staff st ON(s.sampletransportedby = st.id)
		WHERE s.hubid = '".$hubid."'
		ORDER BY s.status ASC";
		$results = \DB::select($query);
		return view('sampletracking.list', compact('results'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $hubid = Auth::getUser()->hubid;
	  $sampletransporters = array_merge_maintain_keys(array('' => 'Select One'),getSampleTransportersforHub($hubid));
		$facilities = array_merge_maintain_keys(array('' => 'Select One'),getFacilitiesforHub($hubid));
		$lt = new LookupType();
		$lt->name = 'SPECIMEN_TYPES';
		$specimentypes  = array_merge_maintain_keys(array('' => 'Select One'),$lt->getOptionValuesAndDescription());
		
      	return View('sampletracking.create', compact('facilities', 'hubid', 'sampletransporters','specimentypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
			$sampletracking = new SampleTracking();
			$sampletracking->facilityid = $request->facilityid;
			$sampletracking->hubid = $request->hubid;
			$sampletracking->status = 1;
			$sampletracking->sampletransportedby = $request->sampletransportedby;
			$sampletracking->patient = $request->patient;
			$sampletracking->specimennumber = $request->specimennumber;
			$sampletracking->specimentype = $request->specimentype;
			$sampletracking->sampletransported_at = $request->sampletransported_at;
			$sampletracking->createdby = Auth::getUser()->id;
			$sampletracking->save();
			return redirect()->route('sampletracking.show', array('id' => $sampletracking->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
       $sampletracking = SampleTracking::findOrFail($id);
	   return view ('sampletracking.view', compact('sampletracking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
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