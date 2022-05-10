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
	
	$p=md5($phonrNumber);
	//chk if the user exist
	 $sqlCHKUN=mysqli_query($con,"SELECT *FROM tbl_admin WHERE login_user='$Username'");
        if($sqlCHKUN){
            $sqlCHKUNRow=mysqli_num_rows($sqlCHKUN);
            if($sqlCHKUNRow > 0){
				echo "Username already exist";
			}else{
				$sqlCHKP=mysqli_query($con,"SELECT *FROM tbl_admin WHERE phone_number='$phonrNumber'");
        if($sqlCHKP){
            $sqlCHKPRow=mysqli_num_rows($sqlCHKP);
            if($sqlCHKPRow > 0){
				echo "Phone Number already exist";
			}else{
				$sqlCHKemail=mysqli_query($con,"SELECT *FROM tbl_admin WHERE email='$email'");
        if($sqlCHKemail){
            $sqlCHKemailRow=mysqli_num_rows($sqlCHKemail);
            if($sqlCHKemailRow > 0){
				echo "Email Number already exist";
			}else{
				//
					$sqlInsert=mysqli_query($con,"INSERT INTO tbl_admin(login_user,login,role,fullname,phone_number,email) VALUES('$Username','$p','$userType','$fullname','$phonrNumber','$email')") or die(mysqli_error($con));
			}
		}
			}
		}
			}
		}
	

?>