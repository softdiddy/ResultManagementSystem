<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	
	//get total number of student 
	 $sql_get=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE status='1'") or die(mysqli_error($con));
    if($sql_get){
        $total_no_of_student=mysqli_num_rows($sql_get);
	}
	
	//get total number of Male student 
	 $sql_get=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE status='1' AND gender='Male'") or die(mysqli_error($con));
    if($sql_get){
        $total_no_of_male_student=mysqli_num_rows($sql_get);
	}
	
	
	//get total number of Female student 
	 $sql_get=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE status='1' AND gender='Female'") or die(mysqli_error($con));
    if($sql_get){
        $total_no_of_female_student=mysqli_num_rows($sql_get);
	}
	
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Search Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	 <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
          <!-- /.col -->
		  
		  <div class="row">
          <div class="col-md-12">
		 
<div class="d-flex flex-row-reverse bd-highlight">
 <div class="form-inline">
  <div class="form-group">
		<input type="text" id="search" class="form-control" placeholder="Search Student by Matric">
  </div>
 <div class="form-group">
	<button id="btn-download" type="button" onclick="search_student()" class="btn btn-success"><i class="fas fa-search pull-right"></i>Search</button>
	<div id="loading"></div>
 </div>
</div>
					
				</div>
            <div class="card" style="top:10px;">
              <div class="card-header">
                <h5 class="card-title">Recent Searchs</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" id="load_page_contecnt">
					
           </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
		  
		  
		  
		  </div>
		  </div>
		  </div>
		  
		</div>
		</section>  
