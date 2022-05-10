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


	$UserID=$_POST['UserID'];
	$side_sub_menu_id=$_POST['side_sub_menu_id'];
	$side_menu_id=$_POST['side_menu_id'];
	
	//chk if the staff has been assign menu b4 or not
	$sqlChk=mysqli_query($con,"SELECT *FROM staff_side_menu WHERE side_menu_id='$side_menu_id' AND staff_id='$UserID'") or die(mysqli_error($con));
	if($sqlChk){
		$sqlChkRow=mysqli_num_rows($sqlChk);
		if($sqlChkRow == 0){
			$sqlInsert=mysqli_query($con,"INSERT INTO staff_side_menu(staff_id,side_menu_id) VALUES('$UserID','$side_menu_id')") or die(mysqli_error($con));
		}
	}
	
	
	//chk if the staff has been assign sub menu b4 or not
	$sqlChk=mysqli_query($con,"SELECT *FROM staff_side_sub_menu WHERE side_sub_menu_id='$side_sub_menu_id' AND staff_id='$UserID'") or die(mysqli_error($con));
	if($sqlChk){
		$sqlChkRow=mysqli_num_rows($sqlChk);
		if($sqlChkRow == 0){
			$sqlInsert=mysqli_query($con,"INSERT INTO staff_side_sub_menu(staff_id,side_sub_menu_id) VALUES('$UserID','$side_sub_menu_id')") or die(mysqli_error($con));
		}
	}
	

?>