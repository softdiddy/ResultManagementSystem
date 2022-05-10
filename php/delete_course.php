<?php
		include_once('../includes/connection.php');
		
		$course_id=$_POST['course_id'];
		
		$Remove=mysqli_query($con,"DELETE FROM courses WHERE course_id='$course_id'") or die(mysqli_error($con));
		if($Remove){
			echo 'Course Deleted Successfully';	
		}
	
?>	

	