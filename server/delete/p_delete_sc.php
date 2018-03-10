<?php

require('p_db_connection.php');

$id = $_GET['delete'];
echo $id;

$delete_sc = "DELETE FROM strand_course WHERE sc_id ='$id'";

$delete_sc_query = mysqli_query($conn, $delete_sc);
echo "<br>";
echo "<br>";
echo $delete_sc;

if ($delete_sc_query) {
	?>
	<script>
	window.location.href='../strand_course.php';
	alert('Successfully Deleted');
	
	</script> 
	<?php
}
else
{
	echo "Failed: ".mysqli_error($conn);
}
?>