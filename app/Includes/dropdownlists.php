<?php

	# This class require_onces functions to access and use the different drop down lists within
	# this application

	/**
	 * function to return the results of an options query as array. This function assumes that
	 * the query returns two columns optionvalue and optiontext which correspond to the corresponding key
	 * and values respectively. 
	 * 
	 * The selection of the names is to avoid name collisions with database reserved words
	 * 
	 * @param String $query The database query
	 * 
	 * @return Array of values for the query 
	 */
	function getOptionValuesFromDatabaseQuery($query) {
		//$conn = getDatabaseConnection(); 
		//echo $query;
		$result = DB::select($query);
		//print_r($result);
		//exit;
		$valuesarray = array();
		foreach ($result as $value) {
			$valuesarray[$value->optionvalue]	= htmlentities($value->optiontext);
		}
		//print_r($valuesarray);
		//exit;
		return decodeHtmlEntitiesInArray($valuesarray);
	}
      
	//get all hubs
	function getAllHubs(){
		$hubs = \App\Models\Facility::where('parentid', '=', NULL)->pluck('hubname', 'id');
		return $hubs;
	}
	
	function getAllFacilities(){
		$facilities = \App\Models\Facility::where('parentid', '<>', NULL)->pluck('name', 'id');
		return $facilities;
	}
	
	function getAllHealthRgions(){
		$healthregions = \App\Models\HeathRegion::pluck('name', 'id');
		return $healthregions;
	}
	function getAllSupportAgencies(){
		$supportagencies = \App\Models\SupportAgency::pluck('name', 'id');
		return $supportagencies;
	}
		
	function getAllFacilityLevels(){
		$levels =  \App\Models\FacilityLevel::pluck('level', 'id');
		return $levels;
	}
	function getAllDistricts(){
		$districts =  \App\Models\District::pluck('name', 'id');
		return $districts;
	}
		
	function getAllIps(){
		return \App\Models\Organization::where('type', 1)->pluck('name','id');
	}
	function getBikesForHub($hubid){
		return \App\Models\Euipment::where('hubid', $hubid)->pluck('name','id');
	}
	
	/*
	* Get name and id of all hubs at leves H/iv, hospital or RRH which are not yet hubs
	*/
	function getAllHubCandidateFacilities(){
	$candidatefacilities =	\App\Models\Facility::where('parentid', '!=', '')
      ->where(function($q) {
          $q->where('facilitylevelid', 1)
            ->orWhere('facilitylevelid', 9)
			->orWhere('facilitylevelid', 11);
      })->pluck('name','id');
	  return $candidatefacilities;
	}
	
	//get all facilities
	function getAllUnAssignedBikes(){
		if(Auth::user()->hasRole('In_charge')){
			$sampletransporters = \App\Models\Equipment::where('type', '=', 1)->where('isassigned', 0)->where('hubid', Auth::user()->hubid)->pluck('numberplate', 'id');
		}else{
			$sampletransporters = \App\Models\Equipment::where('type', '=', 1)->where('isassigned', 0)->pluck('numberplate', 'id');
		}
		return $sampletransporters;
	}
	
	function getFacilitiesforHub($hubid){
		$facilities = \App\Models\Facility::where('parentid', '=', $hubid)->pluck('name', 'id');
		return $facilities;
	}
	
	function getMechanicforHub($id){
		$mechanics = '';
		if($id){
			$mechanics = \App\Models\Contact::where('type', '=', 1)->where('category', 4)->where('isactive', 1)->where('hubid', $id)->pluck('firstname', 'id');
		}
		return $mechanics;
	}
	
	function getUnassignedBikesforHub($hubid){
		$valuesquery = "SELECT id as optionvalue, numberplate as optiontext FROM equipment  
		WHERE  hubid = '".$hubid."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($valuesquery);
	}
	function getAssignedBikesforHub($hubid){
		$valuesquery = "SELECT id as optionvalue, numberplate as optiontext FROM equipment  
		WHERE  hubid = '".$hubid."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($valuesquery);
	}
	function getSampleTransportersforHub($hubid){
		$valuesquery = "SELECT id as optionvalue, CONCAT(`firstname`,' ',`lastname`) as optiontext FROM staff  
		WHERE  hubid = '".$hubid."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($valuesquery);
	}
	
	function getGenerateHtmlforAjaxSelect($options, $empty_string = 'Select One'){
		$select_string = '<option value="">'.$empty_string.'</option>';
		foreach($options as $key => $value){
			$select_string .= '<option value="'.$key.'">'.$value.'</option>';
		}
		return $select_string;
	}
?>