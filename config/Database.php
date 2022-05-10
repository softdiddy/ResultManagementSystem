<?php

	class Database{
		//DB peramiter
		private $host='localhost';
		private $db_name='xbbue9x_turnitin';
		private $username='xbbue9x';
		private $password='--9R08leM5Oi^3$+Go2h31l3nd5arz9rot3sters!';
		private $conn;
		
		
		//database connection
		public function connect(){
			
			$this->conn=null;
			
			try{
				$this->conn=new PDO('mysql:host='. $this->host.';dbname='.$this->db_name,
				$this->username,$this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $err){
				echo "Connection Error " .$err ->getMessage();
			}
			
			return $this->conn;
		}
	}

?>