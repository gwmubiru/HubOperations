<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;
use Session;
use \App\Models\Hub as Hub;
use \App\Models\Facility as Facility;
class RoutingScheduleController extends Controller {

    public function __construct() {
        //$this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $hubs = Facility::where('hubname', '!=', NULL)->orderby('name', 'asc')->paginate(10); //show only 10 items at a time in descending order
		//print_R($equipment);
		//exit;
        return view('hub.list', compact('hubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      	return View('hub.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 

    	//Validate all fields
		try {
			$facility = Facility::findOrFail($request->parentid);
			$facility->hubname = $request->name;
			$facility->address = $request->address;
			$facility->type = 2;
			$facility->ipid = $request->ipid;
			$facility->parentid = $request->parentid;
			$facility->save();
			return redirect()->route('hub.show', array('id' => $facility->id));

		}catch (\Exception $e) {
			//print_r('faild to save'.$e);
			//exit;
			return redirect()->route('hub.create')
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
		$hub = Facility::findOrFail($id); //Find post of id = $id
		//get hub contacts
		$incharge = getContact($id, 2,1, 'hubid');
		$hubcordinator = getContact($id, 2,2, 'hubid');
		$labmanager = getContact($id, 2,3, 'hubid');
		$vlfocalperson = getContact($id, 2,3, 'hubid');
		$eidfocalperson = getContact($id, 2,3, 'hubid');
		//get the facilities served by the hub
		$query = "SELECT f.id, f.name, f.contactperson, f.phonenumber, f.hubname as hub, fl.level as `facilitylevel`, d.name as district 
		FROM facility as f 
		INNER JOIN facilitylevel AS fl ON (f.facilitylevelid = fl.id) 
		INNER JOIN district as d ON(f.districtid = d.id)
		WHERE f.parentid = '".$hub->id."'
		ORDER BY f.name ASC";
		$facilities = \DB::select($query);
		
		return view ('hub.show', compact('hub','incharge','hubcordinator','labmanager','vlfocalperson','eidfocalperson','facilities'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
         $hub = Facility::findOrFail($id);
		$healthregion = getAllHealthRgions();
        return view('hub.edit', compact('hub','healthregion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
         $this->validate($request, [
            'name'=>'required|max:100',
            'email'=>'required',
        ]);

        $hub = Facility::findOrFail($id);
        $hub->parentid = $request->parentid;
		$hub->address = $request->address;
		$hub->hubname = $request->name;
		$hub->address = $request->address;
		$hub->ipid = $request->ipid;
		$hub->parentid = $request->parentid;
        $hub->save();

        return redirect()->route('hub.show', 
            $hub->id)->with('flash_message', 
            'Article, '. $hub->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
       $hub = Hub::findOrFail($id);
        $hub->delete();

        return redirect()->route('hub.list')
            ->with('flash_message',
             'Hub successfully deleted');
    }
}