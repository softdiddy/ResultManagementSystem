<form id="myForm">
<table width="100%" border="1px">
		<tr>
			<th width="5%">SN</th>
			<th width="95%">Test & Range</th>

			
		</tr>
		
		<?php
$n=1;
 
			//$request_id;
$sqlGet=mysqli_query($con,"SELECT *FROM other_investigation_request_catigory WHERE doctors_request_id='$request_id' AND status='1'");
if($sqlGet){
    $sqlGetRow=mysqli_num_rows($sqlGet);
    if($sqlGetRow > 0){
    while($row=mysqli_fetch_array($sqlGet)){
        $title=$row['title'];
		$investi_category_id=$row['id'];
	echo '<tr>
			<td width="5%">'.$n.'</td>
			<td width="95%">
				<b>'.$title.'</b>
<table width="100%" border="1px">';
$sqlGetDetail=mysqli_query($con,"SELECT *FROM investigation_category_details WHERE investi_category_id='$investi_category_id' AND status='1'");
if($sqlGetDetail){
    $sqlG=mysqli_num_rows($sqlGetDetail);
    if($sqlG > 0){
    while($R=mysqli_fetch_array($sqlGetDetail)){
		$item=$R['item'];
		$mesurement=$R['mesurement'];
		$investigation_category_details_ID=$R['investigation_category_details_ID'];
		
		//chk if the record exist or not
		$sqlChk=mysqli_query($con,"SELECT *FROM patient_other_request_result WHERE request_id='$request_id' AND patient_id='$patientID' AND investigation_cat_details_id='$investigation_category_details_ID'");
        if($sqlChk){
            $sqlChkRow=mysqli_num_rows($sqlChk);
            if($sqlChkRow == 0){
				$Savebtn='<span class="time"><a  class="btn btn-success btn-flat" style="size:20px;" href="#" onclick="save_general_test('.$request_id.','.$patientID.','.$encounterID.')"><i class="fas fa-save"></i>Done</a></span>';
				echo '<tr>
						<td width="70%">'.$item.'</td>
						<td width="30%" style="text-align:right;"><input type="text" class="form-control" placeholder="'.$mesurement.'" onfocusout=handleInput(this,'.$request_id.','.$patientID.','.$investigation_category_details_ID.') /></td>
					</tr>';
			}else{
				$r=mysqli_fetch_array($sqlChk);
				$value=$r['result'];
				echo '<tr>
						<td width="70%">'.$item.'</td>
						<td width="30%" style="text-align:right;"><input value="'.$value.'" type="text" class="form-control" placeholder="'.$mesurement.'" onfocusout=handleInput(this,'.$request_id.','.$patientID.','.$investigation_category_details_ID.') disabled/></td>
					</tr>';
			}
		}
		
		
	}
	}
}
echo'</table>
			</td>
		</tr>';
		
		$n++;
	}
 }
}


		?>
</table>

</form><hr/>

 <div id="errorLoading"></div><hr/>
			<?php echo $Savebtn; ?>

