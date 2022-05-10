<?php
	$total_cost_stocked=0;
	$total_cost_purchased=0;
	$tottal_cost_moved=0;
	$total_lost=0;
	$cost=0;
	$cost_lost=0;
	$c=1;
	$exp_drugs='';
	include_once('../includes/connection.php');
	$totalCost=0;
	$drug_out_ofStock=array();
		$sql_get=mysqli_query($con,"SELECT *FROM phamacy_store ms INNER JOIN drugs d ON ms.drug_id=d.drug_id");
						
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
									$pack_quantity=$GetDrugs['pack_quantity'];
									$peces_in_pack=$GetDrugs['peces_in_pack'];
									$peces_used=$GetDrugs['peces_used'];
									$drug_stocked_id=$GetDrugs['main_store_id'];
									$status=$GetDrugs['status'];
									$unit_pack_Price=$GetDrugs['unit_pack_Price'];
									
									$cost=$pack_quantity * $unit_pack_Price;
									
									$total_cost_purchased=$total_cost_purchased + $cost;
									
									
									//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' AND status='1'");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' AND status='1'");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drugtype=$sqlgettype['type_name'];
								}
							}
							
							//get drug_size
							$sqlgetsize=mysqli_query($con,"SELECT *FROM drug_size WHERE id='$size' AND status='1'");
							if($sqlgetsize){
								$sqlgetsize_row=mysqli_num_rows($sqlgetsize);
								if($sqlgetsize_row > 0){
									$sqlget_s=mysqli_fetch_array($sqlgetsize);
									$drug_size=$sqlget_s['size_name'];
								}
							}
							
							
							
									if($status==1){
										$cost_instocked=($pack_quantity - $peces_used) * $unit_pack_Price;
										$total_cost_stocked=$total_cost_stocked + $cost_instocked;
									}elseif($status==2){
										$cost_lost=$pack_quantity * $unit_pack_Price;
										$total_lost=$total_lost + $cost_lost;
										$exp_drugs .='
										<tr>
                    <td>'.$c.'</td>
                    <td>'.$drug_name.'</td>
                    <td>'.$category.'</td>
                    <td>'.$drugtype.'</td>
					<td>'.$drug_size.'</td>
                  </tr>
				  
				  
										';
										$c=$c+1;
									}
								}
							}
						}
						
						
						
						
						
		$tottal_cost_moved=0;
		//total drugs given out to student
		$sql_get=mysqli_query($con,"SELECT *FROM patient_drug sd INNER JOIN phamacy_store ps ON sd.drug_id=ps.drug_id");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$drug_id=$GetDrugs['drug_id'];
									$quantity=$GetDrugs['quantity'];
									$unit_pack_Price=$GetDrugs['unit_pack_Price'];
									
									
									//get price of the drug
								$sql_DrugPrice=mysqli_query($con,"SELECT *FROM phamacy_store WHERE drug_id='$drug_id'");
							if($sql_DrugPrice){
								$sql_DrugPrice_row=mysqli_num_rows($sql_DrugPrice);
								if($sql_DrugPrice_row > 0){
									$sqlPrice=mysqli_fetch_array($sql_DrugPrice);
									$unit_pack_Price=$sqlPrice['unit_pack_Price'];
									$peces_in_pack=$sqlPrice['peces_in_pack'];
									
									$pricePerUnit=$unit_pack_Price/$peces_in_pack;
									$tottal_cost_moved=$quantity * $pricePerUnit;
								}
							}
							
							
							$totalCost=$totalCost + $tottal_cost_moved;
									
								}
							}
						}
		
		
		
		
		
		
		
						
						
						$total_cost_purchased = number_format($total_cost_purchased,2,".",",");
						
						$total_cost_stocked=$total_cost_stocked-$totalCost;
						$total_cost_stocked = number_format($total_cost_stocked,2,".",",");
						$total_lost = number_format($total_lost,2,".",",");
						$totalCost = number_format($totalCost,2,".",",");
						
						
						
	//get out_of_stock
	$out_of_stock ="";
	$c=1;

		$sql_get=mysqli_query($con,"SELECT *FROM drug_out_of_phamacy_stock ms INNER JOIN drugs d ON ms.drug_id=d.drug_id");
						
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
									//$pack_quantity=$GetDrugs['pack_quantity'];
									//$peces_in_pack=$GetDrugs['peces_in_pack'];
									//$peces_used=$GetDrugs['peces_used'];
							
							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category WHERE id='$category_id' ");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									$sql_getCat=mysqli_fetch_array($sql_getCategory);
									$category=$sql_getCat['category_name'];
								}
							}
							
							//get drug type
							$sql_gettype=mysqli_query($con,"SELECT *FROM drug_type WHERE id='$drug_type' ");
							if($sql_gettype){
								$sql_gettype_row=mysqli_num_rows($sql_gettype);
								if($sql_gettype_row > 0){
									$sqlgettype=mysqli_fetch_array($sql_gettype);
									$drugtype=$sqlgettype['type_name'];
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
									
									$out_of_stock.='
									<tr>
                    <td>'.$c.'</td>
                    <td>'.$drug_name.'</td>
                    <td>'.$category.'</td>
                    <td>'.$drugtype.'</td>
					<td>'.$drug_size.'</td>
                  </tr>
				  
				  
										';
										$c=$c+1;
									
								}
							}
	}
	
	
?>

<!-- Content Wrapper. Contains page content -->
  <div class="col-md-12" >
    <h1 class="m-0 text-dark">Phamacy Store<hr/></h1>
			<button onclick="load_drugs_in_phamacy_store()" type="button" class="btn btn-primary pull-right">Available drugs in Phamacy Store</button>
			
	<div style="width:100%;" id="load">
    
   <div class="card-footer" style="width:100%;top:0px;">
                <div class="row" style="width:100%;">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"></span>
                      <h5 class="description-header" style="font-size:20px;">N<?php echo $total_cost_purchased; ?></h5>
                      <span class="description-text">TOTAL RECIEVED</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                       <span class="description-percentage text-success"></span>
                      <h5 class="description-header" style="font-size:20px;">N<?php echo $total_cost_stocked; ?></h5>
                      <span class="description-text">TOTAL IN STOCK</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                       <span class="description-percentage text-success"></span>
                      <h5 class="description-header" style="font-size:20px;">N<?php echo $totalCost;?></h5>
                      <span class="description-text">DISPENCED</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                       <span class="description-percentage text-success"></span>
                      <h5 class="description-header" style="font-size:20px;">N<?php echo $total_lost; ?></h5>
                      <span class="description-text">TOTAL EXPAIRED</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
			  
			  
 <div class="row" style="width:100%;padding-top:25px;font-size:10px">
		<div class="col-sm-6 col-6">
			<h5>Out of Stock</h5>
			<table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Drug Name</th>
                    <th>Category</th>
					<th>Formulation</th>
                    <th>Strength</th>
                  </tr>
                  <?php echo $out_of_stock; ?>
				 </table>
		</div>
		<div class="col-sm-6 col-6">
			<h5>Expaired Drugs</h5>
			<table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Drug Name</th>
                    <th>Category</th>
					<th>Formulation</th>
                    <th>Strength</th>
                  </tr>
                  <?php echo $exp_drugs; ?>
				 </table>
		</div>
 
 </div>
 </div>
  </div>