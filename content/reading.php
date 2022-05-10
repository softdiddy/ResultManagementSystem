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
	$patient_visit_id=$_POST['patient_visit_id'];

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
<div class="row mx-5">
				<div class="col-md-12">
					<p>Name: <?php echo $patientName;?></p>
					<p>DOB: <?php echo $patientDOB;?></p>
			</div>	
				
				<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">Temperature</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="temp" placeholder="Temperature">
        <div class="input-group-prepend">
          <div class="input-group-text">&#8451;</div>
        </div>
       
      </div>
    </div>
</div>

<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">Heart Rate</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="HR" placeholder="Heart Rate">
        <div class="input-group-prepend">
          <div class="input-group-text"></div>
        </div>
       
      </div>
    </div>
</div>


<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">Pulse</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="Pulse" placeholder="Pulse">
        <div class="input-group-prepend">
          <div class="input-group-text"></div>
        </div>
       
      </div>
    </div>
</div>


<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">Blood Presure</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="BP" placeholder="Blood Presure">
        <div class="input-group-prepend">
          <div class="input-group-text">&#8451;</div>
        </div>
       
      </div>
    </div>
</div>


<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">Respiratory Rate</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="RR" placeholder="Respiratory Rate">
        <div class="input-group-prepend">
          <div class="input-group-text"></div>
        </div>
       
      </div>
    </div>
</div>



<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">Oxygen Saturation</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="Oxygen" placeholder="Oxygen Saturation">
        <div class="input-group-prepend">
          <div class="input-group-text"></div>
        </div>
       
      </div>
    </div>
</div>


<div class="col-md-12">
				 <div class="col-sm-6 my-2">
      <label class="sr-only" for="inlineFormInputGroupUsername">PH</label>
      <div class="input-group">
	   <input type="text" class="form-control" id="PH" placeholder="PH">
        <div class="input-group-prepend">
          <div class="input-group-text"></div>
        </div>
       
      </div>
    </div>
</div>


<div class="row mx-5">

<button id="saveVitalSigns" onclick="saveVitalSigns(<?php echo $patientID.','.$patient_visit_id; ?>)" type="button" class="btn btn-primary" style="width:200px;"> 
  Save 
</button>
</div>