<?php
include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql ="UPDATE useraccount SET user_status = '".$_GET['status']."' WHERE user_id = '".$_GET['userid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");


header("Location: ../useraccount.php");

?>