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
	

    $sqlGetStudent=mysqli_query($con,"SELECT *FROM patient_information WHERE  patientID='$token'");
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
   



    $sqlGetVisitDetails=mysqli_query($con,"SELECT *FROM patient_visit_details WHERE  patient_visit_id='$patient_visit_id'");
    if($sqlGetVisitDetails){
        $sqlGetVisitDetailsRow=mysqli_num_rows($sqlGetVisitDetails);
        if($sqlGetVisitDetailsRow > 0){
		$rows=mysqli_fetch_array($sqlGetVisitDetails);
      
        $temp=$rows['temp'];
        $HR=$rows['HR'];
        $Pulse=$rows['Pulse'];
        $BP=$rows['BP'];
        $RR=$rows['RR'];
        $Oxygen=$rows['Oxygen'];
        $PH=$rows['PH'];
        

}
}   
?> 
 <div class="container-fluid" style="color:green">
 
         <div class="col-md-12">
		 

            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
             
              <div class="card-footer">
                <div class="row">
				 
				  
                  <div class="col-sm-2 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $temp; ?></h5>
                      <span class="description-text">Tmp</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-1 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $HR; ?></h5>
                      <span class="description-text">HR</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-2 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $Pulse; ?></h5>
                      <span class="description-text">Pulse</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
				  
				   <div class="col-sm-1 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $BP; ?></h5>
                      <span class="description-text">BP</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
				  
				  
				   <div class="col-sm-2 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $RR; ?></h5>
                      <span class="description-text">RR</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
				  
				  
				   <div class="col-sm-2 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $Oxygen; ?></h5>
                      <span class="description-text">Oxygen</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
				  
				   <div class="col-sm-2 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $PH; ?></h5>
                      <span class="description-text">PH</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
		</div>
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
					<?php
					
	$sqlGetVisit=mysqli_query($con,"SELECT *FROM patient_visit WHERE  patient_id='$token' ORDER BY patient_visit_id  DESC");
    if($sqlGetVisit){
        $sqlGetVisitRow=mysqli_num_rows($sqlGetVisit);
        if($sqlGetVisitRow > 0){
		while($rows=mysqli_fetch_array($sqlGetVisit)){
      
        $patient_visit_id=$rows['patient_visit_id'];
		$visit_date_time=$rows['visit_date_time'];
        $file_position=$rows['file_position'];
        if($file_position=="2"){
			$p='bg-green';
			
		}else{
			$p='bg-gray';
			$function="";
		}
			echo '      <!-- timeline time label -->
              <div class="time-label">
                <span class="'.$p.'">'.$visit_date_time.' Encounter</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                 <i class="fas fa-clock bg-green"></i>
                <div class="timeline-item">
                
                  <div class="timeline-body">
				  <div class="row">';
                   
		//get patient_request		   
			 $sql_Chkpatient_request=mysqli_query($con,"SELECT *FROM patient_request pr INNER JOIN doctors_request dr ON pr.request_id=dr.request_id WHERE pr.encounterID ='$patient_visit_id'");
        if($sql_Chkpatient_request){
            $sql_Chkpatient_requestRow=mysqli_num_rows($sql_Chkpatient_request);
            if($sql_Chkpatient_requestRow > 0){
				while($r=mysqli_fetch_array($sql_Chkpatient_request)){
					
					$request_id=$r['request_id'];
					$request_title=$r['request_title'];
					$status=$r['patient_request_status'];
					
					if($status=='0'){
						$bc='bg-success';
						$c='green';
						$loadButton='<span class="info-box-text"></span><a href="#" data-toggle="modal" data-target="#showLoadInputeLab" onclick="loadTestForm('.$request_id.','.$patient_visit_id.','.$token.')" style="color:'.$c.';">'.$request_title.'</a>';
						
					}else{
						$bc='bg-default';
						$c='#CCC';
						$loadButton='<span class="info-box-text"></span><a href="#"  style="color:'.$c.';">'.$request_title.'</a>';
					}
					
					
				echo '
				  <div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon '.$bc.'"><i class="far fa-copy"></i></span>

              <div class="info-box-content">'.
                $loadButton
             
			 .'</div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
				';

			}
			}
		}
				   
				 
		  
	
                   
         echo'   
		<div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
               <span class="info-box-text"></span><a href="#" data-toggle="modal" data-target="#viewPrescreption" onclick="viewPaitentPrescreption('.$patient_visit_id.')" style="color:green">View Prescreption</a>
             
			</div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		 </div>
				   </div>
                </div>
              </div>
            ';
		}
}
}   
					?>
			  
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->
