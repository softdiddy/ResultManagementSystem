<?php
	$drug_name=$_POST['drug_name'];
	$drug_category=$_POST['drug_category'];
	$drug_type=$_POST['drug_type'];
	$drug_size=$_POST['drug_size'];
	$generic_name=$_POST['generic_name'];
	$manufacturer=$_POST['manufacturer'];
	$description=$_POST['description'];
	$unit_pack=$_POST['unit_pack'];
	
	if($drug_name =="" || $drug_category =="" || $drug_type =="" || $drug_size =="" || $generic_name =="" || $manufacturer =="" || $description =="" || $unit_pack ==""){
		echo'<div class="alert alert-danger" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Missing fields</div>';	
	}else{
		//add
		include_once('../includes/connection.php');
		
		$sql_addDrugs=mysqli_query($con,"INSERT INTO drugs(drug_name,category,drug_type,size,generic_name,manufacturer,description,drug_unit) VALUES('$drug_name','$drug_category','$drug_type','$drug_size','$generic_name','$manufacturer','$description','$unit_pack')") or die(mysqli_error($con));
		if($sql_addDrugs){
			
			echo'<div class="alert alert-success" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>New drug has been added Successfully</div>';	
		}
	}
?>	

	