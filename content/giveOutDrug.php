<?php
	$patient_visit_id=$_POST['patient_visit_id'];
	$patientID=$_POST['patientID'];

?>

<div class="col-md-12" id="search">

<div style="width:100%">
	
</div>
<table class="table table-striped" style="font-size:10px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th>Matric Number</th>
                    <th>Fullname</th>
					
					<th></th>
					
                  </tr>
                 
					<?php
					$sn=1;
						//get all drug list
						include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM patient_information  WHERE status='1' AND patientID= '$patientID%'");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$student_id=$GetDrugs['patientID'];
									$number =$GetDrugs['patientNumber'];
									
									$email=$GetDrugs['patientEmail'];
									$phone_number=$GetDrugs['patientPhone'];
									
									$fullname=$GetDrugs['patientName'];
						

							
							
							
							
							
									echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$number.'</td>
					<td>'.$fullname.'</td>
					
					<td><a onclick="Pickstudent('.$student_id.','.$patient_visit_id.')" href="#" style="color:green;">Ok</a></td>
					
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
								}
							}
						}
					?>
                 
                  
                </table>
</div>


