<div class="row" style="width:100%;">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12">
							 
		  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Available Drugs in the phamacy store</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" id="dispaly_search_drugs">
                <table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th><a href="#" title="This is the category of the drugs">CATEGORY</a></th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
					<th>GENERIC NAME</th>
					<th>STOCKED</th>
					<th>Used</th>
					<th>LEFT</th>
                    
					
                  </tr>
                 
					<?php
					$sn=1;
						//get all drug list
						include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM phamacy_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE d.drug_status='1'AND ms.status='1' ORDER BY d.drug_name");
						
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$drug_id=$GetDrugs['drug_id'];
									$size=$GetDrugs['size'];
									$drug_name=$GetDrugs['drug_name'];
									$generic_name=$GetDrugs['generic_name'];
									$drug_unit=$GetDrugs['drug_unit'];
									$category_id=$GetDrugs['category'];
									$manufacturer=$GetDrugs['manufacturer'];
									$description=$GetDrugs['description'];
									$drug_type=$GetDrugs['drug_type'];
									$pack_quantity=$GetDrugs['pack_quantity'];
									$peces_in_pack=$GetDrugs['peces_in_pack'];
									$peces_used=$GetDrugs['peces_used'];
									$drug_stocked_id=$GetDrugs['main_store_id'];
									
									$Totalstucked=$pack_quantity * $peces_in_pack;
									
								$totalQuantityUsed=0;
								//get drug used
							$sql_getDrugUsed=mysqli_query($con,"SELECT *FROM patient_drug WHERE drug_id='$drug_id' AND patient_drug_status='1'");
							if($sql_getDrugUsed){
								$sql_getDrugUsed_row=mysqli_num_rows($sql_getDrugUsed);
								if($sql_getDrugUsed_row > 0){
									while($DrugUsed=mysqli_fetch_array($sql_getDrugUsed)){
									$quantity=$DrugUsed['quantity'];
									$totalQuantityUsed=$totalQuantityUsed + $quantity;
								}
							}
							}
							
							$totalQuantityR=$Totalstucked-$totalQuantityUsed;
					
							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' ");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' ");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drug_type=$sqlgettype['type_name'];
								}
							}
							
							//get drug_size
							$sqlgetsize=mysqli_query($con,"SELECT *FROM drug_size WHERE id='$size' ");
							if($sqlgetsize){
								$sqlgetsize_row=mysqli_num_rows($sqlgetsize);
								if($sqlgetsize_row > 0){
									$sqlget_s=mysqli_fetch_array($sqlgetsize);
									$drug_size=$sqlget_s['size_name'];
								}
							}
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' ");
							if($sql_getmanufacturer){
								$sql_getmanufacturer_row=mysqli_num_rows($sql_getmanufacturer);
								if($sql_getmanufacturer_row > 0){
									$sqlgetmanufacturer=mysqli_fetch_array($sql_getmanufacturer);
									$manufacturer=$sqlgetmanufacturer['manufacturer_name'];
								}
							}
							
									echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$category.'</td>
					<td>'.$drug_name.'</td>
					<td>'.$drug_type.'</td>
					<td>'.$drug_size.'</td>
					<td>'.$generic_name.'</td>
					<td>'.$Totalstucked.'</td>
					<td>'.$totalQuantityUsed.'</td>
					<td>'.$totalQuantityR.'</td>
					
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
									$totalQuantityUsed="";
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
