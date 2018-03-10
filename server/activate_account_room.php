<?php

include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql = "UPDATE rooms SET room_status = '".$_GET['status']."' where room_id = '".$_GET['roomid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

header("Location: ../room.php");

?>