<?php
	session_start();
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/connection.php');
		//get staff type
		 $sql_login=mysqli_query($con,"SELECT *FROM tbl_admin WHERE id='$phamacy_user_id'");
        if($sql_login){
            $sql_login_row=mysqli_num_rows($sql_login);
            if($sql_login_row > 0){
                //get user id
                $get_data=mysqli_fetch_array($sql_login);
                $user_id=$get_data['id'];  
				$role=$get_data['role'];  
            }
        }
	}else{
        header('location:index.php');
    }
?> 
 <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
				 System Users
              </h1>
               
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
             
			
    <div style="background-color:#fff;width:100%;height:600px;overflow:auto" id="searchContent">
    <div class="col-md-12">
	
    <div style="width:30%;float:left;"></div>
    <div style="width:60%;float:right;">
        <div class="input-group input-group-sm" style="margin:3px;">
<input type="text" class="form-control" id="txtSearchP" placeholder="Enter Search Token">

<span class="input-group-append">
<button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#LoadSearchStaff" onclick="search_Staff()"> 
<i class="nav-icon fas fa-search"></i>Search</button>
</span>


</div>
    </div>
  </div>
  <div class="col-md-12 my-5">
    <?php
$sn='1';
$sqlGetStudent=mysqli_query($con,"SELECT *FROM staff_biodata WHERE password !=''") or die(mysqli_error($con));
if($sqlGetStudent){
    $sqlGetStudentRow=mysqli_num_rows($sqlGetStudent);
    if($sqlGetStudentRow > 0){
        echo '
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">SN</th>
                <th width="10%">Username</th>
                <th width="35%">Fullname</th>
                <th width="20%">Phone Number</th>
                <th width="10%">Email</th>
               
                <th width="5%"></th>
				
				<th width="3%"></th>
            </tr>
        </thead>
        <tbody>';
        while($rows=mysqli_fetch_array($sqlGetStudent)){
            $id=$rows['id'];
            $number=$rows['number'];
           
            $fullname=$rows['first_name'].' '.$rows['other_names'];
            $phone_number=$rows['phone_number'];
            $email=$rows['email'];
           // $delete_status=$rows['delete_status'];
            
            echo '<tr>
            <td width="5%">'.$sn.'</td>
            <td width="10%">'.$number.'</td>
            <td width="35%">'.$fullname.'</td>
            <td width="20%">'.$phone_number.'</td>
            <td width="10%">'.$email.'</td>
           
            <td width="5%"><a href="#" data-toggle="modal" data-target="#showUserPrevelages" style="color:green;" onclick="getUserPrev('.$id.')"> <i class="nav-icon fas fa-info"></i></a></td>
			
			 <td width="5%"><a href="#" style="color:green;" onclick="deleteUser('.$id.')"> <i style="color:red" class="nav-icon fas fa-trash"></i></a></td>
        </tr>';

        $sn=$sn + 1 ;
        }
       
       echo' </tbody>
    </table>
        ';

    }
}

    ?>
        
       
    </div>

		</div>	 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
	  




