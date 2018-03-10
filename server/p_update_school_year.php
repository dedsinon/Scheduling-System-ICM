<?php
require('p_db_connection.php');

$id = $_POST['update_sy_id'];
$year = $_POST['update_year'];

if (isset($_POST['update'])){

$query ="SELECT * FROM school_year where school_year = '".$year."'";
$result = mysqli_query($conn, $query);

$update_sy = "UPDATE school_year SET school_year ='".$year."' WHERE school_year_id = '".$id."'";

$update_sy_query = mysqli_query($conn, $update_sy);

if ($update_sy_query) {
	?>
	
	<script>
	window.location.href='../school_year.php';
	alert('Successfully Edited');
	
	</script> 
	<?php

}
}
?>

