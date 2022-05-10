<?php

session_start();
//error_reporting(0);
include_once('../includes/connection.php');

include_once('../php/get_curent_session.php');


$semester=$_POST['semester'];
$programme=$_POST['programme'];
$token_l=$_POST['level'];

$registered_course_byid=array();
$registered_course_bycode=array();

$token=md5($programme);


   //get registered courses
   $get_all_courses_register ="SELECT * FROM programme_courses_".$current_session." WHERE md5(programme_id)='$token' AND level='$token_l' AND semester='$semester'";
   $get_all_courses_register_query = mysqli_query($con,$get_all_courses_register) or die(mysqli_error($con));
   $get_all_courses_register_num_rows = mysqli_num_rows($get_all_courses_register_query);
   if($get_all_courses_register_num_rows > 0){
   while($get_all_courses_register_arr = mysqli_fetch_array($get_all_courses_register_query)){
   $course_id_reg = $get_all_courses_register_arr['course_id'];
   
   array_push($registered_course_byid,$course_id_reg);
   
   //get the course code
   
   
   }
   }
?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12" style="float:left;box-shadow: 5px 10px #888888;overflow:auto;height:500px;">
                <table border="1px" style="width:100%;">
                    <tr>
                        <th width="5%">SN</th>
                        <th width="15%">MATRIC NUMBER</th>
                        <th width="80%">
                        <table border='1px'>
       <tr>
           <?php
               foreach($registered_course_byid as $course_id ) {
                   //get course code and unit
                   $get_coursedetails = mysqli_query($con,"select * from courses where course_id='$course_id'") OR die(mysqli_error($con));
                   if($get_coursedetails){
                       $get_coursedetails_row=mysqli_num_rows($get_coursedetails);
                       if($get_coursedetails_row > 0 ){
                           $get_course_detailsarr = mysqli_fetch_array($get_coursedetails);
                            $course_unit = $get_course_detailsarr['cradit_unit'];
                            $ccode = $get_course_detailsarr['course_code'];
                       }
                   }
           



                   echo '<th width="60px" style="margin:0px;padding:0px;white-space: nowrap;height:150px"><div class="verticalText">'.$ccode.'('.$course_unit.')</div></th>';
                   
               }
           
           ?>
               
       </tr>
       </table>
                        </th>
                    </tr>

        
<?php
      //get all the student in this level, in this programm
$get_all_student_level = "select * from student_".$current_session." where level='$token_l' AND programme_id='$programme'  ORDER BY number";
$get_all_student_level_query = mysqli_query($con,$get_all_student_level);
$sn=1;
$get_all_student_level_num_rows = mysqli_num_rows($get_all_student_level_query);
if($get_all_student_level_num_rows > 0){
while($get_all_student_level_arr = mysqli_fetch_array($get_all_student_level_query)){
$student_id = $get_all_student_level_arr['id'];
 $number = $get_all_student_level_arr['number'];


 echo '
 <tr>
      <td width="5%">'.$sn.'</td>
                <td width="10%">'.$number.'</td>
              <td width="80%">
              <table border="1px">
              <tr>';
                  
                      foreach($registered_course_byid as $course_id ) {
                          //get course_code
                          $get_coursee = mysqli_query($con,"select * from courses where course_id='$course_id'") OR die(mysqli_error($con));
                          if($get_coursee){
                              $get_courseeRow=mysqli_num_rows($get_coursee);
                              if($get_courseeRow > 0 ){
                                  $getcoursecode = mysqli_fetch_array($get_coursee);
                                 
                                   $code = strtolower($getcoursecode['course_code']);

                              }
                          }
            $sql="SELECT * FROM student_ca_".$current_session." WHERE student_id = '$number' AND course_code='$code'";
            $sql_result_report=mysqli_query($con,$sql) or die(mysqli_error($con));
       if($sql_result_report){
       $sql_result_report_row=mysqli_num_rows($sql_result_report);
       if($sql_result_report_row > 0){
       $get_row=mysqli_fetch_assoc($sql_result_report);
       
       $grade=$get_row['grade'];
       $total=$get_row['total'];
       
       
            }else{
                $grade='-';
                $total='-';
            }
                }

                if($grade=='-'){
                    echo '<td width="60px" style="white-space: nowrap"><div class="normalText">----</div></td>';
                }else{
                    echo '<td width="60px" style="white-space: nowrap"><div class="normalText">'.$grade.'('.$total.')</div></td>';
                }
                

       }
       

                  
                  
                      
             echo' </tr>
              </table>
              </td>
<tr>';

$sn++;
$grade='';
$total='';


}
}
?>
                </table>
        </div>
       
    </div>
</div>


<style>
            .verticalText
            {
                text-align: center;
                vertical-align: middle;
                width: 35px;
                margin: 0px;
                padding: 0px;
           
                padding-top: 10px;
               
                -webkit-transform: rotate(-90deg);
                -moz-transform: rotate(-90deg);                
            }
             .normalText
            {
                text-align: center;
                vertical-align: middle;
                width: 35px;
                margin: 0px;
                padding: 0px;
           
                padding-top: 10px;
                               
            }
           
        </style>