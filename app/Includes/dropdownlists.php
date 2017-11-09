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
      
	//get all facilities
	function getAllHubs(){
		$hubs = array_merge_maintain_keys(array('' => 'Select One'), \App\Models\Facility::where('parentid', '!=', '')->pluck('name', 'id'));
		return $hubs;
	}
	
	function getAllHealthRgions(){
		$healthregions = array_merge_maintain_keys(array('' => 'Select One'), \App\Models\HeathRegion::pluck('name', 'id'));
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
?>