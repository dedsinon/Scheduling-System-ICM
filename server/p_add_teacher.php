<?php
session_start();
require('p_db_connection.php');

$fullname = $_POST ['teacher_fullname'];
$gender = $_POST ['teacher_gender'];
$contact = $_POST ['teacher_contact'];
$status = $_POST ['teacher_status'];
$workstatus = $_POST ['teacher_workstatus'];
$special = $_POST ['teacher_subjmaj'];
$profession = $_POST ['teacher_profession'];
$restday = $_POST ['teacher_restday'];

if (isset($_POST['submit'])){

$query ="SELECT * FROM teacher WHERE teacher_fullname = '".$fullname."' ";

$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

	if ($count > 0) {

		$_SESSION['error_add_teacher'] = "Teacher Already Exist! Please try again.";
		header("Location: ../teacher.php?error_add");
	}

	else{

$secure_fullname = mysqli_escape_string($conn, $fullname);
$secure_gender = mysqli_escape_string($conn, $gender);
$secure_contact = mysqli_escape_string($conn, $contact);
$secure_status = mysqli_escape_string($conn, $status);
$secure_workstatus = mysqli_escape_string($conn, $workstatus);
$secure_special = mysqli_escape_string($conn, $special);
$secure_profession = mysqli_escape_string($conn, $profession);
$secure_restday = mysqli_escape_string($conn, $restday);

$add = "INSERT INTO teacher (teacher_fullname, teacher_gender, teacher_contact, teacher_workstatus, teacher_subjmaj, teacher_status, teacher_profession, teacher_restday)";
$add .= "VALUES ('".$secure_fullname."', '".$secure_gender."', '".$secure_contact."', '".$secure_workstatus."', '".$secure_special."', '".$secure_status."', '".$secure_profession."', '".$secure_restday."')";

$add_query = mysqli_query($conn, $add);

if ($add_query){

	$_SESSION['success_add_teacher'] = "New Teacher Added";
	header("Location: ../teacher.php");
}
}
}

?>








