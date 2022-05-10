<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	
	
	$programm=$_POST['programm'];
	$level=$_POST['level'];
	
	
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


//get programm ID
 $sql_get_programm=mysqli_query($con,"SELECT *FROM programmes WHERE code='$programm'") or die(mysqli_error($con));
    if($sql_get_programm){
        $sql_get_programmRow=mysqli_num_rows($sql_get_programm);
		if($sql_get_programmRow > 0){
			$get=mysqli_fetch_array($sql_get_programm);
			$programm_id=$get['id'];
		}
	}
	

//$sql_query=mysqli_query($conn,"SELECT * FROM student_payment_list") or die(mysqli_error($conn));
//	$sql_query=mysqli_query($conn,"SELECT * FROM student_biodata_registration WHERE id > '$ref_ID'");
	
	$token=$level.'/%'.$programm.'/%';
	$sql="SELECT * FROM student_biodata_registration WHERE matric_no LIKE '$token'";
	$sql_query=mysqli_query($conn,$sql) or die("The operation is taking time than usual, Please check your network and try again");
    if($sql_query){
        $sql_query_row=mysqli_num_rows( $sql_query);
		if($sql_query_row > 0){
			//return an array
			$data_array = array();
			while($rows=mysqli_fetch_array($sql_query)){
				$matric_number=$rows['matric_no'];
				$jamb_no=$rows['jamb_no'];
				$surname=$rows['surname'];
				$firstname=$rows['firstname'];
				$othername=$rows['othername'];
				$student_phone_number=$rows['telephone'];
				
				$matric_number=str_replace("'","",$matric_number);
				
				$surname=str_replace("'","",$surname);
				$firstname=str_replace("'","",$firstname);
				$othername=str_replace("'","",$othername);
				
				$surname=str_replace("/","",$surname);
				$firstname=str_replace("/","",$firstname);
				$othername=str_replace("/","",$othername);
				
				
				$student_phone_number=str_replace("'","",$student_phone_number);
				
				
				
				$gender=$rows['gender_t'];
				$gender=str_replace("'","",$gender);
				//$dept_t=$rows['dept_t'];
				
				//chk if the student exsit
				$sqlChk=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE number='$matric_number'");
				if($sqlChk){
					$sqlChkRow=mysqli_num_rows($sqlChk);
					if($sqlChkRow == 0){
				 $sql="INSERT INTO student_".$current_session." (number,surname,first_name,other_names,programme_id,level) 
				VALUES('$matric_number','$surname','$firstname','$othername','$programm_id','$level')" ;
				$sql_Insert=mysqli_query($con,$sql) or die(mysqli_error($con));
					}
				}
				
				
			}
			echo "Record Updated Successfully";

		}else if($sql_query_row == 0){
			echo "No Record found";
		}
		
		else{
			echo "Something went wrong, Please check your network";
		}
   }

?>