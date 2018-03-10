<?php
include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql ="DELETE FROM exam WHERE exam_id = '".$_GET['userid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

?>
	<script>
		window.location.href='../schedule_exam.php';
		alert('Successfully Edited');
	</script> 