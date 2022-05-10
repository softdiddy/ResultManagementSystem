<?php
		$patient_visit_id=$_POST['patient_visit_id'];
		$patientID=$_POST['patientID'];
		
		include_once('../includes/connection.php');
		$sql=mysqli_query($con,"UPDATE patient_visit SET file_position='0' WHERE patient_visit_id='$patient_visit_id'") or die(mysqli_error($con));
		
	
?>	

	