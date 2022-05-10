<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		include_once('../includes/staff_profile.php');
		
	}else{
        header('location:index.php');
    }
	
	$UserID=$_POST['user_id'];
	
	 $sqlGetUserDetails=mysqli_query($con,"SELECT *FROM staff_biodata WHERE id='$UserID'");
        if($sqlGetUserDetails){
            $sqlGetUserDetailsRow=mysqli_num_rows($sqlGetUserDetails);
            if($sqlGetUserDetailsRow > 0){
                //get user id
                $getdata=mysqli_fetch_array($sqlGetUserDetails);
                $fullname=$getdata['first_name'].' '.$getdata['other_names'];
				$login_user=$getdata['number'];				
				
            }
        }
?> 
 
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
				<?php echo $fullname.' ( '.$login_user.' ) '."'s"?>  Privileges
              </h1>
               
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
		<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
					<tr>
						<th>Menu</th>
						<th></th>
					</tr>
				<?php
	$sn=1;	
					//get current user prev
$sql_get=mysqli_query($con,"SELECT *FROM staff_side_menu ssm INNER JOIN side_menu sm ON ssm.side_menu_id=sm.side_menu_id WHERE ssm.staff_id='$staff_IDD' AND sm.status='1' ORDER BY sm.sort") or die(mysqli_error($con));
if($sql_get){
	$sql_get_row=mysqli_num_rows($sql_get);
	if($sql_get_row > 0){
		while($data=mysqli_fetch_assoc($sql_get)){
			$side_menu_id=$data['side_menu_id'];
			$function=$data['side_menu_function'];
			$icon=$data['side_menu_icon'];
			$title=$data['side_menu_title'];
			$drop_down=$data['drop_down'];
			
			
					echo'<tr>
						<td>'.$title.'</td>
						<td>
						
							<table class="table nowrap">';
							//get submenu
								$sql_getS=mysqli_query($con,"SELECT *FROM staff_side_sub_menu sssm INNER JOIN side_sub_menu ssm ON sssm.side_sub_menu_id=ssm.side_sub_menu_id WHERE sssm.staff_id='$staff_IDD' AND ssm.side_menu_id='$side_menu_id' ORDER BY ssm.sort") or die(mysqli_error($con));
				if($sql_getS){
					$sql_getS_row=mysqli_num_rows($sql_getS);
					if($sql_getS_row > 0){
						while($dataS=mysqli_fetch_assoc($sql_getS)){
							$side_sub_menu_id=$dataS['side_sub_menu_id'];
							$sub_icon=$dataS['icon'];
							$sub_title=$dataS['title'];
							
								echo'<tr>
									<td>'.$sub_title.'</td>
									<td>';
										
									//chk if the staff has the menu or not
									$sqlCHK=mysqli_query($con,"SELECT *FROM staff_side_sub_menu WHERE side_sub_menu_id='$side_sub_menu_id' AND staff_id='$UserID'");
									if($sqlCHK){
										$sqlCHKRow=mysqli_num_rows($sqlCHK);
										if($sqlCHKRow > 0){
											echo'<a href="#" style="color:red;" onclick="DeAssignPriv('.$side_sub_menu_id.','.$UserID.','.$side_menu_id.')"> <i class="nav-icon fas fa-minus"></i></a>';
										}else{
											echo'<a href="#" style="color:green;" onclick="AssignPriv('.$side_sub_menu_id.','.$UserID.','.$side_menu_id.')"> <i class="nav-icon fas fa-plus"></i></a>';
										}
									}
									echo'</td>
								</tr>';
							
						}
					}
				}
				
				
							echo'</table>
						</td>
					</tr>';
			$sn++;
		}
	}
}
					
				?>
			
				</table>
            </div>
          </div>
        </div>
       
	  




