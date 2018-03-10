<?php
include('p_db_connection.php');

mysqli_select_db("informatics",$conn);

$sql = "UPDATE school_year SET status = '".$_GET['status']."', is_current ='".$_GET['current']."' where school_year_id = '".$_GET['syid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

header("Location: ../school_year.php");

?>