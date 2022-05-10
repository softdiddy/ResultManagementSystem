<?php

	include_once('../includes/connection.php');
	
	$session=$_POST['session'];
	$programme=$_POST['programme'];
	$level=$_POST['level'];
	$course_title=$_POST['course_title'];
	$semester=$_POST['semester'];
	
$sql_get_programm=mysqli_query($con,"SELECT *FROM programmes WHERE id='$programme'") or die(mysqli_error($con));
    if($sql_get_programm){
        $sql_get_programmRow=mysqli_num_rows($sql_get_programm);
		if($sql_get_programmRow > 0){
			$get=mysqli_fetch_array($sql_get_programm);
			$programm_id=$get['id'];
			$title=$get['title'];
		}
	}
	
	
	
	 $sql_get_session=mysqli_query($con,"SELECT *FROM sessions WHERE id='$session'") or die(mysqli_error($con));
    if($sql_get_session){
        $sql_get_session_row=mysqli_num_rows($sql_get_session);
		if($sql_get_session_row > 0){
			while($get=mysqli_fetch_array($sql_get_session)){
			$session_title=$get['title'];
			$session_id=$get['id'];
			$current_session=str_replace("/","_",$session_title);
		}
		}
	}
?>		

              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" >
				<table class="table">
								<tr>
									<td>SN</td>
									<td>Course</td>
									<td>Unit</td>
									<td></td>
								</tr>
								<?php
								$sn=1;
									//get all first semester programme course
									$sqlGet=mysqli_query($con,"SELECT *FROM courses WHERE course_code LIKE '$course_title%' AND status='1'");
									if($sqlGet){
										$sqlGetRow=mysqli_num_rows($sqlGet);
										if($sqlGetRow > 0){
											while($row=mysqli_fetch_array($sqlGet)){
												$course_id=$row['course_id'];
												$course_code=$row['course_code'];
												$title=$row['title'];
												$cradit_unit=$row['cradit_unit'];
											
												echo '
												<tr>
									<td>'.$sn.'</td>
									<td>'.$course_code.'</td>
									<td>'.$cradit_unit.'</td>
									<td><button style="float:right;" id="btn-download" type="button" onclick="addCourseToProgramme('.$course_id.','.$semester.')" class="btn btn-success"><i class="fas fa-plus pull-right"></i></button></td>
								</tr>';
								
								$sn ++;
											}
										}
									}
								?>
							</table>
			<div id="error"></div>
			</div>
			</div>
		</div>
		