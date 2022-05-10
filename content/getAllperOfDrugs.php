<?php
	error_reporting(0);
?>
<div class="col-md-12">
	<p>Drug Usage Information</p><hr/>
<?php

	include_once('../includes/connection.php');
	//get how many time drugs are issued
					$sqlgetIssued=mysqli_query($con,"SELECT *FROM student_drug");
						if($sqlgetIssued){
							$sqlgetIssued_row=mysqli_num_rows($sqlgetIssued);
						}
						
						$mostUsed="";
	
	
	//get how drugs are used
	$sql_get=mysqli_query($con,"SELECT DISTINCT(drug_id) FROM phamacy_store");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$drugid=$GetDrugs['drug_id'];
									
									//get drug name
						$sql_getDrugName=mysqli_query($con,"SELECT *FROM drugs WHERE drug_id='$drugid'");
						if($sql_getDrugName){
							$sql_getDrugName_row=mysqli_num_rows($sql_getDrugName);
							if($sql_getDrugName_row > 0){
									$GetDrugs=mysqli_fetch_array($sql_getDrugName);
									$drug_name=$GetDrugs['drug_name'];
							}
									
									
									
					$sqlget=mysqli_query($con,"SELECT *FROM student_drug WHERE drug_id='$drugid'");
						if($sqlget){
							$sqlget_row=mysqli_num_rows($sqlget);
							if($sqlget_row > 0){
								$Get=mysqli_fetch_array($sqlget);
									$drug_id=$Get['drug_id'];
									$drug_id=$Get['drug_id'];
									
							}
						}
						
							$TotalUsedofDrug=$sqlget_row;
							$p=round(($TotalUsedofDrug/$sqlgetIssued_row) * 100);
							
							$mostUsed .=' <a href="#" onclick="getAllperOfDrugs()"><div class="progress-group">
                      '.$drug_name.'  '.$p.'%
                      <span class="float-right"></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: '.$p.'%"></div>
                      </div>
                    </div></a>';
								}
							}
						}
	
						}


?>

	<div class="col-md-12">
		<?php
			echo $mostUsed;
		?>
	</div>
</div>