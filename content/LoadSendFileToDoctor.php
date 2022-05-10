<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		//get staff type
		 $sql_login=mysqli_query($con,"SELECT *FROM tbl_admin WHERE id='$phamacy_user_id'");
        if($sql_login){
            $sql_login_row=mysqli_num_rows($sql_login);
            if($sql_login_row > 0){
                //get user id
                $get_data=mysqli_fetch_array($sql_login);
                $user_id=$get_data['id'];  
				$role=$get_data['role'];  
            }
        }
	}else{
        header('location:index.php');
    }


    $token=$_POST['token'];

    $sqlGetStudent=mysqli_query($con,"SELECT *FROM patient_information WHERE status='1' AND patientID='$token'");
    if($sqlGetStudent){
        $sqlGetStudentRow=mysqli_num_rows($sqlGetStudent);
        if($sqlGetStudentRow > 0){
    $rows=mysqli_fetch_array($sqlGetStudent);
     $patientID=$rows['patientID'];
        $patientNumber=$rows['patientNumber'];
        $patientName=$rows['patientName'];
        $patientPhone=$rows['patientPhone'];
        $patientEmail=$rows['patientEmail'];
        $patientDOB=$rows['patientDOB'];
        $patientGender=$rows['patientGender'];
        $patientNHIS=$rows['patientNHIS'];
        $patientLevel=$rows['patientLevel'];

}
}
?> 

<div style="width:100%;">
        <div style="width:100%;margin-top:30px;margin-left:50px;color:green;">
           <b><h4 style="color:red;">Are you sure you want to perform this operation?</h4></b><hr/>
           
        <div><hr/>
            <a onclick="New_Visit(<?php echo patientID; ?>)" href="#" class="btn btn-primary" role="button" >Yes </a>
        </div>
    </div>
    </div>