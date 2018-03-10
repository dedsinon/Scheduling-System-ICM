<?php

include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql = "UPDATE teacher SET teacher_status = '".$_GET['status']."' where teacher_id = '".$_GET['teacherid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

header("Location: ../teacher.php");

?>