<?php 

$server = "localhost";
$username = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Adatbázis hiba");
}

 ?>