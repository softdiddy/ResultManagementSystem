<?php
	session_start();
	
	include_once('../includes/connection.php');
	
	include_once('../php/get_curent_session.php');
	
	
	
	$g_total= mysqli_real_escape_string($con, $_POST['total']);
	$student_id= mysqli_real_escape_string($con, $_POST['student_id']);
	$ca= mysqli_real_escape_string($con, $_POST['ca']);
	$exam= mysqli_real_escape_string($con, $_POST['exam']);
	$course_id= mysqli_real_escape_string($con, $_POST['course_id']);
	$semester= mysqli_real_escape_string($con, $_POST['semester']);
	
	
	
	
	//GET STUDENT
	$sql="SELECT *FROM student_".$current_session." WHERE id='$student_id'";
	$sqlChkk=mysqli_query($con,$sql);
				if($sqlChkk){
					$sqlChkkRow=mysqli_num_rows($sqlChkk);
					if($sqlChkkRow > 0){
						$rowss=mysqli_fetch_array($sqlChkk);
						$number=$rowss['number'];
										
						
					}
				}
				
	if ($ca == '') {
		$ca = 0;
	}
	if ($exam == '') {
		$exam = 0;
	}

	//get course code
	$mysql_ret_t = mysqli_query($con,"SELECT * FROM courses WHERE course_id='$course_id'");
	if($mysql_ret_t){
		$rowsisis = mysqli_fetch_assoc($mysql_ret_t);
	    $cradit_unit=strtolower($rowsisis['cradit_unit']);
		 $course_code=strtolower($rowsisis['course_code']);
	}


	$sql_get_grade_point="SELECT * FROM grade_point_".$current_session." ";
     $sql_get_grade_point_run=mysqli_query($con,$sql_get_grade_point) or die(mysqli_error($con));
	 if($sql_get_grade_point_run){
		 $sql_get_grade_point_row=mysqli_num_rows($sql_get_grade_point_run);
		 if($sql_get_grade_point_row > 0){
			 while($grade_rows=mysqli_fetch_array($sql_get_grade_point_run)){
			   $min_mark=$grade_rows['min_mark'];
			   $max_mark=$grade_rows['max_mark'];
			   
			   if($g_total >= $min_mark && $g_total <= $max_mark){
					$grade=$grade_rows['grade'];
					$point=$grade_rows['g_point'];
					$grade_point=$point * $cradit_unit;
					
			   }
			 }
		 }
	 }

	$sql_chk=mysqli_query($con,"SELECT * FROM student_ca_".$current_session." WHERE student_id='$number' AND course_code='$course_code'");
	if($sql_chk){
		$sql_chk_row=mysqli_num_rows($sql_chk);
		if($sql_chk_row == 0){
			//insert
			$sql_insert=mysqli_query($con,"INSERT INTO student_ca_".$current_session." (student_id,course_code,ca,exam,total,grade,grade_point,cradit_unit,semester) VALUES('$number','$course_code','$ca','$exam','$g_total','$grade','$grade_point','$cradit_unit','$semester')");
			if($sql_insert){
				echo '1';
			} else {
				echo '0';
			}
		} else{
		    
			$sql_update=mysqli_query($con,"UPDATE student_ca_".$current_session." SET student_id='$number',course_code='$course_code',ca='$ca',exam='$exam',total='$g_total',grade='$grade',grade_point='$grade_point',cradit_unit='$cradit_unit',semester='$semester' WHERE student_id='$number' AND course_code='$course_code'");
			if($sql_update){
				echo '1';
			} else {
				echo '0';
			}
		}
	}

	//Chk if the course is in oustanding table, if grade is not f then remove the course for the student for the corrent semester
?>