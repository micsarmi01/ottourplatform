<?php

	$host = "localhost";
//	$host = "project438.cmpzrkebrqbb.us-west-2.rds.amazonaws.com";
	$dbname = "Ottour";
	$username = "root";
	$password = "ottour2016";
	
	$conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
if($conn)
{
echo "Connected";
}else
echo "Not connected";


?>
