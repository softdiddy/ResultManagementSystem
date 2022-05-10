<?php

	include_once('../includes/connection.php');
	
	$programme_id=$_POST['programme_id'];
	$semester=$_POST['semester'];
	
	
	
?>		
	
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" >
				<div class="col-md-12" style="float:left;">
					<div>
						<div class="com-md-12">
						 <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for..." onkeyup="search_course(<?php echo $semester; ?>)" id="course_title">
    </div><!-- /input-group -->
							
						</div>
						
						<div class="com-md-12" id="load_search_course"></div>
					</div>
				</div>
				
           </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
