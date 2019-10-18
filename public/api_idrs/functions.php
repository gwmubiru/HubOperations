<?php  
header('Access-Control-Allow-Origin: *'); 
 ?> 
<?php
//include("conn.php");

define("HOST", "localhost");
define("USER", "root");
define("PASS", "5ample_db");
define("DB", "sampletracker");

function strip_html_tags( $text )
{
	// PHP's strip_tags() function will remove tags, but it
	// doesn't remove scripts, styles, and other unwanted
	// invisible text between tags.  Also, as a prelude to
	// tokenizing the text, we need to insure that when
	// block-level tags (such as <p> or <div>) are removed,
	// neighboring words aren't joined.
	$text = preg_replace(
		array(
			// Remove invisible content
			'@<head[^>]*?>.*?</head>@siu',
			'@<style[^>]*?>.*?</style>@siu',
			'@<script[^>]*?.*?</script>@siu',
			'@<object[^>]*?.*?</object>@siu',
			'@<embed[^>]*?.*?</embed>@siu',
			'@<applet[^>]*?.*?</applet>@siu',
			'@<noframes[^>]*?.*?</noframes>@siu',
			'@<noscript[^>]*?.*?</noscript>@siu',
			'@<noembed[^>]*?.*?</noembed>@siu',

			// Add line breaks before & after blocks
			'@<((br)|(hr))@iu',
			'@</?((address)|(blockquote)|(center)|(del))@iu',
			'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
			'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
			'@</?((table)|(th)|(td)|(caption))@iu',
			'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
			'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
			'@</?((frameset)|(frame)|(iframe))@iu',
		),
		array(
			' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
			"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
			"\n\$0", "\n\$0",
		),
		$text );

	// Remove all remaining tags and comments and return.
	return strip_tags( $text );
}
 
function addqrcode()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['qrcode'])){
     $qrcode = strip_html_tags(addslashes($_REQUEST['qrcode']));  
     $hubriderName = strip_html_tags(addslashes($_REQUEST['hubriderName'])); 
     $phoneSerialNo = strip_html_tags(addslashes($_REQUEST['phoneSerialNo']));
	 
	 {
	  
	mysqli_query($con,"INSERT INTO qrcodes set qrcode='$qrcode',hubriderName='$hubriderName',phoneSerialNo='$phoneSerialNo',enterdate=NOW() ")or die(mysql_error($con));
		 
	$id = mysql_insert_id(); // last inserted id
	 
		 	
			$sel=mysqli_query($con,"select * from qrcodes where id='$id' ")or die(mysql_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['qrcode']=$row['qrcode']; 
           $json['hubriderName']=$row['hubriderName']; 
           $json['phoneSerialNo']=$row['phoneSerialNo']; 
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

}

function addtest()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['test'])){
      
     $test = strip_html_tags(addslashes($_REQUEST['test'])); 
     $testnumber = strip_html_tags(addslashes($_REQUEST['testnumber']));
     $barcode_id = strip_html_tags(addslashes($_REQUEST['barcode_id']));
	 
	  {
	  
	mysqli_query($con,"INSERT INTO tests set test='$test',testnumber='$testnumber',barcode_id='$barcode_id',enteredate=NOW() ")or die(mysql_error($con));
		 
	$id = mysqli_insert_id($con); // last inserted id
	  
			$sel=mysqli_query($con,"select * from tests where id='$id' ")or die(mysql_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['test']=$row['test']; 
           $json['testnumber']=$row['testnumber']; 
           $json['barcode_id']=$row['barcode_id']; 
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

}

function PackageDetail()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['big_barcodeid'])){
      
     $big_barcodeid = strip_html_tags(addslashes($_REQUEST['big_barcodeid'])); 
     $small_barcodeid = strip_html_tags(addslashes($_REQUEST['small_barcodeid']));
     $final_destination = strip_html_tags(addslashes($_REQUEST['final_destination']));
	 $created_by = strip_html_tags(addslashes($_REQUEST['created_by']));
	 
	  {
	  
	mysqli_query($con,"INSERT INTO packagedetail set big_barcodeid='$big_barcodeid',small_barcodeid='$small_barcodeid',final_destination='$final_destination',created_by='$created_by',created_at=NOW() ")or die(mysql_error($con));
		 
	$id = mysqli_insert_id($con); // last inserted id
	  
			$sel=mysqli_query($con,"select * from packagedetail where id='$id' ")or die(mysql_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['big_barcodeid']=$row['big_barcodeid']; 
           $json['small_barcodeid']=$row['small_barcodeid']; 
           $json['final_destination']=$row['final_destination']; 
		   $json['created_by']=$row['created_by']; 
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

} 

function addbarcode()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['barcode'])){
     $barcode = strip_html_tags(addslashes($_REQUEST['barcode']));  
     $barcode_id = strip_html_tags(addslashes($_REQUEST['barcode_id'])); 
     $facilityid = strip_html_tags(addslashes($_REQUEST['facilityid']));
     $case_id = strip_html_tags(addslashes($_REQUEST['case_id']));
	 $hubid = strip_html_tags(addslashes($_REQUEST['hubid']));
     $type = strip_html_tags(addslashes($_REQUEST['type'])); 
     $final_destination = strip_html_tags(addslashes($_REQUEST['final_destination'])); 
     $created_by = strip_html_tags(addslashes($_REQUEST['created_by'])); 
	 
	 {
	  
	  mysqli_query($con,"INSERT INTO package  set barcode='$barcode',barcode_id='$barcode_id',facilityid='$facilityid',hubid='$hubid',case_id = '$case_id' , type='$type',final_destination='$final_destination',created_by='$created_by',created_at=NOW() ")or die(mysqli_error($con));
		 
	$id = mysqli_insert_id($con); // last inserted id
	 
		 	
			$sel=mysqli_query($con,"select * from package where id='$id' ")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['barcode']=$row['barcode']; 
           $json['barcode_id']=$row['barcode_id'];
           $json['facilityid']=$row['facilityid']; 
           $json['case_id']=$row['case_id'];
		   $json['hubid']=$row['hubid'];
           $json['type']=$row['type'];  
           $json['final_destination']=$row['final_destination']; 
           $json['created_by']=$row['created_by']; 
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

}
function SampleTranspoterLogin() 
{
	
	$con=mysqli_connect(HOST,USER,PASS,DB);
	


	$json=array();

	

	if(isset($_REQUEST['telephonenumber']) && isset($_REQUEST['code'])){



	$telephonenumber = strip_html_tags(addslashes($_REQUEST['telephonenumber']));
 
	$code = strip_html_tags(addslashes($_REQUEST['code']));


	$sel=mysqli_query($con,"SELECT  * FROM `staff` WHERE code = '$code' AND telephonenumber= '$telephonenumber' AND designation= 4 AND isactive=1")or die(mysqli_error($con));

		 
		 

	if(mysqli_num_rows($sel)){
 
         
		 while($row=mysqli_fetch_assoc($sel)){
  
		 
           $json['results'][]=$row;
 
		    
		}

		
		$json['status']='ok';

		$json['message']='Sample Transporter successfully logged into Sample Trackering app!!';

		 }

		 else

		 {

		$json['status']='error';

		$json['message']='Phone Number or Password is Incorrect!!!, Please try again!!! ';

		 }
 

	}




	echo json_encode($json);
 
}

function Login()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	
	$json=array();

	if(isset($_REQUEST['code'])){

	$code = strip_html_tags(addslashes($_REQUEST['code'])); 
	  	 	
	$sel=mysqli_query($con,"SELECT s.id as staffid,s.firstname,s.code, s.lastname,s.designation,s.motorbikeid,s.hubid,f.id, f.name FROM `staff` s INNER JOIN `facility` f ON (s.hubid = f.parentid) WHERE s.code = '$code' AND s.isactive=1")or die(mysql_error($con));


		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		$json['message']='You have successfully logged into Sample Tracking app!!';
		 }
		 else
		 {
		$json['status']='error';
		$json['message']='Facility Not on Your Route List or Staff not active , Please try again!!! ';
		 } 

	}



	echo json_encode($json); 
}

function viewFacility()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id']) && isset($_REQUEST['code'])){

	$id = strip_html_tags(addslashes($_REQUEST['id']));
    $code = strip_html_tags(addslashes($_REQUEST['code']));
	  	 	
	$sel=mysqli_query($con,"SELECT id,code FROM `facility` WHERE id = '$id' && code = '$code'")or die(mysqli_error($con));

		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		$json['message']='You have successfully logged into Sample Trackering app!!';
		 }
		 else
		 {
		$json['status']='error';
		$json['message']='Facility Not on Your Route List,, Please try again!!! ';
		 } 

	}



	echo json_encode($json); 
}
 
function addsample()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['samplecategory'])){
      
     $samplecategory = strip_html_tags(addslashes($_REQUEST['samplecategory'])); 
     $numberofsamples = strip_html_tags(addslashes($_REQUEST['numberofsamples']));
	 $facilityid = strip_html_tags(addslashes($_REQUEST['facilityid']));
	 $samplename = strip_html_tags(addslashes($_REQUEST['samplename']));
     $barcodeid = strip_html_tags(addslashes($_REQUEST['barcodeid']));
	 $hubid = strip_html_tags(addslashes($_REQUEST['hubid']));
     $bikeid = strip_html_tags(addslashes($_REQUEST['bikeid']));     $suspected_disease = strip_html_tags(addslashes($_REQUEST['suspected_disease']));
	 
	  {
	  
	mysqli_query($con,"INSERT INTO samples set samplecategory='$samplecategory',facilityid='$facilityid',samplename='$samplename',numberofsamples='$numberofsamples',barcodeid='$barcodeid',hubid='$hubid',bikeid='$bikeid',suspected_disease='$suspected_disease',thedate=NOW(),created_at=NOW()")or die(mysqli_error($con));
		 
	$id = mysqli_insert_id($con); // last inserted id
	  
			$sel=mysqli_query($con,"select * from samples where id='$id' ")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['facilityid']=$row['facilityid']; 
           $json['samplename']=$row['samplename'];
		   $json['samplecategory']=$row['samplecategory'];
           $json['numberofsamples']=$row['numberofsamples']; 
           $json['barcodeid']=$row['barcodeid']; 
		   $json['hubid']=$row['hubid']; 
           $json['bikeid']=$row['bikeid'];
	   $json['suspected_disease']=$row['suspected_disease'];
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

}
 
function viewSamples()
{
  $con=mysqli_connect(HOST,USER,PASS,DB); 
$json=array();
	
	$sel=mysqli_query($con,"SELECT lv.lookupvaluedescription as optiontext, lv.lookuptypevalue as optionvalue FROM lookuptype AS l , 
        lookuptypevalue AS lv WHERE l.id =  lv.lookuptypeid AND l.name ='SAMPLE_CATEGORIES' ORDER BY optiontext")or die(mysqli_error($con));
		 
	if(mysqli_num_rows($sel)){
        while($row=mysqli_fetch_assoc($sel)){  
		 
		$json['results'][]=$row;
		}
		$json['status']="ok";
      
	  }else{ 
	 
		$json['status']="empty";
      }
	 
echo json_encode($json);	
	
	
}
 
function checkLogin()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['hubid'])){
      
     $hubid = strip_html_tags(addslashes($_REQUEST['hubid'])); 
     $facilityid = strip_html_tags(addslashes($_REQUEST['facilityid']));
	 $bikeid = strip_html_tags(addslashes($_REQUEST['bikeid']));
     $staffid = strip_html_tags(addslashes($_REQUEST['staffid']));
	 
	  {
	  
	mysqli_query($con,"INSERT INTO checklogin set hubid='$hubid',facilityid='$facilityid',bikeid='$bikeid',staffid='$staffid',thedate=NOW(),created_at=NOW()")or die(mysqli_error($con));
		 
	$id = mysql_insert_id($con); // last inserted id
	  
			$sel=mysqli_query($con,"select * from checklogin where id='$id' ")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['facilityid']=$row['facilityid']; 
		   $json['hubid']=$row['hubid'];
           $json['bikeid']=$row['bikeid']; 
           $json['staffid']=$row['staffid']; 
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

}

function RecieveSample()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['barcode'])&& isset($_REQUEST['status'])){

	$barcode = strip_html_tags(addslashes($_REQUEST['barcode']));
	$status = strip_html_tags(addslashes($_REQUEST['status']));
	  	 	
	$sel=mysqli_query($con,"SELECT  s.barcodeid, s.samplename, b.final_destination ,s.samplecategory,s.numberofsamples,s.status FROM `samples` s INNER JOIN `package` b ON (s.barcodeid = b.id ) WHERE b.barcode = '$barcode' AND b.status = '$status'")or die(mysqli_error($con));


		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
}

function ConfirmSamples()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['barcode'])){

	$barcode = strip_html_tags(addslashes($_REQUEST['barcode']));
	  	 	
	$sel=mysqli_query($con,"UPDATE package SET status ='3' WHERE barcode = '$barcode'")or die(mysqli_error($con));
		 
		 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
}

function addPackageMovement()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['packageid'])){
      
     $packageid = strip_html_tags(addslashes($_REQUEST['packageid'])); 
     $status = strip_html_tags(addslashes($_REQUEST['status']));
	 $source = strip_html_tags(addslashes($_REQUEST['source']));
	 $destination = strip_html_tags(addslashes($_REQUEST['destination']));
     $taken_by = strip_html_tags(addslashes($_REQUEST['taken_by'])); 
     $type_of_movement = strip_html_tags(addslashes($_REQUEST['type_of_movement']));
     $longitude = strip_html_tags(addslashes($_REQUEST['longitude']));
     $latitude = strip_html_tags(addslashes($_REQUEST['latitude']));
	 
	  {
	  
	mysqli_query($con,"INSERT INTO packagemovement set packageid='$packageid',status='$status',source='$source',destination='$destination',taken_by='$taken_by',type_of_movement='$type_of_movement',taken_at=NOW(), longitude = '$longitude',latitude = '$latitude' ,created_at=NOW()")or die(mysqli_error($con));
		 
	$id = mysql_insert_id($con); // last inserted id
	  
			$sel=mysqli_query($con,"select * from packagemovement where id='$id' ")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id']; 
           $json['source']=$row['source'];
		   $json['packageid']=$row['packageid'];
           $json['destination']=$row['destination']; 
           $json['taken_by']=$row['taken_by']; 
           $json['type_of_movement']=$row['type_of_movement']; 
	       $json['longitude']=$row['longitude'];
	       $json['latitude']=$row['latitude'];
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

}

function addReferedsample()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['sampleid'])){ 	
      
     $sampleid = strip_html_tags(addslashes($_REQUEST['sampleid']));
	 $sourceid = strip_html_tags(addslashes($_REQUEST['sourceid']));
	 $destinationid = strip_html_tags(addslashes($_REQUEST['destinationid']));
	 $sample_number = strip_html_tags(addslashes($_REQUEST['sample_number']));
     $status = strip_html_tags(addslashes($_REQUEST['status']));
     $createdby = strip_html_tags(addslashes($_REQUEST['createdby'])); 
     
	 
	  {
	  
	mysqli_query($con,"INSERT INTO samplereferral set sampleid='$sampleid',sourceid='$sourceid',destinationid='$destinationid',sample_number='$sample_number',status='$status',createdby='$createdby',created_at=NOW()")or die(mysqli_error($con));
		 
	$id = mysql_insert_id($con); // last inserted id
	  
			$sel=mysqli_query($con,"select * from samplereferral where id='$id' ")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id']; 
		   $json['sampleid']=$row['sampleid'];
           $json['sourceid']=$row['sourceid'];
           $json['destinationid']=$row['destinationid']; 
           $json['sample_number']=$row['sample_number']; 
           $json['createdby']=$row['createdby'];
		    
		}
		
		$json['status']='ok';
		 }
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 

} 

function addTobigpackage()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['barcode'])){

	$barcode = strip_html_tags(addslashes($_REQUEST['barcode']));
	  	 	
	$sel=mysqli_query($con,"SELECT id,barcode, final_destination FROM `package` WHERE barcode = '$barcode'")or die(mysqli_error($con));  
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 

	echo json_encode($json); 
} 

function bigBarcodeLogic()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['barcode'])){

	$barcode = strip_html_tags(addslashes($_REQUEST['barcode'])); 
	  	 	
	$sel=mysqli_query($con,"SELECT * FROM `package` WHERE barcode = '$barcode'")or die(mysqli_error($con)); 
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		   /*$json['barcode']=$row['barcode'];
		   $json['status']=$row['status'];*/
		    
		} 
		$json['status']='ok';
		 }
		 else
		 {
			if(isset($_REQUEST['barcode'])){
				 $barcode = strip_html_tags(addslashes($_REQUEST['barcode']));  
				 $facilityid = strip_html_tags(addslashes($_REQUEST['facilityid']));
				 $hubid = strip_html_tags(addslashes($_REQUEST['hubid']));	 
				 $barcode_id = strip_html_tags(addslashes($_REQUEST['barcode_id'])); 
				 $type = strip_html_tags(addslashes($_REQUEST['type']));
				 $final_destination = strip_html_tags(addslashes($_REQUEST['final_destination']));
				 $created_by = strip_html_tags(addslashes($_REQUEST['created_by']));
				  
				mysqli_query($con,"INSERT INTO package  set barcode='$barcode',facilityid='$facilityid',hubid='$hubid',barcode_id='$barcode_id',type='$type',final_destination='$final_destination',created_by='$created_by',created_at=NOW() ")or die(mysqli_error($con));
					 
				$id = mysql_insert_id($con); // last inserted id 
		 	
				$sel=mysqli_query($con,"select * from package where id='$id' ")or die(mysqli_error($con));
		 
				 if(mysqli_num_rows($sel)){ 
				 
				 while($row=mysqli_fetch_assoc($sel)){ 
				   $json['id']=$row['id'];
				   $json['barcode']=$row['barcode']; 
				   $json['facilityid']=$row['facilityid']; 
				   $json['hubid']=$row['hubid'];
				   $json['barcode_id']=$row['barcode_id']; 
				   $json['type']=$row['type'];
				   $json['final_destination']=$row['final_destination'];
				   $json['created_by']=$row['created_by'];
					
				}
		
				$json['status']='ok';
				 }
		 
			}else{
				 $json['status']= "missing";
				} 
			  
		 } 

	}  

	echo json_encode($json); 
}

function ViewSampleStatus()
{
   $con=mysqli_connect(HOST,USER,PASS,DB);
$json=array(); 

	$sel=mysqli_query($con,"SELECT f.name ,p.barcode,s.samplename, s.numberofsamples FROM `package` as p LEFT JOIN `samples` as s ON p.id = s.barcodeid LEFT JOIN facility as f ON p.facilityid = f.id WHERE p.type=1 AND p.status=5")or die(mysql_error($con));
	
	if(mysqli_num_rows($sel)){
        while($row=mysqli_fetch_assoc($sel)){  
		 
		$json['results'][]=$row;
		}
		$json['status']="ok";
      
	  }else{ 
	 
		$json['status']="empty";
      }
	 
echo json_encode($json);	
	
	
}

function delieverSample()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['hubid'])){
     $hubid = addslashes($_REQUEST['hubid']); 
     $created_by = strip_html_tags(addslashes($_REQUEST['created_by'])); 
	 
	 
		$sel3=mysqli_query($con,"SELECT a.barcode, a.status as barcodeStatus FROM `package`a INNER JOIN `packagemovement`b ON(a.id = b.packageid AND a.created_by = b.taken_by) WHERE a.status='1' AND a.hubid='$hubid'")or die(mysqli_error($con));
	   
		 if(mysqli_num_rows($sel3)){  
	  
			$sel=mysqli_query($con,"UPDATE `package` set status='2' WHERE status='1' AND hubid='$hubid' AND created_by ='$created_by'")or die(mysqli_error($con));
			
	  
		 if($sel){ 
        
			$sel2=mysqli_query($con,"select barcode from `package` where hubid='$hubid' AND created_by ='$created_by' AND status='2'")or die(mysqli_error($con));
			
		
			
			
		 
		 if(mysqli_num_rows($sel2)){ 
         
		  while($row=mysqli_fetch_assoc($sel2)){  
		 
           $json['results'][]=$row; 
		    
		}
		  
		 
		 }
		 
		$json['status']='ok';
		 }
		 
		  }
		 else{
			$json['status']='failed'; 
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 
}

function updateDelivery()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['hubid'])&& isset($_REQUEST['taken_by'])){

	$hubid = strip_html_tags(addslashes($_REQUEST['hubid']));
	$taken_by = strip_html_tags(addslashes($_REQUEST['taken_by']));
	  	 	
	$sel=mysqli_query($con,"UPDATE packagemovement, package 
SET packagemovement.delivered_at=NOW(),packagemovement.status = 2 
WHERE package.id = packagemovement.packageid 
AND packagemovement.packageid IN (SELECT package.id FROM package WHERE packagemovement.packageid = package.id AND package.status='2' AND packagemovement.status='1'AND package.hubid='$hubid' AND packagemovement.taken_by='$taken_by')")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
}

function updateRecieve()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['barcode'])&& isset($_REQUEST['recieved_by'])){

	$barcode = strip_html_tags(addslashes($_REQUEST['barcode']));
	$recieved_by = strip_html_tags(addslashes($_REQUEST['recieved_by']));
	  	 	
	$sel=mysqli_query($con,"UPDATE packagemovement SET packagemovement.recieved_at=NOW() , packagemovement.recieved_by='$recieved_by',packagemovement.status = 3 WHERE packagemovement.packageid = (SELECT package.id FROM package WHERE packagemovement.packageid = package.id AND package.barcode='$barcode')")or die(mysqli_error($con));
		 
		 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
}

function ReferedPackage()
{
  $con=mysqli_connect(HOST,USER,PASS,DB); 
  $json=array(); 

	$sel=mysqli_query($con,"SELECT p.barcode, p.type, p.status, s.sample_number FROM `package` p INNER JOIN `samplereferral` s ON(p.id = s.sampleid) WHERE p.type=2 AND p.status= 1 AND s.status =1")or die(mysqli_error($con));
	
	if(mysqli_num_rows($sel)){
        while($row=mysqli_fetch_assoc($sel)){  
		 
		$json['results'][]=$row;
		}
		$json['status']="ok";
      
	  }else{ 
	 
		$json['status']="empty";
      }
	 
echo json_encode($json);	
	
	
} 

function updateTransportPicking()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['hubid'])){
     $hubid = addslashes($_REQUEST['hubid']); 
     $barcode = strip_html_tags(addslashes($_REQUEST['barcode'])); 
	 
	 
		$sel3=mysqli_query($con,"SELECT * FROM `package`a WHERE a.barcode='$barcode' AND a.hubid='$hubid'")or die(mysqli_error($con));
	   
		 if(mysqli_num_rows($sel3)){  
	  
			$sel=mysqli_query($con,"UPDATE `package` set status='1' WHERE type='2' AND hubid='$hubid' AND barcode ='$barcode'")or die(mysqli_error($con));
			
	  
		 if($sel){ 
        
			$sel2=mysqli_query($con,"select * from `package` where hubid='$hubid' AND barcode ='$barcode' AND status='1'")or die(mysqli_error($con));
			
		
			
			
		 
		 if(mysqli_num_rows($sel2)){ 
         
		  while($row=mysqli_fetch_assoc($sel2)){  
		 
           $json['results'][]=$row; 
		    
		}
		  
		 
		 }
		 
		$json['status']='ok';
		 }
		 
		  }
		 else{
			$json['status']='failed'; 
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 
}

function updateBarStatusPicking()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id']));  
	$sel=mysqli_query($con,"UPDATE package p, packagedetail pd SET p.`status` = 4 WHERE pd.small_barcodeid = p.id AND pd.big_barcodeid = $id;")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}

function updateBStatusPick()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id']));  
	$sel=mysqli_query($con,"UPDATE package p, packagedetail pd SET p.`status` = 5 WHERE pd.small_barcodeid = p.id AND pd.big_barcodeid = $id;")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}

function updateBStatusDeliever()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id']));  
	$sel=mysqli_query($con,"UPDATE package p, packagedetail pd SET p.`status` = 6 WHERE pd.small_barcodeid = p.id AND pd.big_barcodeid = $id;")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}
function updateBStatusDelieverRefer()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id']));  
	$sel=mysqli_query($con,"UPDATE package  SET `status` = 6 WHERE id = $id;")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}

function delieverSampleCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['final_destination'])){
	
     $final_destination = addslashes($_REQUEST['final_destination']); 
	 $taken_by = addslashes($_REQUEST['taken_by']); 
       
	 
	 
		$sel3=mysqli_query($con,"SELECT a.id, a.barcode, b.status as barcodeStatus FROM `package`a INNER JOIN `packagemovement`b 
		ON(a.id = b.packageid AND a.type=b.type_of_movement) WHERE a.status= 1  AND a.final_destination='$final_destination' AND a.type=2 AND b.taken_by='$taken_by'")or die(mysqli_error($con));
	   
		 if(mysqli_num_rows($sel3)){  
	  
			$sel=mysqli_query($con,"UPDATE `package` set status='2' WHERE status='1' AND final_destination='$final_destination' AND type=2 AND taken_by='$taken_by'")or die(mysqli_error($con));
			
	  
		 if($sel){ 
        
			$sel2=mysqli_query($con,"select * from `package` where final_destination='$final_destination' AND status='2'")or die(mysqli_error($con)); 
			
		 
		 if(mysqli_num_rows($sel2)){ 
         
		  while($row=mysqli_fetch_assoc($sel2)){  
		 
           $json['results'][]=$row; 
		    
		}
		  
		 
		 }
		 
		$json['status']='ok';
		 }
		 
		  }
		 else{
			$json['status']='failed'; 
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 
}

function updateDeliveryCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['final_destination'])){

	$final_destination = strip_html_tags(addslashes($_REQUEST['final_destination']));
	$taken_by = strip_html_tags(addslashes($_REQUEST['taken_by']));
	  	 	
	$sel=mysqli_query($con,"UPDATE packagemovement, package 
SET packagemovement.delivered_at=NOW(),packagemovement.status = 2 
WHERE package.id = packagemovement.packageid AND type = 2
AND packagemovement.packageid IN (SELECT package.id FROM package WHERE packagemovement.packageid = package.id AND package.status='2' AND package.type = 2 AND packagemovement.status='1'AND package.final_destination='$final_destination' AND packagemovement.taken_by = '$taken_by' )")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
} 

function updateDeliveryReferCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['final_destination'])){

	$final_destination = strip_html_tags(addslashes($_REQUEST['final_destination']));
	$taken_by = strip_html_tags(addslashes($_REQUEST['taken_by']));
	  	 	
	$sel=mysqli_query($con,"UPDATE packagemovement, package 
SET packagemovement.delivered_at=NOW(),packagemovement.status = 2 
WHERE package.id = packagemovement.packageid
AND packagemovement.packageid IN (SELECT package.id FROM package WHERE packagemovement.packageid = package.id AND package.status='2' AND packagemovement.status='1'AND package.final_destination='$final_destination' AND packagemovement.taken_by = '$taken_by' )")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
} 

function updateCPHLRecieving()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['final_destination'])){
     $final_destination = addslashes($_REQUEST['final_destination']); 
     $barcode = strip_html_tags(addslashes($_REQUEST['barcode'])); 
	 
		$sel3=mysqli_query($con,"SELECT * FROM `package`a WHERE a.barcode='$barcode' AND a.final_destination='$final_destination'")or die(mysqli_error($con)); 
		 if(mysqli_num_rows($sel3)){  
			$sel=mysqli_query($con,"UPDATE `package` set status='3' WHERE type='2' AND final_destination='$final_destination' AND barcode ='$barcode'")or die(mysqli_error($con)); 
	  
		 if($sel){  
			$sel2=mysqli_query($con,"select * from `package` where final_destination='$final_destination' AND barcode ='$barcode' AND status='3'")or die(mysqli_error($con)); 
		 
		 if(mysqli_num_rows($sel2)){  
		  while($row=mysqli_fetch_assoc($sel2)){  
           $json['results'][]=$row; 
		} 
		 } 
		$json['status']='ok';
		 }
		 
		  }
		 else{
			$json['status']='failed'; 
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 
}

function updateBStatusRecieveCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id']));  
	$sel=mysqli_query($con,"UPDATE package p, packagedetail pd SET p.`status` = 7 WHERE pd.small_barcodeid = p.id AND pd.big_barcodeid = $id;")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}
 function RecieveSampleCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['big_barcodeid'])){

	$big_barcodeid = strip_html_tags(addslashes($_REQUEST['big_barcodeid'])); 
	  	 	
	$sel=mysqli_query($con,"SELECT b.barcode FROM `package` b INNER JOIN `packagedetail` pd ON (b.id= pd.small_barcodeid) WHERE pd.big_barcodeid= '$big_barcodeid'")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
} 

function updateRecieveCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['final_destination'])){

	$final_destination = strip_html_tags(addslashes($_REQUEST['final_destination']));
	$barcode = strip_html_tags(addslashes($_REQUEST['barcode']));
	$recieved_by = strip_html_tags(addslashes($_REQUEST['recieved_by']));
	  	 	
	$sel=mysqli_query($con,"UPDATE packagemovement, package SET packagemovement.recieved_at=NOW(),packagemovement.status = 3 , packagemovement.recieved_by = '$recieved_by'
							WHERE package.id = packagemovement.packageid AND type = 2 AND packagemovement.packageid IN (SELECT package.id FROM package WHERE packagemovement.packageid = package.id AND package.status='2' AND package.type = 2 AND package.barcode='$barcode' AND package.final_destination='$final_destination')")or die(mysqli_error($con)); 
 
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}  

	echo json_encode($json); 
}


function CheckMySamples()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array(); 
	if(isset($_REQUEST['created_by'])&& isset($_REQUEST['status']) && isset($_REQUEST['type'])){ 
	$created_by = strip_html_tags(addslashes($_REQUEST['created_by']));
	$status = strip_html_tags(addslashes($_REQUEST['status'])); 
	$type = strip_html_tags(addslashes($_REQUEST['type'])); 
	
	$sel=mysqli_query($con,"select p.id, p.final_destination,  p.barcode, s.samplecategory, s.samplename ,s.numberofsamples,f.name from package p INNER JOIN samples s ON(p.id = s.barcodeid)  LEFT JOIN facility f ON( f.id = p.facilityid) where p.status = '$status' AND p.type = '$type' AND p.created_by = '$created_by'")or die(mysqli_error($con));
	if(mysqli_num_rows($sel)){  
		 while($row=mysqli_fetch_assoc($sel)){  
           $json['results'][]=$row;  
		} 
		$json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 }  
	}  
	echo json_encode($json); 
}


function getFacility()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){

	$id = strip_html_tags(addslashes($_REQUEST['id'])); 
	  	 	
	$sel=mysqli_query($con,"SELECT name FROM `facility` WHERE id = '$id'")or die(mysqli_error($con));

		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		} 
		$json['status']='ok'; 
		 }
		 else
		 {
		$json['status']='error';  
		 } 

	}



	echo json_encode($json); 
}

function viewReferenceLab()

{
  
	$con=mysqli_connect(HOST,USER,PASS,DB); 
	
$json=array();
	
	

	$sel=mysqli_query($con,"SELECT id,hubname FROM `facility` WHERE code =10000 ORDER BY name")or die(mysqli_error($con));
		 
	
	
	if(mysqli_num_rows($sel)){
        
	
	while($row=mysqli_fetch_assoc($sel)){  
	
	 $json['results'][]=$row;
		
	}

		$json['status']="ok";


      
	  }else{ 


	 
	$json['status']="empty";
      
	}

	 
	
echo json_encode($json);

}  


function getSpecimen()
{
    
    $con=mysqli_connect(HOST,USER,PASS,DB);

$json=array();
	
	 if(isset($_REQUEST['date_from'],$_REQUEST['date_to'])){
     $date_from = addslashes($_REQUEST['date_from']); 
     $date_to = addslashes($_REQUEST['date_to']); 
	 
	 
	$sel=mysqli_query($con,"select p.barcode,pm.source, pm.destination, pm.status, s.case_id, s.suspected_disease, s.longitude, s.latitude, pm.taken_at, pm.delivered_at , pm.recieved_at,p.created_by 
	                        from package p INNER JOIN packagemovement pm 
	                        ON(p.id = pm.packageid) 
	                        LEFT JOIN samples s 
	                        ON( p.id = s.barcodeid) 
	                        WHERE s.samplecategory = 11  AND s.created_at >= '$date_from' AND s.created_at <= '$date_to'")or die(mysqli_error($con));
		 
	if(mysqli_num_rows($sel)){
        while($row=mysqli_fetch_assoc($sel)){   
		$json['results'][]=$row;
		}
		//
		$json['status']="ok"; 
      
	  }else{ 
	 
		$json['status']="empty"; 
      }
	 }
	 else
	 {
		$json['status']="missing";  
	 }
	 
echo json_encode($json);	
	
	
}

function getEvents()
{
$con=mysqli_connect(HOST,USER,PASS,DB);

$json=array();

$con=mysqli_connect(HOST,USER,PASS,DB); 
  $json=array(); 
  $where_clause = '';
  
   if(isset($_REQUEST['start_date'],$_REQUEST['end_date'])){
      
      
     $date_from = addslashes($_REQUEST['start_date']); 
     $date_to = addslashes($_REQUEST['end_date']); 
     
     $where_clause = " AND pe.created_at BETWEEN '".$date_from."' AND '".$end_date."'";
     
   }
	 
  $sel=mysqli_query($con,"SELECT p.case_id, of.name as 'facility_of_origin', df.name as destination, f.name AS location, pe.longitude, pe.latitude, pe.created_at as `date`, 
					IF (pe.`status` = 1, 'IDSR_ST_FORWARDING', 
					IF(pe.status = 2 OR pe.status = 3 
					OR pe.status = 4 OR pe.status = 6 
					OR pe.status = 7,'IDSR_ST_RECEIVING','IDSR_ST_TRANSPORTING')) as `status` 
					FROM packagemovement_events pe
					INNER JOIN package p ON(pe.package_id= p.id) 
					INNER JOIN facility of ON (of.id = p.facilityid)
					 INNER JOIN facility df ON (df.id = p.final_destination) 
					INNER JOIN facility f ON (f.id = pe.location) 
					WHERE category_id = 11".$where_clause."
ORDER BY pe.created_at")or die(mysqli_error($con));
		 
	if(mysqli_num_rows($sel)){
        while($row=mysqli_fetch_assoc($sel)){  
			//$case_id = $row['case_id'];
			//$facility_of_origin = $row['facility_of_origin'];
			//$arr = ['case_id'=>$row['case_id'], 'facility_of_origin'=>$row['f']];
			/*$case_vents_query = mysqli_query($con,"SELECT f.name AS source, r.name AS destination, pm.taken_at, pm.delivered_at, pm.recieved_at, pm.longitude, pm.latitude FROM `packagemovement`pm INNER JOIN facility f ON (f.id = pm.source) INNER JOIN facility r ON(r.id = pm.destination) WHERE packageid = '".$row['id']."'")or die(mysqli_error($con));
			
			if(mysqli_num_rows($case_vents_query)){
				while($event_row=mysqli_fetch_assoc($case_vents_query)){ 
				
					$events = $event_row;
					$json[$case_id] = compact('case_id','facility_of_origin', 'events');
					//$json[][] = $event_row; 
				}
			}*/
			$json[] = $row;
		} 
		//$json['status']="ok"; 
      
	  }else{ 
	 
		$json['status']="empty"; 
      }
	  
	//print_r($json);
	//exit;
    print_r(json_encode($json));		
	 
} 


function addPackageEvent()
{
	 $con=mysqli_connect(HOST,USER,PASS,DB);

	$json=array();
  
	if(isset($_REQUEST['package_id'])){
	    
	 $package_id = strip_html_tags(addslashes($_REQUEST['package_id'])); 
	 $source = strip_html_tags(addslashes($_REQUEST['source']));
	 $category_id = strip_html_tags(addslashes($_REQUEST['category_id']));
	 $destination = strip_html_tags(addslashes($_REQUEST['destination']));
     $status = strip_html_tags(addslashes($_REQUEST['status']));  
     $created_by = strip_html_tags(addslashes($_REQUEST['created_by']));
     $location = strip_html_tags(addslashes($_REQUEST['location']));
     $longitude = strip_html_tags(addslashes($_REQUEST['longitude']));
     $latitude = strip_html_tags(addslashes($_REQUEST['latitude']));
	 
	 mysqli_query($con,"INSERT INTO packagemovement_events set package_id='$package_id',source='$source', category_id = '$category_id' ,destination='$destination',status='$status',created_by='$created_by',location = '$location', longitude = '$longitude'  , latitude = '$latitude' ")or die(mysqli_error($con)); 
	 $id = mysqli_insert_id($con); // last inserted id 
  
		$sel=mysqli_query($con,"select * from packagemovement_events where id='$id'")or die(mysqli_error($con));
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){ 
           $json['id']=$row['id'];
           $json['package_id']=$row['package_id']; 
		   $json['source']=$row['source'];
		   $json['category_id']=$row['category_id'];
           $json['destination']=$row['destination']; 
           $json['created_by']=$row['created_by']; 
           $json['location']=$row['location'];
           $json['longitude']=$row['longitude'];
	       $json['latitude']=$row['latitude'];
		}  
		$json['status']='ok'; 
		} 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json);

}

function CheckBarcodeRefered()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['barcode'])){

	$barcode = strip_html_tags(addslashes($_REQUEST['barcode'])); 
	  	 	
	$sel=mysqli_query($con,"SELECT b.id, b.barcode,b.final_destination, b.status, s.samplename,s.numberofsamples FROM `samples` s INNER JOIN `package` b ON (s.barcodeid = b.id ) WHERE b.barcode = '$barcode'")or die(mysqli_error($con));  
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	}



	echo json_encode($json); 
}

function updateReferedBarStatusPicking()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id'])); 
	$sel=mysqli_query($con,"UPDATE package p, packagemovement_events pe SET p.`status` = 4 WHERE pe.package_id = p.id AND pe.package_id = $id;")or die(mysqli_error($con));	
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}

function delieverReferedSampleCPHL()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();
	
	if(isset($_REQUEST['created_by'])){
	  
	 $created_by = addslashes($_REQUEST['created_by']); 
       
	 
	 
		$sel3=mysqli_query($con,"SELECT a.id, a.barcode, b.status as barcodeStatus FROM `package`a INNER JOIN `packagemovement_events`b 
		ON(a.id = b.package_id) WHERE a.final_destination= b.destination AND b.created_by='$created_by'")or die(mysqli_error($con));
	   
		 if(mysqli_num_rows($sel3)){  
	  
			$sel=mysqli_query($con,"UPDATE `package` set status='6' WHERE  created_by='$created_by'")or die(mysqli_error($con));
			
	  
		 if($sel){ 
        
			$sel2=mysqli_query($con,"select * from `package` where created_by='$created_by' AND status='6'")or die(mysqli_error($con)); 
			
		 
		 if(mysqli_num_rows($sel2)){ 
         
		  while($row=mysqli_fetch_assoc($sel2)){  
		 
           $json['results'][]=$row; 
		    
		}
		  
		 
		 }
		 
		$json['status']='ok';
		 }
		 
		  }
		 else{
			$json['status']='failed'; 
		 }
		 
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 
}

// this is for out break 

function delieverOBSampleCPHL()
{  	
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['final_destination']) && isset($_REQUEST['created_by'])){

	$final_destination = addslashes($_REQUEST['final_destination']); 
	$created_by = addslashes($_REQUEST['created_by']); 
	  	 	
	$sel=mysqli_query($con,"SELECT a.id, a.barcode, b.status as barcodeStatus, b.category_id, a.final_destination FROM `packagemovement_events`b INNER JOIN `package`a
		ON(a.id = b.package_id AND a.final_destination = b.destination) WHERE  a.final_destination ='$final_destination' AND b.created_by='$created_by' AND b.source !=a.final_destination")or die(mysqli_error($con));  
		 
		 if(mysqli_num_rows($sel)){ 
         
		 while($row=mysqli_fetch_assoc($sel)){  
		 
           $json['results'][]=$row; 
		    
		}
		
		$json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 

	echo json_encode($json);  
	
}

function addResults()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$con1=mysqli_connect('10.200.254.59','root','hubmodule123','vl_test_db');
	$json=array();
	
	if(isset($_REQUEST['locator_id'])){
     $locator_id = strip_html_tags(addslashes($_REQUEST['locator_id']));  
     $hubid = strip_html_tags(addslashes($_REQUEST['hubid'])); 
     $facilityid = strip_html_tags(addslashes($_REQUEST['facilityid'])); 
     $created_by = strip_html_tags(addslashes($_REQUEST['created_by']));
	 
	mysqli_query($con,"INSERT INTO results  set locator_id='$locator_id',hubid='$hubid',facilityid='$facilityid',created_by='$created_by',created_at=NOW(),delivered_at=NOW(),received_at=NOW() ")or die(mysqli_error($con));
		 
		 
		$id = mysqli_insert_id($con); // last inserted id 
		$sel=mysqli_query($con,"select * from results where id='$id' ")or die(mysqli_error($con));
		
		if(mysqli_num_rows($sel)){  

		//$con1=mysqli_connect('10.200.254.74','vldash',"$$vldash123$$",vl_production');
		$con1=mysqli_connect('10.200.254.59 3306','vluser','pa55w0rd5','vl_test_db');
		
		mysqli_query($con1, "UPDATE vl_results_dispatch SET received_at_facility = 1 , date_received_at_facility = NOW() WHERE sample_id = '$locator_id'")or die(mysqli_error($con1));
		 
		
		   while($row=mysqli_fetch_assoc($sel)){ 
           	   $json['id']=$row['id'];
                   $json['locator_id']=$row['locator_id']; 
                   $json['hubid']=$row['hubid'];
                   $json['facilityid']=$row['facilityid']; 
                   $json['created_by']=$row['created_by']; 
		   $json['created_at']=$row['created_at']; 
		   $json['delivered_at']=$row['delivered_at']; 
		   $json['received_at']=$row['received_at']; 
		   } 
		$json['status']='ok';
		}  
	 }else{
		 $json['status']= "missing";
		}
	echo json_encode($json); 
}
 
function updatevl_lodresults()
{
	$con1=mysqli_connect('10.200.254.59 3306','vluser','pa55w0rd5','vl_test_db');
	$json=array();

	if(isset($_REQUEST['sample_id'])){ 
	$sample_id = strip_html_tags(addslashes($_REQUEST['sample_id']));  
	$sel=mysqli_query($con1,"UPDATE vl_results_dispatch SET received_at_facility = 1 , date_received_at_facility = NOW() WHERE sample_id = '$sample_id';")or die(mysqli_error($con1)); 
		
	 if($sel){  	
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}

function BarEmergencyStatus()
{
	$con=mysqli_connect(HOST,USER,PASS,DB);
	$json=array();

	if(isset($_REQUEST['id'])){ 
	$id = strip_html_tags(addslashes($_REQUEST['id']));  
	$status = strip_html_tags(addslashes($_REQUEST['status'])); 
	$sel=mysqli_query($con,"UPDATE package p, packagemovement_events pe SET p.`status` = $status WHERE pe.package_id = p.id AND pe.package_id = $id;")or die(mysqli_error($con)); 
		
	 if($sel){  
		
		        $json['status']='ok';
		 }
		 else
		 {
		$json['status']='failed';
		 } 

	} 
	echo json_encode($json); 
}


?>