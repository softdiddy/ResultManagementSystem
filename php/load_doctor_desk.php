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
 <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                Vital Signs
              </h1>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
             
			 <div class="col-md-12">
	
    <div style="width:30%;float:left;"></div>
    <div style="width:60%;float:right;">
        <div class="input-group input-group-sm" style="margin:3px;">
<input type="text" class="form-control" id="txtSearchP" placeholder="Enter Search Token">

<span class="input-group-append">
<button onclick="" type="button" class="btn btn-success btn-flat"> 
<i class="nav-icon fas fa-search"></i>Search</button>
</span>


</div>
    </div>
  </div>
    <div style="background-color:#fff;width:100%;height:400px;overflow:auto" id="searchContent">
   
   
        
       
    </div>

			 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  

