<?php

function getConnection() {
    //Creating database connection
    $host = "localhost";    //get this by...
    $dbname = "Ottour";  //get this by...
    $username = "root";
    $password = "ottour2016";
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

	//Creates conection
	$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

	//Sets Error handling to Exception so it shows all errors when trying to get the data
	$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $dbConn;
}



?>
