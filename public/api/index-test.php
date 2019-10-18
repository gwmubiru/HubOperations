<?php
	/*define("HOST", "10.200.254.74 3306");
	define("USER", "vldash");
	define("PASS", "$$vldash123$$");
	define("DB", "vl_production");*/
	
	$con=mysqli_connect('10.200.254.59 3306','vluser','pa55w0rd5','vl_test_db'); 
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }else{
		  echo 'connected successfully';
	}
?>