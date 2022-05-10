	
	
<?php
include_once('../includes/connection.php');
	$report=$_POST['report'];
	
	if($report=="Drug List"){
		//get Drug List
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		echo'<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th><a href="#" title="This is the category of the drugs">CATEGORY</a></th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
					<th>GENERIC NAME</th>
					<th>MANUFACTURER</th>
                    <th>UNIT PACK</th>
					
                  </tr>';
					$sn=1;
						//get all drug list
						
						$sql_get=mysqli_query($con,"SELECT *FROM drugs WHERE drug_status='1' ORDER BY drug_id  DESC");
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
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
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
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' AND status='1'");
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
					<td>'.$manufacturer.'</td>
					<td>'.$drug_unit.'</td>
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
								}
							}
						}
					
                 
                  
                echo'</table>';
	}elseif($report=="Drug Available in Main Store"){
		include_once('../includes/connection.php');
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		echo'<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th><a href="#" title="This is the category of the drugs">CATEGORY</a></th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
					<th>GENERIC NAME</th>
					<th>MANUFACTURER</th>
					<th>UNIT PACK</th>
					 	
					
                  </tr';
                 
					
					$sn=1;
						//get all drug list
						
						$sql_get=mysqli_query($con,"SELECT *FROM main_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE d.drug_status='1'AND ms.status='1' ORDER BY d.drug_name");
						
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
									
									$peacesRemaining=$pack_quantity - $peces_used;
						

							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
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
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' AND status='1'");
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
					<td>'.$manufacturer.'</td>
					<td>'.$drug_unit.'</td>
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
								}
							}
						}
					
                 
                  
                echo'</table>';
	}elseif($report=="Drug Available in Phamacy Store"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		 echo '<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th><a href="#" title="This is the category of the drugs">CATEGORY</a></th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
					<th>GENERIC NAME</th>
					<th>MANUFACTURER</th>
					<th>UNIT PACK</th>
					 
                  </tr>';
                 
				
					$sn=1;
						//get all drug list
						
						$sql_get=mysqli_query($con,"SELECT *FROM phamacy_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE d.drug_status='1' AND ms.status='1' ORDER BY d.drug_name") or die(mysqli_error($con));
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
							$sql_getDrugUsed=mysqli_query($con,"SELECT *FROM student_drug WHERE drug_id='$drug_id' AND student_drug_status='1'");
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
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
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
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' AND status='1'");
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
					<td>'.$manufacturer.'</td>
					<td>'.$drug_unit.'</td>
					
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
									$totalQuantityUsed="";
								}
							}
						}
				
                  
               echo'</table>';
	}elseif($report=="Manufacturer List"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		 echo '<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>MANUFACTURER NAME</th>
					<th>DESCRIPTION</th>
					
                  </tr>';
                 
				
					$sn=1;
						//get all drug list
						
						$sql_get=mysqli_query($con,"SELECT *FROM manufacturer") or die(mysqli_error($con));
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									
									$manufacturer_name=$GetDrugs['manufacturer_name'];
									$description=$GetDrugs['description'];
									
									echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$manufacturer_name.'</td>
					<td>'.$description.'</td>
					
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
									
								}
							}
						}
				
                  
               echo'</table>';
	}elseif($report=="Supplier List"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		 echo '<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>NAME</th>
					<th>ADDRESS</th>
					<th>CONTACT</th>
					
                  </tr>';
                 
				
					$sn=1;
						//get all drug list
						
						$sql_get=mysqli_query($con,"SELECT *FROM suppliers") or die(mysqli_error($con));
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									
									$name=$GetDrugs['name'];
									$address=$GetDrugs['address'];
									$telephone=$GetDrugs['telephone'];
									
									echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$name.'</td>
					<td>'.$address.'</td>
					<td>'.$telephone.'</td>
					
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
									
								}
							}
						}
				
                  
               echo'</table>';
	}
	elseif($report=="Drug Usege Information"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		echo'<div class="col-md-12">';
	
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
							$p=($TotalUsedofDrug/$sqlgetIssued_row) * 100;
							
							$mostUsed .=' <a href="#" onclick="getAllperOfDrugs()"><div class="progress-group">
                      '.$drug_name.'
                      <span class="float-right"></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: '.$p.'%"></div>
                      </div>
                    </div></a>';
								}
							}
						}
	
						}



	echo'<div class="col-md-12">
		'.$mostUsed.'
		
	</div>
</div>';
	}elseif($report=="Out of Stock in Main Store"){
		$c=1;
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		echo'<table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>Drug Name</th>
                    <th>Category</th>
					<th>Formulation</th>
                    <th>Strength</th>
                  </tr>';
                  $sql_get=mysqli_query($con,"SELECT *FROM drug_out_of_main_stock ms INNER JOIN drugs d ON ms.drug_id=d.drug_id");
						
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
									//$pack_quantity=$GetDrugs['pack_quantity'];
									//$peces_in_pack=$GetDrugs['peces_in_pack'];
									//$peces_used=$GetDrugs['peces_used'];
							
							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' AND status='1'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drugtype=$sqlgettype['type_name'];
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
									
					echo'
									<tr>
                    <td>'.$c.'</td>
                    <td>'.$drug_name.'</td>
                    <td>'.$category.'</td>
                    <td>'.$drugtype.'</td>
					<td>'.$drug_size.'</td>
                  </tr>
				  
				  
										';
										$c=$c+1;
									
								}
							}
	}
				 echo'</table>';
	}elseif($report=="Out of Stock in Phamacy Store"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		$c=1;
		echo'<table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>Drug Name</th>
                    <th>Category</th>
					<th>Formulation</th>
                    <th>Strength</th>
                  </tr>';
                  $sql_get=mysqli_query($con,"SELECT *FROM drug_out_of_phamacy_stock ms INNER JOIN drugs d ON ms.drug_id=d.drug_id");
						
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
									//$pack_quantity=$GetDrugs['pack_quantity'];
									//$peces_in_pack=$GetDrugs['peces_in_pack'];
									//$peces_used=$GetDrugs['peces_used'];
							
							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' AND status='1'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drugtype=$sqlgettype['type_name'];
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
									
					echo'
									<tr>
                    <td>'.$c.'</td>
                    <td>'.$drug_name.'</td>
                    <td>'.$category.'</td>
                    <td>'.$drugtype.'</td>
					<td>'.$drug_size.'</td>
                  </tr>
				  
				  
										';
										$c=$c+1;
									
								}
							}
	}
				 echo'</table>';
	}elseif($report=="Expaired Drugs in the Main store"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		$c=1;
		echo'<table class="table">
		<tr>
                    <th>SN</th>
					<th>DRUG NAME</th>
					<th>CATEGORY</th>
					<th>FORMULATION</th>
					<th>STRENGTH</th>
                    
         </tr>';
		$sql_get=mysqli_query($con,"SELECT *FROM main_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE ms.status='2'");
						
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
									$status=$GetDrugs['status'];
									$unit_pack_Price=$GetDrugs['unit_pack_Price'];
									
									
									
									//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' AND status='1'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drugtype=$sqlgettype['type_name'];
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
							
							
							
								
				echo'<tr>
                    <td>'.$c.'</td>
                    <td>'.$drug_name.'</td>
                    <td>'.$category.'</td>
                    <td>'.$drugtype.'</td>
					<td>'.$drug_size.'</td>
                  </tr>
				  
				  
										';
										$c=$c+1;
									
								}
							}
						}
			echo'</table>';
	}elseif($report=="Expaired Drugs in the Phamacy store"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		$c=1;
		echo'<table class="table">
		<tr>
                    <th>SN</th>
					<th>DRUG NAME</th>
					<th>CATEGORY</th>
					<th>FORMULATION</th>
					<th>STRENGTH</th>
					<th></th>
                    
         </tr>';
		$sql_get=mysqli_query($con,"SELECT *FROM phamacy_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE ms.status='2'");
						
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
									$status=$GetDrugs['status'];
									$unit_pack_Price=$GetDrugs['unit_pack_Price'];
									
									
									
									//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' AND status='1'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drugtype=$sqlgettype['type_name'];
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
							
							
							
								
				echo'<tr>
                    <td>'.$c.'</td>
                    <td>'.$drug_name.'</td>
                    <td>'.$category.'</td>
                    <td>'.$drugtype.'</td>
					<td>'.$drug_size.'</td>
                  </tr>
				  
				  
										';
										$c=$c+1;
									
								}
							}
						}
			echo'</table>';
	}elseif($report=="Re-Order List"){
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		echo '<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th><a href="#" title="This is the category of the drugs">CATEGORY</a></th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
					<th>GENERIC NAME</th>
					<th>MANUFACTURER</th>
					<th>UNIT PACK</th>
					<th>QUANTITY NEEDED</th>
					 
                  </tr>';
                 
				
					$sn=1;
						//get all drug list
						
						$sql_get=mysqli_query($con,"SELECT *FROM re_order_level ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE d.drug_status='1' AND ms.status='1' ORDER BY d.drug_name") or die(mysqli_error($con));
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
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
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
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' AND status='1'");
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
					<td>'.$manufacturer.'</td>
					<td>'.$drug_unit.'</td>
					<td></td>
					
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
									$totalQuantityUsed="";
								}
							}
						}
				
                  
               echo'</table>';
	}elseif($report=="Unverify Despenced Drugs"){
		$TTPrice=0;
		echo'<center><img src="images/ibbulogo.jpeg" width="10%"></center>
	<center><h5>IBRAHIM BADAMASI BABANGIDA UNIVERSITY, LAPAI</h5></center>
	<center><h5>'.$report.'</h5></center>';
		echo'<table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>Invoice Number</th>
					<th>Matric Number</th>
					<th>Name</th>
					<th>Total Drugd</th>
					 <th>Invoice Date</th>
					 <th>List of Drugs</th>
					
                  </tr>';
                 
					
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
					 $s=1;
						echo'<table>
							<tr>
								<td>SN</td>
								<td>Drug Name</td>
								<td>Formulation</td>
								<td>Strength</td>
								<td>Price</td>
							</tr>';
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
									
								echo'<tr>
								<td>'.$s.'</td>
								<td>'.$drug_name.'</td>
								<td>'.$drug_type.'</td>
								<td>'.$drug_size.'</td>
								<td>N'.$Price.'</td>
							</tr>';
									
								
								$TPrice=$TPrice + $Price;
								$s=$s+1;
							}
								
							
							$Price=0;
							
							$quantity_given=0;
							$pricePerUnit=0;
							
							
						}
					}
							
						echo'</table>
						
							<table>
								<tr>
									<td>N'.$TPrice.'</td>
								</tr>
							</table>';
						
					$TTPrice=$TTPrice + $TPrice;
					 $TPrice=0;
					 echo'</td>
					 
                  </tr>';
				  $sn=$sn+1;
				  $TotalDrugse=0;
				  $totalCost=0;
								}
							}
						}
					
                 
                  
                echo'</table>';
				echo'<table class="table" width="100%">
					<tr>
						<td>N'.$TTPrice.'</td>
					</tr>
				</table>';
	}elseif($report=="All Despenced Drugs"){
		echo'<div class="col-md-6">
			<div class="form-group">
    <label for="exampleInputEmail1">By Student : Student Matric Number</label>
    <input type="email" class="form-control" id="student_matric">
  </div>
	<div class="col-md-12">
		<div class="col-md-6">
		<div class="form-group">
    <label for="exampleInputPassword1">Start Date</label>
		<input type="date" class="form-control" id="start_date">
  </div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
    <label for="exampleInputPassword1">End Date</label>
		<input type="date" class="form-control" id="end_date">
  </div>
		</div>
	</div>
 <div class="form-group">
    <label for="exampleInputEmail1">By Drug</label>
   <select class="form-control" id="drug_id">
		<option></option>';
		
						$sql_get=mysqli_query($con,"SELECT *FROM drugs WHERE drug_status='1' ORDER BY drug_name");
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
									
									echo '<option value="'.$drug_id.'">'.$drug_name.'</option>';
								}
							}
						}
   echo'</select>
  </div>
  
  <button onclick="Search_report()" class="btn btn-default">Submit</button>
		</div>
		<div id="displayResult"></div>';
	}
?>