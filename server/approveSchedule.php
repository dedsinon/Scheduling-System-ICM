<?php
include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql ="UPDATE schedule SET is_approved = '".$_GET['status']."' WHERE schedule_id = '".$_GET['userid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");


header("Location: ../e_view_class.php");

?>