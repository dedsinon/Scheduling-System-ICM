<?php
include('../server/p_db_connection.php');


$conn->Query('SELECT * FROM chat');

echo $conn->Get();



?>