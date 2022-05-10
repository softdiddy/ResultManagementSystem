<?php

	class Attendance{
		//database stuffs
		private $conn;
		
		
		//staff properties
		public $fileno;
		public $leftfinger;
		public $rightfinger;
		public $att_day;
		public $att_month;
		public $att_year;
		public $att_time;
		public $att_type;
		public $att_id;
		
		
		//database contructor
		public function __construct($db){
			$this->conn=$db;
		}
		
		
		public function UpdateFingerPrint(){
			//query
			$query='UPDATE staff_biodata 
				SET 
					left_finger=:leftfinger,
					right_finger=:rightfinger
				WHERE fileno=:fileno';
				
			//prepare statement
			$stmt=$this->conn->prepare($query);
			
			//clean data
			$this->leftfinger=htmlspecialchars(strip_tags($this->leftfinger));
			$this->rightfinger=htmlspecialchars(strip_tags($this->rightfinger));
			$this->fileno=htmlspecialchars(strip_tags($this->fileno));
			
			//bind data
			$stmt->bindParam(':leftfinger',$this->leftfinger);
			$stmt->bindParam(':rightfinger',$this->rightfinger);
			$stmt->bindParam(':fileno',$this->fileno);
			
			//execute query
			if($stmt->execute()){
				return true;
			}
			
			//print error if somthing goes wrong
			printf("Error: %s.\n", $stmt->error);
		}
		
	
	
	public function SyncAttendance(){
			
				//clean data
			$this->att_day=htmlspecialchars(strip_tags($this->att_day));
			$this->att_month=htmlspecialchars(strip_tags($this->att_month));
			$this->att_year=htmlspecialchars(strip_tags($this->att_year));
			$this->att_time=htmlspecialchars(strip_tags($this->att_time));
			$this->att_type=htmlspecialchars(strip_tags($this->att_type));
			$this->fileno=htmlspecialchars(strip_tags($this->fileno));
			$this->att_id=htmlspecialchars(strip_tags($this->att_id));
			
			
			
			$curentM=$this->att_month;
			$curentY=$this->att_year;
			
			if($this->att_type=="0"){
				$query='INSERT INTO staff_attendance_'.$curentM.'_'.$curentY.'
				SET 
					att_in=:att_time,
					att_day=:att_day,
					fileno=:fileno';
			}elseif($this->att_type=="1"){
				$query='UPDATE staff_attendance_'.$curentM.'_'.$curentY.'
				SET 
					att_out=:att_time
				
				WHERE fileno=:fileno AND att_day=:att_day';
			}
			
			
					
				//prepare statement
				$stmt=$this->conn->prepare($query);
				
			
			
			//bind data
			$stmt->bindParam(':att_day',$this->att_day);
			$stmt->bindParam(':att_time',$this->att_time);
			$stmt->bindParam(':fileno',$this->fileno);
			
			//execute query
			if($stmt->execute()){
				return true;
			}
			
			//print error if somthing goes wrong
			printf("Error: %s.\n", $stmt->error);
		}
		
		
	}

?>