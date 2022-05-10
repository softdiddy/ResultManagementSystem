<?php
	$txtSearch=$_POST['txtSearch'];
	$student_id=$_POST['student_id'];
	$patient_visit_id=$_POST['patient_visit_id'];
	
	
?>
<table class="table table-striped" style="font-size:10px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th>CATEGORY</th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
                  
					<th></th>
					
                  </tr>
                 
					<?php
					$sn=1;
						//get all drug list
						$totalD=0;
						include_once('../includes/connection.php');
						if($txtSearch !=''){
							$sql="SELECT *FROM phamacy_store ps INNER JOIN drugs d ON ps.drug_id=d.drug_id WHERE d.drug_status='1' AND d.drug_name LIKE '%$txtSearch%' AND ps.status='1'";
						
						$sql_get=mysqli_query($con,$sql);
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
									$totalD=$pack_quantity * $peces_in_pack;
						

							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id'");
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
					$Trquantity=0;
						//chk if the drug is avalaible or not
						$sql_get_avalable_drug=mysqli_query($con,"SELECT *FROM patient_drug WHERE patient_drug_status='1' AND drug_id='$drug_id'");
						if($sql_get_avalable_drug){
							$sql_get_avalable_drug_row=mysqli_num_rows($sql_get_avalable_drug);
							if($sql_get_avalable_drug_row > 0){
								while($r=mysqli_fetch_array($sql_get_avalable_drug)){
									$rquantity=$r['quantity'];
									$Trquantity=$Trquantity + $rquantity;
								}
							}
						}
						
						if($Trquantity < $totalD){
							
							echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$category.'</td>
					<td>'.$drug_name.'</td>
					<td>'.$drug_type.'</td>
					<td>'.$drug_size.'</td>

					<td><a onclick="PickdrugForStudent('.$drug_id.','.$student_id.','.$patient_visit_id.')" href="#" style="color:green;">Pick</a></td>
					
                  </tr>
				  
				  
									';
									$sn=$sn + 1;
									$totalD=0;
						}			
									
									
								}
							}
						}
						}
					?>
                 
                  
                </table>