<?php
session_start();
require('p_db_connection.php');

$scid = $_POST ['sc_id'];
$scname = $_POST ['sc_name'];
$sccode = $_POST ['sc_code'];
$sc_sc = $_POST ['sc_sc'];
$status = $_POST ['status'];

$secure_name = mysqli_escape_string($conn, $scname);
$secure_code = mysqli_escape_string($conn, $sccode);
$secure_sc = mysqli_escape_string($conn, $sc_sc);
$secure_status = mysqli_escape_string($conn, $status);

if(isset($_POST['submit'])){

$query ="SELECT * FROM strand_course where sc_name = '".$scname."'";
$query .= "OR sc_code = '".$code."' ";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

if($count > 0){


	$_SESSION['error_add'] = "You already have existing strand & course description.";
	header('Location: ../strand_course.php?error=add' );

}
else {


$add = "INSERT INTO strand_course ( sc_name, sc_code, sc_sc, sc_status)";
$add .= "VALUES ('".$secure_name."', '".$secure_code."', '".$secure_sc."', '".$secure_status."')";

$add_query = mysqli_query($conn, $add) or die ('failed query');


if ($add_query){

	$_SESSION['success_add'] = "New Strand & Course Added";
	header("Location: ../strand_course.php?success=added");
}
}
}

?>





