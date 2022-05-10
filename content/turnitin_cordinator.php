<?php
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('../includes/staff_profile.php');
	}else{
        header('location:index.php');
    }
	
    $fn="";
    $fno="";
    $e="";
    $p="";

?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
               Anti-Plagiarism Cordinators
              </h1>
              
            </div>
            			  
	
	<div class="row" style="width:100%;">
    <div class="col-md-12" style="height:70vh;overflow:auto;" id="load_page">
		
             <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
               <div class="card">
               
              <div class="card-header">
                <h3 class="card-title">Assigned Faculty Cordinators</h3>
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
                                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="AssignStaffToFaculty()"><i class="fas fa-search fa-md"></i>Assign Staff</button>
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
                    <th>Faculty</th>
                    <th>Code</th>
                    <th>Fno.</th>
                    <th>Name</th>
                    <th> Email</th>
                    <th>Phone Number</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sn=1;

          if($role=="0"){
            $sql_getSup=mysqli_query($con,"SELECT *FROM faculties f INNER JOIN faculty_cordinator fc ON f.faculty_id=fc.faculty_id");
					
          }else{
		
            $sql_getSup=mysqli_query($con,"SELECT *FROM faculties f INNER JOIN faculty_cordinator fc ON f.faculty_id=fc.faculty_id WHERE fc.staff_id='$staff_IDD'");
					
          }
          
          
          
          if($sql_getSup){
							$sql_getSup_row=mysqli_num_rows($sql_getSup);
							if($sql_getSup_row > 0){
									while($GetRecord=mysqli_fetch_array($sql_getSup)){
                  $faculty_id=$GetRecord['faculty_id'];
									$faculty_title=$GetRecord['faculty_title'];
                  $faculty_code=$GetRecord['faculty_code'];
                  $stfid=$GetRecord['staff_id'];
                        

                //get staff details
                $sqlStaff=mysqli_query($con,"SELECT *FROM staff_biodata WHERE id='$stfid'");
                if($sqlStaff){
                    $sqlStaffRow=mysqli_num_rows($sqlStaff);
                    if($sqlStaffRow > 0){
                        $dataa=mysqli_fetch_array($sqlStaff);
                        $fn =$dataa['first_name'] .' '.$dataa['other_names'].' '.$dataa['other_names'];
                        $fno=$dataa['number'];
                        $e=$dataa['email'];
                        $p=$dataa['phone_number'];
                      }
                }

                echo' <tr>
                    <td>'.$sn.'</td>
                    <td>'.$faculty_title.'</td>
                    <td>'.$faculty_code.'</td>
                    <td>'.$fno.'</td>
                    <td>'.$fn.'</td>
                    <td>'.$e.'</td>
                    <td>'.$p.'</td>
                    <td>
                    <button type="button" class="btn btn-info btn-flat" onclick="getListOfStudentUnderFac('.$faculty_id.')">
                        <i class="fas fa-eye fa-md"></i>
                        </button>
                    </td>
                  </tr>';
                  
                  $sn=$sn + 1;
                 $fn ='';
                        $fno='';
                        $e='';
                        $p='';

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



	  




