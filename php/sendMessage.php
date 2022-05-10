<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
	
        
	}else{
        header('location:index.php');
    }
	
    $msg=$_POST['msg'];
    $staff_IDD=$_POST['staff_IDD'];
    $student_id=$_POST['student_id'];
  
    $sql_SendMessage=mysqli_query($con,"INSERT INTO massages(sender_id,reciever_id,message,date_time) VALUES('$staff_IDD','$student_id','$msg',now())");