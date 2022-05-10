<?php
session_start();
include_once('../includes/connection.php');   
include_once('../php/get_curent_session.php');   

require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
$data="";
$sn=1;
    $course=$_GET['c'];
    $semester=$_GET['sm'];

   
  
  
if (isset($_POST["import"]))
{
    
	//get course detail
	if(!isset($_GET['c']) || !isset($_GET['sm'])){	
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
                    $course_code = mysqli_real_escape_string($con,$Row[1]);
                }

                if(isset($Row[2])) {
                    $semester = mysqli_real_escape_string($con,$Row[2]);
                }

                
             
                if (!empty($number) && !empty($course_code) && !empty($semester)) {
				  
                  //chk if the student exist
                  $sqlChk=mysqli_query($con,"SELECT *FROM student_courses_".$current_session." WHERE student_id='$number' AND course_code='$course_code'") or die(mysqli_error($con));
                  if($sqlChk){
                    $sqlChkRow=mysqli_num_rows($sqlChk);
                    if($sqlChkRow == 0){
                        //insert
                        $sqlInsert=mysqli_query($con,"INSERT INTO student_courses_".$current_session." (student_id,course_code,semester) VALUES('$number','$course_code','$semester')") or die(mysqli_error($con));
                     
                    }
                  }


                  //insert into ca
    $sql_chk=mysqli_query($con,"SELECT * FROM student_ca_".$current_session." WHERE student_id='$number' AND course_code='$course_code' AND semester='$semester'") or die(mysqli_error($con));
	if($sql_chk){
		$sql_chk_row=mysqli_num_rows($sql_chk);
		if($sql_chk_row == 0){
			//insert
            $sql="INSERT INTO student_ca_".$current_session." (student_id,course_code,ca,exam,total,grade,grade_point,cradit_unit,semester) VALUES('$number','$course_code',0,0,0,'-','0','0','$semester')";
			$sql_insert=mysqli_query($con,$sql);
			
		}
	}


                 

               $sn++;
               
               $number = "";
              
                }
             }
        
         }
         $type = "success";
         $message = "Uploaded Successfully.";
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