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
                Doctor's Desk
              </h1>
                <div class="card-tools">
            <button type="button" class="btn btn-tool" onclick="load_doctor_desk()">
              <i class="fas fa-backward"></i>Back</button>
           
          </div>
			 
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
             
			
    <div style="background-color:#fff;width:100%;height:600px;overflow:auto" id="searchContent">
    <div class="col-md-12">
	
    <div style="width:30%;float:left;"></div>
    <div style="width:60%;float:right;">
        <div class="input-group input-group-sm" style="margin:3px;">
<input type="text" class="form-control" id="txtSearchP" placeholder="Enter Search Token">

<span class="input-group-append">
<button onclick="" type="button" class="btn btn-success btn-flat"> 
<i class="nav-icon fas fa-search"></i>Search</button>
</span>

<span class="input-group-append">
<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#LoadManageTestRequest" onclick="loadManage_TestRequest()"> 
<i class="nav-icon fas fa-"></i>Manage Test Request</button>
</span>


</div>
    </div>
  </div>
  <div class="col-md-12 my-5">
    <?php
$sn='1';
$sqlGetStudent=mysqli_query($con,"SELECT *FROM patient_information pi INNER JOIN patient_visit pv ON pi.patientID=pv.patient_id WHERE pv.file_position='2' AND pv.status='0' ORDER BY pv.patient_id ") or die(mysqli_error($con));
if($sqlGetStudent){
    $sqlGetStudentRow=mysqli_num_rows($sqlGetStudent);
    if($sqlGetStudentRow > 0){
        echo '
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">SN</th>
                <th width="10%">NHIS NO.</th>
                <th width="15%">PATIENT No.</th>
                <th width="20%">NAME</th>
                <th width="5%">LEVEL</th>
                <th width="10%">PHONE</th>
                <th width="10%">EMAIL</th>
                <th width="10%">DOB</th>
                <th width="5%">GENDER</th>
                <th width="5%"></th>
				<th width="5%"></th>
            </tr>
        </thead>
        <tbody>';
        while($rows=mysqli_fetch_array($sqlGetStudent)){
            $patientID=$rows['patientID'];
            $patientNumber=$rows['patientNumber'];
            $patientName=$rows['patientName'];
            $patientPhone=$rows['patientPhone'];
            $patientEmail=$rows['patientEmail'];
            $patientDOB=$rows['patientDOB'];
            $patientGender=$rows['patientGender'];
            $patientNHIS=$rows['patientNHIS'];
            $patientLevel=$rows['patientLevel'];
			$patient_visit_id=$rows['patient_visit_id'];
            
            echo '<tr>
            <td width="5%">'.$sn.'</td>
            <td width="10%">'.$patientNHIS.'</td>
            <td width="15%">'.$patientNumber.'</td>
            <td width="20%">'.$patientName.'</td>
            <td width="5%">'.$patientLevel.'</td>
            <td width="10%">'.$patientPhone.'</td>
            <td width="10%">'.$patientEmail.'</td>
            <td width="10%">'.$patientDOB.'</td>
            <td width="5%">'.$patientDOB.'</td>
            <td width="5%"><a href="#" style="color:green;" onclick="viewPatientDetails_DV('.$patientID.','.$patient_visit_id.')"> <i class="nav-icon fas fa-search"></i></a></td>
			 <td width="5%"><a href="#" style="color:green;" onclick="closePatientFile('.$patientID.','.$patient_visit_id.')"> <i class="nav-icon fas"></i>Close</a></td>
        </tr>';

        $sn=$sn + 1 ;
        }
       
       echo' </tbody>
    </table>
        ';

    }else{
		echo '<h1><b style="top:200px;color:red;"><center>No Pateint Record</center></b></h1>';
	}
}

    ?>
        
       
    </div>

		</div>	 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  




