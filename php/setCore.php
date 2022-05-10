<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		
	
        
	}else{
        header('location:index.php');
    }

    $session=$_POST['session'];
	
    include_once('../includes/connection.php');
    $sql_get_session=mysqli_query($con,"SELECT *FROM sessions WHERE id='$session'") or die(mysqli_error($con));
    if($sql_get_session){
        $sql_get_session_row=mysqli_num_rows($sql_get_session);
		if($sql_get_session_row > 0){
			while($get=mysqli_fetch_array($sql_get_session)){
			$session_title=$get['title'];
			$session_id=$get['id'];
			$current_session=str_replace("/","_",$session_title);
		}
		}
	}

    $programm_course_id=$_POST['programm_course_id'];
    $core=$_POST['core'];
   
    $sql_Update=mysqli_query($con,"UPDATE programme_courses_".$current_session." SET core='$core' WHERE id='$programm_course_id'");
     if($sql_Update){
        echo "Record updated Successfully";
     }