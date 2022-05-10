<?php
session_start();
include_once('../includes/connection.php');   
include_once('../php/get_curent_session.php');   

require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
$data="";
$sn=1;
$error="";
    $level=$_GET['l'];
    $programme=$_GET['pr'];
    $session=$_GET['sss'];

      //get session
      $sql_get_session=mysqli_query($con,"SELECT *FROM sessions WHERE md5(id)='$session'") or die(mysqli_error($con));
      if($sql_get_session){
          $sql_get_session_row=mysqli_num_rows($sql_get_session);
          if($sql_get_session_row > 0){
              $get=mysqli_fetch_array($sql_get_session);
              $session_title=$get['title'];
              $session_id=$get['id'];
              $currentsession=str_replace("/","_",$session_title);
          }
      }
  
      //get programme
      $sql_get=mysqli_query($con,"SELECT *FROM programmes WHERE md5(id)='$programme'");
      if($sql_get){
          $sql_get_row=mysqli_num_rows($sql_get);
          if($sql_get_row > 0){
              $get=mysqli_fetch_array($sql_get);
              $programm_id=$get['id'];
              $programm_title=$get['title'];
              $programm_code=$get['code'];
              }
          }
      
  
  
if (isset($_POST["import"]))
{
    
	//get course detail
	if(!isset($_GET['l']) || !isset($_GET['pr']) || !isset($_GET['sss'])){	
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
                    $surname = mysqli_real_escape_string($con,$Row[1]);
                }

                
                if(isset($Row[2])) {
                    $firstname = mysqli_real_escape_string($con,$Row[2]);
                }

               
                if(isset($Row[3])) {
                    $othername = mysqli_real_escape_string($con,$Row[3]);
                }

               
                if(isset($Row[4])) {
                    $gender = mysqli_real_escape_string($con,$Row[4]);
                }
				
                if(isset($Row[5])) {
                    $mode_of_entry = mysqli_real_escape_string($con,$Row[5]);
                }
				
                
                if (!empty($number) && !empty($surname) && !empty($firstname) && !empty($gender) && !empty($mode_of_entry)) {
				  
                  //chk if the student exist
                  $sqlChk=mysqli_query($con,"SELECT *FROM student_".$currentsession." WHERE number='$number'");
                  if($sqlChk){
                    $sqlChkRow=mysqli_num_rows($sqlChk);
                    if($sqlChkRow == 0){
                        //insert
                        $sqlInsert=mysqli_query($con,"INSERT INTO student_".$currentsession." (number,surname,first_name,other_names,gender,mode_of_entry,programme_id,level) VALUES('$number','$surname','$firstname','$othername','$gender','$mode_of_entry','$programm_id','$level')");
                      
                    }
                  }
                 

               $sn++;
               $gender = "";
               $number = "";
               $surname = "";
               $firstname = "";
               $othername = "";
               $mode_of_entry="";
                }
             }
        
         }

         $error="Completed Successfully";
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
        
       <h1><?php echo $error;?></h1>
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
    
         

</body>
</html>