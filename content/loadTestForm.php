<?php
error_reporting(0);
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


//GET patient detals
		$patient_id=$_POST['patient_id'];
		 $sqlGetStudent=mysqli_query($con,"SELECT *FROM patient_information WHERE status='1' AND patientID='$patient_id'");
    if($sqlGetStudent){
        $sqlGetStudentRow=mysqli_num_rows($sqlGetStudent);
        if($sqlGetStudentRow > 0){
    $rows=mysqli_fetch_array($sqlGetStudent);
     $patientID=$rows['patientID'];
        $patientNumber=$rows['patientNumber'];
        $patientName=$rows['patientName'];
        $patientPhone=$rows['patientPhone'];
        $patientEmail=$rows['patientEmail'];
        $patientDOB=$rows['patientDOB'];
        $patientGender=$rows['patientGender'];
        $patientNHIS=$rows['patientNHIS'];
        $patientLevel=$rows['patientLevel'];

}
}

	//get the type of test
	
	$encounterID=$_POST['encounterID'];
	$request_id=$_POST['request_id'];
	 $sqlGetRequestLest=mysqli_query($con,"SELECT *FROM doctors_request WHERE request_id='$request_id'");
        if($sqlGetRequestLest){
            $sqlGetRequestLestRow=mysqli_num_rows($sqlGetRequestLest);
            if($sqlGetRequestLestRow > 0){
                //get user id
                $get=mysqli_fetch_array($sqlGetRequestLest);
                $request_title=$get['request_title'];   
            }
        }
		
		//chk if the record exist or not
	$saveButton=' <span class="time"><a  class="btn btn-success btn-flat" style="size:20px;" href="#" onclick="save_microbiology('.$patientID.','.$request_id.')"><i class="fas fa-save"></i>Save</a></span>';
	 $sqlChk=mysqli_query($con,"SELECT *FROM microbiology_request_investigation WHERE request_id='$request_id' AND patientID='$patientID'");
        if($sqlChk){
            $sqlChkRow=mysqli_num_rows($sqlChk);
            if($sqlChkRow == 0){
				
				$saveButton=' <span class="time"><a  class="btn btn-success btn-flat" style="size:20px;" href="#" onclick="save_microbiology('.$patientID.','.$request_id.','.$encounterID.')"><i class="fas fa-save"></i>Save</a></span>';
			}else{
				$saveButton='';
				
				$getData=mysqli_fetch_array($sqlChk);
				$nature_of_sample=$getData['nature_of_sample'];
				$investigation=$getData['investigation'];
				$sensitive_to=$getData['sensitive_to'];
				$resistance_to=$getData['resistance_to'];
				$medical_lab_note=$getData['medical_lab_note'];
			}
		}
		
	
   
?> 
        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                 <?php echo $request_title; ?> Form / Report
              </h1>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
            
    <div style="background-color:#fff;width:100%;height:600px;overflow:auto" id="loadSubPage">
		<h5><b>Patient Details</b></h5>
		<table class="table">
			<tr>
				<td><b>NAME: <?php echo $patientName; ?></b></td>
				<td><b>NUMBER: <?php echo $patientNumber; ?></b></td>
			</tr>
		</table>
		
		<?php
		
		if($request_title=="Microbiology Request"){
			include_once("load_microbiology_test.php");
		}else{
			include_once("load_general_test.php");
		}
		
		?>
    </div>

			 
            </div>
			
			
          </div>
		 
        </div>
        <!-- /.col-->
      
	  
