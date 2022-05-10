<div class="col-md-12">
<table width="100%" border="0px">
		<tr>
			<td width="50%">
			<h5><b>Nature of Sample:</b></h5>
			<div class="input-group">
			<?php
				if($nature_of_sample==""){
					echo '
					 <select class="form-control" id="sample">
			      <option></option>
				  <option>STOOL</option>
				  <option>URINE</option>
				  <option>SWAB</option>
				  <option>SPUTUM</option>
				  <option>BLOOD</option>
				  <option>SERUM</option>
			  </select>
					';
				}else{
					echo '<input type="text" value="'.$nature_of_sample.'" class="form-control" disabled/>';
				}
			?>
             
			</div>
			</td>
			<td width="50%" valign="top">
				<h5><b>Investigation Requested:</b></h5>
				<div class="input-group">
				<?php
				if($investigation==""){
					echo '
					 
			     <select class="form-control" id="investigation">
			      <option></option>
				  <option>MICROSCOPY</option>
				  <option>CULTURE</option>
				  <option>MICROSCOPY/CULTURE/SENSITIVITY</option>
				  <option>GRAM STAIN</option>
				  <option>ANALYSIS</option>
				  <option>ZN STAIN</option>
				  <option>SEMEN ANALYSIS</option>
			  </select>
			 
					';
				}else{
					echo '<input type="text" value="'.$investigation.'" class="form-control" disabled/>';
				}
			?>
               
                </div>
			</td>
		</tr>
	</table>


</div>

<br/><br/><br/>

<div class="col-md-12"><h5><b>REPORT <br/>MICROSCOPY <br/>Culture/Antibiogram</b></h5><hr/></div>


<div class="col-md-12">
<table width="100%" border="0px">
		<tr>
			<td width="50%">
			<h5><b>Sensitive To:</b></h5>
			<?php 
				if($sensitive_to==""){
					echo'
					<div class="input-group">
			
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         1
                        </span>
                      </div>
                      <input type="text" class="form-control" id="sensitiveTo1">
                    </div>
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         2
                        </span>
                      </div>
                      <input type="text" class="form-control" id="sensitiveTo2">
                    </div>
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         3
                        </span>
                      </div>
                      <input type="text" class="form-control" id="sensitiveTo3">
                    </div>
					
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         4
                        </span>
                      </div>
                      <input type="text" class="form-control" id="sensitiveTo4">
                    </div>
			<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         5
                        </span>
                      </div>
                      <input type="text" class="form-control" id="sensitiveTo5">
                    </div>
					
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         6
                        </span>
                      </div>
                      <input type="text" class="form-control" id="sensitiveTo6">
                    </div>
					';
				}else{
					echo'<ul>'.$sensitive_to.'</ul>';
				}
			?>
			
			</td>
			<td width="50%" valign="top">
				<h5><b>Resistant To:</b></h5>
				<?php
					if($resistance_to==""){
						echo '<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         1
                        </span>
                      </div>
                      <input type="text" class="form-control" id="resistantTo1">
                    </div>
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         2
                        </span>
                      </div>
                      <input type="text" class="form-control" id="resistantTo2">
                    </div>
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         3
                        </span>
                      </div>
                      <input type="text" class="form-control" id="resistantTo3">
                    </div>
					
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         4
                        </span>
                      </div>
                      <input type="text" class="form-control" id="resistantTo4">
                    </div>
			<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         5
                        </span>
                      </div>
                      <input type="text" class="form-control" id="resistantTo5">
                    </div>
					
				<div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         6
                        </span>
                      </div>
                      <input type="text" class="form-control" id="resistantTo6">
                    </div>';
					}else{
						echo '<ul>'.$resistance_to.'</ul>';
					}
				?>
			</td>
					
				
				
		</tr>
	</table>

	<br></hr>
					<div class="form-group">
                        <label><b>Medical Lab Scientist Note:</b></label>
						<?php
				if($medical_lab_note==""){
					echo'<textarea class="form-control" rows="3" id="lab_note"></textarea>';
				}else{
					echo '<textarea class="form-control" rows="3" id="lab_note" disabled>'.$medical_lab_note.'</textarea>';
				}
				?>
                        
                      </div>
	
	
	
</div>
 <div id="errorLoading"></div>
			<?php echo $saveButton; ?>
	