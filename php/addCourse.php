<?php
    session_start();
	require_once '../includes/connection.php';
    include_once('get_curent_session.php');

	if(isset($_SESSION['phamacy_user_id'])){
		$courseCode=$_SESSION['courseCode'];
        $courseTitle=$_POST['courseTitle'];
        $courseUnit=$_POST['courseUnit'];

        $sql_get_staff=mysqli_query($con,"SELECT *FROM courses WHERE title='$courseTitle' OR course_code='$courseCode'") or die(mysqli_error($con));
        if($sql_get_staff){
            $sql_get_staffRow=mysqli_num_rows($sql_get_staff);
            if($sql_get_staffRow == 0){
                //insert
                $sqlInsert=mysqli_query($con,"INSERT INTO courses(title,course_code,cradit_unit) VALUES('$courseTitle','$courseCode','$courseUnit')");
                if($sqlInsert){
                    echo '1';
                }
            }else{
                echo '<p style="color:red">Course Already Exist</p>';
            }
        }
        

      
    }
?>