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
	
  
    $faculty_id=$_POST['faculty_id'];

  
?> 
 <div class="row" style="width:100%">
 <div class="row" style="width:100%;">
    <div class="col-md-12" id="load_page">
		
             <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
               <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-6" style="text-align:right;float:right;">
        <div class="input-group input-group-sm">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-sucondary btn-flat" onclick="turnitin_cordinator()"><i class="fas fa-arrow-left fa-md"></i>Back</button>
                  </span>
                </div>
				
        </div>
				<h4>List of Student</h4>
                <table id="example1" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Matric</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Project Title</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sn=1;
                    	$sql_getSup=mysqli_query($con,"SELECT *FROM student_".$current_session." s INNER JOIN student_project sp ON s.id=sp.student_id WHERE s.faculty='$faculty_id' AND sp.turnitin_status !='0'");
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
                                    $topic=$GetRecord['topic'];
                                    $file=$GetRecord['file'];
                                    
                        //get number of students
                        $sql_get=mysqli_query($con,"SELECT *FROM programmes WHERE id='$programme_id'");
                        if($sql_get){
                            $sql_getRow=mysqli_num_rows($sql_get);
                            if($sql_getRow > 0){
                                $data=mysqli_fetch_array($sql_get);
                                $title=$data['title'];
                            }
                        }
							
                       

                echo' <tr>
                    <td>'.$sn.'</td>
                    <td>'.$number.'</td>
                    <td>'.$fullname.'</td>
                    <td>'. $gender.'</td>
                    <td>'.$email.'</td>
                    <td>'.$phone_number.'</td>
                    <td>'.$topic.'</td>
                    <td>
                    <button type="button" class="btn btn-info btn-flat" onclick="view_student_project('.$student_id.')">
                        <i class="fas fa-eye fa-md"></i> 
                        </button>
                    </td>
                  </tr>';
                  
                  $sn=$sn + 1;
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
       
	  




