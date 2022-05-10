<?php
    session_start();
	require_once '../includes/connection.php';
	if(isset($_SESSION['phamacy_user_id'])){
		$user_id=$_SESSION['phamacy_user_id'];
        $staffid=$_POST['staffid'];
        //chk if the staff is already a supervisor or not
$sqlChk=mysqli_query($con,"SELECT *FROM project_supervisor WHERE staff_id='$staffid'");
if($sqlChk){
    $sqlChk_Row=mysqli_num_rows($sqlChk);
    if($sqlChk_Row > 0){
        echo "Staff Already a Supervisor";
    }else{
        //add
        $sqlAdd=mysqli_query($con,"INSERT INTO project_supervisor(staff_id,session_id) VALUES('$staffid','1')");
    }
}

    }

?>