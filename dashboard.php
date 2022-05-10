
  <?php
	session_start();
	//error_reporting(0);
	include_once('includes/connection.php');
	if(!isset($_SESSION['phamacy_user_id'])){
		header('location:index.php');
	}else{
	
	        $UID=$_SESSION['phamacy_user_id'];
			include_once('includes/get_drugs_outof_stock.php');
			
	}
include_once('includes/connection.php');

//get total staff
$sqlTotalStaff=mysqli_query($con,"SELECT *FROM staff_biodata WHERE password !=''");
if($sqlTotalStaff){
  $sqlTotalStaffRow=mysqli_num_rows($sqlTotalStaff);
}

//get total Male staff
$sqlTotalMaleStaff=mysqli_query($con,"SELECT *FROM staff_biodata WHERE password !='' AND gender='Male'");
if($sqlTotalMaleStaff){
  $sqlTotalMaleStaffRow=mysqli_num_rows($sqlTotalMaleStaff);
}

//get total Female staff
$sqlTotalFemaleStaff=mysqli_query($con,"SELECT *FROM staff_biodata WHERE password !='' AND gender='Female'");
if($sqlTotalFemaleStaff){
  $sqlTotalFemaleStaffRow=mysqli_num_rows($sqlTotalFemaleStaff);
}


					//get how many time drugs are issued
					$sqlgetIssued=mysqli_query($con,"SELECT *FROM patient_drug");
						if($sqlgetIssued){
							$sqlgetIssued_row=mysqli_num_rows($sqlgetIssued);
						}
						
	$mostUsed="";
	//get how drugs are used
	$sql_get=mysqli_query($con,"SELECT DISTINCT(drug_id) FROM phamacy_store LIMIT 10");
						if($sql_get){
							$sql_get_row=mysqli_num_rows($sql_get);
							if($sql_get_row > 0){
								while($GetDrugs=mysqli_fetch_array($sql_get)){
									$drugid=$GetDrugs['drug_id'];
									
									//get drug name
						$sql_getDrugName=mysqli_query($con,"SELECT *FROM drugs WHERE drug_id='$drugid'");
						if($sql_getDrugName){
							$sql_getDrugName_row=mysqli_num_rows($sql_getDrugName);
							if($sql_getDrugName_row > 0){
									$GetDrugs=mysqli_fetch_array($sql_getDrugName);
									$drug_name=$GetDrugs['drug_name'];
							}
									
									
									
					$sqlget=mysqli_query($con,"SELECT *FROM patient_drug WHERE drug_id='$drugid'");
						if($sqlget){
							$sqlget_row=mysqli_num_rows($sqlget);
							if($sqlget_row > 0){
								$Get=mysqli_fetch_array($sqlget);
									$drug_id=$Get['drug_id'];
									$drug_id=$Get['drug_id'];
									
							}
						}
						
							$TotalUsedofDrug=$sqlget_row;
							$p=round(($TotalUsedofDrug/$sqlgetIssued_row) * 100);
							
							$mostUsed .=' <a href="#" onclick="getAllperOfDrugs()"><div class="progress-group">
                      '.$drug_name.'  -'.$p.'%
                      <span class="float-right"></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: '.$p.'%"></div>
                      </div>
                    </div></a>';
								}
							}
						}
	
						}
						
						
							$sqlgetnotifications=mysqli_query($con,"SELECT *FROM notifications WHERE status='1'");
							if($sqlgetnotifications){
								$sqlgetnotifications_row=mysqli_num_rows($sqlgetnotifications);
								if($sqlgetnotifications_row > 0){
									$color="red";
								}else{
									$color="black";
								}
							}
				
		//get total drugs
		$sql_getDrugName=mysqli_query($con,"SELECT *FROM drugs");
						if($sql_getDrugName){
							$TotalDrugs=mysqli_num_rows($sql_getDrugName);
							
							}
							
	//total visit
					$sqlt=mysqli_query($con,"SELECT *FROM patient_visit");
						if($sqlt){
							$totalVisit=mysqli_num_rows($sqlt);
						}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdLiTE 3</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css">
   <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
   <style>
     .chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 450px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

   </style>
   
</head>
<body class="hold-transition sidebar-mini sidebar-collapse" style="overflow-y:hidden;overflow-x:hidden;">
<!-- Site wrapper -->
<div class="wrapper">
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="images/ibbulogo.jpeg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">IBBUL APPLICATIONS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>
	  
	  	<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		 <?php
			include_once('includes/side_menu.php');
		?>
          
          <li class="nav-header">User</li>
          <li class="nav-item">
            <a href="#" onclick="changePassword()" class="nav-link">
              <i class="nav-icon far fa-key"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="#" class="nav-link" onclick="staff_logout()">
              <i class="nav-icon far fa-key"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
           <!-- Main content -->
    <section class="content" style="height:100vh;width:100%;overflow-y:hidden;overflow-x:hidden;" id="load_content" >
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                DASHBOARD
              </h1>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
             
			 	<div class="row">
				
				<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3><?php echo $sqlTotalStaffRow; ?></h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
		  
		   <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                 <h3><?php echo $sqlTotalMaleStaffRow; ?></h3>

                <p>Male</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
		  
		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $sqlTotalFemaleStaffRow; ?></h3>

                <p>Female</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
		  
		
	
		  
		  
			</div>
			 
    <div style="background-color:#fff;width:100%;height:600px;overflow:auto" id="searchContent">
   
	
		
    </div>

			 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="newDrug" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
			<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">New Drug</h3>
              </div>
              <div class="card-body">
				<div class="form-group">
                    <label for="exampleInputEmail1">Drug Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Drug Name" id="drug_name">
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Drug Category</label>
                    <select class="form-control form-control-sm" id="drug_category">
						<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getCategory=mysqli_query($con,"SELECT *FROM category ");
							if($sql_getCategory){
								$sql_getCategory_row=mysqli_num_rows($sql_getCategory);
								if($sql_getCategory_row > 0){
									while($sql_getCat=mysqli_fetch_array($sql_getCategory)){
									$category_id=$sql_getCat['id'];
									$category_name=$sql_getCat['category_name'];
									
									echo '<option value="'.$category_id.'">'.$category_name.'</option>';
								}
								}
							}
						?>
					</select>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Formulation</label>
                    <select class="form-control form-control-sm" id="drug_type">
					<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getdrug_type=mysqli_query($con,"SELECT *FROM drug_type ");
							if($sql_getdrug_type){
								$sql_getdrug_type_row=mysqli_num_rows($sql_getdrug_type);
								if($sql_getdrug_type_row > 0){
									while($sql_getType=mysqli_fetch_array($sql_getdrug_type)){
									$type_id=$sql_getType['id'];
									$type_name=$sql_getType['type_name'];
									
									echo '<option value="'.$type_id.'">'.$type_name.'</option>';
								}
								}
							}
						?>
					</select>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Strength</label>
					
                    <select class="form-control form-control-sm" id="drug_size">
					<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getdrug_size=mysqli_query($con,"SELECT *FROM drug_size ") or die(mysqli_error($con));
							if($sql_getdrug_size){
								$sql_getdrug_size_row=mysqli_num_rows($sql_getdrug_size);
								if($sql_getdrug_size_row > 0){
									while($sql_getsize=mysqli_fetch_array($sql_getdrug_size)){
									$size_id=$sql_getsize['id'];
									$size_name=$sql_getsize['size_name'];
									
									echo '<option value="'.$size_id.'">'.$size_name.'</option>';
								}
								}
							}
						?>
					</select>
                  </div>
				
				<div class="form-group">
                    <label for="exampleInputEmail1">Generic Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Generic Name" id="generic_name">
                  </div>
				  
				   <div class="form-group">
                    <label for="exampleInputEmail1">Manufacturer</label>
                    <select class="form-control form-control-sm" id="manufacturer">
						<option></option>
						<?php
							include_once('includes/connections.php');
							//get drug categories
							$sql_getmanufacturer=mysqli_query($con,"SELECT *FROM manufacturer ");
							if($sql_getmanufacturer){
								$sql_getmanufacturer_row=mysqli_num_rows($sql_getmanufacturer);
								if($sql_getmanufacturer_row > 0){
									while($sqlmanufacturer=mysqli_fetch_array($sql_getmanufacturer)){
									$manufacturer_id=$sqlmanufacturer['id'];
									$manufacturer_name=$sqlmanufacturer['manufacturer_name'];
									
									echo '<option value="'.$manufacturer_id.'">'.$manufacturer_name.'</option>';
								}
								}
							}
						?>
					</select>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
					<textarea class="form-control form-control-sm" id="description"></textarea>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Unit Pack</label>
                     <input type="text" class="form-control" placeholder="Unit Pack" id="unit_pack">
                  </div>
				  
				  
				  <div id="error"></div>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
      <div class="modal-footer">
        <button onclick="close_new_drugs()" type="button" class="btn btn-default" >Close</button>
        <button onclick="addNDrugs()" type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="Showmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modalBody">
			 <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                Vital Signs
              </h1>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
             
			 <div class="col-md-12">
	
    <div style="width:30%;float:left;"></div>
    <div style="width:60%;float:right;">
        <div class="input-group input-group-sm" style="margin:3px;">
<input type="text" class="form-control" id="txtSearchP" placeholder="Enter Search Token">

<span class="input-group-append">
<button onclick="" type="button" class="btn btn-success btn-flat"> 
<i class="nav-icon fas fa-search"></i>Search</button>
</span>


</div>
    </div>
  </div>
    <div style="background-color:#fff;width:100%;height:400px;overflow:auto" id="searchContent">
   
   
        
       
    </div>

			 
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="showMedical" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header" style="align:left;"> 
        <h4 class="modal-title" id="gridSystemModalLabel">Medical Record</h4>
      </div>

      <div class="modal-body">
        <div class="row" id="loadModalContent">

        </div>
    </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ViwSendToDoc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header" style="align:left;"> 
        <h4 class="modal-title" id="gridSystemModalLabel">New Visit</h4>
      </div>

      <div class="modal-body">
        <div class="row" id="GetContent">

        </div>
    </div>
    </div>
  </div>
</div>

		
<div class="modal fade" id="takeReading" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header" style="align:left;"> 
        <h4 class="modal-title" id="gridSystemModalLabel">Take Reading</h4>
      </div>

      <div class="modal-body">
        <div class="row" id="GetContentR">
			
		</div>
        </div>
    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="requestForm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="GetrequestFormPage">
			
		</div>
        </div>
    </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="showLoadInputeLab" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="GetshowLoadInputeLab">
			
		</div>
        </div>
    </div>
    </div>
  </div>



  <div class="modal fade" id="showUserPrevelages" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="loadUserPrevelages">
			
		</div>
        </div>
    </div>
    </div>
  </div>
  
  
    <div class="modal fade" id="viewPrescreption" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="loadData">
			
		</div>
        </div>
    </div>
    </div>
  </div>
  
  
 <div class="modal fade" id="LoadManageTestRequest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="GetData">
			
		</div>
        </div>
    </div>
    </div>
  </div>


  <div class="modal fade" id="LoadSearchStaff" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="GetLoadSearchStaff">
			
		</div>
        </div>
    </div>
    </div>
  </div>

  <!-- Small modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" id="LoadSerchStaff">
        
    </div>
  </div>
</div>

<div class="modal fade" id="turnitin_assessment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row" id="turnitin_assessment" style="margin-left:100px;">

		    </div>
        </div>
    </div>
    </div>
  </div>


  

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="build/js/main.js"></script>
<script src="build/js/out.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title pull-left" id="myModalLabel">Set Programme Courses</h4>
      </div>
      <div class="modal-body" id="loadCourses">
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title pull-left" id="myModalLabel">Result Wizard</h4>
      </div>
      <div class="modal-body" id="loadCourses">
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="generalModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modelData">
      
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</body>
</html>
