<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods:POST');
	
	
	
	require('../../config/Database.php');
	require('../../models/Attendance.php');
	
	//innitiate database
	$database=new Database();
	$db=$database->connect();
	

	//initiate Attendance object
	$attendance=new Attendance($db);
	
    $dec = json_decode(file_get_contents("php://input"));

	

//$dec = json_decode($json);
$array = array();
if (! empty($dec->attendance)) {
    foreach ($dec->attendance as $att) {
       $attendance->id=$att->att_id;
       $attendance->fileno=$att->fileno;
	   $attendance->att_day=$att->att_day;
	    $attendance->att_month=$att->att_month;
	   $attendance->att_time=$att->att_time;
	   $attendance->att_type=$att->att_type;
	   $attendance->att_year=$att->att_year;
	   
	   $staffFileno=$att->att_id;
	   
	   //update
	if($attendance -> SyncAttendance()){
	
		//array_push($array,$staffFileno);
		 array_push($array,[ 'att_id' => $staffFileno]);
	}
  }
    
    echo json_encode($array);
    http_response_code(201);
}


?>

