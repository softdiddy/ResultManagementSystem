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
	
	//get raw posted data
	$data=json_decode(file_get_contents("php://input"));
	
	$attendance->fileno=$data->fileno;
	$attendance->leftfinger=$data->leftfinger;
	$attendance->rightfinger=$data->rightfinger;
	
	//update
	if($attendance -> UpdateFingerPrint()){
		echo json_encode(
			array('message' => 'Fingerprint update successfully')
		);
		http_response_code(201);
	}else{
		echo json_encode(
			array('message' => 'Something went wrong')
		);
	}


?>