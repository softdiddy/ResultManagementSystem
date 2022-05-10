<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Search Result</h3>
  </div>
  <div class="panel-body">
<?php
     $txtStaff=$_POST['txtStaff']; 
    include_once('../includes/connection.php');
    //get staff
    $sql_getData=mysqli_query($con,"SELECT *FROM staff_biodata WHERE number='$txtStaff'");
    if($sql_getData){
        $sql_getData_Row=mysqli_num_rows($sql_getData);
        if($sql_getData_Row > 0){
                $GetData=mysqli_fetch_array($sql_getData);
                $staff_id=$GetData['id'];
                $first_name=$GetData['first_name'];
                $other_names=$GetData['other_names'];
                $gender=$GetData['gender'];

                echo '
                <ul class="list-group">
                    <li class="list-group-item"><span class="label label-success" style="font-size:20px;color:green;">'.$first_name.' '.$other_names.'</span></li>
                    <li class="list-group-item"><span class="label label-success" style="font-size:20px;color:green;">'.$gender.'</span></li>
                </ul>
                <hr/>
        <b style="color:red;padding:20px;">
            <center>Are you sure you want to make the Staff a Project Supervisors ? </center>
        </b>
        <p><center><a style="width:50%;" class="btn btn-success btn-lg" href="#" role="button" onclick="make_staff_supervisor('.$staff_id.')">Yes</a></center></p>
                ';
        }else{
            echo '<div class="alert alert-danger" role="alert">No staff Found</div>';
        }
    }
    ?>

    
  </div>
</div>
