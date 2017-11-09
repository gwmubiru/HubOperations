<?php

# functions to create and manage drop down lists
#require_once 'dropdownlists.php';



/**
 * Change a date from MySQL database Format (yyyy-mm-dd) to the format displayed on pages(mm/dd/yyyy)
 * 
 * If the date from the database is NULL, it is transformed to an empty string for display on the pages 
 *
 * @param String $mysqldate The date in MySQL format 
 * @return String the date in short date format, or an empty string if no date is provided 
 */
function changeMySQLDateToPageFormatForReports($mysqldate) {
	$aconfig = Zend_Registry::get("config"); 
	if (isEmptyString($mysqldate)) {
		return $mysqldate;
	} else {
		return date('M d, Y', strtotime($mysqldate));
	}
}

/**
 * Change a date from MySQL database Format (yyyy-mm-dd) to the format displayed on pages(mm/dd/yyyy)
 * 
 * If the date from the database is NULL, it is transformed to an empty string for display on the pages 
 *
 * @param String $mysqldate The date in MySQL format 
 * @return String the date in short date format, or an empty string if no date is provided 
 */
function changeMySQLDateToPageFormat($mysqldate) {
	if (isEmptyString($mysqldate)) {
		return $mysqldate;
	} else {
		return date('d/m/Y', strtotime($mysqldate));
	}
}

/**
 * Transform a date from the format displayed on pages(mm/dd/yyyy) to the MySQL database date format (yyyy-mm-dd). 
 * If the date from the database is an empty string or the string NULL, it is transformed to a NULL value.
 *
 * @param String $pagedate The string representing the date
 * @return String The MYSQL datetime format or NULL if the provided date is an empty string or the string NULL 
 */
function changeDateFromPageToMySQLFormat($pagedate) {
	if ($pagedate == "NULL") {
		return NULL;
	}
	if (isEmptyString($pagedate)) {
		return NULL;
	} else {
		return date("Y-m-d H:i:s", strtotime($pagedate));
	}
}


/**
 * Check whether or not the value of the key in the specified array is empty
 *
 * @param String $key The key whose value is to be checked
 * @param Array $arr The array to check  
 * 
 * @return bool Whether or not the array key is empty
 */
function isArrayKeyAnEmptyString($key, $arr) {
	if (!array_key_exists($key, $arr)) {
		return true; 
	}
	if (empty($arr[$key])) {
		return true; 
	}
	if (is_string($arr[$key])) {
		return isEmptyString($arr[$key]);
	}
	return false; 
}
/**
 * Check whether or not the string is empty. The string is emptied
 *
 * @param String $str The string to be checked
 * 
 * @return boolean Whether or not the string is empty
 */
function isNotAnEmptyString($str) {
	return ! isEmptyString($str);
}

/**
 * Return a debug message with a break tag before and two break tags after
 *
 * @param Object $obj The object to be printed
 */
function debugMessage($obj) {
	echo "<br />";
	print_r($obj);
	echo "<br /><br />";
}
/**
 * Print the Doctrine management entity
 *
 * @param Object $obj The object to be printed
 
function debugEntity($obj) {
    echo "<br />";
    \Doctrine\Common\Util\Debug::dump($obj);
    echo "<br /><br />";
}*/

/**
 *  Merge the arrays passed to the function and keep the keys intact.
 *  If two keys overlap then it is the last added key that takes precedence.
 * 
 * @return Array the merged array
 */
function array_merge_maintain_keys() {
	$args = func_get_args();
	$result = array();
	foreach ( $args as &$array ) {
		foreach ( $array as $key => &$value ) {
			$result[$key] = $value;
		}
	}
	return $result;
}

# function that trims every value of an array
function trim_value(&$value) {
	$value = trim($value);
}

/**
 * Recursively Remove empty values from an array. If any of the keys contains an 
 * array, the values are also removed.
 *
 * @param Array $input The array
 * @return Array with the specified values removed or the filtered values
 */
function array_remove_empty($arr) {
	$narr = array();
	while ( list ($key, $val) = each($arr) ) {
		if (is_array($val)) {
			$val = array_remove_empty($val);
			// does the result array contain anything?
			if (count($val) != 0) {
				// yes :-)
				$narr[$key] = $val;
			}
		} else {
			if (! isEmptyString($val)) {
				$narr[$key] = $val;
			}
		}
	}
	unset($arr);
	return $narr;

}


/**
 * Wrapper function for the encoding of the urls using base64_encode 
 *
 * @param String $str The string to be encoded
 * @return String The encoded string 
 */
function encode($str) {
	return base64_encode($str); 
}
/**
 * Wrapper function for the decoding of the urls using base64_decode 
 *
 * @param String $str The string to be decoded
 * @return String The encoded string 
 */
function decode($str) {
	return base64_decode($str); 
}

/**
 * Function to generate a JSON string from an array of data, using the keys and values
 *
 * @param $data The data to be converted into a string
 * @param $default_option_value Value of the default option
 * @param $default_option_text Test for the default 
 * 
 * @return the JSON string containing the select options
 */
function generateJSONStringForSelectChain($data, $default_option_value = "", $default_option_text = "<Select One>") {
	$values = array(); 
	//debugMessage($data);
	if (!isEmptyString($default_option_value)) {
		# use the text and option from the data
		if(!isArrayKeyAnEmptyString($default_option_value, $data)){
			$values[] = '{"id":"' . $default_option_value . '", "label":"' . $data[$default_option_value] . '"}';
			// remove the default option from the available options
			unset($data[$default_option_value]);
		}
	}
	# add a default option
	$values[] = '{"id":"", "label":"' . $default_option_text . '"}';
	foreach ( $data as $key => $value ) {
		$values[] = '{"id":"'.$key.'", "label":"' . $value . '"}';
		//debugMessage($strstring);
	}
	# remove the first comma at the end
	return '[' . implode("," , $values). "]";
}

/**
 * Generate an HTML list from an array of values
 *
 * @param Array $array
 * @return String 
 */
function createHTMLListFromArray($array) {
	$str = ""; 
	// return empty string if no array is passed
	if (!is_array($array)) {
		return $str; 
	}
	// return an empty string if the array is empty
	if (!$array) {
		return $str; 
	}
	
	// opening list tag and the first li element
	$str  = "<ul><li>";
	// explode the array and generate the inner list items
	$str .= implode($array, "</li><li>");
	// close the last list item, and the ul
	$str .= "</li></ul>"; 
	
	return $str; 
}


/**
	 * Decode all html entities of an array  
	 * @param Array $elem the array to be decoded
	 */
	function decodeHtmlEntitiesInArray(&$elem){ 
  		if (!is_array($elem)) { 
    		$elem=html_entity_decode($elem); 
		}  else  { 
			foreach ($elem as $key=>$value){
				$elem[$key]=decodeHtmlEntitiesInArray($value);
			} 
  		} 
		return $elem; 
	}
	
	/**
	 * Get a database connection to execute straight SQL queries
	 * 
	 * @return Doctrine\DBAL\Connection 
	 */
	
	
	
	function isValidObject($object){
		return is_object($object) && (count(get_object_vars($object)) > 0);
	}
	
	
	/**
	 * Generate a 10 digit activation key  
	 * 
	 * @return String An activation key
	 */
    function generateActivationKey() {
		return substr(md5(uniqid(mt_rand(), 1)), 0, 10);
    }
    /**
     * Return the file extension from a file name
     * @param string $filename
     * @return string The file extension
     */
    function findExtension($filename){
        return substr(strrchr($filename,'.'),1);
    }
    /** Displays the file siz in bytes, KB, MB or GB depending on your selection, from the size stored for the
     * document.
     *
     * @param integer $size The size of the file
     * @param integer $precision The number of decimal places to show  
     *
     * @return String The file size with the defined type of FALSE if there is an invalid size
     */
    function formatBytes($size, $precision = 2) {
        $base = log($size) / log(1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
    
        return round(pow(1024, $base - floor($base)), $precision) . " ".$suffixes[floor($base)];
    }
    /**
	 * Trims a given string with a length more than a specified length with a more link to view the details 
	 *
	 * @param string $text
	 * @param int $length
	 * @param string $tail
	 * @return string the substring with a more link as the tail
	 */
	function snippet($text, $length, $tail) {
		$text = trim($text);
		$txtl = strlen($text);
		if ($txtl > $length) {
			for($i = 1; $text[$length - $i] != " "; $i ++) {
				if ($i == $length) {
					return substr($text, 0, $length) . $tail;
				}
			}
			for(; $text[$length - $i] == "," || $text[$length - $i] == "." || $text[$length - $i] == " "; $i ++) {
				;
			}
			$text = substr($text, 0, $length - $i + 1) . $tail;
		}
		return $text;
	}
	
 	function printtoScreen(){
	 echo 'common functions works find';
	}
	
	function generateContextMenu($currenturl){
		$links = '';
		if (strpos($currenturl, 'hub') !== false){
			$links .= '<li> <a href="'.route('hub.index').'">All hubs</a></li>';
			$links .= '<li> <a href="'.route('hub.create').'">New hub</a></li>';
		}elseif(strpos($currenturl, 'organization') != false){
			$links .= '<li> <a href="'.route('organization.index').'">All IPs</a></li>';
			$links .= '<li> <a href="'.route('organization.create').'">New IP</a></li>';
		}elseif(strpos($currenturl, 'facility') != false){
			$links .= '<li> <a href="'.route('facility.index').'">All facilities</a></li>';
			$links .= '<li> <a href="'.route('facility.create').'">New facility</a></li>';
		}elseif(strpos($currenturl, 'equipment') != false){
			$links .= '<li> <a href="'.route('equipment.index').'">All bikes</a></li>';
			$links .= '<li> <a href="'.route('equipment.create').'">New bike</a></li>';
		}elseif(strpos($currenturl, 'staff/list/2') != false || strpos($currenturl, 'staff/new/2') != false){
			$links .= '<li> <a href="'.url('staff/list/2').'">All staff members</a></li>';
			$links .= '<li> <a href="'.url('staff/new/2').'">New staff member</a></li>';
		}elseif(strpos($currenturl, 'staff/list/1') != false || strpos($currenturl, 'staff/new/1') != false){
			$links .= '<li> <a href="'.url('staff/list/1').'">All sample transporters</a></li>';
			$links .= '<li> <a href="'.url('staff/new/1').'">New transporter</a></li>';
		}
		return $links;
	}
	/*get the name of a model
	*
	*
	*
	*/
	function getModelAttribute($id, $model, $attribute) {
		$model = $model::findOrFail($id); //Find model of id = $id
        return $model->$attribute;
    }
	
	/**
	 * Return the description of a lookup value 
	 * 
	 * @param String $lookuptype The Lookuptype - passed dynamically, that is why a static method is used
	 * 
	 * @param String $lookuptypevalue The actual lookvalue that was saved, now needs translation 
	 * 
	 * @return Array containing the lookup types for the values or false if an error occurs
	 *
	 */
	 function getLookupValueDescription($lookuptype, $lookuptypevalue) {
	    $cache_key = $lookuptype;
		//try to load the lookup from cache - if it exist
	    $result = Cache::get($cache_key, null);

	    if (!$result) {
			//pluck out the needed column
		$result = DB::table('lookuptypevalue as lv')->select('lv.lookupvaluedescription')->join('lookuptype as l','lv.lookuptypeid', 'l.id')
												->where('l.name','=',$lookuptype)
												->where('lv.lookuptypevalue','=',$lookuptypevalue)->pluck('lv.lookupvaluedescription');
		//DB::table('users')->pluck('columname');
    		// add the result to the cache
			Cache::put($cache_key, $lookuptype.$lookuptypevalue, \Config::get('app.lookup_value_cache_minutes'));
	   } 
	   return $result[0];
	}
	function getSupportPeriodDates($organizationid){
		$query = "SELECT sp.startdate, sp.enddate from supportagencyperiod sp
		INNER JOIN organization org ON sp.organizationid = org.id";
		$dates = \DB::select($query);
		return $dates;
	} 
	function getContact($obj, $cat,$type,$table_attribute = 'organizationid'){
		return \App\Models\Contact::where($table_attribute, $obj)
											->where('category',$cat)
											->where('type',$type)->first();
	}
	function getHubScheduleforaDay($day, $hubid){
		$schedule =  \App\Models\RoutingSchedule::where('dayoftheweek', '=', $day)->where('hubid', $hubid)->get();
		return $schedule;
	}
		
	function getHubScheduleFacilitiesforaDay($day, $hubid){
		$schedule = getHubScheduleforaDay($day, $hubid);
		$ids_array = array();
		$no_items = count($schedule);
		if($no_items){
			foreach($schedule as $line){
				$ids_array[] = $line->facilityid;
				
			}
		}
		return $ids_array;
	}
?>