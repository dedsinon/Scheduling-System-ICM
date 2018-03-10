<?php
session_start();
require('p_db_connection.php');


$code = $_POST ['section_code'];
$name = $_POST ['section_name'];
$sc = $_POST ['section_sc'];
$status = $_POST ['status'];

$secure_code = mysqli_escape_string($conn, $code);
$secure_name = mysqli_escape_string($conn, $name);
$secure_sc = mysqli_escape_string($conn, $sc);
$secure_status = mysqli_escape_string($conn, $status);

if (isset($_POST['submit'])){

$query ="SELECT * FROM section WHERE sec_name = '".$secure_name."' ";
$query .= "OR sec_code = '".$secure_code."'";

$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

	if ($count > 0) {

		$_SESSION['error_add_section'] = "Section Name Already Exist! Please try again.";
		header("Location: ../section.php?error_add");
	}

	else{

$add = "INSERT INTO section (sec_code, sec_name, sc_id_fk, sec_status)";
$add .= "VALUES ('".$secure_code."', '".$secure_name."', '".$secure_sc."', '".$secure_status."')";

$add_query = mysqli_query($conn, $add) or die ('failed query');

if ($add_query){

	$_SESSION['success_add_section'] = "New Section Added.";
	header("Location: ../section.php?success=added");
}
}
}
?>








