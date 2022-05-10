<?php
error_reporting(0);
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/staff_profile.php');
        include_once('../php/get_curent_session.php');
       
		
	}else{
        header('location:index.php');
    }
	
    $student_id=$_POST['student_id'];
   
    //get student details
    $sql_getSup=mysqli_query($con,"SELECT *FROM student_".$current_session." WHERE id='$student_id'");
    if($sql_getSup){
        $sql_getSup_row=mysqli_num_rows($sql_getSup);
        if($sql_getSup_row > 0){
                while($GetRecord=mysqli_fetch_array($sql_getSup)){
                
                $student_id=$GetRecord['id'];
                $first_name=$GetRecord['first_name'];
                $other_names=$GetRecord['other_names'];
                $surname=$GetRecord['surname'];
                    
                $full_name=$first_name .' '.$other_names.' '.$surname;
                $programme_id =$GetRecord['programme_id'];
                $phone_number=$GetRecord['phone_no'];
                $email=$GetRecord['email'];

                $gender=$GetRecord['gender'];
               
                
    //get number of students
    $sql_get=mysqli_query($con,"SELECT *FROM programmes WHERE id='$programme_id'");
    if($sql_get){
        $sql_getRow=mysqli_num_rows($sql_get);
        if($sql_getRow > 0){
            $data=mysqli_fetch_array($sql_get);
            $title=$data['title'];
        }
    }
}
        }
    } 

    

        //get project details
        $sql_get=mysqli_query($con,"SELECT *FROM student_project WHERE student_id='$student_id'");
        if($sql_get){
            $sql_getRow=mysqli_num_rows($sql_get);
            if($sql_getRow > 0){
                $data=mysqli_fetch_array($sql_get);
                $topic=$data['topic'];
                $file=$data['file'];
    
                $similarityIndex=$data['similarityIndex'];
                $internetSources=$data['internetSources'];
                $publications=$data['publications'];
                $studentPapers=$data['studentPapers'];
            }
        }
        
        

?> 
 <div class="row" style="width:100%">
        <div class="col-md-12" style="width:100%">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h1 class="card-title">
                <?php echo $full_name; ?>
              </h1>
            </div>
            <div class="card-header">
                <h3 class="card-title">
                    <?php
                    if($topic !=""){
                        echo '<a href="">'.$topic.'</a>';
                    }else{
                        echo '<div class="alert alert-danger" role="alert">Project topic not Available</div>';
                    }
                    ?>
                </h3>
              </div>
              <div class="col-md-1" style="float:right;">
        <div class="input-group input-group-sm">
                  
                  <span class="input-group-append">
                    <button type="button" class="btn btn-sucondary btn-flat" onclick="turnitin_cordinator()"><i class="fas fa-arrow-left fa-md"></i>Back</button>
                  </span>
                  
                </div>
        </div>
                <div class="row">
                    <div class="col-md-12" style="width:100%">
                        <div style="width:60%;float:left;">
                            <?php
                                if($file !=""){
                                    echo '<iframe src="http://student.apps.ibbu.edu.ng/uploads/'.$file.'" style="width:100%; height:400px;"/>';
                                }else{
                                    echo '<div class="alert alert-danger" role="alert">No file Uploaded</div>';
      
                                }
                            ?>
                        </div>
                        <div style="width:40%;float:right;">
                            <div class="col-md-12">
                                <div class="thumbnail" style="width:100%">
                           <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Feedback</h3>
                            </div>
                            <div class="panel-body" style="height:40vh;">
                            <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
    
            <div class="panel-collapse " id="collapseOne">
                <div class="panel-body">
                <table class="table">
                                    <tr>
                                        <td width="70%"><b><h5 style="color:green;">
                                            Similarity Index (%)
                                        </h5></b></td>
                                        <td width="30%">
                                            <input type="text" value="<?php echo $similarityIndex; ?>" id="similarityIndex" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="70%"><b><h5 style="color:green;">
                                            Internet Sources (%)
                                        </h5></b></td>
                                        <td width="30%">
                                            <input type="text" value="<?php echo $internetSources; ?>" id="internetSources" class="form-control">
                                        </td>
                                        <tr>
                                        <td width="70%"><b><h5 style="color:green;">
                                            Publications (%)
                                        </h5></b></td>
                                       
                                        <td width="30%">
                                            <input type="text" value="<?php echo $publications; ?>" id="publications" class="form-control">
                                        </td>
                                        <tr>
                                        <td width="70%"><b><h5 style="color:green;">
                                            Student Papers (%)
                                        </h5></b></td>
                                       
                                        <td width="70%">
                                            <input type="text" value="<?php echo $studentPapers; ?>" id="studentPapers" class="form-control">
                                        </td>
                                        
                                        
                                       
                                    </tr>
                                    </tr>
                                    </tr>
                                   
                                </table>
                                
                                 <td width="70%">
                                            <a href="#" class="btn btn-primary btn-lg" role="button" onclick="approveProjectByCordidator(<?php echo $student_id; ?>)">Approve</a>
                                       
                                        </td>
                                        
                                         <td width="70%">
                                            <a href="#" class="btn btn-danger btn-lg" role="button" onclick="declineProjectByCordidator()">Decline</a>
                                        </td>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

                            </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>  
       
	  




