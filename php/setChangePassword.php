<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
	
        
	}else{
        header('location:index.php');
    }
	
    $old_pass=md5($_POST['old_pass']);
    $new_pass1=md5($_POST['new_pass1']);
   
    $sql_profile=mysqli_query($con,"SELECT * FROM staff_biodata WHERE password='$old_pass' AND id='$phamacy_user_id'");
    if($sql_profile){
        $row=mysqli_fetch_assoc($sql_profile);
		if($row > 0){
    $sql_Update=mysqli_query($con,"UPDATE staff_biodata SET password='$new_pass1' WHERE id='$phamacy_user_id'");
     if($sql_Update){
        echo "Password Changed Successfully";
     }
}else{
            echo "Invalid Entry";
        }
    }