<?php
session_start();
require('p_db_connection.php');

$comment = mysqli_escape_string($conn, $_POST ['comments']);
$sched = mysqli_escape_string($conn,$_POST ['schedule_id']);

if (isset($_POST['submit'])){


$add = "INSERT INTO chat ( c_schedule_id_fk, chat_message )";
$add .= "VALUES ('".$sched."', '".$comment."')";

$add_query = mysqli_query($conn, $add) or die ('failed add room, on line 34'); 

if ($add_query){
?>
	
	<script>
	window.location.href='../e_view_class.php';
	alert('Comment Successfully Added');
	
	</script> 
	<?php

	
}
}


?>