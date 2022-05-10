<?php
	session_start();
    include_once('includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('includes/staff_profile.php');
	}else{
        header('location:index.php');
    }
	
    
	
  		$sql = "SELECT *FROM uploads";
	

		$sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));
		$no_of_rows=mysqli_num_rows($sql_run);
		if($no_of_rows > 0){
			 while($get_Acc_detail = mysqli_fetch_assoc($sql_run)){
			 $MATRIC_NO=$get_Acc_detail['MATRIC_NO'];
			 $SURNAME=$get_Acc_detail['SURNAME'];
			 $FIRSTNAME=$get_Acc_detail['FIRSTNAME'];
			 $OTHERNAME=$get_Acc_detail['OTHERNAME'];
			 
			
			 $sqlInsert=mysqli_query($con,"INSERT INTO student_2020_2021(number,surname,first_name,other_names) VALUES('$MATRIC_NO','$SURNAME','$FIRSTNAME','$OTHERNAME')")or die(mysqli_error($con));
			 
			 }	
		}
    

?>
