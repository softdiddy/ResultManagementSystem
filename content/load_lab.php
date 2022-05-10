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
                 Lab Request
              </h1>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
            
    <div style="background-color:#fff;width:100%;height:600px;overflow:auto" id="loadSubPage">
	<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
		<tr>
			<td>SN</td>
			<td>NUMBER</td>
			<td>NAME</td>
			<td>D.O.B</td>
			<td>GENDER</td>
			<td>TYPE</td>
			<td></td>
		</tr>

<?php
$i=1;
$sqlGet=mysqli_query($con,"SELECT *FROM patient_request pr INNER JOIN patient_visit pv ON pr.encounterID=pv.patient_visit_id WHERE pv.file_position='2' AND pr.patient_request_status='1' AND pv.status !='1'");
if($sqlGet){
    $sqlGetRow=mysqli_num_rows($sqlGet);
    if($sqlGetRow > 0){
    while($rowVisit=mysqli_fetch_array($sqlGet)){
        $visit_date_time=$rowVisit['visit_date_time'];
		$request_id=$rowVisit['request_id'];
		$encounterID=$rowVisit['encounterID'];
		$patient_id=$rowVisit['patient_id'];
		$InvestigationRequested=$rowVisit['InvestigationRequested'];
		
		
		//GET patient detals
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
		//get type of test
		$sqlGetTestType=mysqli_query($con,"SELECT *FROM doctors_request WHERE  request_id='$request_id'");
    if($sqlGetTestType){
        $sqlGetTestTypeRow=mysqli_num_rows($sqlGetTestType);
        if($sqlGetTestTypeRow > 0){
			$GetTpe=mysqli_fetch_array($sqlGetTestType);
			$type=$GetTpe['type'];
			$request_title=$GetTpe['request_title'];
			
			if($type=="lab"){
				echo '
				<tr>
			<td>'.$i.'</td>
			<td>'.$patientNumber.'</td>
			<td>'.$patientName.'</td>
			<td>'.$patientDOB.'</td>
			<td>'.$patientGender.'</td>
			<td>'.$request_title.'</td>
			<td> <span class="time"><a  data-toggle="modal" data-target="#showLoadInputeLab" class="btn btn-success btn-flat" style="size:20px;" href="#" onclick="loadTestForm('.$request_id.','.$encounterID.','.$patient_id.')"><i class="fas fa-info"></i>Inpute</a></span></td>
		</tr>
				';
				
				$i++;
			}else{
				echo'<p><b style="color:red;">No Record Found</p></b>';
			}
			
		}
	}		
		
    }
}
}
?>
	</table>
    </div>

			 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  
