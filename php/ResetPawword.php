<?php
session_start();
	require_once '../includes/connection.php';
	
	
	if($_POST['token']=="resetpassword"){
		if(isset($_POST['uname']) && isset($_POST['token']))
{

		$uname=$_POST['uname'];
		//get staff detail
		 $sql_getData=mysqli_query($con,"SELECT *FROM staff_biodata WHERE email='$uname'");
    if($sql_getData){
        $sql_getData_Row=mysqli_num_rows($sql_getData);
        if($sql_getData_Row > 0){
                $GetData=mysqli_fetch_array($sql_getData);
                $staff_id=$GetData['id'];
                $first_name=$GetData['first_name'];
                $other_names=$GetData['other_names'];
                
                
                $email=$GetData['email'];

        }
    }
		
	    
	    $pass=rand(40000,99999);
	    $pass1=md5($pass);

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
$message .= '<h1 style="color:green;">Hello '.$first_name.', </h1>';
$message .= '<p style="color:#000;font-size:18px;">You have requested to reset the password to your account on Ibrahim Badamasi Babangida University Lapai Anti-Plagiarism Check Platform, Your Password has been reset Successfully.</p>';
$message .= '</p><b>Your new Password is '.$pass.'</b></p>';
$message .= '</body></html>';
 

        $sql_login=mysqli_query($con,"UPDATE staff_biodata SET password='$pass1' WHERE email ='$uname'");
        if($sql_login){
            mail($to, $subject, $message, $headers);
        }
		
}
}



?>