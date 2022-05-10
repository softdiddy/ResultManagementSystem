<?php
		$patient_visit_id=$_POST['patient_visit_id'];
		$date=date('d/M/Y');
		include_once('../includes/connection.php');
		
		$sql_DeleteDrugs=mysqli_query($con,"UPDATE patient_drug SET patient_drug_status='0' WHERE encounterID='$patient_visit_id'") or die(mysqli_error($con));
		if($sql_DeleteDrugs){
			echo'<div class="alert alert-success" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Updated Successfully</div>';	
		}
	
?>	

	