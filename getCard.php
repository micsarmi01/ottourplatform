<?php
include 'conn.php';
$conn = getDatabaseConnection();

$mac = $_POST['mac'];

//$mac = strval($mac);
$url = "card url";
//$sql = "select * from cards";
$sql = "SELECT url 
	FROM cards
	WHERE mac = :mac";

$namedParameters = array();
$namedParameters[':mac'] = $mac;
$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$result = $statement->fetch(PDO::FETCH_NUM);

$url = $result[0];
$cardURL = array("url" => $url);
echo json_encode($cardURL,JSON_PRETTY_PRINT);

?>
