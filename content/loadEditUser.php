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
	
	$user_ID=$_POST['user_ID'];
	$sqlGet=mysqli_query($con,"SELECT *FROM tbl_admin WHERE id='$user_ID'");
        if($sqlGet){
            $sqlGetRow=mysqli_num_rows($sqlGet);
            if($sqlGetRow > 0){
                //get user id
                $get_data=mysqli_fetch_array($sqlGet);
                
				$login_user=$get_data['login_user'];  
				$fullname=$get_data['fullname'];  
				$phone_number=$get_data['phone_number'];  
				$role=$get_data['role'];  
				$email=$get_data['email'];  
            }
        }
?> 

        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
				 Edit Users
              </h1>
               
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
				<div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Username" id="Username" value="<?php echo $login_user; ?>" disabled>
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="FullName" id="fullname" value="<?php echo $fullname; ?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Phone Number" id="phonrNumber" value="<?php echo $phone_number; ?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Email" id="email" value="<?php echo $email; ?>">
                  </div>
				  
				   <div class="form-group">
                    <label for="exampleInputEmail1">User Type</label>
                    <select class="form-control" id="userType">
						<option><?php echo $role; ?></option>
						<option>Sub-Admin</option>
						<option>Nurses</option>
						<option>Doctor</option>
						<option>Lab</option>
						<option>Phamarcist</option>
					</select>
                  </div>
				  
				   <div class="form-group">
                     <button  type="button" class="btn btn-success" style="width:30%" onclick="UsersUpdate(<?php echo $user_ID; ?>)">Update</button>
                  </div>
            </div>
          </div>
        </div>
  




