<?php
	include_once('../includes/connection.php');
	
	//get staff department
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Courses</h1>
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
		<select class="form-control" id="programme_id">
			<option></option>
			<?php
    $sql_get_programme=mysqli_query($con,"SELECT *FROM programmes") or die(mysqli_error($con));
    if($sql_get_programme){
        $sql_get_programmeRow=mysqli_num_rows($sql_get_programme);
		if($sql_get_programmeRow > 0){
			while($get=mysqli_fetch_array($sql_get_programme)){
			$title=$get['title'];
			$id=$get['id'];
			
			echo '<option value="'.$id.'">'.$title.'</option>';
		}
		}
	}
			?>
		</select>
  </div>
  

 <div class="form-group">
	<button style="margin-left:2px;" id="btn-download" type="button" onclick="load_courses()" class="btn btn-success"><i class="fas fa-search pull-right"></i>Search</button>
	
 </div>
</div>
					
				</div>
            <div class="card" style="top:10px;" id="load_courses">
             
		  </div>
		  </div>
		  </div>
		  
		</div>
		</section>  
