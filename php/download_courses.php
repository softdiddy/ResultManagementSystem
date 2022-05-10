<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	
	
	$programme_id=$_POST['programme_id'];
	
	
	 $sql_get_programme=mysqli_query($con,"SELECT *FROM programmes WHERE id='$programme_id'") or die(mysqli_error($con));
    if($sql_get_programme){
        $sql_get_programmeRow=mysqli_num_rows($sql_get_programme);
		if($sql_get_programmeRow > 0){
			while($get=mysqli_fetch_array($sql_get_programme)){
			$title=$get['title'];
			$id=$get['id'];
			$code=$get['code'];

		}
		}
	}
	
	
	
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




//$sql_query=mysqli_query($conn,"SELECT * FROM student_payment_list") or die(mysqli_error($conn));
//	$sql_query=mysqli_query($conn,"SELECT * FROM student_biodata_registration WHERE id > '$ref_ID'");
	
	$sql="SELECT * FROM student_course_registration WHERE c_code LIKE '$code%'";
	$sql_query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if($sql_query){
        $sql_query_row=mysqli_num_rows( $sql_query);
		if($sql_query_row > 0){
			while($sql_query_rowGet=mysqli_fetch_array($sql_query)){
			
			$c_code=$sql_query_rowGet['c_code'];
			$c_title=$sql_query_rowGet['c_title'];
			$c_semester=$sql_query_rowGet['c_semester'];
			
			$c_unit=$sql_query_rowGet['c_unit'];
			
			//chk if the student exsit
				$sqlChk=mysqli_query($con,"SELECT *FROM courses WHERE course_code='$c_code'");
				if($sqlChk){
					$sqlChkRow=mysqli_num_rows($sqlChk);
					if($sqlChkRow == 0){
				 $sql="INSERT INTO courses(programme_id,semester,title,course_code,cradit_unit) 
				VALUES('$programme_id','$c_semester','$c_title','$c_code','$c_unit')" ;
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