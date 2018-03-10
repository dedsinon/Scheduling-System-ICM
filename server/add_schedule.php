<?php
session_start();
require('p_db_connection.php');

$subject = $_POST ['subject'];
$teacher = $_POST ['teacher'];
$room = $_POST ['room'];
$sc = $_POST ['sc'];
$sy = $_POST ['sy'];
$sec = $_POST ['sec'];

$secure_subject = mysqli_escape_string($conn, $subject);
$secure_teacher = mysqli_escape_string($conn, $teacher);
$secure_room = mysqli_escape_string($conn, $room);
$secure_sc = mysqli_escape_string($conn, $sc);
$secure_sy = mysqli_escape_string($conn, $sy);
$secure_sec = mysqli_escape_string($conn, $sec);

if (isset($_POST['submit'])){

$query ="SELECT * FROM schedule WHERE strand_course = '".$sc."' ";

$result = mysqli_query($conn, $query) or die ('failed add schedule, on line 23');
$count = mysqli_num_rows($result);

	if ($count > 0) {

		$_SESSION['error_schedule'] = "Information Already Exist! Please try again.";
		header("Location: ../create_schedule.php?error_add");
	}

	else{

$add = "INSERT INTO schedule (subject, teacher, room, strand_course, school_year, section)";
$add .= "VALUES ('".$secure_subject."', '".$secure_teacher."', '".$secure_room."', '".$secure_sc."', '".$secure_sy."', '".$secure_sec."')";

$add_query = mysqli_query($conn, $add) or die ('failed add schedule, on line 37'); 

if ($add_query){

	$_SESSION['success_schedule'] = "New Schedule Added.";
	header("Location: ../create_schedule.php?success=added");
	
}
}
}

?>