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
?> 

        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
				 Manage Drugs
              </h1>
               
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
				   <div class="col-md-12">
	
						<div style="width:30%;float:left;"></div>
						<div style="width:60%;float:right;">
							<div class="input-group input-group-sm" style="margin:3px;">
                  <input type="text" class="form-control" onkeypress="search_drug()" id="txtSearchDrug">
                 
				   <span class="input-group-append">
                    <button onclick="add_new_drugs()" type="button" class="btn btn-success btn-flat"> <i class="nav-icon fas fa-file-medical"></i>Add New</button>
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
                  <div class="col-md-12" style="height:600px;overflow:auto;">
							 
		  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Available Drug List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" id="dispaly_search_drugs">
                <table class="table table-striped" style="font-size:12px;">
                  <tr>
                    <th style="width: 10px">SN</th>
					<th><a href="#" title="This is the category of the drugs">CATEGORY</a></th>
                    <th>NAME OF DRUG</th>
					<th>FORMULATION</th>
					 <th>STRENGTH</th>
					<th>GENERIC NAME</th>
					<th>MANUFACTURER</th>
					<th>DESCRIPTION</th>
                    <th>UNIT PACK</th>
					<th></th>
					<th></th>
                  </tr>
                 
					<?php
					$sn=1;
						//get all drug list
						include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM drugs WHERE drug_status='1' ORDER BY drug_id  DESC");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$drug_id=$GetDrugs['drug_id'];
									$size=$GetDrugs['size'];
									$drug_name=$GetDrugs['drug_name'];
									$generic_name=$GetDrugs['generic_name'];
									$drug_unit=$GetDrugs['drug_unit'];
									$category_id=$GetDrugs['category'];
									$manufacturer=$GetDrugs['manufacturer'];
									$description=$GetDrugs['description'];
									$drug_type=$GetDrugs['drug_type'];
									
						

							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drug_type=$sqlgettype['type_name'];
								}
							}
							
							//get drug_size
							$sqlgetsize=mysqli_query($con,"SELECT *FROM drug_size WHERE id='$size'");
							if($sqlgetsize){
								$sqlgetsize_row=mysqli_num_rows($sqlgetsize);
								if($sqlgetsize_row > 0){
									$sqlget_s=mysqli_fetch_array($sqlgetsize);
									$drug_size=$sqlget_s['size_name'];
								}
							}
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' ");
							if($sql_getmanufacturer){
								$sql_getmanufacturer_row=mysqli_num_rows($sql_getmanufacturer);
								if($sql_getmanufacturer_row > 0){
									$sqlgetmanufacturer=mysqli_fetch_array($sql_getmanufacturer);
									$manufacturer=$sqlgetmanufacturer['manufacturer_name'];
								}
							}
							
									echo '
				 <tr>
					<td>'.$sn.'</td>
                    <td>'.$category.'</td>
					<td>'.$drug_name.'</td>
					<td>'.$drug_type.'</td>
					<td>'.$drug_size.'</td>
					<td>'.$generic_name.'</td>
					<td>'.$manufacturer.'</td>
					<td>'.$description.'</td>
					<td>'.$drug_unit.'</td>
					<td><a href="#" style="color:green;"> <i class="nav-icon fas fa-search"></i></a></td>
					<td><a href="#" style="color:green;"> <i class="nav-icon fas fa-search"></i></a></td>
					
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
			
            </div>
          </div>
        </div>
  




