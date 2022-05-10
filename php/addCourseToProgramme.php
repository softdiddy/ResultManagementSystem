<?php
	$course_id=$_POST['course_id'];
	$session=$_POST['session'];
	$programme=$_POST['programme'];
	$level=$_POST['level'];
	$semester=$_POST['semester'];
	
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
		
		
		 $sqlcHK=mysqli_query($con,"SELECT *FROM programme_courses_".$current_session." WHERE programme_id='$programme' AND level='$level' AND course_id='$course_id' AND semester='$semester'") or die(mysqli_error($con));
    if($sqlcHK){
        $sqlcHKrOW=mysqli_num_rows($sqlcHK);
		if($sqlcHKrOW == 0){
			$sql=mysqli_query($con,"INSERT INTO programme_courses_".$current_session."(programme_id,level,course_id,semester) VALUES('$programme','$level','$course_id','$semester')") or die(mysqli_error($con));
	if($sql){
		echo "Record Added Successfully";
	}
		}else{
			echo "Course Already Exist";
		}
	}
	
		
?>	

	