<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
	
        
	}else{
        header('location:index.php');
    }
	
    $student_id=$_POST['student_id'];

  	include_once('../includes/connection.php');
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
$message .= '<p style="color:#000;font-size:18px;">Your project on Ibrahim Badamasi Babangida University Lapai Anti-Plagiarism Check Platform has been Approved, you can now print your certificate</p>';
$message .= '</body></html>';

    $sql_Update=mysqli_query($con,"UPDATE student_project SET turnitin_status='3' WHERE student_id='$student_id'");
  if($sql_Update){
      mail($to, $subject, $message, $headers);
  }  
?>