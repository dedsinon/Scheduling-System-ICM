<?php
require('p_db_connection.php');

$teacher_id = $_POST['update_teacher_id'];
$teacher_fullname = $_POST['update_teacher_fullname'];
$teacher_gender = $_POST['update_teacher_gender'];
$teacher_contact = $_POST['update_teacher_contact'];
$teacher_status = $_POST['update_teacher_status'];
$teacher_subjmaj = $_POST['update_teacher_subjmaj'];
$teacher_profession = $_POST ['update_teacher_profession'];
$teacher_restday = $_POST ['update_teacher_restday'];


$update_teacher = "UPDATE teacher SET teacher_fullname ='".$teacher_fullname."', teacher_gender ='".$teacher_gender."', teacher_contact ='".$teacher_contact."', teacher_workstatus ='".$teacher_status."', teacher_subjmaj ='".$teacher_subjmaj."', teacher_profession = '".$teacher_profession."', teacher_restday = '".$teacher_restday."'  WHERE teacher_id = '".$teacher_id."'";

$update_teacher_query = mysqli_query($conn, $update_teacher);

if ($update_teacher_query) {
	?>
	
	<script>
	window.location.href='../teacher.php';
	alert('Successfully Edited');
	
	</script> 
	<?php

}
else
{
	echo "Failed: ".mysqli_error($conn);
}


?>