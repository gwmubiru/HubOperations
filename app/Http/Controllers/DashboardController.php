<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
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
		if(Auth::user()->hasRole('In_charge')){
			$equipment_brokendown = Equipment::where('hubid',Auth::user()->hubid)->where('status',2)->orderby('id', 'desc')->paginate(10);
			$equipment_no_service = Equipment::where('hubid',Auth::user()->hubid)->where('hasservicecontract',0)->orderby('id', 'desc')->paginate(10);					
			return redirect()->route('equipment.index');
		}else{
			$equipment_broken_down = Equipment::orderby('id', 'desc')->where('status',2)->paginate(10); 
			$equipment_no_service = Equipment::orderby('id', 'desc')->where('hasservicecontract',0)->paginate(10); 
			return view('dashboard.index', compact('equipment_broken_down', 'equipment_no_service'));
		}
		if(Auth::user()->hasRole('In_charge')){
			
		}else{
        	
		}
    }

       
}