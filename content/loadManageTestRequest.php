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

        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                Manage Test Request
              </h1>
                <div class="card-tools">
            <button type="button" class="btn btn-tool" onclick="load_doctor_desk()">
              <i class="fas fa-home"></i>Close</button>
           
          </div>
			 
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
				<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
			<tr>
				<th>SN</th>
				<th>Request Title</th>
				<th>Type</th>
				<th></th>
				<th></th>
			</tr>
             <?php
	$sn=1;
	$sqlGetTestType=mysqli_query($con,"SELECT *FROM doctors_request");
    if($sqlGetTestType){
        $sqlGetTestTypeRow=mysqli_num_rows($sqlGetTestType);
        if($sqlGetTestTypeRow > 0){
			while($GetTpe=mysqli_fetch_array($sqlGetTestType)){
			
			$type=$GetTpe['type'];
			$request_title=$GetTpe['request_title'];
			$request_id=$GetTpe['request_id'];
			
			
			
			echo '<tr>
				<td>'.$sn.'</td>
				<td>'.$request_title.'</td>
				<td>'.$type.'</td>
				<td><a href="#" style="color:green;" onclick="loaddoctors_requestDetails('.$request_id.')"> <i class="nav-icon fas fa-edit"></i></a></td>
				<td><a href="#" style="color:red;"> <i class="nav-icon fas fa-trash"></i></a></td>
			</tr>';
			
			$sn++;
		}
	}
 }
			 
			 
			 ?>
			</table>
            </div>
          </div>
        </div>
 
	  




