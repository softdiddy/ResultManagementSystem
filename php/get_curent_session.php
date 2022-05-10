<?php
//error_reporting(0);
	include_once('../includes/connection.php');
	//get total number of student 
	
	 $sql_get_session=mysqli_query($con,"SELECT *FROM sessions WHERE current_session='1'") or die(mysqli_error($con));
    if($sql_get_session){
        $sql_get_session_row=mysqli_num_rows($sql_get_session);
		if($sql_get_session_row > 0){
			$get=mysqli_fetch_array($sql_get_session);
			$session_title=$get['title'];
			$session_id=$get['id'];
			$level1=$get['level1'];
			$level2=$get['level2'];
			$level3=$get['level3'];
			$level4=$get['level4'];
			$level5=$get['level5'];
			
			$current_session=str_replace("/","_",$session_title);
		}
	}

?>