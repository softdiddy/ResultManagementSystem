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

   

	$investigation=$_POST['investigation'];
	$sample=$_POST['sample'];
	$sensitiveTo=$_POST['sensitiveTo'];
	$resistantTo=$_POST['resistantTo'];
	$lab_note=$_POST['lab_note'];
	$patientID=$_POST['patientID'];
	$request_id=$_POST['request_id'];
	$encounterID=$_POST['encounterID'];
	
	//chk if the record exist or not
		$sqlChk=$_POST['request_id'];
	 $sqlChk=mysqli_query($con,"SELECT *FROM microbiology_request_investigation WHERE request_id='$request_id' AND patientID='$patientID'");
        if($sqlChk){
            $sqlChkRow=mysqli_num_rows($sqlChk);
            if($sqlChkRow == 0){
                //insert
				$sql_insert=mysqli_query($con,"INSERT INTO microbiology_request_investigation(request_id,nature_of_sample,investigation,sensitive_to,resistance_to,medical_lab_note,patientID) VALUES('$request_id','$sample','$investigation','$sensitiveTo','$resistantTo','$lab_note','$patientID')") or die(mysqli_error($con));
				if($sql_insert){
					echo "Record Saved Successfully";
					$sqlUpdate=mysqli_query($con,"UPDATE patient_request SET patient_request_status='0' WHERE request_id='$request_id' AND patient_ID='$patientID' AND encounterID='$encounterID'") or die(mysqli_error($con));
				}
            }
        }

?>