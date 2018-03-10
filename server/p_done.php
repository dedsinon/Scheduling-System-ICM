<?php
include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql ="UPDATE chat SET chat_status = '".$_GET['status']."' WHERE chat_id = '".$_GET['userid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");


header("Location: ../create_schedule.php");

?>
