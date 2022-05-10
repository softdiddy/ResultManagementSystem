<?php
include_once('../includes/connection.php');
$student_id=$_POST['student_id'];
$patient_visit_id=$_POST['patient_visit_id'];

						$sql_get=mysqli_query($con,"SELECT *FROM patient_information  WHERE patientID = '$student_id'");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$student_id=$GetDrugs['patientID'];
									$number =$GetDrugs['patientNumber'];
									
									$email=$GetDrugs['patientEmail'];
									$phone_number=$GetDrugs['patientPhone'];
									
									$fullname=$GetDrugs['patientName'];
								}
							}
						}
						
						$sql_student_drug=mysqli_query($con,"SELECT *FROM patient_drug WHERE patient_id='$student_id' AND patient_drug_status ='1'");
						if($sql_student_drug){
							$sql_student_drug_row=mysqli_num_rows($sql_student_drug);
							if($sql_student_drug_row > 0){
								$rr=mysqli_fetch_array($sql_student_drug);
								$refid=$rr['refid'];
							}else{
								$r=$sql_student_drug_row + 1;
								$refid=$r.mt_rand(1000,9000);
							}
						}
						

						
?> 
 <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Student Search</h1><hr/>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	<div class="row">
		<div class="col-md-12">
			<div style="width:50%;float:right;"><input id="refid" disabled type="text" class="form-control col-md-12" value="<?php echo $refid; ?>"/></div>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-12">
			
			<div class="col-md-12" style="marging:0px;padding:0px;">
				 <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Matric Number: <span class="float-right badge bg-success"><?php echo $number; ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Student Name: <span class="float-right badge bg-success"><?php echo $fullname; ?></span>
                    </a>
                  </li>
                 
                </ul>
              </div>
			</div>
			<div class="col-md-12" style="marging:0px;padding:0px;">
				<input type="text" class="form-control col-md-12" id="txtSearch" placeholder="Search Drug" onkeyup="searchDrugForStudent(<?php echo $student_id,','.$patient_visit_id; ?>)">
				
			</div>
			<div class="col-md-12" id="StudentDrugs">
			<ul class="list-group">
				<?php
				$Price=0;
							$TPrice=0;
							$quantity_given=0;
							$pricePerUnit=0;
					//get student drugs
					$sql_get_student_drug=mysqli_query($con,"SELECT *FROM patient_drug sd INNER JOIN drugs d ON sd.drug_id=d.drug_id WHERE sd.patient_id='$student_id' AND sd.patient_drug_status='1'");
						
						if($sql_get_student_drug){
							$sql_get_student_drug_row=mysqli_num_rows($sql_get_student_drug);
							if($sql_get_student_drug_row > 0){
									while($Get=mysqli_fetch_array($sql_get_student_drug)){
									$student_drug_id=$Get['patient_drug_status'];
									$drug_id=$Get['drug_id'];
									$quantity_given=$Get['quantity'];
									$drug_name=$Get['drug_name'];
									$size=$Get['size'];
									$drug_type=$Get['drug_type'];
									$refid=$Get['refid'];
									
									//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drug_type=$sqlgettype['type_name'];
								}
							}
							
							//get drug_size
							$sqlgetsize=mysqli_query($con,"SELECT *FROM drug_size WHERE id='$size'");
							if($sqlgetsize){
								$sqlgetsize_row=mysqli_num_rows($sqlgetsize);
								if($sqlgetsize_row > 0){
									$sqlget_s=mysqli_fetch_array($sqlgetsize);
									$drug_size=$sqlget_s['size_name'];
								}
							}
							
									
								//get price of the drug
								$sql_DrugPrice=mysqli_query($con,"SELECT *FROM phamacy_store WHERE drug_id='$drug_id'");
							if($sql_DrugPrice){
								$sql_DrugPrice_row=mysqli_num_rows($sql_DrugPrice);
								if($sql_DrugPrice_row > 0){
									$sqlPrice=mysqli_fetch_array($sql_DrugPrice);
									$unit_pack_Price=$sqlPrice['unit_pack_Price'];
									$peces_in_pack=$sqlPrice['peces_in_pack'];
									
									$pricePerUnit=$unit_pack_Price/$peces_in_pack;
								}
							}
							
									$Price=$quantity_given * $pricePerUnit;
									

									
								echo '<li class="list-group-item">
									'.$drug_name.'('.$drug_size.') '.$drug_type.', '.$quantity_given.'Q  -N'.$Price.'  <b id="remove"><a onclick="removeStudentDrug('.$student_id.','.$drug_id.','.$refid.','.$student_drug_id.','.$patient_visit_id.')" href="#" style="color:red;font-size:12px;">Remove</a></b>
								</li>';
  
								$TPrice=$TPrice + $Price;
							}
								
							echo '<hr/><div style="width:100%;background-color:green;color:#fff;font-size:20px;"><b><center>N'.$TPrice.'</center></b></div>';
							$Price=0;
							$TPrice=0;
							$quantity_given=0;
							$pricePerUnit=0;
							echo'<hr/><a onclick="updateStudentDrug('.$student_id.','.$refid.','.$patient_visit_id.')" ref="#" class="btn btn-success">Update</a>
							<a onclick="viewPatientDetails_DV('.$student_id.','.$patient_visit_id.')" href="#" class="btn btn-info">Close</a>';
						}
					}
				?>
			</ul>
			</div>
		</div>
	</div>
	<div class="modal-footer" id="student_drugInfor" style="color:green">
        
      </div>