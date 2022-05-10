<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		//get staff type
		 $sql_login=mysqli_query($con,"SELECT *FROM tbl_admin WHERE id='$phamacy_user_id'");
        if($sql_login){
            $sql_login_row=mysqli_num_rows($sql_login);
            if($sql_login_row > 0){
                //get user id
                $get_data=mysqli_fetch_array($sql_login);
                $user_id=$get_data['id'];  
				$role=$get_data['role'];  
            }
        }
	}else{
        header('location:index.php');
    }


	$patientID=$_POST['patientID'];
	$request_id=$_POST['request_id'];
	$encounterID=$_POST['encounterID'];
	
	$sqlUpdate=mysqli_query($con,"UPDATE patient_request SET patient_request_status='0' WHERE request_id='$request_id' AND patient_ID='$patientID' AND encounterID='$encounterID'") or die(mysqli_error($con));
?>