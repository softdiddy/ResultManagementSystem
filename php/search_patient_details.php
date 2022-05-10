<?php
	session_start();
	include_once('../includes/connection.php');
	if(!isset($_SESSION['phamacy_user_id'])){
		header('location:index.php');
	}
   
    $txtSearchP=$_POST['txtSearchP'];

    $sn='1';
$sqlGetStudent=mysqli_query($con,"SELECT *FROM patient_information WHERE  patientNumber='$txtSearchP' AND status='1' OR patientName='$txtSearchP' AND status='1' OR patientPhone='$txtSearchP' AND status='1' OR patientEmail='$txtSearchP' AND status='1' OR patientNHIS='$txtSearchP' AND status='1' ORDER BY patientID DESC LIMIT 10");
if($sqlGetStudent){
    $sqlGetStudentRow=mysqli_num_rows($sqlGetStudent);
    if($sqlGetStudentRow > 0){
        echo '
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">SN</th>
                <th width="10%">NHIS NO.</th>
                <th width="15%">PATIENT No.</th>
                <th width="20%">NAME</th>
                <th width="5%">LEVEL</th>
                <th width="10%">PHONE</th>
                <th width="10%">EMAIL</th>
                <th width="10%">DOB</th>
                <th width="5%">GENDER</th>
                <th width="10%"></th>
            </tr>      
        </thead>
        <tbody>';
        while($rows=mysqli_fetch_array($sqlGetStudent)){
            $patientID=$rows['patientID'];
            $patientNumber=$rows['patientNumber'];
            $patientName=$rows['patientName'];
            $patientPhone=$rows['patientPhone'];
            $patientEmail=$rows['patientEmail'];
            $patientDOB=$rows['patientDOB'];
            $patientGender=$rows['patientGender'];
            $patientNHIS=$rows['patientNHIS'];
            $patientLevel=$rows['patientLevel'];
            
            echo '<tr>
            <td width="5%">'.$sn.'</td>
            <td width="10%">'.$patientNHIS.'</td>
            <td width="15%">'.$patientNumber.'</td>
            <td width="20%">'.$patientName.'</td>
            <td width="5%">'.$patientLevel.'</td>
            <td width="10%">'.$patientPhone.'</td>
            <td width="10%">'.$patientEmail.'</td>
            <td width="10%">'.$patientDOB.'</td>
            <td width="5%">'.$patientDOB.'</td>
            <td width="10%">View File</td>
        </tr>';

        $sn=$sn + 1 ;
        }
       
       echo' </tbody>
    </table>';

    }else{
        echo '<p><b style="color:red;">No record found</b><p>';
    }
}
?>