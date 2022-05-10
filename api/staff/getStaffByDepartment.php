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
	$staff->department_id=isset($_GET['department_id']) ? $_GET['department_id'] : die();
	
	//staff query
	$result=$staff->ReadStaffByDepartment();
	
	//get row
	$rows=$result->rowCount();
	
	//chk if there is a row
	if($rows > 0){
		$staff_arr=array();
		$staff_arr['data']=array();
		
		while($row=$result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			$staff_item=array(
				'id' => $id,
				'department_id' => $department_id,
				'fileno' => $fileno,
				'surname' => $surname,
				'firstname' => $firstname,
				'middlename' => $middlename,
				'left_finger' => $left_finger,
				'right_finger' => $right_finger
				
			);
			
			//push
			array_push($staff_arr['data'],$staff_item);
			
			
		}
		
		//json
			echo json_encode($staff_arr);
	}else{
		echo json_encode(
			array('Message' => 'No staff record')
		);
	}
?>