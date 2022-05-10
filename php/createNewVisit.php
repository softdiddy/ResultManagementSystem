<?php
	session_start();
	require_once '../includes/connection.php';
	if(isset($_SESSION['phamacy_user_id'])){
		$user_id=$_SESSION['phamacy_user_id'];
		$patientID=$_POST['token'];
		$visit_date_time=date('d/m/Y');
		
		$sql_newVisit=mysqli_query($con,"INSERT INTO patient_visit(patient_id,visit_date_time,status) VALUES('$patientID','$visit_date_time','0')");
		if($sql_newVisit){
			echo "Operation completed successfully";
			
$sqlGetVisit=mysqli_query($con,"SELECT *FROM patient_visit WHERE status='0' AND patient_id='$patientID' AND file_position='1'");
if($sqlGetVisit){
    $sqlGetVisitRow=mysqli_num_rows($sqlGetVisit);
    if($sqlGetVisitRow > 0){
   $rowVisit=mysqli_fetch_array($sqlGetVisit);
        $patient_visit_id=$rowVisit['patient_visit_id'];
		
		$sqlInsert=mysqli_query($con,"INSERT INTO patient_visit_details(patient_visit_id,status) VALUES('$patient_visit_id','1')");
	}
}
		
		
		}
	}else{
		die();
	}
?>

 