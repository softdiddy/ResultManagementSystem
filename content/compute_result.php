<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	
		session_start();
	//error_reporting(0);
	
	if(!isset($_SESSION['phamacy_user_id'])){
		header('location:index.php');
	}
	
	$staff_id=$_SESSION['phamacy_user_id'];

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Result</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	 <section class="content">
      <div class="container-fluid" id="load_sub_content">
	  
	   <div class="row">
          <div class="col-md-12">
				<p><h5>Please Select Course (Curent Session)</h5></p>
		  </div>
		  </div>
		  
        <!-- Info boxes -->
        <div class="row">
			<?php
	$sql_get_courses=mysqli_query($con,"SELECT *FROM staff_courses sc INNER JOIN courses c ON sc.course_id=c.course_id WHERE staff_id='$staff_id'");
    if($sql_get_courses){
        $sql_get_coursesRow=mysqli_num_rows($sql_get_courses);
		if($sql_get_coursesRow > 0){
			while($get=mysqli_fetch_array($sql_get_courses)){
			$course_id=$get['course_id'];
			$course_code=$get['course_code'];
			$semester=$get['semester'];
			
			echo '
				
				 <div class="col-12 col-sm-6 col-md-3"> <a href="#" style="color:green" onclick="load_cumpute_result('.$course_id.','.$semester.')">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><h5>'.$course_code.'</h5></span>
                <span class="info-box-number">';
                  //get number of registered student
				   $sql_get=mysqli_query($con,"SELECT *FROM student_courses_".$current_session." WHERE status='1' AND course_code='$course_code'") or die(mysqli_error($con));
					if($sql_get){
							echo $total_no=mysqli_num_rows($sql_get);
					}
                echo'</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a></div>
			';
		}
	}else{
		echo'<p><b style="color:red;">No record fund</p></b>';
	}
	}
			?>
         
         
         
		   </div>  
          <!-- /.col -->
		  
		 
		</div>
		</section>  
