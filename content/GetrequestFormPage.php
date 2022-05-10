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
	
	$encounterID=$_POST['token'];
	$patient_ID=$_POST['patientID'];
	
	
	
	
?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                Request Test
              </h1>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
				<div class="row">
				
<div class="col-md-12">
		<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Type</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  
  $c=1;
		 $sql_GetRequest=mysqli_query($con,"SELECT *FROM doctors_request WHERE status='1'");
        if($sql_GetRequest){
            $sql_GetRequestRow=mysqli_num_rows($sql_GetRequest);
            if($sql_GetRequestRow > 0){
                //get user id
                while($get_data=mysqli_fetch_array($sql_GetRequest)){
                $request_id=$get_data['request_id'];  
				$request_title=$get_data['request_title'];  
				
				//chk if the request has been added or not patient_request
				 $sql_Chkpatient_request=mysqli_query($con,"SELECT *FROM patient_request WHERE encounterID ='$encounterID' AND request_id='$request_id'");
        if($sql_Chkpatient_request){
            $sql_Chkpatient_requestRow=mysqli_num_rows($sql_Chkpatient_request);
            if($sql_Chkpatient_requestRow > 0){
				echo '
	<tr>
      <th scope="row">'.$c.'</th>
      <td>'.$request_title.'</td>
      <td><a  onclick="RemoveRequest('.$request_id.','.$encounterID.','.$patient_ID.')" href="#"><i class="fas fa-minus" style="color:green"></i></a></td>
    </tr>
	
				';
			}else{
				echo '
	<tr>
      <th scope="row">'.$c.'</th>
      <td>'.$request_title.'</td>
      <td><a  onclick="addRequest('.$request_id.','.$encounterID.','.$patient_ID.')" href="#"><i class="fas fa-plus" style="color:green"></i></a></td>
    </tr>
	
				';
			}
		}
				
				
				$c++;
            }
		}
       }
  ?>
  </tbody>
</table>
					</div>
		 
				</div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  




