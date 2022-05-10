<?php
	$drug_stocked_id=$_POST['drug_stocked_id'];
	include_once('../includes/connection.php');
						$sql_get=mysqli_query($con,"SELECT *FROM main_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id WHERE d.drug_status='1' AND ms.status='1' AND main_store_id='$drug_stocked_id'");
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
									$pack_quantity=$GetDrugs['pack_quantity'];
									$peces_in_pack=$GetDrugs['peces_in_pack'];
									$peces_used=$GetDrugs['peces_used'];
									$drug_stocked_id=$GetDrugs['main_store_id'];
									
									$peacesRemaining=$pack_quantity - $peces_used;
									
									//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' ");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							$pR=($peces_used/$pack_quantity) * 100;
							
								}
							}
						

?>
<div class="card card-success" >
              <div class="card-header" style="background-color:#000;">
                <h3 class="card-title" style="background-color:#000;">Move Drug to Phamacy Store</h3>
              </div>
              <div class="card-body">
				 <div class="row">
          <div class="col-md-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo $drug_name; ?> [ <?php echo $generic_name; ?> ]</span>
                <span class="info-box-number">Stocked: <?php echo $pack_quantity; ?>, Left: <?php echo $peacesRemaining; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $pR; ?>%"></div>
                </div>
                <span class="progress-description">
                  <?php echo $category; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
			
              </div>
              <!-- /.card-body -->
			   <div class="row">
				<input id="quantity_to_move" type="text" class="form-control col-md-12" placeholder="Quantity" />
			   </div>
			   <div id="Error"></div>
            </div>
			
			 <div class="modal-footer">
       
        <button onclick="MoveDrugs(<?php echo $drug_stocked_id;?>)" type="button" class="btn btn-primary" style="background-color:#000;">Move</button>
      </div>