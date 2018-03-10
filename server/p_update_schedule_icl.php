<?php
require('p_db_connection.php');
		
$user_id = mysqli_real_escape_string($conn, $_POST['update_user_id']);

if (isset($_POST['update'])){

	$query ="SELECT * FROM useraccount";

	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	if ($count > 0) {


		$update_info = "UPDATE useraccount SET user_fname ='".$user_fname."', user_lname ='".$user_lname."', user_department ='".$user_department."', user_position = '".$user_position."', user_gender ='".$user_gender."', user_email = '".$user_email."', user_privileges ='".$user_privileges."', user_name = '".$user_username."', user_pass ='".$encrypt_password."' WHERE user_id = '".$user_id."'";

		$update_info_query = mysqli_query($conn, $update_info) or die("Failed Update Query");

		
	?>
	<script>
		window.location.href='../useraccount.php';
		alert('Successfully Edited');
	</script> 

	<?php
	}
	}		

?>