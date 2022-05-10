<?php
error_reporting(0);
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('../includes/staff_profile.php');
    include_once('../php/get_curent_session.php');
	}else{
        header('location:index.php');
    }
	
    $session_title="2020_2021";
    $sup_id=$_POST['sup_id'];

    //get the sup details
    $sql_sup_details=mysqli_query($con,"SELECT *FROM staff_biodata WHERE id='$sup_id'");
    if($sql_sup_details){
        $sql_sup_detailsRow=mysqli_num_rows($sql_sup_details);
        if($sql_sup_detailsRow > 0){
                $GetD=mysqli_fetch_array($sql_sup_details);
                $firstname=$GetD['first_name'];
                $othernames=$GetD['other_names'];
        }
    }
?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                  <?php echo $firstname.' '.$othernames;?>
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
              <h1 class="card-title">
               Anti-Plagiarism Approval Desk
              </h1>
              
            </div>
              
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Matric</th>
                    <th>Fullname</th>
                 
                    <th>Phone No.</th>
                    <th>Project Title</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sn=1;
                    	$sql_getSup=mysqli_query($con,"SELECT *FROM turnitin_payments tp INNER JOIN student_".$current_session." sb ON tp.student_id=sb.id ");
						if($sql_getSup){
							$sql_getSup_row=mysqli_num_rows($sql_getSup);
							if($sql_getSup_row > 0){
									while($GetRecord=mysqli_fetch_array($sql_getSup)){
                                    
                                    $student_id=$GetRecord['id'];
									$first_name=$GetRecord['first_name'];
                                    $other_names=$GetRecord['other_names'];
                                    $surname=$GetRecord['surname'];
                                    $number=$GetRecord['number'];
                                        
                                    $fullname=$first_name .' '.$other_names.' '.$surname;
                                    $programme_id =$GetRecord['programme_id'];
                                    $phone_number=$GetRecord['phone_no'];
                                    $email=$GetRecord['email'];

                                    $gender=$GetRecord['gender'];
                                   
                                    
                        //get number of students
                        $sql_get=mysqli_query($con,"SELECT *FROM programmes WHERE id='$programme_id'");
                        if($sql_get){
                            $sql_getRow=mysqli_num_rows($sql_get);
                            if($sql_getRow > 0){
                                $data=mysqli_fetch_array($sql_get);
                                $title=$data['title'];
                            }
                        }
							
                        //get project details
    $sql_get=mysqli_query($con,"SELECT *FROM student_project WHERE student_id='$student_id'");
    if($sql_get){
        $sql_getRow=mysqli_num_rows($sql_get);
        if($sql_getRow > 0){
            $data=mysqli_fetch_array($sql_get);
            $topic=$data['topic'];
            $file=$data['file'];
            $turnitin_status=$data['turnitin_status'];
        }
    }

            if($turnitin_status==1){
                echo' <tr>
                    <td>'.$sn.'</td>
                    <td>'.$number.'</td>
                    <td>'.$fullname.'</td>
    
                   
                    <td>'.$phone_number.'</td>
                    <td>'.$topic.'</td>
                    <td>
                    <button type="button" class="btn btn-info btn-flat" onclick="view_project_details_forApproval('.$student_id.')">
                        <i class="fas fa-eye fa-md"></i> 
                        </button>
                    </td>

                    <td>
                    <button type="button" class="btn btn-success btn-flat" onclick="turnitin_Approval('.$student_id.')">
                        <i class="fas fa-check-circle fa-md"></i> 
                        </button>
                    </td>
                    
                    
                  </tr>';
                  
                  $sn=$sn + 1;
            }
                
                  $topic="";

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
       
	  




