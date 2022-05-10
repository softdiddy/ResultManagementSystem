	<?php
				

				
				//session_start();
				//error_reporting(0);
				include_once('includes/connection.php');
				if(!isset($_SESSION['phamacy_user_id'])){
					header('location:index.php');
				}else{
				
						$UID=$_SESSION['phamacy_user_id'];
						include_once('includes/get_drugs_outof_stock.php');
						
				}
			include_once('includes/connection.php');
			


$function="";
$icon ="";
$title="";
$sql_get=mysqli_query($con,"SELECT *FROM staff_side_menu ssm INNER JOIN side_menu sm ON ssm.side_menu_id=sm.side_menu_id WHERE  sm.status='1' AND ssm.staff_id='$UID' ORDER BY sm.sort") or die(mysqli_error($con));
if($sql_get){
	$sql_get_row=mysqli_num_rows($sql_get);
	if($sql_get_row > 0){
		while($data=mysqli_fetch_assoc($sql_get)){
			$side_menu_id=$data['side_menu_id'];
			$function=$data['side_menu_function'];
			$icon=$data['side_menu_icon'];
			$title=$data['side_menu_title'];
			$drop_down=$data['drop_down'];

			
			echo '
			 <li class="nav-item has-treeview">
            <a href="#" class="nav-link" onlick="'.$function.'">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                '.$title.'
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">';
			$sql_getS=mysqli_query($con,"SELECT *FROM staff_side_sub_menu sssm INNER JOIN side_sub_menu ssm ON sssm.side_sub_menu_id=ssm.side_sub_menu_id WHERE ssm.side_menu_id='$side_menu_id' AND sssm.staff_id='$UID' ORDER BY ssm.sort") or die(mysqli_error($con));
				if($sql_getS){
					$sql_getS_row=mysqli_num_rows($sql_getS);
					if($sql_getS_row > 0){
						while($dataS=mysqli_fetch_assoc($sql_getS)){
							$sub_function=$dataS['function'];
							//$sub_icon=$dataS['side_menu_icon'];
							$sub_title=$dataS['title'];
							
			echo '<li class="nav-item">
                <a href="#" class="nav-link" onclick="'.$sub_function.'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>'.$sub_title.'</p>
                </a>
              </li>';
							
						}
					}
				}
			
             
              
           echo'</ul>
          </li>
			';

		}
	}
}

		
?>

         
          
          
    