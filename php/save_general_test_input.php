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

   

	$resultValue=$_POST['resultValue'];
	$request_id=$_POST['request_id'];
	$patientID=$_POST['patientID'];
	$investi_category_id=$_POST['investi_category_id'];
	
	//chk if the record exist or not
		$sqlChk=$_POST['request_id'];
	 $sqlChk=mysqli_query($con,"SELECT *FROM patient_other_request_result WHERE request_id='$request_id' AND patient_id='$patientID' AND investigation_cat_details_id='$investi_category_id'")  or die(mysqli_error($con));;
        if($sqlChk){
            $sqlChkRow=mysqli_num_rows($sqlChk);
            if($sqlChkRow == 0){
                //insert
				$sql_insert=mysqli_query($con,"INSERT INTO patient_other_request_result(patient_id,request_id,investigation_cat_details_id,result) VALUES('$patientID','$request_id','$investi_category_id','$resultValue')") or die(mysqli_error($con));
				if($sql_insert){
					echo "Changes Saved Successfully";
					//$sqlUpdate=mysqli_query($con,"UPDATE patient_request SET patient_request_status='0' WHERE request_id='$request_id'") or die(mysqli_error($con));
				}
            }else{
				$sqlUpdate=mysqli_query($con,"UPDATE patient_other_request_result SET result='$resultValue' WHERE patient_id='$patientID' AND request_id='$request_id' AND investigation_cat_details_id='$investi_category_id'") or die(mysqli_error($con));
				if($sqlUpdate){
					echo "Changes Saved Successfully";
				}
		}
        }

?>