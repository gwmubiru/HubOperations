<?php
namespace Khill\Lavacharts\Examples\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Lava;
use Auth;
use Session;
use \App\Models\Equipment as Equipment;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
		if(Auth::user()->hasRole('eoc_admin')){
			//exit('ad');
			return redirect('staff/list/5');
		}
		$where_condition = '';
		if(Auth::user()->hasRole('hub_coordinator')){
            $where_condition .= " AND e.hubid ='".Auth::user()->hubid."'";
        }
        if(Auth::user()->hasRole('implementing_partner')){
        	$ips_facilities = getFacilitiesForIP(Auth::user()->organisation_id);
        	if(count($ips_facilities)){
        		$where_condition .= " AND e.hubid in (".$ips_facilities.")";
        	}
    	}
		$where_condition .= " AND e.status = 2";		

		$query = "SELECT e.id, lv.lookupvaluedescription as name, e.model, e.serial_number, e.status, e.location, f.hubname, e.installation_date FROM facilitylabequipment e
        INNER JOIN facility f ON(e.hubid = f.id)
		INNER JOIN lookuptypevalue lv ON (lv.lookuptypevalue = e.labequipment_id AND lv.lookuptypeid = 27)
        WHERE e.id != '' ".$where_condition."
        ORDER BY lv.lookupvaluedescription  ASC";
		//echo $query; exit;
        $lab_equipment_broken_down = \DB::select($query);
		
		$where_clause = '';
		$facilities_not_visited_cond = '';
		if(Auth::user()->hasRole('hub_coordinator')){
			$where_clause .= "AND s.hubid = '".Auth::user()->hubid."'";
			$facilities_not_visited_cond = "AND f.parentid = '".Auth::user()->hubid."'";
			$equipment_broken_down = Equipment::where('hubid',Auth::user()->hubid)->where('status',2)->orderby('id', 'desc')->paginate(10);
			$equipment_no_service = Equipment::where('hubid',Auth::user()->hubid)->where('hasservicecontract',0)->orderby('id', 'desc')->paginate(10);					
			//return redirect()->route('dashboard.coordinator');
		}else{
			$equipment_broken_down = Equipment::orderby('id', 'desc')->where('status',2)->paginate(10); 
			$equipment_no_service = Equipment::orderby('id', 'desc')->where('hasservicecontract',0)->paginate(10); 
		}
			
			//facilities not visited last week
			$query = 'select f.id, f.name, h.hubname from 
			facility f
			INNER JOIN facility h ON (f.parentid = h.id '.$facilities_not_visited_cond.')
			WHERE f.id NOT IN(select c.facilityid from checklogin c 
			WHERE c.thedate >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
			AND c.thedate < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY)
			order by f.name';			
			$facilities_not_visited = \DB::select($query);
			
			// get the samples for this week
			$query = "SELECT lv.lookupvaluedescription as sampletype, SUM(s.numberofsamples) AS samples
	FROM samples s 
	INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
	INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid)
	WHERE lv.lookuptypeid = 18 AND YEARWEEK(`thedate`) = YEARWEEK(CURDATE()) ".$where_clause."
	GROUP BY lv.lookupvaluedescription ASC";
	
		   $samples = \DB::select($query);
		 
		 $samplestable = lava::DataTable();
		$samplestable->addStringColumn('Sample Type')
				->addNumberColumn('Number of samples');
			foreach($samples as $line){
				$samplestable->addRow([
				  $line->sampletype, $line->samples
				]);
			}
			//$chart = lava::LineChart('samples', $stocksTable);			
			lava::ColumnChart('samples', $samplestable, [
				'title' => ' Samples this week',
				'titleTextStyle' => [
					'color'    => '#eb6b2c',
					'fontSize' => 14
				]
			]);
			
			// Random Data For Example
			$query = "SELECT count(s.id) AS results
	FROM results s 
	WHERE delivered_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY ".$where_clause."
	GROUP BY s.id ASC";
		   $results = \DB::select($query);		
			
	$resultstable = lava::DataTable();
	$resultstable->addNumberColumn('Number of results');
			 foreach($results as $line){
				$resultstable->addRow([
				  $line->results
				]);
			}
	
	lava::ColumnChart('theresults', $resultstable, [
		'title' => 'Results this week',
		'titleTextStyle' => [
			'color'    => '#eb6b2c',
			'fontSize' => 14
		]
	]);
	
		//print_r(count($equipment_brokendown));
		//exit;
		return view('dashboard.index', compact('equipment_broken_down', 'equipment_no_service','samples','results', 'facilities_not_visited', 'lab_equipment_broken_down'));
    }
	
	public function coordinator(){
      	$stocksTable = lava::DataTable();  
		/*$stocksTable->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');
*/		$stocksTable->addStringColumn('Sample Type')
            ->addNumberColumn('Number of Samples');
		// Random Data For Example
		$query = "SELECT lv.lookupvaluedescription as sampletype, SUM(s.numberofsamples) AS samples
FROM samples s 
INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid)
WHERE lv.lookuptypeid = 18 AND s.hubid = '".Auth::user()->hubid."'AND MONTH(thedate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
GROUP BY lv.lookupvaluedescription ASC";
	   $samples = \DB::select($query);
	   //print_r($samples);
	  // exit;
		/*for ($a = 1; $a <= 30; $a++) {
			$stocksTable->addRow([
			  '2015-10-' . $a, rand(800,1000), rand(800,1000)
			]);
		}*/
		foreach($samples as $line){
			$stocksTable->addRow([
			  $line->sampletype, $line->samples
			]);
		}
		$chart = lava::LineChart('MyStocks', $stocksTable);
		
		$resultstable = lava::DataTable();  
			$resultstable->addStringColumn('Result Type')
            ->addNumberColumn('Number of results');
		// Random Data For Example
		$query = "SELECT lv.lookupvaluedescription as resulttype, SUM(s.numberofresults) AS results
FROM results s 
INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid)
WHERE lv.lookuptypeid = 18 AND s.hubid = '".Auth::user()->hubid."'AND MONTH(thedate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
GROUP BY lv.lookupvaluedescription ASC";
	   $results = \DB::select($query);
		foreach($results as $line){
			$resultstable->addRow([
			  $line->resulttype, $line->results
			]);
		}
		//print_r($resultstable);
		//exit;
		$resultchart = lava::LineChart('theresults', $resultstable);	
		return View('dashboard.coordinator', compact('samples','results'));
	}

       
}