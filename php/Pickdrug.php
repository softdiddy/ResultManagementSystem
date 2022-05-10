 <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Manage Drugs</h1><hr/>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php
	$drug_id=$_POST['drug_id'];
	include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM drugs WHERE drug_status='1' AND drug_id='$drug_id'");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
									$GetDrugs=mysqli_fetch_array($sql_get);
									$drug_id=$GetDrugs['drug_id'];
									$size=$GetDrugs['size'];
									$drug_name=$GetDrugs['drug_name'];
									$generic_name=$GetDrugs['generic_name'];
									$drug_unit=$GetDrugs['drug_unit'];
									$category_id=$GetDrugs['category'];
									$manufacturer=$GetDrugs['manufacturer'];
									$description=$GetDrugs['description'];
									$drug_type=$GetDrugs['drug_type'];
									$pq=$GetDrugs['drug_unit'];
									
						

							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category ");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							
							
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type ");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drug_type=$sqlgettype['type_name'];
								}
							}
							
							//get drug_size
							$sqlgetsize=mysqli_query($con,"SELECT *FROM drug_size ");
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
				}
			}
?>


	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12" style="marging:0px;padding:0px;">
				 <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Name: <span class="float-right badge bg-success"><?php echo $drug_name; ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Category: <span class="float-right badge bg-success"><?php echo $category; ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Formulation: <span class="float-right badge bg-success"><?php echo $drug_type; ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Strength: <span class="float-right badge bg-success"><?php echo $drug_size; ?></span>
                    </a>
                  </li>
				  
                </ul>
              </div>
			</div>
			<div class="col-md-12" style="marging:0px;padding:0px;">
				Quantity: <input type="text" class="form-control" id="quantity" placeholder="Quantity">
				Unit Price
				<div class="input-group input-group-sm">
				 <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">=N=</button>
                  </span>
				  
                  <input type="text" class="form-control" placeholder="Unit Pack Price" id="unitPackPrice">
                 
                </div>
				Unit in Pack
				<input type="text" class="form-control" id="packQuantity" placeholder="Pack Quantity" disabled value="<?php echo $pq; ?>">
				Expiring Date
				<input type="date" class="form-control" id="expired_date"  >
			</div>
			<div id="showError"></div>
		</div>
	</div>
	<div class="modal-footer">
        <button onclick="addNDrugsToMainStore(<?php echo $drug_id; ?>)" type="button" class="btn btn-primary">Add</button>
      </div>