<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SampleTracking;
use Auth;
use Session;
use \Lava;
use \App\Models\LookupType as LookupType;
use \App\Models\DailyRouting as DailyRouting;
use \App\Models\Facility as Facility;
use \App\Models\Hub as Hub;
use \App\Models\DailyRoutingReason as DailyRoutingReason;
use \App\Models\Sample as Sample;
use \App\Models\Result as Result;
use Excel;

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
	
	public function all(Request $request){
			// get the samples for this month
			$hubs = array_merge_maintain_keys(array('' => 'Select a hub'), getAllHubs());
			$facilities = array('' => 'Filter by facility');
			$districts = array_merge_maintain_keys(array('' => 'Select a district'), getAllDistricts());
			$status_dropdown = array_merge_maintain_keys(array('' => 'Fileter by status'), getHubPackageStatus());
			$status_dropdown_for_hubs = getHubPackageStatusLabel();
			$this_week = getWeekEndDates();
			$incharge_clause = '';
			if(Auth::user()->hasRole('hub_coordinator')){
				$incharge_clause .= " AND pm.destination = '".Auth::user()->hubid."'";
				$facilities = array_merge_maintain_keys(array(''=>'Select a facility'),getFacilitiesforHub(Auth::user()->hubid));
			}
			$where_clause = '';
			$where = 'WHERE p.created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)';
			$filters = $request->all();
			
			if(!empty($filters)){
				if($filters['from'] != '' && $filters['to'] != ''){
					$where = "WHERE p.created_at BETWEEN '".getMysqlDateFormat($filters['from'])."'  AND '".getMysqlDateFormat($filters['to'])."'";
				}
			
				if(array_key_exists('facilityid',$filters) && $filters['facilityid']){
					$where_clause .= ' AND pm.source = '.$filters['facilityid'];
				}
				if(array_key_exists('hubid',$filters) && $filters['hubid']){
					$where_clause .= ' AND pm.destination = '.$filters['hubid'];
				}
				if(array_key_exists('status',$filters) && $filters['status']){
					$where_clause .= ' AND p.status = '.$filters['status'];
				}
				
			}
			$query = "SELECT p.id, lv.lookupvaluedescription as sampletype, p.barcode, s.numberofsamples, sf.name as sourcefacility,  pm.taken_at, pm.delivered_at, pm.recieved_at, pdpm.recieved_at AS received_at_cphl_on, df.hubname as destinationfacility, p.created_at as thedate, p.status FROM package p
LEFT JOIN packagemovement pm ON (p.id = pm.packageid) 
LEFT JOIN facility sf ON (pm.source = sf.id) 
LEFT JOIN facility df ON(pm.destination = df.id) 
LEFT JOIN samples s ON(s.barcodeid = p.id) 
LEFT JOIN packagedetail pd ON (pd.small_barcodeid = p.id)
LEFT JOIN packagemovement pdpm ON (pdpm.packageid = pd.big_barcodeid) 
INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
	INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid) 
".$where.$incharge_clause.$where_clause." AND lv.lookuptypeid = 18 AND p.type = 1
group by p.id, p.barcode, s.numberofsamples, sf.name,  pm.delivered_at, pm.taken_at, pm.recieved_at, pdpm.recieved_at,df.hubname, p.created_at, p.status,lv.lookupvaluedescription";
		//echo $query; exit;
		
			$package_samples = \DB::select($query);	
						
		return view('sampletracking.all', compact('package_samples', 'hubs', 'facilities','districts','status_dropdown','status_dropdown_for_hubs','this_week','request'));
	}
	
	public function receiveRample($id){
		$packages = \DB::select('SELECT p.barcode, p.id, p.status FROM packagedetail pd  
				INNER JOIN package p ON (pd.small_barcodeid = p.id)
				WHERE pd.big_barcodeid ='.$id.' GROUP BY p.id');
		if(count($packages)){
			return view('sampletracking.receive',compact('packages','id'));
		}else{
			//save the untracked barcode and redirect to receive individual packages
			return redirect()->route('samples.all');
		}
		
	}
	
	public function cphl(Request $request){
		// get the samples for this month
			$hubs = array_merge_maintain_keys(array('' => 'Filter by hub'), getAllHubs());
			$facilities = array('' => 'Filter by facility');
			$districts = array_merge_maintain_keys(array('' => 'Filter by district'), getAllDistricts());
			$status_dropdown = array_merge_maintain_keys(array('' => 'Fileter by status'), getCphlPackageStatus());
			
			$incharge_clause = '';
			if(Auth::user()->hasRole('hub_coordinator')){
				$incharge_clause .= " AND pm.destination = '".Auth::user()->hubid."'";
				$facilities = array_merge_maintain_keys(array(''=>'Select a facility'),getFacilitiesforHub(Auth::user()->hubid));
			}
			$where_clause = '';
			$where = 'WHERE p.created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)';
			$filters = $request->all();
			if(!empty($filters)){
				if($filters['from'] != '' && $filters['to'] != ''){
					$where = "WHERE p.created_at BETWEEN '".getMysqlDateFormat($filters['from'])."'  AND '".getMysqlDateFormat($filters['to'])."'";
				}
			
				if(array_key_exists('hubid',$filters) && $filters['hubid']){
					$where_clause .= ' AND p.hubid = '.$filters['hubid'];
				}
				if(array_key_exists('status',$filters) && $filters['status']){
					$where_clause .= ' AND p.status = '.$filters['status'];
				}
			}
			$query = "SELECT p.id, p.barcode, h.name as hubname, p.status as packagestatus, df.hubname as sourcefacility, sp.numberofenvelopes, p.created_at as thedate, pm.`status`, pm.recieved_at, pm.delivered_at from package p
INNER JOIN (SELECT COUNT(pd.id) AS numberofenvelopes, pd.big_barcodeid  FROM packagedetail pd
GROUP BY pd.big_barcodeid) AS sp ON (p.id = sp.big_barcodeid)
INNER JOIN facility h ON(p.hubid = h.id)
LEFT JOIN packagemovement pm ON (pm.packageid = p.id)
LEFT JOIN facility df ON(pm.source = df.id)
".$where.$incharge_clause.$where_clause." AND p.type = 2
group by p.id, p.barcode,df.hubname,pm.status,sp.numberofenvelopes,p.created_at,pm.recieved_at, pm.delivered_at,h.name, p.status";
//echo $query;
//exit;
		
			$samples = \DB::select($query);	
						
		return view('sampletracking.cphl', compact('samples', 'hubs', 'facilities','districts','status_dropdown'));
		
		/*'SELECT p.id,p.barcode,sp.numberofenvelopes from package p
INNER JOIN (SELECT COUNT(pd.id) AS numberofenvelopes,pd.small_barcodeid, pd.big_barcodeid  FROM packagedetail pd
GROUP BY pd.big_barcodeid) AS sp ON (p.id = sp.big_barcodeid)
WHERE p.`type` = 2';

'SELECT p.id,p.barcode,sp.numberofenvelopes, sp.numberofsamples from package p
INNER JOIN (SELECT COUNT(pd.id) AS numberofenvelopes,sm.numberofsamples, pd.small_barcodeid, pd.big_barcodeid  FROM packagedetail pd
INNER JOIN (SELECT COUNT(id) AS numberofsamples, barcodeid FROM samples ) AS sm ON (pd.small_barcodeid = sm.barcodeid)
GROUP BY pd.big_barcodeid) AS sp ON (p.id = sp.big_barcodeid)
WHERE p.`type` = 2';	*/	
	}
	
	public function packageStatistics(){
		$destinedforcphl = packageStats(5,2);
		$receivedatcphl = packageStats(7,2);
		$hubpackages = packageStats(1,1);
		//exit;
    	return response()->json(['destinedforcphl' => $destinedforcphl,'receivedatcphl' => $receivedatcphl,'hubpackages' => $hubpackages]);
    }
	public function outbreak(){
		$incharge_clause = '';
		if(Auth::user()->hasRole('hub_coordinator')){
			$incharge_clause .= " AND hubid = '".Auth::user()->hubid."'";
		}
		$query = "SELECT s.id FROM samples s
INNER JOIN package p ON (s.barcodeid = p.id)
WHERE (p.`status` = 1 OR p.`status` = 2 OR p.`status` = 3 OR p.`status` = 4 OR p.`status` = 5 OR p.`status` = 6) AND s.samplecategory = 116";
	$samples = \DB::select($query);	
		if(!empty($samples)) { 
			echo count($samples);
		 }else{
			 echo 0;
		}
	}
	
	public function receive(Request $request){
		// get the samples for this month
			$hubs = array_merge_maintain_keys(array('' => 'Filter by hub'), getAllHubs());
			$facilities = array('' => 'Filter by facility');
			$districts = array_merge_maintain_keys(array('' => 'Filter by district'), getAllDistricts());
			$status_dropdown = array_merge_maintain_keys(array('' => 'Fileter by status'), getCphlPackageStatus());
			
			$incharge_clause = '';
			if(Auth::user()->hasRole('hub_coordinator')){
				$incharge_clause .= " AND pm.destination = '".Auth::user()->hubid."'";
				$facilities = array_merge_maintain_keys(array(''=>'Select a facility'),getFacilitiesforHub(Auth::user()->hubid));
			}
			$where_clause = '';
			$where = '';
			$filters = $request->all();
			if(!empty($filters)){
				if($filters['from'] != '' && $filters['to'] != ''){
					$where = "WHERE p.created_at BETWEEN '".getMysqlDateFormat($filters['from'])."'  AND '".getMysqlDateFormat($filters['to'])."'";
				}
			
				if(array_key_exists('hubid',$filters) && $filters['hubid']){
					$where_clause .= ' AND p.hubid = '.$filters['hubid'];
				}
				if(array_key_exists('status',$filters) && $filters['status']){
					$where_clause .= ' AND p.status = '.$filters['status'];
				}
			}
			$query = "SELECT p.barcode, p.id as packageid, pm.id as packagemovementid, h.name as hubname, p.status as packagestatus, df.hubname as sourcefacility, sp.numberofenvelopes, p.created_at as thedate, pm.`status`, pm.recieved_at, pm.delivered_at from package p
INNER JOIN (SELECT COUNT(pd.id) AS numberofenvelopes, pd.big_barcodeid  FROM packagedetail pd
GROUP BY pd.big_barcodeid) AS sp ON (p.id = sp.big_barcodeid)
INNER JOIN facility h ON(p.hubid = h.id)
INNER JOIN packagemovement pm ON (pm.packageid = p.id AND pm.`status` = 2)
LEFT JOIN facility df ON(pm.source = df.id)
".$where.$incharge_clause.$where_clause." AND p.type = 2  
group by p.barcode,df.hubname,pm.status,sp.numberofenvelopes,p.created_at,pm.recieved_at, pm.delivered_at,h.name, p.status, p.id, pm.id";
		
			$samples = \DB::select($query);	
						
		return view('sampletracking.receive', compact('samples', 'hubs', 'facilities','districts','status_dropdown'));
	}
	
	public function processReceipt($packageid, $packagemovementid){
		echo $packageid.' pm ';
		echo $packagemovementid;
		exit;
		$query = "select small_barcodeid from packagedetail where big_barcodeid = '".$packageid."'";
		$samples = \DB::select($query);
		
		return View('sampletracking.create', compact('packageid', 'packagemovementid'));
	}
	
	public function results(){
		$where = '';
		if(Auth::user()->hasRole('hub_coordinator')){
			$where = "WHERE r.hubid = ".Auth::user()->hubid."";
		}
		$query = "SELECT h.hubname, f.name as facility, r.locator_id, r.delivered_at, CONCAT (s.firstname, ' ', s.lastname) as delivered_by FROM results r
		INNER JOIN facility h ON(r.hubid = h.id)
		INNER JOIN facility f ON(r.facilityid = f.id)
		INNER JOIN staff s ON(r.created_by = s.id)
		".$where;
		$results = \DB::select($query);		
		return View('sampletracking.results', compact('results'));
		
	}
	
	
}