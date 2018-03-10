<?php
require('p_db_connection.php');

$sc_id = $_POST['update_sc_id'];
$sc_name = $_POST['update_sc_name'];
$sc_code = $_POST['update_sc_code'];
$sc_sc = $_POST['update_sc'];

if (isset($_POST['update'])){

$query ="SELECT * FROM strand_course where sc_name = '".$sc_name."'";
$result = mysqli_query($conn, $query);


$update_sc = "UPDATE strand_course SET sc_code ='".$sc_code."', sc_name ='".$sc_name."', sc_sc ='".$sc_sc."' WHERE sc_id = '".$sc_id."'";

$update_sc_query = mysqli_query($conn, $update_sc);


if ($update_sc_query) {
	?>
	
	<script>
	window.location.href='../strand_course.php';
	alert('Successfully Edited');
	
	</script> 
	<?php
}
}


?>