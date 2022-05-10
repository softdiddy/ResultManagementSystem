<?php
		include_once('../includes/connection.php');
		
		$id=$_POST['id'];
		$session=$_POST['session'];
		
		
		
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
	
	

		$Remove=mysqli_query($con,"DELETE FROM programme_courses_".$current_session." WHERE id='$id'") or die(mysqli_error($con));
		if($Remove){
			echo 'Course Removed Successfully';	
		}
	
?>	

	