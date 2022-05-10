<?php
	session_start();
	require_once '../includes/connection.php';
    $user_id=$_SESSION['ibbu_pplessoffice_staff_id'];  

     $sql_profile=mysqli_query($con,"SELECT * FROM staff_biodata WHERE id='$user_id'");
    if($sql_profile){
        $row=mysqli_fetch_assoc($sql_profile);
		if($row > 0){
			$token =$row['fileno'];
			//get staff information by fileno
			require_once('get_staff_infomation_by_cno.php');
		}
       
    }
	
	
	session_destroy();
	
		echo '1';
	
	
?>