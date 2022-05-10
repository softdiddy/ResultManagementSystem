<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
	
        
	}else{
        header('location:index.php');
    }
	
    $txtSearchP=$_POST['txtStaff'];
    $sqlGetUserDetails=mysqli_query($con,"SELECT *FROM staff_biodata WHERE number='$txtSearchP'");
        if($sqlGetUserDetails){
            $sqlGetUserDetailsRow=mysqli_num_rows($sqlGetUserDetails);
            if($sqlGetUserDetailsRow > 0){
                //get user id
                $getdata=mysqli_fetch_array($sqlGetUserDetails);
                $fullname=$getdata['first_name'].' '.$getdata['other_names'];
				$login_user=$getdata['number'];	
                $staffIDD=$getdata['id'];				
				
                echo '
                <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
				'. $fullname.'
              </h1>
               
            </div>
           
            <div class="card-body pad">
            <div class="alert alert-success" role="alert" style="width:100%">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    Are you sure you want to make '.$fullname.' ('.$login_user.') a system user ?
                    </hr>
                    <p>You can assign a user privilege(s) to the staff after
                    making the staff a System user, click yes to proceed</p> 
                    <hr/>

                    <button type="button" class="btn btn-success btn-flat" onclick="set_password('.$staffIDD.')">
                        <i class="fas fa-ok fa-md"></i> Yes
                    </button>
            </div>
            </div>
          </div>
        </div>';
            }else{
                echo '<div class="alert alert-danger" role="alert" style="width:100%">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                No Staff Record Found.
              </div>';
            }
        }

?> 
 
        



