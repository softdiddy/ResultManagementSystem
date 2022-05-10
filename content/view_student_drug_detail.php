<?php
include_once('../includes/connection.php');

$refid=$_POST['refid'];

$sqlGetTotalDrugse=mysqli_query($con,"SELECT *FROM student_drug WHERE refid='$refid'");
							if($sqlGetTotalDrugse){
								$TotalDrugse=mysqli_num_rows($sqlGetTotalDrugse);
								if($TotalDrugse > 0){
									while($r=mysqli_fetch_array($sqlGetTotalDrugse)){
										$drug_id=$r['drug_id'];
										$date_invoiced=$r['date_invoiced'];
										$student_id=$r['student_id'];
										$verification_status=$r['verification_status'];
										$quantity=$r['quantity'];
										
										//get drug cost
					$sql_getCost=mysqli_query($con,"SELECT *FROM phamacy_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id");
						if($sql_getCost){
							$sql_getCost_row=mysqli_num_rows($sql_getCost);
							if($sql_getCost_row > 0){
								$GetDrugsc=mysqli_fetch_array($sql_getCost);
									$unit_pack_Price=$GetDrugsc['unit_pack_Price'];
								}
							}
							
									}
								}
							}

						$sql_get=mysqli_query($con,"SELECT *FROM student_information  WHERE student_id = '$student_id'");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$student_id=$GetDrugs['student_id'];
									$number =$GetDrugs['number'];
									$first_name=$GetDrugs['first_name'];
									$other_name=$GetDrugs['other_name'];
									$email=$GetDrugs['email'];
									$phone_number=$GetDrugs['phone_number'];
									$programme_id=$GetDrugs['programme_id'];
									
									$fullname=$first_name.' '.$other_name;
								}
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
			<div style="width:50%;float:right;">Ref. ID:<input id="refid" disabled type="text" class="form-control col-md-12" value="<?php echo $refid; ?>"/></div>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-12">
			
			<div class="col-md-12" style="marging:0px;padding:0px;">
				 <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Name: <span class="float-right badge bg-success"><?php echo $number; ?></span>
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
			<div class="col-md-12" id="StudentDrugs">
			<ul class="list-group">
				<?php
				$Price=0;
							$TPrice=0;
							$quantity_given=0;
							$pricePerUnit=0;
					//get student drugs
					$sql_get_student_drug=mysqli_query($con,"SELECT *FROM student_drug sd INNER JOIN drugs d ON sd.drug_id=d.drug_id WHERE sd.student_id='$student_id' AND sd.student_drug_status='1' AND refid='$refid'");
						
						if($sql_get_student_drug){
							$sql_get_student_drug_row=mysqli_num_rows($sql_get_student_drug);
							if($sql_get_student_drug_row > 0){
									while($Get=mysqli_fetch_array($sql_get_student_drug)){
									$student_drug_id=$Get['student_drug_id'];
									$drug_id=$Get['drug_id'];
									$quantity_given=$Get['quantity'];
									$drug_name=$Get['drug_name'];
									$size=$Get['size'];
									$drug_type=$Get['drug_type'];
									$refid=$Get['refid'];
									
									//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' AND status='1'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drug_type=$sqlgettype['type_name'];
								}
							}
							
							//get drug_size
							$sqlgetsize=mysqli_query($con,"SELECT *FROM drug_size WHERE id='$size' AND status='1'");
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
									'.$drug_name.'('.$drug_size.') '.$drug_type.', '.$quantity_given.'Q  -N'.$Price.'  
								</li>';
  
								$TPrice=$TPrice + $Price;
							}
								
							echo '<hr/><div style="width:100%;background-color:green;color:#fff;font-size:20px;"><b><center>N'.$TPrice.'</center></b></div>';
							$Price=0;
							$TPrice=0;
							$quantity_given=0;
							$pricePerUnit=0;
							
							
						}
					}
				?>
			</ul>
			</div>
		</div>
	</div>
	<div class="modal-footer" id="student_drugInfor" style="color:green">
        
      </div>