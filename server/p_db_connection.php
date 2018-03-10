<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "informatics";

$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn){

	die("Connection Failed: ".mysqli_connect_error());
}



 date_default_timezone_set("Asia/Manila");
 
 ?>
