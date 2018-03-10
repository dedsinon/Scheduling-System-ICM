<?php

include('p_db_connection.php');

mysqli_select_db("informatics",$conn);

$sql = "UPDATE strand_course SET sc_status = '".$_GET['status']."' where sc_id = '".$_GET['scid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

header("Location: ../strand_course.php");

?>