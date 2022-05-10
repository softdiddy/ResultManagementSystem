<?php
    session_start();
	require_once '../includes/connection.php';
    include_once('get_curent_session.php');

	if(isset($_SESSION['phamacy_user_id'])){
		$user_id=$_SESSION['phamacy_user_id'];
        $course_id=$_POST['course_id'];
        $staffNo=$_POST['staffNo'];

        $sql_get_staff=mysqli_query($con,"SELECT *FROM staff_biodata WHERE number='$staffNo'") or die(mysqli_error($con));
        if($sql_get_staff){
            $sql_get_staffRow=mysqli_num_rows($sql_get_staff);
            if($sql_get_staffRow > 0){
                $get=mysqli_fetch_array($sql_get_staff);
                $staffId=$get['id'];
              
                //chk if the course is already assigned
                $sqlChk=mysqli_query($con,"SELECT *FROM staff_courses WHERE course_id='$course_id'");
                if($sqlChk){
                    $sqlChkRow=mysqli_num_rows($sqlChk);
                    if($sqlChkRow > 0){
                        $sqlUpdate=mysqli_query($con,"UPDATE staff_courses SET staff_id='$staffId' WHERE course_id='$course_id'") or die(mysqli_error($con));
                        if($sqlUpdate){
                            echo "Record updated Successfully";
                        }
                    }else{
                        $sqlInsert=mysqli_query($con,"INSERT INTO staff_courses(staff_id,course_id,session_id) VALUES('$staffId','$course_id','$session_id')");
                        if($sqlInsert){
                            echo "Record updated Successfully";
                        }
                    }
                }
            }else{
                echo "Invalid Staff Number";
            }
        }
        

      
    }
?>