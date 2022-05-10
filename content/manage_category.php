 <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Manage Category</h1><hr/>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	 <!-- Main content -->
    <div class="col-md-12">
	
						<div style="width:30%;float:left;"></div>
						<div style="width:60%;float:right;">
							<div class="input-group input-group-sm" style="margin:3px;">
                  <input type="text" class="form-control"  id="txtSearchDrug">
                 
				   <span class="input-group-append">
                    <button onclick="add_new_category()" type="button" class="btn btn-success btn-flat"> <i class="nav-icon fas fa-file-medical"></i>Add Category</button>
                  </span>
				  
				 
                </div>
						</div>
					  </div>
					  
	
	<div class="row" style="width:100%;">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-12" style="height:400px;overflow:auto;">
							 
		  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Available Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" id="dispaly_search_drugs">
                <table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
                    <th>Category Name</th>
					<th>Short Name</th>
					<th></th>
					<th></th>
                  </tr>
                 <?php
				
					$sn=1;
						//get all drug list
							include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM category") or die(mysqli_error($con));
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									
									$category_name=$GetDrugs['category_name'];
									$short_name=$GetDrugs['short_name'];
									
									echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$category_name.'</td>
					<td>'.$short_name.'</td>
					<td><a href="#" style="color:red;">Edit</a></td>
					<td><a href="#" style="color:red;">Delete</a></td>
                  </tr>
				  
				  
									';
									
									$sn=$sn + 1;
									
								}
							}
						}
				
                  ?>
               </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
     	 

                 
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
		
 </div>
