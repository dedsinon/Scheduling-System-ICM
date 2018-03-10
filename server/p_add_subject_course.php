<?php
session_start();
require('p_db_connection.php');

$name = $_POST['subj_name'];
$code = $_POST['subj_code'];
$unit = $_POST['subj_unit'];
$term = $_POST['subj_term'];
$status = $_POST['subj_status'];
$sc = $_POST['sc_id'];
$room = $_POST['room_class'];

$secure_name = mysqli_escape_string($conn, $name);
$secure_code = mysqli_escape_string($conn, $code);
$secure_unit = mysqli_escape_string($conn, $unit);
$secure_term = mysqli_escape_string($conn, $term);
$secure_status = mysqli_escape_string($conn, $status);
$secure_sc = mysqli_escape_string($conn, $sc);
$secure_room = mysqli_escape_string($conn, $room);

if (isset($_POST['submit'])){

$query ="SELECT * FROM subject WHERE subj_name = '".$secure_name."' ";
$query .= "AND subj_code = '".$secure_code."' AND sc_id = '".$secure_sc."'";

$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

	if ($count > 0) {

		$_SESSION['error_add_subj_exist'] = "Adding Subject Failed! Please try again.";
		header("Location: ../subject_course.php?error_add");
	}

	else{


	$add .= "INSERT INTO subject ( subj_name, subj_code, subj_unit, subj_term, subj_status, sc_id, room_classification)";
	$add .= "VALUES ('".$secure_name."', '".$secure_code."', '".$secure_unit."', '".$secure_term."', '".$secure_status."', '".$secure_sc."', '".$secure_room."')";
	
	


	$add_query = mysqli_query($conn, $add);

		if ($add_query){

		$_SESSION['success_add_subj'] = "New Subject Added";
		header("Location: ../subject_course.php");

}
}	
}
?>








