<?php

	$drug_id=$_POST['drug_id'];
	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];
	$student_matric=$_POST['student_matric'];
	$report ="List of Dispensed Drugs";
	
	
	if($drug_id !="" && $student_matric=="" && $start_date=="" && $end_date==""){
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
						$satetment="SELECT DISTINCT(refid) FROM student_drug WHERE drug_id='$drug_id'";
						$sql_get=mysqli_query($con,$satetment);
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$refid=$GetDrugs['refid'];
									
									
						
									//get total drugs
					$sqlGetTotalDrugse=mysqli_query($con,"SELECT *FROM student_drug WHERE refid='$refid' AND drug_id='$drug_id'");
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
					$sql_get_student_drug=mysqli_query($con,"SELECT *FROM student_drug sd INNER JOIN drugs d ON sd.drug_id=d.drug_id WHERE sd.student_id='$student_id' AND sd.student_drug_status='1' AND sd.refid='$refid' AND sd.drug_id='$drug_id'");
						
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
				
	
	}elseif($start_date !="" && $end_date !="" && $drug_id=="" && $student_matric==""){
		$TTPrice=0;
		echo $start_date;
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
						$satetment="SELECT DISTINCT(refid) FROM student_drug WHERE date_invoiced LIKE ".$start_date."% AND ".$end_date."%";
						$sql_get=mysqli_query($con,$satetment);
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
					$sql_get_student_drug=mysqli_query($con,"SELECT *FROM student_drug sd INNER JOIN drugs d ON sd.drug_id=d.drug_id WHERE sd.student_id='$student_id' AND sd.student_drug_status='1' AND sd.refid='$refid'");
						
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
	}elseif($student_matric !="" && $drug_id=="" && $start_date=="" && $end_date==""){
		//get student id
		include_once('../includes/connection.php');
		$sqlgetStudent=mysqli_query($con,"SELECT *FROM student_information  WHERE number = '$student_matric'");
						if($sqlgetStudent){
							$sqlgetStudent_row=mysqli_num_rows($sqlgetStudent);
							if($sqlgetStudent_row > 0){
								$GetStd=mysqli_fetch_array($sqlgetStudent);
									$student_id=$GetStd['student_id'];
									
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
						
						$satetment="SELECT DISTINCT(refid) FROM student_drug WHERE student_id='$student_id'";
						$sql_get=mysqli_query($con,$satetment);
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$refid=$GetDrugs['refid'];
									
									
						
									//get total drugs
					$sqlGetTotalDrugse=mysqli_query($con,"SELECT *FROM student_drug WHERE refid='$refid' AND student_id='$student_id'");
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
					$sql_get_student_drug=mysqli_query($con,"SELECT *FROM student_drug sd INNER JOIN drugs d ON sd.drug_id=d.drug_id WHERE sd.student_id='$student_id' AND sd.student_drug_status='1' AND sd.refid='$refid' AND sd.student_id='$student_id'");
						
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
								
							}
						}	
		
	}elseif($drug_id=="" && $student_matric=="" && $start_date=="" && $end_date==""){
	
	
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
						$satetment="SELECT DISTINCT(refid) FROM student_drug";
						$sql_get=mysqli_query($con,$satetment);
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
				
	}

?>