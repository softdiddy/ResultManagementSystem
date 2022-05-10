<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		
	}else{
        header('location:index.php');
    }

   
		$UserID=$_POST['UserID'];
		include_once('../includes/connection.php');
		$sql_DeleteDrugs=mysqli_query($con,"UPDATE staff_biodata SET password='' WHERE id='$UserID'") or die(mysqli_error($con));
		if($sql_DeleteDrugs){
			echo'<div class="alert alert-success" role="alert" style="top:20px;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>User Deleted Successfully</div>';	
		}

		//delete staff prev both menu and sub menu


		$sqlDelete=mysqli_query($con,"DELETE FROM staff_side_menu WHERE staff_id='$UserID'");
		$sqlDelete=mysqli_query($con,"DELETE FROM staff_side_sub_menu WHERE staff_id='$UserID'");
	
?>	

	