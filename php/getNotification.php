<div class="col-md-12">
	Notification
	<hr/>
	<?php
		//get all notifications
		include_once('../includes/connection.php');
		$sqlgetnotifications=mysqli_query($con,"SELECT *FROM notifications WHERE status='1'");
							if($sqlgetnotifications){
								$sqlgetnotifications_row=mysqli_num_rows($sqlgetnotifications);
								if($sqlgetnotifications_row > 0){
									while($sqlget_s=mysqli_fetch_array($sqlgetnotifications)){
										$notification_title=$sqlget_s['notification_title'];
										$notification_text=$sqlget_s['notification_text'];
										
										echo '<div class="well well-sm" style="width:100%;background-color:#ccc;">
											<div class="col-md-12">
												<b style="color:red;"><u>'.$notification_title.'</u></b><br/>'.$notification_text.'
											</div>
										</div>';
									}
								}else{
									echo '<b style="color:red;"><center>You do not have any unread Notifications</center></b>';
								}
							}
							
							
		$sql_update=mysqli_query($con,"UPDATE notifications SET status='0'");
							
	?>
</div>