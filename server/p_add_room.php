<?php
session_start();
require('p_db_connection.php');

$number = $_POST ['room_number'];
$name = $_POST ['room_name'];
$class = $_POST ['room_class'];
$status = $_POST ['status'];

$secure_number = mysqli_escape_string($conn, $number);
$secure_name = mysqli_escape_string($conn, $name);
$secure_class = mysqli_escape_string($conn, $class);
$secure_status = mysqli_escape_string($conn, $status);

if (isset($_POST['submit'])){

$query ="SELECT * FROM rooms WHERE room_name = '".$name."' ";
$query .= "OR room_number = '".$number."' ";

$result = mysqli_query($conn, $query) or die ('failed add room, on line 20');
$count = mysqli_num_rows($result);

	if ($count > 0) {

		$_SESSION['error_add_room'] = "Room Already Exist! Please try again.";
		header("Location: ../room.php?error_add");
	}

	else{

$add = "INSERT INTO rooms (room_number, room_name, room_classification, room_status)";
$add .= "VALUES ('".$secure_number."', '".$secure_name."', '".$secure_class."', '".$secure_status."')";

$add_query = mysqli_query($conn, $add) or die ('failed add room, on line 34'); 

if ($add_query){

	$_SESSION['success_add_room'] = "New Room Added.";
	header("Location: ../room.php?success=added");
	
}
}
}

?>