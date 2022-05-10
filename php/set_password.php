<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
	
        
	}else{
        header('location:index.php');
    }
	
    $staffIDD=$_POST['staffIDD'];

    $pwd=md5("123456");
    $sql_Update=mysqli_query($con,"UPDATE staff_biodata SET password='$pwd' WHERE id='$staffIDD'");