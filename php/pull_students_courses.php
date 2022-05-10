<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	
	
	$course_id=$_POST['course_id'];
	
	
    $dbServerName = "portals.ibbu.edu.ng";
    $dbUsername = "portalsi_syncdba";
    $dbPassword = "765QWE119ssjXxxX";
    $dbName = "portalsi_UGRegSyncDB";

    // create connection
$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_get_courses=mysqli_query($con,"SELECT *FROM courses WHERE course_id='$course_id'") or die(mysqli_error($con));
    if($sql_get_courses){
        $sql_get_coursesRow=mysqli_num_rows($sql_get_courses);
		if($sql_get_coursesRow > 0){
			$get=mysqli_fetch_array($sql_get_courses);
			$course_id=$get['course_id'];
			$course_code=$get['course_code'];
			}
	}
	

//$sql_query=mysqli_query($conn,"SELECT * FROM student_payment_list") or die(mysqli_error($conn));
//	$sql_query=mysqli_query($conn,"SELECT * FROM student_biodata_registration WHERE id > '$ref_ID'");
	
	$sql="SELECT * FROM student_course_registration WHERE c_code='$course_code' AND c_session='$session_title'";
	$sql_query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if($sql_query){
        $sql_query_row=mysqli_num_rows( $sql_query);
		if($sql_query_row > 0){
			while($sql_query_rowGet=mysqli_fetch_array($sql_query)){
			$student_id=$sql_query_rowGet['student_no'];
			$c_code=$sql_query_rowGet['c_code'];
			
			//chk if the student exsit
				$sqlChk=mysqli_query($con,"SELECT *FROM student_courses_".$current_session." WHERE student_id='$student_id'");
				if($sqlChk){
					$sqlChkRow=mysqli_num_rows($sqlChk);
					if($sqlChkRow == 0){
				 $sql="INSERT INTO student_courses_".$current_session." (student_id,course_code) 
				VALUES('$student_id','$course_code')" ;
				$sql_Insert=mysqli_query($con,$sql) or die(mysqli_error($con));
					}
				}
			}	
		}else if($sql_query_row == 0){
			echo "No Record found";
		}
		
		else{
			echo "Something went wrong, Please check your network";
		}
		
		
		
   }

?>