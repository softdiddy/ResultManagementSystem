<?php
error_reporting(0);
session_start();
include_once('../includes/connection.php');   
include_once('../php/get_curent_session.php');   

require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
$data="";
$sn=1;
    $token=$_GET['token'];
   
      //get session
      $sql_get_session=mysqli_query($con,"SELECT *FROM courses WHERE md5(course_id)='$token'") or die(mysqli_error($con));
      if($sql_get_session){
          $sql_get_session_row=mysqli_num_rows($sql_get_session);
          if($sql_get_session_row > 0){
              $get=mysqli_fetch_array($sql_get_session);
              $course_code=$get['course_code'];
              $course_id=$get['course_id'];
              $cradit_unit=$get['cradit_unit'];
             
          }
      }
  
  
  
  
if (isset($_POST["import"]))
{
    
	//get course detail
	if(!isset($_GET['token'])){	
        header("location:../");
	}
    
    
  


    //get level

  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
       $sheetCount = count($Reader->sheets());
      
       
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
               
                if(isset($Row[0])) {
                    $number = mysqli_real_escape_string($con,$Row[0]);
                }
				
              
              
                if(isset($Row[1])) {
                    $code = mysqli_real_escape_string($con,$Row[1]);
                }

              
                if(isset($Row[2])) {
                    $total = mysqli_real_escape_string($con,$Row[2]);
                }

                if(isset($Row[3])) {
                    $semesterr = mysqli_real_escape_string($con,$Row[3]);
                }

                

                
    $sql_get_grade_point="SELECT * FROM grade_point_".$current_session." ";
     $sql_get_grade_point_run=mysqli_query($con,$sql_get_grade_point) or die(mysqli_error($con));
	 if($sql_get_grade_point_run){
		 $sql_get_grade_point_row=mysqli_num_rows($sql_get_grade_point_run);
		 if($sql_get_grade_point_row > 0){
			 while($grade_rows=mysqli_fetch_array($sql_get_grade_point_run)){
			   $min_mark=$grade_rows['min_mark'];
			   $max_mark=$grade_rows['max_mark'];
			   
			   if($total >= $min_mark && $total <= $max_mark){
					$grade=$grade_rows['grade'];
					$point=$grade_rows['g_point'];
					$grade_point=$point * $cradit_unit;
					
			   }
			 }
		 }
	 }

     //chk if course registered or not
     $sqlChk=mysqli_query($con,"SELECT *FROM student_courses_".$current_session." WHERE course_code='$course_code' AND student_id='$number'");
     if($sqlChk){
        $sqlChkRow=mysqli_num_rows($sqlChk);
        if($sqlChkRow > 0){

     if(!$number=="" && !$total=="" && !$code=="" && $total <= 70){
        $sql_chk=mysqli_query($con,"SELECT * FROM student_ca_".$current_session." WHERE student_id='$number' AND course_code='$course_code'");
        if($sql_chk){
            $sql_chk_row=mysqli_num_rows($sql_chk);
            if($sql_chk_row == 0){
                //insert
                $sql_insert=mysqli_query($con,"INSERT INTO student_ca_".$current_session." (student_id,course_code,exam,total,grade,grade_point,cradit_unit,semester) VALUES('$number','$course_code','$total','$total','$grade','$grade_point','$cradit_unit','$semesterr')");
                
            } else{
                $sqll="UPDATE student_ca_".$current_session." SET exam='$total',total='$total',grade='$grade',grade_point='$grade_point',cradit_unit='$cradit_unit' WHERE student_id='$number' AND course_code='$course_code' AND semester='$semesterr'";
                $sql_update=mysqli_query($con,$sqll) or die(mysqli_error($con));
                
            }
        }
     }
  
    }
}
               
             }
        
         }
         $type = "success";
        $message = "File uploaded Successfully.";
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>

<!DOCTYPE html>
<html>    
<head>
<style>    
body {
	font-family: Arial;
	width: 80%;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2>Upload Student</h2>
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Upload</button>
                <a class="btn-submit" href="../dashboard.php">Back</a>
        
            </div>
        
        </form>
        
       
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
    
         

</body>
</html>