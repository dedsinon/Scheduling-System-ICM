<?php

include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql = "UPDATE section SET sec_status = '".$_GET['status']."' where sec_id = '".$_GET['sectionid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

header("Location: ../section.php");

?>