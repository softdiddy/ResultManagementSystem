<?php
	$drug_id=$_POST['drug_id'];
	$quantity=$_POST['quantity'];
	$unitPackPrice=$_POST['unitPackPrice'];
	$packQuantity=$_POST['packQuantity'];
	$expired_date=$_POST['expired_date'];
	
	
	if($quantity =="" || $unitPackPrice =="" || $packQuantity =="" || $expired_date ==""){
		echo'<div class="alert alert-danger" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Missing fields</div>';	
	}else{
		//add
		include_once('../includes/connection.php');
		
		$sql_addDrugs=mysqli_query($con,"INSERT INTO main_store(drug_id,pack_quantity,unit_pack_Price,peces_in_pack,expired_date) VALUES('$drug_id','$quantity','$unitPackPrice','$packQuantity','$expired_date')") or die(mysqli_error($con));
		if($sql_addDrugs){
			//chk if this drug is out of stock or not
			$sql_chkOutofStock=mysqli_query($con,"SELECT *FROM drug_out_of_main_stock WHERE drug_id='$drug_id'");
								if($sql_chkOutofStock){
									$sql_chkOutofStock_row=mysqli_num_rows($sql_chkOutofStock);
									if($sql_chkOutofStock_row > 0){
										$sql_addTophamacy_store=mysqli_query($con,"DELETE FROM drug_out_of_main_stock WHERE drug_id='$drug_id'");
									}
								}
			echo'<div class="alert alert-success" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>New record added successfully</div>';	
		}
	}
?>	

	