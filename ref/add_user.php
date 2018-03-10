<?php
session_start();
require('p_db_connection.php');


$firstname = $_POST ['firstname'];
$lastname = $_POST ['lastname'];
$department = $_POST ['department'];
$position = $_POST['position'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$usertype = $_POST['usertype'];
$status = $_POST['status'];
$username = $_POST['username'];
$password = $_POST['password'];

$secure_firstname = mysqli_escape_string($conn, $firstname);
$secure_lastname = mysqli_escape_string($conn, $lastname);
$secure_department = mysqli_escape_string($conn, $department);
$secure_position = mysqli_escape_string($conn, $position);
$secure_gender = mysqli_escape_string($conn, $gender);
$secure_email = mysqli_escape_string($conn, $email);
$secure_usertype = mysqli_escape_string($conn, $usertype);
$secure_status = mysqli_escape_string($conn, $status);
$secure_username = mysqli_escape_string($conn, $username);
$secure_password = mysqli_escape_string($conn, $password);
$encrypt_password = sha1($secure_password);

$add = "INSERT INTO useraccount ( user_fname, user_lname, user_department, user_position, user_gender, user_email, user_privileges, user_status, user_name, user_pass) ";
$add .= "VALUES ('".$secure_firstname."', '".$secure_lastname."','".$secure_department."','".$secure_position."','".$secure_gender."','".$secure_email."', '".$secure_usertype."', '".$secure_status."', '".$secure_username."', '".$encrypt_password."')";

$add_query = mysqli_query($conn, $add);

if ($add_query)
{
	
	$_SESSION['success_user_add'] = "New User Account Added";
	header("Location: ../useraccount.php");
} else {
	
	$_SESSION['error_user_add'] = "Please try again";
	header("Location: ../useraccount.php");
}
?>