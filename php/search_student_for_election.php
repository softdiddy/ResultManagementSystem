<?php
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('../includes/staff_profile.php');
	}else{
        header('location:index.php');
    }
	
    
		$matric_number=$_POST['matric_number'];

  		$sql = "SELECT *FROM student_2020_2021 WHERE number='$matric_number'";
	

		$sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));
		$no_of_rows=mysqli_num_rows($sql_run);
		if($no_of_rows > 0){
			 $get_Acc_detail = mysqli_fetch_assoc($sql_run);
			 $id=$get_Acc_detail['id'];
			 //$project_id=$get_Acc_detail['project_id'];
			 $image=$get_Acc_detail['image'];
			 $number=$get_Acc_detail['number'];
			 $gender=$get_Acc_detail['gender'];
			
			 $email=$get_Acc_detail['email'];
			 $surname=$get_Acc_detail['surname'];
			 $first_name=$get_Acc_detail['first_name'];
			 $other_names=$get_Acc_detail['other_names'];
			 $level=$get_Acc_detail['level'];
		
			 $full_name=$surname.' '.$first_name.' '.$other_names;
			 $img=str_replace("/","_",$number);
			 
			 $pin=rand(100,999).rand(10,99);
			 $p=md5($pin);
			 //update
			 $update_pin=mysqli_query($con,"UPDATE student_2020_2021 SET password='$p' WHERE number='$matric_number'");
			 
			 if($update_pin){
				  echo '
				<div class="col-md-4">
				<center>
				<img src="../student/images/candidates/0.png" alt="..." class="img-thumbnail" style="width:95%;height:150px;">
					<b>'.$number.'</b><br/>
					<b>'.$full_name.'</b><br/>
					<b>'.$level.'</b><br/><hr/>
					<b>PIN: '.$pin.'</b><br/>
					<b>Username: '.$id.'</b><br/>
				</a>
				
				</center>
				</div>
				
			 ';
			 }
			
		}else{
			$sqlAdd=mysqli_query($con,"INSERT INTO student_2020_2021(number) VALUES('$matric_number')");
			if($sqlAdd){
				echo "I cant find the record but i have Added the record to the Database, Please ask the student to Write down his/her Matric Number";
			}
			
		}
    

?>
