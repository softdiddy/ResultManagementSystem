<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		//get staff type
		 $sql_login=mysqli_query($con,"SELECT *FROM tbl_admin WHERE id='$phamacy_user_id'");
        if($sql_login){
            $sql_login_row=mysqli_num_rows($sql_login);
            if($sql_login_row > 0){
                //get user id
                $get_data=mysqli_fetch_array($sql_login);
                $user_id=$get_data['id'];  
				$role=$get_data['role'];  
            }
        }
	}else{
        header('location:index.php');
    }
	

?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
               Manage Stock
              </h1>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
			
			 <div class="col-md-12">
	
						
						<div style="width:40%;float:right;">
							<div class="input-group input-group-sm" style="margin:3px;">
                  
				  <span class="input-group-append">
				   <div class="btn-group">
                    <button type="button" class="btn btn-default">Select Store</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                    </button>
					<div class="dropdown-menu" role="menu">
					<?php
						if($role=="Admin"){
							echo '
							<a class="dropdown-item" href="#" onclick="load_main_store()">Main Drug Store</a>
							<a class="dropdown-item" href="#" onclick="load_phamacy_store()">Phamacy Store</a>
							';
						}else{
							echo '<a class="dropdown-item" href="#" onclick="load_phamacy_store()">Phamacy Store</a>';
						}
					?>
                    
                      
                    </div>
					<?php
						if($role=="Admin"){
							echo '
							<span class="input-group-append">
                    <button onclick="add_drugs_to_main_store()" type="button" class="btn btn-success btn-flat"> <i class="nav-icon fas fa-file-medical"></i>Add Drug to Main Store</button>
                  </span>
				 
							';
						}
					?>
					
                  </span>
                </div>
						</div>
					  </div>
</div>					  
	
	<div class="row" style="width:100%;">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12" style="height:550px;overflow:auto;" id="load_page">
							 
		  <div class="card">
              <div class="card-header">
                <h3 class="card-title"><center><b style="color:green;">Please Select Store</b></center></h3>
              </div>
              <!-- /.card-header -->
              
            </div>
            <!-- /.card -->
     	 

                 
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
	</div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  




