<div class="row" style="width:100%;">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12">
							 
		  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Verification</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" id="dispaly_search_drugs">
                <table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>Invoice Number</th>
					<th>Matric Number</th>
					<th>Name</th>
					<th>Total Drugd</th>
					 <th>Invoice Date</th>
					 <th>Verification Status</th>
					 <th></th>
					
                  </tr>
                 
					<?php
					$sn=1;
					$totalCost=0;	
						$T=0;
						$unitPrice=0;
						//get all drug list
						include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT DISTINCT(refid) FROM student_drug");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$refid=$GetDrugs['refid'];
									
									
						
									//get total drugs
					$sqlGetTotalDrugse=mysqli_query($con,"SELECT *FROM student_drug WHERE refid='$refid'");
							if($sqlGetTotalDrugse){
								$TotalDrugse=mysqli_num_rows($sqlGetTotalDrugse);
								if($TotalDrugse > 0){
									$r=mysqli_fetch_array($sqlGetTotalDrugse);
										$drug_id=$r['drug_id'];
										$date_invoiced=$r['date_invoiced'];
										$verification_status=$r['verification_status'];
										$student_id=$r['student_id'];
									
										
									}
								}
							
							
						//get Student	
						$sqlgetStudent=mysqli_query($con,"SELECT *FROM student_information  WHERE student_id = '$student_id'");
						if($sqlgetStudent){
							$sqlgetStudent_row=mysqli_num_rows($sqlgetStudent);
							if($sqlgetStudent_row > 0){
								$GetStd=mysqli_fetch_array($sqlgetStudent);
									$student_id=$GetStd['student_id'];
									$number =$GetStd['number'];
									$first_name=$GetStd['first_name'];
									$other_name=$GetStd['other_name'];
									$email=$GetStd['email'];
									$phone_number=$GetStd['phone_number'];
									$programme_id=$GetStd['programme_id'];
									
									$fullname=$first_name.' '.$other_name;
								
							}
						}	
							
								
							echo'			<tr>
                    <td style="width: 10px">'.$sn.'</td>
					<td>'.$refid.'</td>
                    <td>'.$number.'</td>
					<td>'.$fullname.'</td>
					
					<td>'.$TotalDrugse.'</td>
					 
					 <td>'.$date_invoiced.'</td>
					 <td>';
						if($verification_status==1){
							echo '<b style="color:green;">Verified</b>';
						}else{
							echo '<b style="color:red;">Not Verified</b>';
						}
					 
					 echo'</td>
					  <td><a href="#" onclick="view_student_drug_detail('.$refid.')">View Details</a></td>
					
                  </tr>';
				  $sn=$sn+1;
				  $TotalDrugse=0;
				  $totalCost=0;
								}
							}
						}
					?>
                 
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
     	 

                 
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
		
 </div>
