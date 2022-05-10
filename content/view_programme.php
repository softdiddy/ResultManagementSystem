<?php
error_reporting(0);
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
            <h1 class="m-0">Student </h1>
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
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Number of Students</span>
                <span class="info-box-number">
                  <?php echo $total_no_of_student; ?>
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
                <span class="info-box-text">Total Male</span>
                <span class="info-box-number"><?php echo $total_no_of_male_student?> </span>
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
                <span class="info-box-text">Total Female</span>
                <span class="info-box-number"><?php echo $total_no_of_female_student?> </span>
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
		<select class="form-control" id="level">
			<option value="">--- Please Select year</option>
			<option value="U19">100 Level</option>
			<option value="U18">200 Level</option>
			<option value="U17">300 Level</option>
			<option value="U16">400 Level</option>
			<option value="U15">500 Level</option>
		</select>
  </div>
   <div class="form-group">
		<select class="form-control" id="programm">
			<option value="">--- Please Select Programm</option>
			
			<?php
	$sql_get=mysqli_query($con,"SELECT *FROM programmes WHERE status='1'");
    if($sql_get){
        $sql_get_row=mysqli_num_rows($sql_get);
		if($sql_get_row > 0){
			while($get=mysqli_fetch_array($sql_get)){
			$programm_id=$get['id'];
			$programm_title=$get['title'];
			$programm_code=$get['code'];
			
			echo'<option value="'.$programm_code.'">'.$programm_title.'</option>';
		}
	}
	}
			?>
			
		</select>
  </div>
   <div class="form-group">
  <button id="btn-download" type="button" onclick="download_student()" class="btn btn-success"><i class="fas fa-download pull-right"></i>Pull Student Information</button>
	<div id="loading"></div>
</div>

</div>
					
				</div>
            <div class="card" style="top:10px;">
              <div class="card-header">
                <h5 class="card-title">Student Summary by Programm</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" style="height:250px;overflow:auto;">
           <table class="table">
             <tr>
             <td>SN</td>
              <td>Programme</td>
              <td></td>
             </tr>
           
					<?php
          $sn=1;
	$sql_get_programme=mysqli_query($con,"SELECT *FROM programmes WHERE status='1'") or die(mysqli_error($con));
    if($sql_get_programme){
        $sql_get_programmeRow=mysqli_num_rows($sql_get_programme);
		if($sql_get_programmeRow > 0){
			while($get=mysqli_fetch_array($sql_get_programme)){
			$programme_title=$get['title'];
			$programme_id=$get['id'];
			
	
	$sql_get=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE status='1' AND programme_id='$programme_id'") ;
    if($sql_get){
       $no_student=mysqli_num_rows($sql_get);
		$percentage=round($no_student * (100/$total_no_of_student),2);
	}
	

			echo '<tr>
      <td width="5%">'.$sn.'</td>
              <td width="90%">
              <div class="progress-group">
                      '.$programme_title.'
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: '.$percentage.'%"></div>
                      </div>
                    </div>
              </td>
              <td width="5%"><a href="#" class="btn btn-success" onclick="view_programme('.$programme_id.')">View</a></td>
				
			<tr>';
     
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
		  </div>
		  </div>
		  
		</div>
		</section>  
