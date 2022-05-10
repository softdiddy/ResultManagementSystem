<?php
		$student_drug_id=$_POST['student_drug_id'];
		include_once('../includes/connection.php');
		$sql_DeleteDrugs=mysqli_query($con,"DELETE FROM student_drug WHERE student_drug_id='$student_drug_id'") or die(mysqli_error($con));
		
	
?>	

	