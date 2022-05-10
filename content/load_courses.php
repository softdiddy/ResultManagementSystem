<?php

	include_once('../includes/connection.php');
	
	$programme=$_POST['programme'];
	
	
?>		
	
<div class="card-header">
                <button style="margin-left:2px;float:right;" id="btn-download" type="button" onclick="download_courses()" class="btn btn-success"><i class="fas fa-download pull-right"></i></button>

              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" >
		   <div class="col-md-4" style="float:left;">
		   		<div class="card-header">
					Add New Course
				</div>
				<div class="row mt-2">
					<div class="col-md-12"><input type="text" id="courseCode" class="form-control" placeholder="Course Code"></div>
				</div>

				<div class="row mt-2">
					<div class="col-md-12"><input type="text" id="courseTitle" class="form-control" placeholder="Course Title"></div>
				</div>

				<div class="row mt-2">
					<div class="col-md-12">
						<select class="form-control" id="courseUnit">
							<option></option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
						</select>
					</div>
				</div>
				<div class="error"></div>
				<div class="row mt-2">
					<div class="col-md-12"><button class="btn-success" onclick="AddNewCourse()">Add New</button></div>
				</div>
		   </div>

				<div class="col-md-8" style="float:right;">
					<div>
						<div class="com-md-12" style="max-height:300px;overflow:auto;">
							<table class="table">
								<tr>
									<td>SN</td>
									<td>Title</td>
									<td>Code</td>
									<td>Unit</td>
									<td></td>
								</tr>
								<?php
								$sn=1;
									//get all first semester programme course
									$sqlGet=mysqli_query($con,"SELECT *FROM courses WHERE programme_id='$programme'");
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
									<td>'.$title.'</td>
									<td>'.$course_code.'</td>
									<td>'.$cradit_unit.'</td>
									<td><a style="color:red;" href="#" onclick="delete_course('.$course_id.')"><i class="fas fa-trash pull-right"></i></td>
								</tr>';
								
								$sn ++;
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
			  
