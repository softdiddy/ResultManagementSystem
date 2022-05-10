<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require('../../config/Database.php');
	require('../../models/Staffs.php');
	
	//innitiate database
	$database=new Database();
	$db=$database->connect();
	
	
	//initiate staff object
	$staff=new Staff($db);
	
	
	//get staff file no
	$staff->fileno=isset($_GET['fileno']) ? $_GET['fileno'] : die();
	
	//Get
	$staff->singleRead();

		
	//create array
	$staff_item=array(
				'id' =>$staff-> id,
				'fileno' =>$staff->fileno,
				'surname' =>$staff->surname,
				'firstname' =>$staff->firstname,
				'middlename' =>$staff->middlename,
				'left_finger' =>$staff->left_finger,
				'right_finger' =>$staff->right_finger
			);

			
	//make json
	echo json_encode($staff_item);
	
?>