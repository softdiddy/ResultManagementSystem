<?php
	$request_id=$_POST['request_id'];
	$encounterID=$_POST['encounterID'];
	$patientID=$_POST['patientID'];
	
	
	
		include_once('../includes/connection.php');
		
		$sql_RemoveRequest=mysqli_query($con,"DELETE FROM patient_request WHERE encounterID='$encounterID' AND request_id='$request_id' AND patient_ID='$patientID'") or die(mysqli_error($con));
		
?>	

	