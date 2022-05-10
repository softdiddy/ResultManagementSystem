<?php

session_start();
//error_reporting(0);
include_once('../includes/connection.php');


$semester=$_POST['semester'];
$level=$_POST['level'];
$programme=$_POST['programme'];
$session=$_POST['session'];

$registered_course_byid=array();
$registered_course_bycode=array();



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

 
?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12" style="float:left;box-shadow: 5px 10px #888888;overflow:auto;height:500px;">
                <table border="1px" style="width:100%;">
                    <tr>
                        <td width="5%">SN</td>
                        <td width="15%">MATRIC NUMBER</td>
                        <td width="80%">
                        <table border='1px' width="100%">
                        <tr>
                                <td style="margin:0px;padding:0px;white-space:wrap;"><div class="normalText">NSS</div></td>
                                <td style="margin:0px;padding:0px;white-space:rap;"><div style="width:50px" class="normalText">ME</div></td>
                                <td style="margin:0px;padding:0px;white-space:rap;"><div class="normalText">RCU</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div class="normalText">ECU</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div class="normalText">CP</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div class="normalText">GPA</div></td>
                                <td style="margin:0px;padding:0px;white-space: norap;"><div style="width: 40px;" class="normalText">TRCU</div></td>
                                <td style="margin:0px;padding:0px;white-space: norap;"><div style="width: 40px;" class="normalText">TECU</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div style="width: 40px;" class="normalText">TCP</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div style="width: 40px;" class="normalText">CGPA</div></td>
                                <td style="margin:0px;padding:0px;white-space: wrap;"><div style="width: 200px;" class="normalText">OUTSTANDING COURSES</div></td>
                                <td style="margin:0px;padding:0px;white-space: wrap;"><div style="width: 150px;" class="normalText">REMARKS</div></td>
                            </tr>
  
                        </table>
                        </th>
                    </tr>

        
<?php
      //get all the student in this level, in this programm
$get_all_student_level = "select * from student_".$current_session." where level='$level' AND programme_id='$programme'  ORDER BY number";
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
              <table border="1px" width="100%">';
            $sql="SELECT *FROM result_summary_".$current_session." WHERE student_id='$number' AND semester='$semester'";
                $sqlGet=mysqli_query($con,$sql);
                if($sqlGet){
                    $sqlGetRow=mysqli_num_rows($sqlGet);
                    if($sqlGetRow > 0){
                        $getData=mysqli_fetch_array($sqlGet);
                        echo'
                        <tr>
                                <td style="margin:0px;padding:0px;white-space:wrap;"><div class="normalText">'.$getData['NSS'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space:rap;"><div style="width:50px" class="normalText">'.$getData['ME'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space:rap;"><div class="normalText">'.$getData['RCU'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div class="normalText">'.$getData['ECU'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div class="normalText">'.$getData['CP'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div class="normalText">'.$getData['GPA'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div style="width: 40px;" class="normalText">'.$getData['TRCU'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div style="width: 40px;" style="width: 40px;" class="normalText">'.$getData['TECU'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div style="width: 40px;" class="normalText">'.$getData['TCP'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: rap;"><div style="width: 40px;" class="normalText">'.$getData['CGPA'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: wrap;"><div style="width: 200px;" class="normalText">'.$getData['oustanding_courses'].'</div></td>
                                <td style="margin:0px;padding:0px;white-space: wrap;"><div style="width: 150px;" class="normalText">';
                                if($getData['oustanding_courses'] ==""){
                                    echo "Good Standing";
                                }else{
                                    echo "Deficient";
                                }
                                echo'</div></td>
                            </tr>';
                    }
                }
               

          echo'</table>
              </td>
<tr>';

$sn++;


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