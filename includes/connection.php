<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	
    $db = "RMS";

 //create login connection and login
$con = new mysqli($servername,$username,$password,$db);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  
  ?>