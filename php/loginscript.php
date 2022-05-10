<?php
session_start();
	require_once '../includes/connection.php';
	
	if($_POST['token']=="login"){
		if(isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['token']))
{

		$uname=$_POST['uname'];
		$pass=md5($_POST['pass']);

        $sql_login=mysqli_query($con,"SELECT *FROM staff_biodata WHERE number='$uname' AND password='$pass' AND user_status='1'");
        if($sql_login){
            $sql_login_row=mysqli_num_rows($sql_login);
            if($sql_login_row > 0){
                //get user id
                $get_data=mysqli_fetch_array($sql_login);
                $user_id=$get_data['id'];
                echo '1';
                $_SESSION['phamacy_user_id']=$user_id;

            }else{
                echo '0';
            }
        }
		
}
}

if($_POST['token']=="logout"){

	 unset($_SESSION['phamacy_user_id']);
	if(!isset($_SESSION['phamacy_user_id'])){
		echo "1";
	}
}




?>