<?php
		$drug_id=$_POST['drug_id'];
		include_once('../includes/connection.php');
		$sql_DeleteDrugs=mysqli_query($con,"UPDATE drugs SET drug_status='0' WHERE drug_id='$drug_id'") or die(mysqli_error($con));
		if($sql_DeleteDrugs){
			echo'<div class="alert alert-success" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Drug Deleted Successfully</div>';	
		}
	
?>	

	