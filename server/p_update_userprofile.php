<?php
require('p_db_connection.php');

$user_id = $_POST['update_user_id'];
$user_fname = $_POST['update_firstname'];
$user_lname = $_POST['update_lastname'];
$user_department = $_POST['update_department'];
$user_position = $_POST['update_position'];
$user_gender = $_POST['update_gender'];
$user_email = $_POST['update_email'];
$user_privileges = $_POST['update_usertype'];
$user_username = $_POST['update_username'];
$user_password = $_POST['update_password'];

$secure_password = mysqli_real_escape_string($conn, $user_password);
$encrypt_password = sha1($secure_password);

$update_info = "UPDATE useraccount SET user_fname ='".$user_fname."', user_lname ='".$user_lname."', user_department ='".$user_department."', user_position = '".$user_position."', user_gender ='".$user_gender."', user_email = '".$user_email."', user_privileges ='".$user_privileges."', user_name = '".$user_username."', user_pass ='".$encrypt_password."' WHERE user_id = '".$user_id."'";

$update_info_query = mysqli_query($conn, $update_info);

if ($update_info_query) {
	?>
	
	<script>
	window.location.href='../user_profile.php';
	alert('Successfully Edited');
	
	</script> 
	<?php

}
else
{
	echo "Failed: ".mysqli_error($conn);
}


?>