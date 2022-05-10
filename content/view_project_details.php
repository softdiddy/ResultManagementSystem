<?php
error_reporting(0);
	session_start();
    include_once('../includes/connection.php');
	if(isset($_SESSION['phamacy_user_id'])){
		$phamacy_user_id=$_SESSION['phamacy_user_id'];
		include_once('../includes/staff_profile.php');
		
	}else{
        header('location:index.php');
    }
	
    $student_id=$_POST['student_id'];
    $session_title="2020_2021";
    //get student details
    $sql_getSup=mysqli_query($con,"SELECT *FROM student_".$session_title." WHERE id='$student_id'");
    if($sql_getSup){
        $sql_getSup_row=mysqli_num_rows($sql_getSup);
        if($sql_getSup_row > 0){
                while($GetRecord=mysqli_fetch_array($sql_getSup)){
                $faculty_id=$GetRecord['faculty'];
                $student_id=$GetRecord['id'];
                $first_name=$GetRecord['first_name'];
                $other_names=$GetRecord['other_names'];
                $surname=$GetRecord['surname'];
                    
                $full_name=$first_name .' '.$other_names.' '.$surname;
                $programme_id =$GetRecord['programme_id'];
                $phone_number=$GetRecord['phone_no'];
                $email=$GetRecord['email'];

                $level=$GetRecord['level'];
               
                
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
        
              <div class="col-md-1" style="float:right;">
        <div class="input-group input-group-sm">
                  
                  <span class="input-group-append">
                    <button type="button" class="btn btn-sucondary btn-flat" onclick="turnitinDesk()"><i class="fas fa-arrow-left fa-md"></i>Back</button>
                  </span>
                  
                </div>
        </div>
                <div class="row" style="width:100%">
                    <div class="col-md-12" style="width:100%">
                        <div style="width:60%;float:left;">
                            <?php
                                if($file !=""){
                                    echo '<iframe src="http://turnitin.ibbuapps.com/uploads/'.$file.'" style="width:100%; height:500px;"/>';
                                }else{
                                    echo '<div class="alert alert-danger" role="alert">No file Uploaded</div>';
      
                                }
                            ?>
                        </div>
                        <div style="width:40%;float:right;">
                            <div class="col-md-12">
                                <div class="thumbnail" style="width:100%">
                           <div class="panel panel-default">
                            
                                <table class="table">
                                    <tr>
                                        <td><b><h5 style="color:green;"><?php echo $full_name; ?></h5></b></td>
                                    </tr>
                                    <tr>
                                        <td><b><h5 style="color:green;"><?php echo $level; ?></h5></b></td>
                                    </tr>
                                    <tr>
                                        <td><b><h5 style="color:green;"><?php echo $topic; ?></h5></b></td>
                                    </tr>
                                </table><hr/>

                                <table class="table">
                                    <tr>
                                        <td style="70%"><b><h5 style="color:green;">
                                            Similarity Index (%)
                                        </h5></b></td>
                                        <td style="30%">
                                            <input type="text" value="<?php echo $similarityIndex; ?>" id="similarityIndex" class="form-control" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="70%"><b><h5 style="color:green;">
                                            Internet Sources (%)
                                        </h5></b></td>
                                        <td style="30%">
                                            <input type="text" value="<?php echo $internetSources; ?>" id="internetSources" class="form-control" disabled>
                                        </td>
                                        <tr>
                                        <td style="70%"><b><h5 style="color:green;">
                                            Publications (%)
                                        </h5></b></td>
                                       
                                        <td style="30%">
                                            <input type="text" value="<?php echo $publications; ?>" id="publications" class="form-control" disabled>
                                        </td>
                                        <tr>
                                        <td style="70%"><b><h5 style="color:green;">
                                            Student Papers (%)
                                        </h5></b></td>
                                       
                                        <td style="30%">
                                            <input type="text" value="<?php echo $studentPapers; ?>" id="studentPapers" class="form-control" disabled>
                                        </td>
                                       
                                    </tr>
                                    </tr>
                                    </tr>
                                   
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
       
	  




