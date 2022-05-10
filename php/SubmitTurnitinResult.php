<?php
	$student_id=$_POST['student_id'];
	$similarityIndex=$_POST['similarityIndex'];
	$internetSources=$_POST['internetSources'];
	$publications=$_POST['publications'];
	$studentPapers=$_POST['studentPapers'];
	
	require_once '../includes/connection.php';
	
	//get student email
		$sql = "SELECT *FROM student_2019_2020 WHERE id='$student_id'";
		$sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));
		$no_of_rows=mysqli_num_rows($sql_run);
		if($no_of_rows > 0){
			 $get_Acc_detail = mysqli_fetch_assoc($sql_run);
			 //$usertype=$get_Acc_detail['user_type'];
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
		}
	
	
	if($similarityIndex =="" || $internetSources =="" || $publications =="" || $studentPapers =="" ){
		echo'Error:Missing fields';	
	}else{
		//add
		include_once('../includes/connection.php');
			$to = $email;
$subject = 'Anti-Plagiarism Account';
$from = 'Anti-Plagiarism@ibbu.edu.ng';


 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"></head><body>';
$message .= '<h1 style="color:green;">Dear '.$full_name.' ('.$number.'),</h1>';
$message .= '<p style="color:#000;font-size:18px;">You have an update on your project on Ibrahim Badamasi Babangida University Lapai Anti-Plagiarism Check Platform has been updated, kindly login to review</p>';
$message .= '</p><b><a href="http://student.apps.ibbu.edu.ng">Click here to login</a></b></p>';
$message .= '</body></html>';
 
// Sending email
    if(mail($to, $subject, $message, $headers)){
        	$sql_UpdateDrugs=mysqli_query($con,"UPDATE student_project SET similarityIndex='$similarityIndex',internetSources='$internetSources',publications='$publications',studentPapers='$studentPapers' WHERE student_id='$student_id'");
		if($sql_UpdateDrugs){
			echo'Record Updated Successfully';
		
		}
    }
	}
?>	

	