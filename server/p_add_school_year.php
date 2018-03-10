<?php
session_start();
require('p_db_connection.php');

$id = $_POST ['sy_id'];
$year = $_POST ['sy'];
$status = $_POST ['status'];

$secure_id = mysqli_escape_string($conn, $id);
$secure_year = mysqli_escape_string($conn, $year);
$secure_status = mysqli_escape_string($conn, $status);

if(isset($_POST['submit'])){

$query ="SELECT * FROM school_year where school_year = '".$year."' ";

$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

if($count > 0){


	$_SESSION['error_add'] = "You already have existing School Year";
	header('Location: ../school_year.php?error=add' );

}
else {

	
$add = "INSERT INTO school_year ( school_year, status)";
$add .= "VALUES ('".$secure_year."', '".$secure_status."')";

$add_query = mysqli_query($conn, $add) or die ('failed query');


if ($add_query){

	$_SESSION['success_add'] = "New School Year & Term Added";
	header("Location: ../school_year.php?success=added");
}
}
}

?>





