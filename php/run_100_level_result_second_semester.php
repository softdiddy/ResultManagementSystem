<?php

include_once('../includes/connection.php');
	
	$session=$_POST['session'];
	$programme=$_POST['programme'];
	$level='100 Level';
    $semester='2';

    //get session details
    $sql_get_session=mysqli_query($con,"SELECT *FROM sessions WHERE id='$session'") or die(mysqli_error($con));
    if($sql_get_session){
        $sql_get_session_row=mysqli_num_rows($sql_get_session);
		if($sql_get_session_row > 0){
			$get=mysqli_fetch_array($sql_get_session);
			$session_title=$get['title'];
			$session_id=$get['id'];

        }
    }
    

    $current_session=str_replace("/","_",$session_title);

    //get students  
     //get student and CA of the student
     $sql="SELECT *FROM student_".$current_session." WHERE programme_id='$programme' AND level='$level'";
     $sqlStudent=mysqli_query($con,$sql) or die(mysqli_error($con));
     if($sqlStudent){
         $sqlStudentRow=mysqli_num_rows($sqlStudent);
         if($sqlStudentRow > 0){
             while($row=mysqli_fetch_array($sqlStudent)){
                 //get result of a student 
                  $number=$row['number'];
                  $me=$row['mode_of_entry'];

                  //get the courses this student register
                  $sqlGet=mysqli_query($con,"SELECT *FROM programme_courses_".$current_session." pc INNER JOIN courses c ON pc.course_id=c.course_id WHERE pc.programme_id='$programme' AND pc.level='$level' AND pc.semester='$semester'");
                  if($sqlGet){
                      $sqlGetRow=mysqli_num_rows($sqlGet);
                      if($sqlGetRow > 0){
                          while($roww=mysqli_fetch_array($sqlGet)){
                              $id=$roww['id'];
                              $course_id=$roww['course_id'];
                              $course_code=$roww['course_code'];
                              $title=$roww['title'];
                              $cradit_unit=$roww['cradit_unit'];

                              //get the score of the courses
                               //get CA
                $sqlGetCA=mysqli_query($con,"SELECT sum(grade_point) AS totalpoint, sum(cradit_unit) AS RCU FROM student_ca_".$current_session." WHERE student_id='$number' AND semester='$semester'");
				if($sqlGetCA){
					$sqlGetCARow=mysqli_num_rows($sqlGetCA);
					if($sqlGetCARow > 0){
						$rowss=mysqli_fetch_array($sqlGetCA);
						$totalpoint=$rowss['totalpoint'];
						$totalunit=$rowss['RCU'];

                    }
                }


                $sqlGetCA=mysqli_query($con,"SELECT sum(cradit_unit) AS ECU FROM student_ca_".$current_session." WHERE student_id='$number' AND semester='$semester' AND grade !='F'") or die(mysqli_error($con));
				if($sqlGetCA){
					$sqlGetCARow=mysqli_num_rows($sqlGetCA);
					if($sqlGetCARow > 0){
						$rowss=mysqli_fetch_array($sqlGetCA);
						$ECU=$rowss['ECU'];

                    }
                }

                $co="";
                $sqlGetCA=mysqli_query($con,"SELECT *FROM student_ca_".$current_session." WHERE student_id='$number' AND grade ='F'") or die(mysqli_error($con));
				if($sqlGetCA){
					$sqlGetCARow=mysqli_num_rows($sqlGetCA);
					if($sqlGetCARow > 0){
						while($rowsss=mysqli_fetch_array($sqlGetCA)){
						    $course_code=$rowsss['course_code'];
                            $co.=$course_code.',';
                        }
                    }
                }

            
                          }
                      }
                  }
                  
                  if($totalpoint !=0){
                    $gpa=number_format($totalpoint/$totalunit,2);
                  }else{
                    $gpa=0;
                  }
                 
                //save record 
                $slect=mysqli_query($con,"SELECT *FROM result_summary_".$current_session." WHERE student_id='$number' AND semester='$semester'" );
                if($slect){
                    $slectRow=mysqli_num_rows($slect);
                    if($slectRow > 0){
                        //update
                        $sqlUpdate=mysqli_query($con,"UPDATE result_summary_".$current_session." SET RCU='$totalunit',GPA='$gpa',CGPA='$gpa',ME='$me',NSS='1',ECU='$ECU',TRCU='$totalunit',TECU='$ECU',TCP='$totalpoint',CP='$totalpoint' WHERE student_id='$number' AND semester='$semester'") or die(mysqli_error($con));
                        $sqlCOUpdate=mysqli_query($con,"UPDATE result_summary_".$current_session." SET oustanding_courses ='$co' WHERE student_id='$number' AND semester='$semester'") or die(mysqli_error($con));

                     }else{
                        $sqlInsert=mysqli_query($con,"INSERT INTO result_summary_".$current_session." (student_id,semester,RCU,GPA,CGPA,NSS,ME,ECU,TRCU,TECU,TCP,CP) VALUES('$number','$semester','$totalunit','$gpa','$gpa','1','$me','$ECU','$totalunit','$ECU','$totalpoint','$totalpoint')") or die(mysqli_error($con));
                        $sqlCOUpdate=mysqli_query($con,"UPDATE result_summary_".$current_session." SET oustanding_courses ='$co' WHERE student_id='$number' AND semester='$semester'") or die(mysqli_error($con));

                    }
                }
               
                $totalunit=0;
             }
         }
     }
    
?>
