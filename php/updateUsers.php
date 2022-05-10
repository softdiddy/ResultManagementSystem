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


	$Username=$_POST['Username'];
	$fullname=$_POST['fullname'];
	$phonrNumber=$_POST['phonrNumber'];
	$email=$_POST['email'];
	$userType=$_POST['userType'];
	$user_ID=$_POST['user_ID'];
	
	$login=md5($phonrNumber);
	
	
	$sqlInsert=mysqli_query($con,"UPDATE tbl_admin SET login='$login',role='$userType',fullname='$fullname',phone_number='$phonrNumber',email='$email' WHERE id='$user_ID'") or die(mysqli_error($con));
	

?>