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

    $token=$_POST['token'];

    $sqlGetStudent=mysqli_query($con,"SELECT *FROM patient_information WHERE status='1' AND patientID='$token'");
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
    
?> 
 <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                 Medical Record
              </h1>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
             <div class="col-md-12">
	
    <div style="width:95%;float:left;"></div>
    <div style="width:5%;float:right;" style="text-align:right">
        <div class="input-group input-group-sm" style="margin:3px;">
<span class="input-group-append">
<button onclick="manage_patients()" type="button" class="btn btn-success btn-flat"> 
<i class="nav-icon fas fa-back"></i>Back</button>
</span>
</div>
    </div>
  </div><hr/>
			
    <div style="background-color:#fff;width:100%;height:400px;overflow:auto" id="searchContent">
			<table width="100%">
                <tr>
                    <td style="width:20%" valign="top">
   <div class="thumbnail">
      <div class="caption">
        <h4><?php echo $patientName;?></h4>
        <p><?php echo $patientNHIS;?></p>
        <p><?php echo $patientGender;?></p>
        <p><?php echo $patientDOB;?></p>
<p>
<?php
	$sqlpatient_visitChk=mysqli_query($con,"SELECT *FROM patient_visit WHERE file_position !='0' AND patient_id='$token'");
    if($sqlpatient_visitChk){
        $sqlpatient_visitChkRow=mysqli_num_rows($sqlpatient_visitChk);
        if($sqlpatient_visitChkRow > 0){
			echo '<p style="color:red;">Patient file is out, you can not create new Encounter at the moment</p>';
		}else{
			echo '<a onclick="createVisit('.$patientID.')" href="#" class="btn btn-primary">New Encounter</a>';
		}
	}
?>
</p>
      </div>
    </div>
                    </td>
                    <td style="width:80%;" valign="top">
                        <h5>Encounter History</h5><hr/>
<?php

$sqlGetVisit=mysqli_query($con,"SELECT *FROM patient_visit WHERE patient_id='$patientID'");
if($sqlGetVisit){
    $sqlGetVisitRow=mysqli_num_rows($sqlGetVisit);
    if($sqlGetVisitRow > 0){
    while($rowVisit=mysqli_fetch_array($sqlGetVisit)){
        $patient_visit_id=$rowVisit['patient_visit_id'];
        $patientID=$rowVisit['patient_id'];
        $Notes=$rowVisit['Notes'];
        $visit_date_time=$rowVisit['visit_date_time'];
        
        echo '<a href="#" style="color:green;" data-toggle="modal" data-target="#showMedical" onclick="LoadMedicalRecord('.$patient_visit_id.','.$patientID.')">
        <div style="width:10%;background-color:#fff;float: left;padding:5px;margin:5px;border-style: double dotted dashed solid ;">
            <img src="images/file2.jpg" style="width:100%"/>
            <p><b><center>'.$visit_date_time.' Visit</center></b></p>
        </div></a>';
    }
}else{
    echo'<p><b style="color:red;">No Record Found</p></b>';
}
}
?>
                    </td>
                </tr>
            </table>
       
    </div>

			 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  
