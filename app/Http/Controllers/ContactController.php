<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use \App\Models\LookupType as LookupType;
use \App\Models\Contact as Contact;

class ContactController extends Controller {

    public function __construct() {
        //$this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($pagetype) {
        $staff = Staff::Orderby('id', 'desc')->where('type', $pagetype)->paginate(10);
		return view('staff.index', compact('staff', 'pagetype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
	public function form($category, $type, $obj){
		$title = 'Create Contact';
		//$districts = array_merge_maintain_keys(array('' => 'Select one'),getAllDistricts());
		//$organizations = array_merge_maintain_keys(array('' => 'Select one'),getAllHubs());
		//$pagetype = $type;
		//exit;
		return view('contact.create', compact('category','type', 'obj', 'title'));
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
		$contact = new Contact;
		try {
			
			$contact->type = $request->type;
			$contact->firstname = $request->firstname;
			$contact->lastname = $request->lastname;
			$contact->othernames = $request->othernames;
			$contact->emailaddress = $request->emailaddress;
			$contact->telephonenumber = $request->telephonenumber;
			$contact->category = $request->category;
			$contact->isactive = 1;
			$contact->createdby = Auth::getUser()->id;
			//depending on whethe the contact is for ip, hub, district, save the relevant table attribute
			if($request->category == 1){
				$contact->organizationid = $request->obj;
				$return_url = 'organization.show';
			}elseif($request->category == 2){
				$contact->hubid = $request->obj;
				$return_url = 'hub.show';
			}else{
			}
			$contact->save();
			//in the return url, use the obj id for which you are saving the contact
			return redirect()->route($return_url, array('id' => $request->obj));

		}catch (\Exception $e) {
			
			print_r('faild to save'.$e);
			return redirect()->url('contact/new/category/'.$request->category.'/type/'.$request->type)
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
		$contact = contact::findOrFail($id); 
		$title = 'Update Contact';
		return view('contact.edit', compact('title','contact'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
		$contact = Contact::findOrFail($id);
		try {
			$contact->firstname = $request->firstname;
			$contact->lastname = $request->lastname;
			$contact->othernames = $request->othernames;
			$contact->emailaddress = $request->emailaddress;
			$contact->telephonenumber = $request->telephonenumber;
			$contact->lastupdatedby = Auth::getUser()->id;
			//depending on whethe the contact is for ip, hub, district, save the relevant table attribute
			if($contact->category == 1){
				$contact->organizationid = $contact->organizationid;
				$return_url = 'organization.show';
			}else{
			}
			$contact->save();
			//in the return url, use the obj id for which you are saving the contact
			return redirect()->route($return_url, array('id' => $contact->organizationid));

		}catch (\Exception $e) {
			//print_r('faild to save'.$e);
			//exit;
			return redirect()->route('contact.edit', array('id' => $contact->id))
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