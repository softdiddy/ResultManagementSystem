<?php
	$txtSearch=$_POST['txtSearch'];

?>
<table class="table table-striped" style="font-size:10px;">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
                    <th>UNIT PACK</th>
					<th></th>
					
                  </tr>
                 
					<?php
					$sn=1;
						//get all drug list
						include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM drugs WHERE drug_status='1' AND drug_name LIKE '%$txtSearch%'");
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
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer'");
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
                    
					<td>'.$drug_name.'</td>
					<td>'.$drug_type.'</td>
					<td>'.$drug_size.'</td>
					
					<td>'.$drug_unit.'</td>
					<td><a onclick="Pickdrug('.$drug_id.')" href="#" style="color:red;">Add</a></td>
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
								}
							}
						}
					?>
                 
                  
                </table>