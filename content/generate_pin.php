<?php
	include_once('../php/get_curent_session.php');
	include_once('../includes/connection.php');
	

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Generate Pin</h1>
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
   
    <input type="text" class="form-control" id="matric_number" placeholder="Matric Number">
  </div>
  
 <div class="form-group">
  <button id="btn-download" type="button" onclick="search_student()" class="btn btn-primary"><i class="fas fa-search pull-right"></i>Search</button>
</div>

</div>
					
				</div>
              <div class="col-md-12" style="height:400px; overflow:auto;" id="loadSearch">
					
                  </div>
		  </div>
		  </div>
		  
		</div>
		</section>  
