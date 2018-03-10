<?php

include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql = "UPDATE monitoring SET m_is_monitored = '0' WHERE m_is_monitored = '1' ";

$query = mysqli_query($conn, $sql) or die("RESET Failed");

if ($query){

$_SESSION['success_reset'] = "Success Weekly Reset";
header("Location: ../monitor_schedule.php");

}

?>
