<?php
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('../includes/staff_profile.php');
	}else{
        header('location:index.php');
    }
	

?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
               Project Supervisors
              </h1>
              
            </div>
            			  
	
	<div class="row" style="width:100%;">
    <div class="col-md-12" style="height:80vh;overflow:auto;" id="load_page">
		
             <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
               <div class="card">
               
              <div class="card-header">
                <h3 class="card-title">Existing Suppervisor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
            <?php
                if($role !='2'){
                    echo '
                    <div class="col-md-4" style="float:right;">
                    <div class="input-group input-group-sm">
                              <input type="text" class="form-control" id="txtStaff">
                              <span class="input-group-append">
                                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="load_serach_staff()"><i class="fas fa-search fa-md"></i>Search Staff</button>
                              </span>
                              
                            </div>
                    </div>
                    ';
                }
            ?>

             




                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Fullname</th>
                    <th>D.O.F.A.</th>
                    <th>No. of Students</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sn=1;

          if($role=="0"){
            $sql_getSup=mysqli_query($con,"SELECT *FROM project_supervisor ps INNER JOIN staff_biodata sb ON ps.staff_id=sb.id");
					
          }else{
            $sql_getSup=mysqli_query($con,"SELECT *FROM project_supervisor ps INNER JOIN staff_biodata sb ON ps.staff_id=sb.id WHERE ps.staff_id='$staff_IDD'");
					
          }
          
          
          
          if($sql_getSup){
							$sql_getSup_row=mysqli_num_rows($sql_getSup);
							if($sql_getSup_row > 0){
									while($GetRecord=mysqli_fetch_array($sql_getSup)){
									$first_name=$GetRecord['first_name'];
                                    $other_names=$GetRecord['other_names'];
                                    $fullname=$first_name .' '.$other_names;
                                    $date_of_first_appointment =$GetRecord['date_of_first_appointment'];
                                    $phone_number=$GetRecord['phone_number'];
                                    $email=$GetRecord['email'];
                                    $staffId=$GetRecord['staff_id'];
                                    
                        //get number of students
                        $sql_getNo=mysqli_query($con,"SELECT *FROM student_supervisor WHERE staff_id='$staffId'");
                        if($sql_getNo){
                            $sql_getNoRow=mysqli_num_rows($sql_getNo);
                        }
							

                echo' <tr>
                    <td>'.$sn.'</td>
                    <td>'.$fullname.'</td>
                    <td>'.$date_of_first_appointment.'</td>
                    <td>'. $sql_getNoRow.'</td>
                    <td>'.$email.'</td>
                    <td>'.$phone_number.'</td>
                    <td>
                    <button type="button" class="btn btn-info btn-flat" onclick="view_sup_list('.$staffId.')">
                        <i class="fas fa-eye fa-md"></i>
                        </button>
                    </td>
                  </tr>';
                  
                  $sn=$sn + 1;

                }
            }
                        }
                 ?>
                  
                
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

         </div>
	</div>
            </div>
          </div>
        </div>



	  




