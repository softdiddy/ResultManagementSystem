<?php
	class Staff{
		//database stuffs
		private $conn;
		
		
		//staff properties
		public $id;
		public $fileno;
		public $surname;
		public $firstname;
		public $middlename;
		public $department_id;
		public $left_finger;
		public $right_finger;
		
		//database contructor
		public function __construct($db){
			$this->conn=$db;
		}
		
		//get all staff
		public function read(){
			//query
			$query="SELECT *FROM staff_biodata ORDER BY fileno";
			$stmt=$this->conn->prepare($query);
			$stmt->execute();
			
			return $stmt;
		}
		
		
		//get single staff
		public function singleRead(){
				//query
			$query="SELECT *FROM staff_biodata WHERE fileno=?";
			$stmt=$this->conn->prepare($query);
			
			//bind 
			$stmt->bindParam(1, $this->fileno);
			
			$stmt->execute();
			
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			//set properties
			$this->id=$row['id'];
			$this->fileno=$row['fileno'];
			$this->surname=$row['surname'];
			$this->firstname=$row['firstname'];
			$this->middlename=$row['middlename'];
			$this->left_finger=$row['left_finger'];
			$this->right_finger=$row['right_finger'];
		}
		
		
		//get single staff
		public function ReadStaffByDepartment(){
				//query
			$query="SELECT *FROM staff_biodata sbio INNER JOIN staff_official_record soff ON sbio.id=soff.staff_id WHERE soff.department_id=?";
			$stmt=$this->conn->prepare($query);
			
			//bind 
			$stmt->bindParam(1, $this->department_id);
			
			$stmt->execute();
			
			return $stmt;
		}
		
	}


?>