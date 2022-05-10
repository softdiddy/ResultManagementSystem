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
    $patient_id=$_POST['patientID'];
    

    
?> 
<div class="card-body" style="background-color:#ccc;">
    <?php
    $sqlGetVisitDetails=mysqli_query($con,"SELECT *FROM patient_visit_details WHERE status='1' AND patient_visit_id='$token' ORDER BY patient_visit_id DESC");
    if($sqlGetVisitDetails){
        $sqlGetVisitDetailsRow=mysqli_num_rows($sqlGetVisitDetails);
        if($sqlGetVisitDetailsRow > 0){
        while($rowV=mysqli_fetch_array($sqlGetVisitDetails)){
            $images=$rowV['images'];
            $patient_visit_id=$rowV['patient_visit_id'];
           
            echo ' <img src="images/uploads/medicalRecords/'.$patient_id.'/'.$images.'" style="width:100%" /><br/>';
        }
    }else{
        echo'<p><b style="color:red;">No Record Found</p></b>';
    }
    }
    ?>
</div>

