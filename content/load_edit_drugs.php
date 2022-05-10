<?php
	$drug_id=$_POST['drug_id'];
	include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM drugs WHERE drug_status='1' AND drug_id='$drug_id'");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								$GetDrugs=mysqli_fetch_array($sql_get);
									$drug_id=$GetDrugs['drug_id'];
									$drugsize=$GetDrugs['size'];
									$drug_name=$GetDrugs['drug_name'];
									$generic_name=$GetDrugs['generic_name'];
									$drugunit=$GetDrugs['drug_unit'];
									$cat_id=$GetDrugs['category'];
									$manufacturer=$GetDrugs['manufacturer'];
									$description=$GetDrugs['description'];
									$drugtype=$GetDrugs['drug_type'];
								
							}
						}
	
?>

			<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Edit Drug</h3>
              </div>
              <div class="card-body">
				<div class="form-group">
                    <label for="exampleInputEmail1">Drug Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Drug Name" id="drug_nameE" value="<?php echo $drug_name; ?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Drug Category</label>
                    <select class="form-control form-control-sm" id="drug_categoryE">
						<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category") or die(mysqli_error($con));
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									while($sql_getCat=mysqli_fetch_array($sql_getCategory)){
									$category_id=$sql_getCat['id'];
									$category_name=$sql_getCat['category_name'];
									
									if($cat_id==$category_id){
										echo '<option selected value="'.$category_id.'">'.$category_name.'</option>';
									}else{
										echo '<option value="'.$category_id.'">'.$category_name.'</option>';
									}
									
								}
								}
							}
						?>
					</select>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Formulation</label>
                    <select class="form-control form-control-sm" id="drug_typeE">
					<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getdrug_type=mysqli_query($con,"SELECT *FROM drug_type ");
							if($sql_getdrug_type){
								$sql_getdrug_type_row=mysqli_num_rows($sql_getdrug_type);
								if($sql_getdrug_type_row > 0){
									while($sql_getType=mysqli_fetch_array($sql_getdrug_type)){
									$type_id=$sql_getType['id'];
									$type_name=$sql_getType['type_name'];
									
									if($drugtype==$type_id){
										echo '<option selected value="'.$type_id.'">'.$type_name.'</option>';
									}else{
										echo '<option value="'.$type_id.'">'.$type_name.'</option>';
									}
									
								}
								}
							}
						?>
					</select>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Strength</label>
					
                    <select class="form-control form-control-sm" id="drug_sizeE">
					<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getdrug_size=mysqli_query($con,"SELECT *FROM drug_size");
							if($sql_getdrug_size){
								$sql_getdrug_size_row=mysqli_num_rows($sql_getdrug_size);
								if($sql_getdrug_size_row > 0){
									while($sql_getsize=mysqli_fetch_array($sql_getdrug_size)){
									$size_id=$sql_getsize['id'];
									$size_name=$sql_getsize['size_name'];
									
									if($drugsize==$size_id){
										echo '<option selected value="'.$size_id.'">'.$size_name.'</option>';
									}else{
										echo '<option value="'.$size_id.'">'.$size_name.'</option>';
									}
									
								}
								}
							}
						?>
					</select>
                  </div>
				
				<div class="form-group">
                    <label for="exampleInputEmail1">Generic Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Generic Name" id="generic_nameE" value="<?php echo $generic_name; ?>">
                  </div>
				  
				   <div class="form-group">
                    <label for="exampleInputEmail1">Manufacturer</label>
                    <select class="form-control form-control-sm" id="manufacturerE">
						<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer ");
							if($sql_getmanufacturer){
								$sql_getmanufacturer_row=mysqli_num_rows($sql_getmanufacturer);
								if($sql_getmanufacturer_row > 0){
									while($sqlmanufacturer=mysqli_fetch_array($sql_getmanufacturer)){
									$manufacturer_id=$sqlmanufacturer['id'];
									$manufacturer_name=$sqlmanufacturer['manufacturer_name'];
									
									if($manufacturer==$manufacturer_id){
										echo '<option selected value="'.$manufacturer_id.'">'.$manufacturer_name.'</option>';
									}else{
										echo '<option value="'.$manufacturer_id.'">'.$manufacturer_name.'</option>';
									}
									
								}
								}
							}
						?>
					</select>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Description" id="descriptionE" value="<?php echo $description; ?>">
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Unit Pack</label>
                     <input type="text" class="form-control" placeholder="Unit Pack" id="unit_packE" value="<?php echo $drugunit; ?>">
                  </div>
				  
				  
				  <div id="errorEdit"></div>
              </div>
              <!-- /.card-body -->
            </div>
			
			 <div class="modal-footer">
       
        <button onclick="UpdateDrugs(<?php echo $drug_id; ?>)" type="button" class="btn btn-success">Update Record</button>
      </div>