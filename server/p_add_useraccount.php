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

$encrypt_password = sha1($password);
 

if (isset($_POST['submit'])){

$query ="SELECT * FROM useraccount where user_name = '".$username."' AND user_privileges = 'Admin'";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

	if ($count > 0) {
		$_SESSION['error_user_exist'] = "Username Already Exist! Please try again.";
	header("Location: ../useraccount.php?error_add");
	}

	else{
$add = "INSERT INTO useraccount (user_fname, user_lname, user_department, user_position, user_gender, user_email, user_privileges, user_status, user_name, user_pass) ";
$add .= "VALUES ('".$firstname."', '".$lastname."','".$department."','".$position."','".$gender."','".$email."', '".$usertype."', '".$status."', '".$username."', '".$encrypt_password."')";

$add_query = mysqli_query($conn, $add);

if ($add_query)
{
	
	$_SESSION['success_user_add'] = "New User Account Added";
	header("Location: ../useraccount.php?success_add");
}
}
} 

?>