<?php
namespace Khill\Lavacharts\Examples\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
use \App\Models\Package as Package;
use \App\Models\PackageMovement as PackageMovement;
use \App\Models\PackageDetail as PackageDetail;
use \App\Models\PackageReceipt as PackageReceipt;
use \App\Models\UntrackedPackage as UntrackedPackage;

class SamplesController extends Controller {

    public function __construct() {
        //$this->middleware(['auth', 'clearance'])->except('index', 'show');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function sampleList(Request $request){
			// get the samples for this month
			$hubs = array_merge_maintain_keys(array('' => 'Select a hub'), getAllHubs());
			$facilities = array_merge_maintain_keys(array('' => 'Select a facility'), getAllFacilities());
			$districts = array_merge_maintain_keys(array('' => 'Select a district'), getAllDistricts());
			
			$incharge_clause = '';
			if(Auth::user()->hasRole('hub_coordinator')){
				$incharge_clause .= " AND s.hubid = '".Auth::user()->hubid."'";
				$facilities = array_merge_maintain_keys(array(''=>'Select a facility'),getFacilitiesforHub(Auth::user()->hubid));
			}
			$graph_title = 'Samples last month';
			$where_clause = '';
			$where = 'WHERE MONTH(thedate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)';
			$filters = $request->all();
			if(!empty($filters)){
				$graph_title = 'Samples for selected options';
				if($filters['from'] != '' && $filters['to'] != ''){
					$where = "WHERE s.thedate BETWEEN '".getMysqlDateFormat($filters['from'])."'  AND '".getMysqlDateFormat($filters['to'])."'";
				}
			
				if(array_key_exists('facilityid',$filters) && $filters['facilityid']){
					$where_clause .= ' AND s.facilityid = '.$filters['facilityid'];
				}
				if(array_key_exists('hubid',$filters) && $filters['hubid']){
					$where_clause .= ' AND h.id = '.$filters['hubid'];
				}
				if(array_key_exists('districtid',$filters) && $filters['districtid']){
					$where_clause .= ' AND d.id = '.$filters['districtid'];
				}
			}
			$query = "SELECT h.hubname as hub, d.name as district, f.name as facility,
	SUM(CASE WHEN s.samplecategory = 1 THEN s.numberofsamples END) AS `VL`,
	SUM(CASE WHEN s.samplecategory = 2 THEN s.numberofsamples  END) AS `HIVEID`,
	SUM(CASE WHEN s.samplecategory = 3 THEN s.numberofsamples  END) AS `SickleCell`,
	SUM(CASE WHEN s.samplecategory = 4 THEN s.numberofsamples  END) AS `CD4CD8`,
	SUM(CASE WHEN s.samplecategory = 5 THEN s.numberofsamples  END) AS `Genexpert`,
	SUM(CASE WHEN s.samplecategory = 6 THEN s.numberofsamples  END) AS `CBCFBC`,
	SUM(CASE WHEN s.samplecategory = 7 THEN s.numberofsamples  END) AS `LFTS`,
	SUM(CASE WHEN s.samplecategory = 8 THEN s.numberofsamples  END) AS `RFTS`,
	SUM(CASE WHEN s.samplecategory = 9 THEN s.numberofsamples  END) AS `Culturesensitivity`,
	SUM(CASE WHEN s.samplecategory = 10 THEN s.numberofsamples  END) AS `MTBCultureDST`,
	SUM(s.numberofsamples) as total
	FROM samples s  
	LEFT JOIN  facility f ON (f.id = s.facilityid)
	LEFT JOIN  facility AS h ON (f.parentid = h.id)
	LEFT JOIN  district AS d ON (f.districtid = d.id)
	 ".$where.$where_clause.$incharge_clause."
	GROUP BY s.facilityid ASC";
	
	$samples = \DB::select($query);
		 
		$query = "SELECT lv.lookupvaluedescription as sampletype, SUM(s.numberofsamples) AS samples
	FROM samples s 
	INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
	INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid AND lv.lookuptypeid = 18 )
	".$where.$where_clause.$incharge_clause."
	GROUP BY lv.lookupvaluedescription ASC";
		   $samples_graph = \DB::select($query);
		 
		 $samplestable = lava::DataTable();
		$samplestable->addStringColumn('Sample Type')
				->addNumberColumn('Number of samples');
			foreach($samples_graph as $line){
				$samplestable->addRow([
				  $line->sampletype, $line->samples
				]);
			}
			//$chart = lava::LineChart('samples', $stocksTable);			
			lava::ColumnChart('samples', $samplestable, [
				'title' => $graph_title,
				'titleTextStyle' => [
					'color'    => '#eb6b2c',
					'fontSize' => 14
				]
			]);
			
		return view('samaples.all', compact('samples', 'hubs', 'facilities','districts', 'samples_graph'));
	}
	public function recevieSample(){
		return View('samples.receive');
	}
	public function receiveSmallPackage(Request $request){
		$small_package = Package::findOrFail($request->id);
		$package_receipt = new PackageReceipt;
		$package_receipt->packageid = $request->id;
		$package_receipt->packagetype = $small_package->type;
		$package_receipt->received_by = Auth::user()->id;
		$package_receipt->previous_status = $small_package->status;
		$package_receipt->numberofsamples = $request->numberofsamples;
		$package_receipt->created_by = Auth::user()->id;
		$package_receipt->save();

		//mark package as received at CPHL
		$small_package->status = 7;
		$small_package->save();
		return redirect()->route('samples.all');
	}
	public function processReceipt(Request $request) {		
		$packages = $request->packages;
		try {
			foreach($packages as $package){
				
				$small_package = Package::findOrFail($package['small_package_id']);
				//create record for package receipt
				$package_receipt = new PackageReceipt;
				$package_receipt->packageid = $package['small_package_id'];
				$package_receipt->packagetype = $small_package->type;
				$package_receipt->received_by = Auth::user()->id;
				$package_receipt->previous_status = $small_package->status;
				$package_receipt->numberofsamples = $package['number_of_samples'];
				$package_receipt->created_by = Auth::user()->id;
				$package_receipt->save();

				//mark package as received at CPHL
				$small_package->status = 7;
				$small_package->save();
			}
			//mark the big package as received
			$big_package = Package::findOrFail($request->big_package_id);
			$big_package->status = 3;
			$big_package->save();

			//update status of package movement
			$package_movement = PackageMovement::where('packageid','=',$request->big_package_id)->first();
			
			if(is_object($package_movement)){

				$package_movement->status = 3;
				$package_movement->recieved_at = \Carbon\Carbon::now();
				$package_movement->recieved_by = Auth::user()->id;
				$package_movement->save();
			}else{
				//package was not scanned by driver so create it
				$package_movement = new PackageMovement;
				$package_movement->status = 3;
				$package_movement->recieved_at = \Carbon\Carbon::now();
				$package_movement->recieved_by = Auth::user()->id;
				$package_movement->packageid = $big_package->id;
				$package_movement->source = $big_package->facilityid;
				$package_movement->destination = $big_package->final_destination;
				$package_movement->taken_by = 1;
				$package_movement->scaned_by_transporter = 0;
				$package_movement->taken_at = $big_package->created_at;
				$package_movement->type_of_movement = 2;
				$package_movement->save();
			}

		}catch (\Exception $e) {
			
			print_r('faild to save'.$e);
			exit;
			
            //->with('flash_message', 'failed');
		}
		return redirect()->route('samples.cphl');
		//exit;
	}

	public function saveunscannedbarcode(Request $request){
		$untrackedp = new UntrackedPackage;
		$untrackedp->barcode = $request->barcode;
		if($request->has('facilityid')){
			$untrackedp->facilityid = $request->facilityid;
		}
		$untrackedp->hubid = $request->hubid;
		$untrackedp->type = $request->type;
		$untrackedp->created_by = Auth::user()->id;
		$untrackedp->save();
		return redirect()->route('samples.all');
	}
}