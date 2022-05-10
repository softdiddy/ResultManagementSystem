<?php
include_once('../includes/connection.php');
		
	$drug_id=$_POST['drug_id'];
	$student_id=$_POST['student_id'];
	$refid=$_POST['refid'];
	$drug_quantity=$_POST['drug_quantity'];
	$patient_visit_id=$_POST['patient_visit_id'];
	
	
	if($drug_quantity ==""){
		echo'<div class="alert alert-danger" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Missing fields</div>';	
	}else{
		//chk the remaining drug
		$sql_get=mysqli_query($con,"SELECT *FROM phamacy_store WHERE drug_id='$drug_id'");
						
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								$GetDrugs=mysqli_fetch_array($sql_get);
									$drug_id=$GetDrugs['drug_id'];
									$pack_quantity=$GetDrugs['pack_quantity'];
									$peces_in_pack=$GetDrugs['peces_in_pack'];
									$totalP=$pack_quantity * $peces_in_pack;
									
							}
						}
						
		$Tquantity=0;
		$sql_get_student_drug=mysqli_query($con,"SELECT *FROM patient_drug WHERE drug_id='$drug_id'");
						
						if($sql_get_student_drug){
							$sql_get_student_drug_row=mysqli_num_rows($sql_get_student_drug);
							if($sql_get_student_drug_row > 0){
									while($Get=mysqli_fetch_array($sql_get_student_drug)){
									$drug_id=$Get['drug_id'];
									$quantity=$Get['quantity'];
									
									$Tquantity=$Tquantity + $quantity;
									
							}
						}
					}
					
					$rm=$totalP - $Tquantity;
					
					if($rm >= $drug_quantity){
						//insert
					
						$sql_insert=mysqli_query($con,"INSERT INTO patient_drug(drug_id,patient_id,quantity,refid,encounterID) VALUES('$drug_id','$student_id','$drug_quantity','$refid','$patient_visit_id')");
						if($sql_insert){
							echo "Record Add Successfully";
						}
						
					}else{
						echo "Invalid Quantity";
					}
	}
?>	

	