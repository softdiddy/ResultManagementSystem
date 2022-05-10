<div class="col-md-12">
	<table class="table"border="1px">
		<tr>
			<td>SN</td>
			<td>Drug</td>
			<td>Drug Formulation</td>
			<td>Drug Strength</td>
			<td>Drug Category</td>
			<td>Manufacturer</td>
		</tr>
	
	<?php
		$sn=1;
					include_once('../includes/connection.php');
					$sqlget_re_order_level=mysqli_query($con,"SELECT *FROM re_order_level rl INNER JOIN drugs d ON rl.drug_id=d.drug_id WHERE status='1'");
							if($sqlget_re_order_level){
								$sqlget_re_order_level_row=mysqli_num_rows($sqlget_re_order_level);
								if($sqlget_re_order_level_row > 0){
									while($sqlget_orderLevel=mysqli_fetch_array($sqlget_re_order_level)){
										$drug_id=$sqlget_orderLevel['drug_id'];
										$drug_name=$sqlget_orderLevel['drug_name'];
										$category_id=$sqlget_orderLevel['category'];
										$drug_type=$sqlget_orderLevel['drug_type'];
										$size=$sqlget_orderLevel['size'];
										$manufacturer=$sqlget_orderLevel['manufacturer'];
										
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
									$drug_type=$sqlgettype['type_name'];
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
							
							
							//get drug manufacturer
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer WHERE id='$manufacturer' AND status='1'");
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
			<td>'.$drug_name.'</td>
			<td>'.$drug_type.'</td>
			<td>'.$drug_size.'</td>
			<td>'.$category.'</td>
			<td>'.$manufacturer.'</td>
		</tr>
									';	
									
									$sn=$sn + 1;
								}
							}
						}
	?>
	
	</table>
</div>