<?php

	class Departments{
		//database stuffs
		private $conn;
		
		
		//department properties
		public $id;
		public $tittle;
		public $status;
		
		//database contructor
		public function __construct($db){
			$this->conn=$db;
		}
		
		public function getAllDepartments(){
			//query
			$query="SELECT *FROM departments  WHERE status='1' ORDER BY tittle";
			$stmt=$this->conn->prepare($query);
			$stmt->execute();
			
			return $stmt;
		}
		
	}

?>