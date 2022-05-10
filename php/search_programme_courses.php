<?php

	include_once('../includes/connection.php');
	
	$session=$_POST['session'];
	$programme=$_POST['programme'];
	$level=$_POST['level'];
	
	$number="";

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
		<div class="card-header">
                <h5 class="card-title"><?php echo $title; ?></h5>
				
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" id="result_error">
				<div class="col-md-6" style="float:left;max-height: 350px; overflow:auto;">
					<div>
						<div class="card-header">
							First Semester<hr/>
							<button style="margin-left:2px;" id="btn-download" type="button" data-toggle="modal" data-target="#myModal" onclick="loadCoursesByProgramme(<?php echo $programme.','.'1'; ?>)" class="btn btn-success"><i class="fas fa-edit"></i> Add</button>
							<button style="margin-left:2px;" id="btn-download" type="button" onclick="runResultWiz(1)" class="btn btn-success"><i class="fad fa-cogs"></i>Run Result Wizard</button>
							<button style="margin-left:2px;" id="btn-download" type="button" onclick="vewResult(1)" class="btn btn-info"><i class="fad fa-cogs"></i>View Grade</button>
							<button style="margin-left:2px;" id="btn-download" type="button" onclick="vewSenet(1)" class="btn btn-primary"><i class="fad fa-cogs"></i>Senet</button>
						
						</div>
						<div class="com-md-12">
							<table class="table">
								<tr>
									<td>SN</td>
									<td>Course</td>
									<td>Unit</td>
									<td>Type</td>
									<td>Assigned to</td>
									<td></td>
								</tr>
								<?php
								$sn=1;
									//get all first semester programme course
									$sqlGet=mysqli_query($con,"SELECT *FROM programme_courses_".$current_session." pc INNER JOIN courses c ON pc.course_id=c.course_id WHERE pc.programme_id='$programm_id' AND pc.level='$level' AND pc.semester='1'");
									if($sqlGet){
										$sqlGetRow=mysqli_num_rows($sqlGet);
										if($sqlGetRow > 0){
											while($row=mysqli_fetch_array($sqlGet)){
												$programm_course_id=$row['id'];
												$course_id=$row['course_id'];
												$course_code=$row['course_code'];
												$title=$row['title'];
												$cradit_unit=$row['cradit_unit'];
												$core=$row['core'];
											
											//chk if the course is assiged
											$sql="SELECT *FROM staff_courses sc INNER JOIN staff_biodata sb ON sc.staff_id=sb.id WHERE sc.course_id='$course_id'";
											$sqlChk=mysqli_query($con,$sql) or die(mysqli_error($con));
											if($sqlChk){
												$sqlChkRow=mysqli_num_rows($sqlChk);
												if($sqlChkRow > 0){
													$sqlGett=mysqli_fetch_array($sqlChk);
													$staff_id=$sqlGett['staff_id'];
													$number=$sqlGett['number'];
												}
											}
												echo '
												<tr>
									<td>'.$sn.'</td>
									<td>'.$course_code.'</td>
									<td>'.$cradit_unit.'</td>
									<td>
										<select id="corev" onchange="setCore(this.value,'.$programm_course_id.')">
											<option></option>';
											if($core==0){
												echo'<option selected value="0">Elective</option>
												<option value="1">Core</option>
												<option value="2">Compulsory Elective</option>';
											}elseif($core==1){
												echo'<option value="0">Elective</option>
												<option selected value="1">Core</option>
												<option value="2">Compulsory Elective</option>';
											}elseif($core==2){
												echo'<option value="0">Elective</option>
												<option value="1">Core</option>
												<option selected value="2">Compulsory Elective</option>';
											}else{
												echo'<option value="0">Elective</option>
												<option value="1">Core</option>
												<option value="2">Compulsory Elective</option>';
											}
											
										echo'</select>
									</td>
									<td><a style="color:red;" href="#" data-toggle="modal" data-target="#generalModel" onclick="asignCourseToStaff('.$course_id.')">'.$number.' <i class="fas fa-edit pull-right"></i></td>
									<td><a style="color:red;" href="#" onclick="removeCourse('.$programm_course_id.')"><i class="fas fa-trash pull-right"></i></td>
								</tr>';
								
								$sn ++;
								$number="";
											}
										}
									}
								?>
							</table>

						</div>
					</div>
					
				</div>
				<div class="col-md-6" style="float:right;max-height: 350px; overflow:auto;">
					<div>
						<div class="card-header">
							Second Semester<hr/>
							<button style="margin-left:2px;" id="btn-download" type="button" data-toggle="modal" data-target="#myModal" onclick="loadCoursesByProgramme(<?php echo $programme.','.'2'; ?>)" class="btn btn-success"><i class="fas fa-edit"></i> Add</button>
							<button style="margin-left:2px;" id="btn-download" type="button" onclick="runResultWiz(2)" class="btn btn-success"><i class="fad fa-cogs"></i>Run Result Wizard</button>
							<button style="margin-left:2px;" id="btn-download" type="button" onclick="vewResult(2)" class="btn btn-info"><i class="fad fa-cogs"></i>View Grade</button>
							<button style="margin-left:2px;" id="btn-download" type="button" onclick="vewSenet(2)" class="btn btn-primary"><i class="fad fa-cogs"></i>Senet</button>
						
						</div>
						<div class="com-md-12">
							<table class="table">
								<tr>
									<td>SN</td>
									<td>Course</td>
									<td>Unit</td>
									<td>Type</td>
									<td>Assigned to</td>
									<td></td>
								</tr>
								<?php
								$sn=1;
									//get all first semester programme course
									$sqlGet=mysqli_query($con,"SELECT *FROM programme_courses_".$current_session." pc INNER JOIN courses c ON pc.course_id=c.course_id WHERE pc.programme_id='$programm_id' AND pc.level='$level' AND pc.semester='2'");
									if($sqlGet){
										$sqlGetRow=mysqli_num_rows($sqlGet);
										if($sqlGetRow > 0){
											while($row=mysqli_fetch_array($sqlGet)){
												$programm_course_id=$row['id'];
												$course_id=$row['course_id'];
												$course_code=$row['course_code'];
												$title=$row['title'];
												$cradit_unit=$row['cradit_unit'];
												$core=$row['core'];
												
													//chk if the course is assiged
											$sql="SELECT *FROM staff_courses sc INNER JOIN staff_biodata sb ON sc.staff_id=sb.id WHERE sc.course_id='$course_id'";
											$sqlChk=mysqli_query($con,$sql) or die(mysqli_error($con));
											if($sqlChk){
												$sqlChkRow=mysqli_num_rows($sqlChk);
												if($sqlChkRow > 0){
													$sqlGett=mysqli_fetch_array($sqlChk);
													$staff_id=$sqlGett['staff_id'];
													$number=$sqlGett['number'];
												}
											}
												echo '
												<tr>
									<td>'.$sn.'</td>
									<td>'.$course_code.'</td>
									<td>'.$cradit_unit.'</td>
									<td>
										<select id="corev2" onchange="setCore2(this.value,'.$programm_course_id.')">
											<option></option>';
											if($core==0){
												echo'<option selected value="0">Elective</option>
												<option value="1">Core</option>
												<option value="2">Compulsory Elective</option>';
											}elseif($core==1){
												echo'<option value="0">Elective</option>
												<option selected value="1">Core</option>
												<option value="2">Compulsory Elective</option>';
											}elseif($core==2){
												echo'<option value="0">Elective</option>
												<option value="1">Core</option>
												<option selected value="2">Compulsory Elective</option>';
											}else{
												echo'<option value="0">Elective</option>
												<option value="1">Core</option>
												<option value="2">Compulsory Elective</option>';
											}
											
										echo'</select>
									</td>
									<td><a style="color:red;" href="#" data-toggle="modal" data-target="#generalModel" onclick="asignCourseToStaff('.$course_id.')" data-toggle="modal" data-target="#assignCourse">'.$number.' <i class="fas fa-edit pull-right"></i></td>
									<td><a style="color:red;" href="#" onclick="removeCourse('.$programm_course_id.')"><i class="fas fa-trash pull-right"></i></td>
								</tr>';
								
								$sn ++;
								$number="";
											}
										}
									}
								?>
							</table>
						</div>
					</div>
				</div>
           </div>
                  <!-- /.col -->
				 
                </div>
				
                <!-- /.row -->
              </div>
			  
			 