<?php
	//session_start();
		include_once('connection.php');
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		 $sql_profile=mysqli_query($con,"SELECT * FROM staff_biodata WHERE id='$phamacy_user_id'");
    if($sql_profile){
        $row=mysqli_fetch_assoc($sql_profile);
		if($row > 0){
			$staff_id =$row['id'];
			$staff_IDD =$row['id'];
			$login_user =$row['number'];
			$fullname =$row['first_name'] .' '.$row['other_names'].' '.$row['other_names'];
			$role =$row['priv'];
			
		}
       
    }
?>