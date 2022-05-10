<?php
    session_start();
	require_once '../includes/connection.php';
	if(isset($_SESSION['phamacy_user_id'])){
		$user_id=$_SESSION['phamacy_user_id'];
        $staffid=$_POST['staffid'];
        $faculty=$_POST['faculty'];

        $sql_Update=mysqli_query($con,"UPDATE faculty_cordinator SET staff_id='$staffid' WHERE faculty_id='$faculty'");
    }
?>