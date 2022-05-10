 <?php
 	session_start();
     include_once('../includes/connection.php');
     if(isset($_SESSION['phamacy_user_id'])){
         $phamacy_user_id=$_SESSION['phamacy_user_id'];
         include_once('../includes/staff_profile.php');
         
     }else{
         header('location:index.php');
     }
 $staffIDD=$_POST['staffIDD'];
 $student_id=$_POST['student_id'];

 $session_title="2020_2021";
    //get student details
    $sql_getSup=mysqli_query($con,"SELECT *FROM student_".$session_title." WHERE id='$student_id'");
    if($sql_getSup){
        $sql_getSup_row=mysqli_num_rows($sql_getSup);
        if($sql_getSup_row > 0){
                while($GetRecord=mysqli_fetch_array($sql_getSup)){
                
                $student_id=$GetRecord['id'];
                $first_name=$GetRecord['first_name'];
                $other_names=$GetRecord['other_names'];
                $surname=$GetRecord['surname'];
                    
                $full_name=$first_name .' '.$other_names.' '.$surname;
                $programme_id =$GetRecord['programme_id'];
                $phone_number=$GetRecord['phone_no'];
                $email=$GetRecord['email'];

                $gender=$GetRecord['gender'];
               
                
    //get number of students
    $sql_get=mysqli_query($con,"SELECT *FROM programmes WHERE id='$programme_id'");
    if($sql_get){
        $sql_getRow=mysqli_num_rows($sql_get);
        if($sql_getRow > 0){
            $data=mysqli_fetch_array($sql_get);
            $title=$data['title'];
        }
    }
}
        }
    } 

 
                            //get msg between student and his/ her sup.
                        $sql_get_msg=mysqli_query($con,"SELECT *FROM massages WHERE sender_id='$student_id' AND reciever_id='$staff_IDD' OR sender_id='$staff_IDD' AND reciever_id='$student_id'");
                            if($sql_get_msg){
                                $sql_get_msgRow=mysqli_num_rows($sql_get_msg);
                                if($sql_get_msgRow > 0){
                                    while($data=mysqli_fetch_array($sql_get_msg)){
                                    $sender_id=$data['sender_id'];
                                    $reciever_id=$data['reciever_id'];
                                    $message=$data['message'];
                                    $date_time =$data['date_time'];
                                
                                    if($sender_id==$staff_IDD){
                                        echo '
                                        <li class="left clearfix">
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">'.$fullname.'</strong> <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>'.$date_time.'</small>
                                        </div>
                                        <p>
                                            '.$message.'
                                        </p>
                                    </div>
                                </li>';
                                    }else{
                                        echo '<li class="right clearfix">
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$date_time.'</small>
                                                <strong class="pull-right primary-font">'.$full_name.'</strong>
                                            </div>
                                            <p>
                                            '.$message.'
                                            </p>
                                        </div>
                                    </li>';
                                    }
                               
                        
                                
                                }
                            }
                        }
                        ?>