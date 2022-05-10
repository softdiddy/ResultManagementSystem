<?php
include_once('../includes/connection.php');
    $course_id=$_POST['course_id'];
    $number="";
    //chk if the course is assiged
    $sql="SELECT *FROM staff_courses sc INNER JOIN staff_biodata sb ON sc.staff_id=sb.id WHERE sc.course_id='$course_id'";
    $sqlChk=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($sqlChk){
        $sqlChkRow=mysqli_num_rows($sqlChk);
        if($sqlChkRow > 0){
            $sqlGett=mysqli_fetch_array($sqlChk);
            $staff_id=$sqlGett['staff_id'];
            $number=$sqlGett['number'];
            $staffFullanem=$sqlGett['first_name'] .' '.$sqlGett['other_names'];
        }
    }

?>
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title pull-left" id="myModalLabel">Assign Course</h4>
      </div>
      <div class="modal-body">
            <div class="alert alert-info" role="alert">
                <?php
                    if($number !=""){
                        echo'<b>This course has been assigned to '.$staffFullanem.'('. $number.').',' 
                        if you want to assign it to another staff, please enter the Staff number </b>';
                    }else{
                        echo "This course has not been assigned to any staff, do you want me to Assign this course to a staff? please enter the staff number";
                    }
                ?>
               
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="..." id="staffNo">
                </div>
                <div class="input-group" style="top:10px;">
                <button type="button" onclick="assignCourse(<?php echo $course_id; ?>)" class="btn btn-success" style="width:100%" data-dismiss="modal">Yes Please</button>
                </div>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>