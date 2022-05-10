<?php
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
    include_once('../includes/staff_profile.php');
    include_once('../php/get_curent_session.php');
	}else{
        header('location:index.php');
    }
	
    $fn="";
    $fno="";
    $e="";
    $p="";
    $totalPaid=0;
    $sql_getSup=mysqli_query($con,"SELECT *FROM turnitin_payments WHERE status='1'");
    if($sql_getSup){
        $total=mysqli_num_rows($sql_getSup);
        if($total > 0){
          while($r=mysqli_fetch_assoc($sql_getSup)){
            $totalPaid=$totalPaid + $r['Amount'];
          }
        }
    }

    

?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
               Turnitin Payment
              </h1>
              
            </div>
            			  
	<div class="row" style="width:100%;">
    <div class="card-body pad">
             
			 	<div class="row">
	
		  
		   <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                 <h3>N<?php echo number_format($totalPaid); ?></h3>

                <p>Total Amount Paid</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>

		  
 </div>
 
  </div>
    <div class="col-md-12" style="height:80vh;overflow:auto;" id="load_page">
		
             <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
               <div class="card">
               
              <div class="card-header">
                <h3 class="card-title">Payment History</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="height:200px;overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>TID</th>
                    <th>Matric</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Date</th>
                    <th> Amount</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sn=1;

                  $sql_getSup=mysqli_query($con,"SELECT *FROM turnitin_payments WHERE status='1' ORDER BY turnitin_payments_id DESC");
			
          if($sql_getSup){
							$sql_getSup_row=mysqli_num_rows($sql_getSup);
							if($sql_getSup_row > 0){
									while($GetRecord=mysqli_fetch_array($sql_getSup)){
                  $TID=$GetRecord['TID'];
				$date_paid=$GetRecord['date_paid'];
                  $Amount=$GetRecord['Amount'];
                  $student_id=$GetRecord['student_id'];
                        

                //get staff details
                $sqlStaff=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE id='$student_id'");
                if($sqlStaff){
                    $sqlStaffRow=mysqli_num_rows($sqlStaff);
                    if($sqlStaffRow > 0){
                        $dataa=mysqli_fetch_array($sqlStaff);
                        $fn =$dataa['surname'] .' '.$dataa['first_name'].' '.$dataa['other_names'];
                        $matric=$dataa['number'];
                        $e=$dataa['email'];
                        $p=$dataa['phone_no'];
                      }
                }

                echo' <tr>
                    <td>'.$sn.'</td>
                    <td>'.$TID.'</td>
                    <td>'.$matric.'</td>
                    <td>'.$fn.'</td>
                    <td>'.$e.'</td>
                    <td>'.$p.'</td>
                    <td>'.$date_paid.'</td>
                    <td>'.$Amount.'</td>
                    
                   
                  </tr>';
                  
                  $sn=$sn + 1;
                  $fn="";

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



	  




