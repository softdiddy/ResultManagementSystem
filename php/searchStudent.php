<?php
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('../includes/staff_profile.php');
	}else{
        header('location:index.php');
    }
	
    $sup_id=$_POST['sup_id'];
    $txtMatric=$_POST['txtMatric'];

    //get student id
    $sql_getstdID=mysqli_query($con,"SELECT *FROM student_2020_2021 WHERE number='$txtMatric'");
    if($sql_getstdID){
        $sql_getstdIDRow=mysqli_num_rows($sql_getstdID);
        if($sql_getstdIDRow > 0){
                $GetD=mysqli_fetch_array($sql_getstdID);
                $std_id=$GetD['id'];
        }else{
            echo '<div class="alert alert-danger" role="alert">Invalid Matric Number or the record does not exist</div>';
            die();
        }
    }
    

?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Search Result</h3>
  </div>
  <div class="panel-body">
<?php
    
    include_once('../includes/connection.php');
    //get staff
    $sql_getData=mysqli_query($con,"SELECT *FROM student_supervisor WHERE student_id='$std_id'");
    if($sql_getData){
        $sql_getData_Row=mysqli_num_rows($sql_getData);
        if($sql_getData_Row == 0){   
            echo '<div class="alert alert-success" role="alert">
                Student has not been Assigned, do you want to assign the student to the staff ? <hr/>
                <p><center><a style="width:50%;" class="btn btn-success btn-lg" href="#" role="button" onclick="assign_student('.$sup_id.','.$std_id.')">Yes</a></center></p>
            </div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">Student Already Assign to a Supervisor</div>';
      
        }
    }
    ?>

    
  </div>
</div>
