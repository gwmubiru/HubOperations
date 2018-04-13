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
		$where_clause = '';
		if(Auth::user()->hasRole('hub_coordinator')){
			$where_clause .= "AND s.hubid = '".Auth::user()->hubid."'";
			$equipment_brokendown = Equipment::where('hubid',Auth::user()->hubid)->where('status',2)->orderby('id', 'desc')->paginate(10);
			$equipment_no_service = Equipment::where('hubid',Auth::user()->hubid)->where('hasservicecontract',0)->orderby('id', 'desc')->paginate(10);					
			//return redirect()->route('dashboard.coordinator');
		}
			$equipment_broken_down = Equipment::orderby('id', 'desc')->where('status',2)->paginate(10); 
			$equipment_no_service = Equipment::orderby('id', 'desc')->where('hasservicecontract',0)->paginate(10); 
			
			
			
			// get the samples for this month
			$query = "SELECT lv.lookupvaluedescription as sampletype, SUM(s.numberofsamples) AS samples
	FROM samples s 
	INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
	INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid)
	WHERE lv.lookuptypeid = 18 AND MONTH(thedate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) ".$where_clause."
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
				'title' => ' Samples this last month',
				'titleTextStyle' => [
					'color'    => '#eb6b2c',
					'fontSize' => 14
				]
			]);
			
			// Random Data For Example
			$query = "SELECT lv.lookupvaluedescription as resulttype, SUM(s.numberofresults) AS results
	FROM results s 
	INNER JOIN lookuptypevalue lv ON(lv.lookuptypevalue = s.samplecategory)
	INNER JOIN lookuptype l ON(l.id = lv.lookuptypeid)
	WHERE lv.lookuptypeid = 18 AND MONTH(thedate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) ".$where_clause."
	GROUP BY lv.lookupvaluedescription ASC";
		   $results = \DB::select($query);		
			
	$resultstable = lava::DataTable();
	$resultstable->addStringColumn('Result Type')
				->addNumberColumn('Number of results');
			 foreach($results as $line){
				$resultstable->addRow([
				  $line->resulttype, $line->results
				]);
			}
	
	lava::ColumnChart('theresults', $resultstable, [
		'title' => 'Results last month',
		'titleTextStyle' => [
			'color'    => '#eb6b2c',
			'fontSize' => 14
		]
	]);
	
		
			return view('dashboard.index', compact('equipment_broken_down', 'equipment_no_service','samples','results'));
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