<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require('../../config/Database.php');
	require('../../models/Departments.php');
	
	//innitiate database
	$database=new Database();
	$db=$database->connect();
	
	
	//initiate staff object
	$departments=new Departments($db);
	
	//staff query
	$result=$departments->getAllDepartments();
	
	//get row
	$rows=$result->rowCount();
	
	//chk if there is a row
	if($rows > 0){
		$arr=array();
		$arr['data']=array();
		
		while($row=$result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			$data_item=array(
				'id' => $id,
				'tittle' => $tittle,
				'status' => $status
			);
			
			//push
			array_push($arr['data'],$data_item);
			
		
		}
			//json
			echo json_encode($arr);
	}else{
		echo json_encode(
			array('Message' => 'No Department record')
		);
	}
?>