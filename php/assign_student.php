<?php
    session_start();
	require_once '../includes/connection.php';
	if(isset($_SESSION['phamacy_user_id'])){
		$user_id=$_SESSION['phamacy_user_id'];
        $sup_id=$_POST['sup_id'];
        $std_id=$_POST['std_id'];

        //chk if the staff is already a supervisor or not
$sqlChk=mysqli_query($con,"SELECT *FROM student_supervisor WHERE student_id='$std_id'");
if($sqlChk){
    $sqlChk_Row=mysqli_num_rows($sqlChk);
    if($sqlChk_Row > 0){
        echo "Student Already Assigned";
    }else{
        //add
        $sqlAdd=mysqli_query($con,"INSERT INTO student_supervisor(staff_id,student_id) VALUES('$sup_id','$std_id')");
    }
}

    }

?>