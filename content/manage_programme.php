<?php
	include_once('../includes/connection.php');
	
	//get staff department
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Programmes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	 <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
          <!-- /.col -->
		  
		  <div class="row">
          <div class="col-md-12">

            <div class="card" style="top:10px;" id="load_courses">
             
<div class="card-header">
                <button style="margin-left:2px;float:right;" id="btn-download" type="button" onclick="download_courses()" class="btn btn-success"><i class="fas fa-download pull-right"></i></button>

              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                <div class="row">
             
           <div class="col-md-12" >
				<div class="col-md-12" style="float:left;">
					<div>
						<div class="com-md-12" style="max-height:410px;overflow:auto;">
							<table class="table">
								<tr>
									<td>SN</td>
									<td>Title</td>
									<td>Code</td>
									<td></td>
								</tr>
								<?php
								$sn=1;
									//get all first semester programme course
									$sqlGet=mysqli_query($con,"SELECT *FROM programmes");
									if($sqlGet){
										$sqlGetRow=mysqli_num_rows($sqlGet);
										if($sqlGetRow > 0){
											while($row=mysqli_fetch_array($sqlGet)){
												
												$id=$row['id'];
												$title=$row['title'];
												$faculty_id=$row['faculty_id'];
                                                $code=$row['code'];
												
												echo '
												<tr>
									<td>'.$sn.'</td>
									<td>'.$title.'</td>
									<td>'.$code.'</td>
									
                                    </tr>';
								
								$sn ++;
											}
										}
									}
								?>
							</table>
						</div>
					</div>
				</div>
           </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
			  

		  </div>
		  </div>
		  </div>
		  
		</div>
		</section>  
