<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	
	$course_id=$_POST['course_id'];
	
	
	//get course code
	$sql_get_courses=mysqli_query($con,"SELECT *FROM courses WHERE course_id='$course_id'") or die(mysqli_error($con));
    if($sql_get_courses){
        $sql_get_coursesRow=mysqli_num_rows($sql_get_courses);
		if($sql_get_coursesRow > 0){
			$get=mysqli_fetch_array($sql_get_courses);
			$course_id=$get['course_id'];
			$course_code=$get['course_code'];
			$semester=$get['semester'];
			}
	}
	
	//get total number of student that register the course
	 $sql_get=mysqli_query($con,"SELECT *FROM student_courses_".$current_session." WHERE course_code='$course_code'") or die(mysqli_error($con));
    if($sql_get){
        $total_no_of_student=mysqli_num_rows($sql_get);
	}
	
	//get total number of student result computed
	 $sql_get=mysqli_query($con,"SELECT *FROM student_ca_".$current_session." WHERE course_code='$course_code'") or die(mysqli_error($con));
    if($sql_get){
        $total_result_computed=mysqli_num_rows($sql_get);
	}
	
	
	$yet_to_be_computed=$total_no_of_student-$total_result_computed
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Result <?php echo $course_code; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	 <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Students</span>
                <span class="info-box-number">
                  <?php echo $total_no_of_student; ?>
				  <b id="loading"><a style="color:red;" href="#" onclick="RefreshRegisteredStudent(<?php echo $course_id; ?>)">Download</a></b>
				  <b id="loading"><a style="color:green;" target="_blank" href="upload_result_wiz/uploadRegisteredStudent.php?sm=<?php echo md5($semester).'&c='.md5($course_id).'&s='.$semester; ?>" target="_blank">Upload</a></b>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Computed</span>
                <span class="info-box-number"><?php echo $total_result_computed; ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
		   <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Yet to be Computed</span>
                <span class="info-box-number"><?php echo $yet_to_be_computed; ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		   </div>  
          <!-- /.col -->
		  
		  <div class="row">
          <div class="col-md-12">
		 
				<div class="d-flex flex-row-reverse bd-highlight">
				 <div class="form-inline">
 
  
 <div class="form-group">
  <button id="btn-download" type="button" onclick="submit_result(<?php echo $course_id; ?>)" class="btn btn-primary"><i class="fas fa-save pull-right"></i>Submit</button>
</div>

<div class="form-group" style="margin-left:3px;">
  <a href="upload_result_wiz/?token=<?php echo md5($course_id); ?> " target="_blank" id="btn-download" type="button"  class="btn btn-info"><i class="fas fa-upload pull-right"></i>Upload</a>
</div>

<div class="form-group" style="margin-left:3px;">
  <button id="btn-download" type="button" onclick="compute_result()" class="btn btn-success"><i class="fas fa-backward pull-right"></i>Back</button>
</div>

</div>
					
				</div>
				
				
				
				
            <div class="card" style="top:10px;width:70%;float:left;">
              <div class="card-header">
                <h5 class="card-title">Student Result</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" style="height:400px; overflow:auto;">
					<table class="table">
						<tr>
							<th style="width:5%">SN</th>
							<th style="width:25%">Matric Number</th>
							<th style="width:40%">Name</th>
							<th style="width:10%">C.A</th>
							<th style="width:10%">Exam</th>
							<th style="width:10%">Total</th>
							
						</tr>
						<?php
						$sn=1;
						
							//get student
							$sql="SELECT *FROM student_".$current_session." s INNER JOIN student_courses_".$current_session;
							$sql.=" sc ON s.number=sc.student_id WHERE sc.course_code='$course_code' ORDER BY s.number";
							$sqlStudent=mysqli_query($con,$sql) or die(mysqli_error($con));
							if($sqlStudent){
								$sqlStudentRow=mysqli_num_rows($sqlStudent);
								if($sqlStudentRow > 0){
									while($row=mysqli_fetch_array($sqlStudent)){
										$number=$row['number'];
										$surname=$row['surname'];
						$firstname=$row['first_name'];
						$othername=$row['other_names'];
						
						$student_id=$row['id'];
										
						$fullname=$surname.' '.$firstname.' '.$othername;
										
					

					//get student result
				$sqlGetCA=mysqli_query($con,"SELECT *FROM student_ca_".$current_session." WHERE student_id='$number' AND course_code='$course_code'");
				if($sqlGetCA){
					$sqlGetCARow=mysqli_num_rows($sqlGetCA);
					if($sqlGetCARow > 0){
						$rowss=mysqli_fetch_array($sqlGetCA);
						$ca=$rowss['ca'];
						$exam=$rowss['exam'];
						$total=$rowss['total'];
						$grade=$rowss['grade'];
						
						if($total==""){
							$total=$exam + $ca;
							
						}
						
					}else{
						$ca='0';
						$exam='0';
						$total='0';
						$grade='F';
					}
				}
				
										
										echo '<tr>
											<td style="width:5%">'.$sn.'</td>
											<td style="width:25%">'.$number.'</td>
											<td style="width:40%">'.$fullname.'</td>
											<td style="width:10%"><input type="text" class="form-control" placeholder="CA" value="'.$ca.'" id="ca_'.$student_id.'" onchange="save_ca(this.id,'.$student_id.','.$course_id.','.$semester.')" style="border: 3px solid #555"></td>
											<td style="width:10%"><input type="text" class="form-control" placeholder="Exam" value="'.$exam.'" id="exam_'.$student_id.'" style="border: 3px solid #555" onchange="save_ca(this.id,'.$student_id.','.$course_id.','.$semester.')"></td>
											<td style="width:10%"><input type="text" class="form-control" placeholder="Total" value="'.$total.'" id="total_'.$student_id.'" disabled style="border: 3px solid #555"></td>
									
										</tr>';
										$ca="";
										$exam="";
										$total="";
										$sn++;
									}
								}
							}
						?>
						
					</table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>		  
		  </div>
		  
		  		
            <div class="card" style="top:10px;width:30%;float:right;">
              <div class="card-header">
                <h5 class="card-title">Result Activities</h5>
              </div>
			 </div>
		  
		  
		  
		  </div>
		  </div>
		  
		</div>
		</section>  
