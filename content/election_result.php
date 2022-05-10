
  <?php
	session_start();
	//error_reporting(0);
	include_once('../includes/connection.php');
	if(!isset($_SESSION['phamacy_user_id'])){
		header('location:index.php');
	}else{
	
	
		//	include_once('includes/get_drugs_outof_stock.php');
			
	}
include_once('../includes/connection.php');

//get total staff
$sqlTotalStaff=mysqli_query($con,"SELECT *FROM student_2020_2021");
if($sqlTotalStaff){
  $sqlTotalStaffRow=mysqli_num_rows($sqlTotalStaff);
}


$totalVotes=mysqli_query($con,"SELECT DISTINCT(student_id) FROM votes");
if($totalVotes){
  $totalVotesRow=mysqli_num_rows($totalVotes);
}


$yetTovote=$sqlTotalStaffRow-$totalVotesRow;
	
?>
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
                SUMMARY
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

                <p>Total Voters</p>
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
                 <h3><?php echo $totalVotesRow; ?></h3>

                <p>Total Voted</p>
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
                <h3><?php echo $yetTovote; ?></h3>

                <p>Yet to Vote</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
		  
		
	</div>
		  
		  
			</div>
			
			
</div>
</div>
</div>
</section>
</div>

</section>
</div>

<script>
	  setInterval(function() {
    $.post("content/election_result.php",
   function(response){
	   $('#load_content').html(response);
	  
   });
  }, 3000);
</script>