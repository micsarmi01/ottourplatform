<?php
require "conn.php";
$username = $_POST['username'];
$pass = $_POST['password'];
$sql = "SELECT * from users 
		WHERE username = '$username' AND
		password = '$pass'";
	
$namedParameters = array();
$namedparameters[':username'] = $username;
$namedparameters[':pass'] = $pass;

$statement = $conn->prepare($sql);
$statement->execute();
$result = $statement->fetch();

if(!empty($result))
{
       echo "success";//echo $result['username'] . " has logged in";
}else
{
	echo "Wrong username or password.";
}


?>
