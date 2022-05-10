<?php
error_reporting(0);
	$drug_stocked_id=$_POST['drug_stocked_id'];
	$quantity_to_move=$_POST['quantity_to_move'];
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
									$unit_pack_Price=$GetDrugs['unit_pack_Price'];
									$expired_date=$GetDrugs['expired_date'];
									
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
							
							
					if($quantity_to_move > $peacesRemaining){
						echo "Quantity to be move can not be more than the quantity remaining";
					}elseif($quantity_to_move == $peacesRemaining){
						$sql_addTophamacy_store=mysqli_query($con,"INSERT INTO phamacy_store(main_store_id,drug_id,pack_quantity,unit_pack_Price,peces_in_pack,expired_date) VALUES('$drug_stocked_id','$drug_id','$quantity_to_move','$unit_pack_Price','$peces_in_pack','$expired_date')") or die(mysqli_error($con));
						if($sql_addTophamacy_store){
							$sql_update=mysqli_query($con,"UPDATE main_store SET status='0',peces_used='$quantity_to_move' WHERE main_store_id='$drug_stocked_id'") or die(mysqli_error($con));
							if($sql_update){
								echo "Moved Successfully";
								//out of stock
								$sql_chkOutofStock=mysqli_query($con,"SELECT *FROM drug_out_of_main_stock WHERE drug_id='$drug_id'") or die(mysqli_error($con));
								if($sql_chkOutofStock){
									$sql_chkOutofStock_row=mysqli_num_rows($sql_chkOutofStock);
									if($sql_chkOutofStock_row == 0){
										$sql_addTophamacy_store=mysqli_query($con,"INSERT INTO drug_out_of_main_stock(drug_id) VALUES('$drug_id')") or die(mysqli_error($con));
									}
								}
							}
							
						}
					}elseif($quantity_to_move < $peacesRemaining){
						$sql_addTophamacy_store=mysqli_query($con,"INSERT INTO phamacy_store(main_store_id,drug_id,pack_quantity,unit_pack_Price,peces_in_pack,expired_date) VALUES('$drug_stocked_id','$drug_id','$quantity_to_move','$unit_pack_Price','$peces_in_pack','$expired_date')") or die(mysqli_error($con));
						if($sql_addTophamacy_store){
							$sql_update=mysqli_query($con,"UPDATE main_store SET peces_used='$quantity_to_move' WHERE main_store_id='$drug_stocked_id'") or die(mysqli_error($con));
							if($sql_update){
								echo "Moved Successfully";
							}
							
						}
						
					}

?>