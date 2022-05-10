<?php
	$number =$_POST['number'];
	$email =$_POST['email'];
	$phone =$_POST['phoneNumber'];
	$faculty =$_POST['faculty'];
	$type =$_POST['type'];
	$name =$_POST['name'];
	$gender =$_POST['gender'];
	$sup_id =$_POST['sup_id'];
	

  include_once('../includes/connection.php');

$pass=rand(3000,9999);
$pass1=md5($pass);

	if($number =="" && $email=="" && $phone=="" && $faculty=="" && $type=="" && $name=="" && $gender==""){
		echo '<p style="color:red">Provide all the requred Informations</p>';
	}else{
		
			//chk if email exist
			$sql_email = "SELECT *FROM student_2019_2020 WHERE email='$email' OR number='$number' OR phone_no='$phone'";
		$sql_run = mysqli_query($con, $sql_email) or die(mysqli_error($con));
		$no_of_rows=mysqli_num_rows($sql_run);
		if($no_of_rows > 0){	
			echo "User already exist";
			
		}else{
			//create account
			$sql_insert=mysqli_query($con,"INSERT INTO student_2019_2020(faculty,number,surname,phone_no,gender,password,email,accountType) VALUES('$faculty','$number','$name','$phone','$gender','$pass1','$email','$type')");
			if($sql_insert){
				echo "Student Added Successfully";
				 $last_id = $con->insert_id;
				 
				         //chk if the staff is already a supervisor or not
$sqlChk=mysqli_query($con,"SELECT *FROM student_supervisor WHERE student_id='$std_id'");
if($sqlChk){
    $sqlChk_Row=mysqli_num_rows($sqlChk);
    if($sqlChk_Row > 0){
        echo "Student Already Assigned";
    }else{
        //add
        $sqlAdd=mysqli_query($con,"INSERT INTO student_supervisor(staff_id,student_id) VALUES('$sup_id','$last_id')");
        if($sqlAdd){
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
$message .= '<h1 style="color:green;">Dear '.$name.' ('.$number.'),</h1>';
$message .= '<p style="color:#000;font-size:18px;">Your Ibrahim Badamasi Babangida University Lapai Anti-Plagiarism Account has been created, you are to login with your matric number and the password below.</p>';
$message .= '</p><b>Your new Password is '.$pass.' </b></p><br/>';
$message .= '</p><b><a href="http://student.apps.ibbu.edu.ng">Click here to login</a></b></p>';
$message .= '</body></html>';
 
// Sending email
    mail($to, $subject, $message, $headers);
        }
    }
}


			}
		}
	}


?>