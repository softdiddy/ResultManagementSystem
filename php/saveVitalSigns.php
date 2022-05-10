<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		
		
		 $temp=$_POST['temp'];
		 $HR=$_POST['HR'];
		 $Pulse=$_POST['Pulse'];
		 $BP=$_POST['BP'];
		 $RR=$_POST['RR'];
		 $Oxygen=$_POST['Oxygen'];
		 $PH=$_POST['PH'];
		 
		 $token=$_POST['token'];
		 $patient_visit_id=$_POST['patient_visit_id'];
		 
		
		 $sqlUpdate=mysqli_query($con,"UPDATE patient_visit_details SET temp='$temp',HR='$HR',Pulse='$Pulse',BP='$BP',RR='$RR',Oxygen='$Oxygen',PH='$PH' WHERE patient_visit_id='$patient_visit_id'") or die(mysqli_error($con));
				
				if($sqlUpdate){
					echo "Vital Sign Reading Saved Successfully";
					
					$sqlUpdate=mysqli_query($con,"UPDATE patient_visit SET file_position='2' WHERE patient_visit_id='$patient_visit_id'") or die(mysqli_error($con));
				
					
				}
				
	}else{
        header('location:index.php');
    }

   
  
?> 