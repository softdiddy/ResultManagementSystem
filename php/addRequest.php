<?php
	$request_id=$_POST['request_id'];
	$encounterID=$_POST['encounterID'];
	$patientID=$_POST['patientID'];
	
		include_once('../includes/connection.php');
		
		$sql_addRequest=mysqli_query($con,"INSERT INTO patient_request(encounterID,request_id,patient_ID) VALUES('$encounterID','$request_id','$patientID')") or die(mysqli_error($con));
		
?>	

	