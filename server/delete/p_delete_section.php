<?php

require('p_db_connection.php');

$id = $_GET['delete'];
echo $id;

$delete_section = "DELETE FROM section WHERE sec_id ='$id'";

$delete_section_query = mysqli_query($conn, $delete_room);


if ($delete_section_query) {
	?>
	<script>
	window.location.href='../section.php';
	alert('Successfully Deleted');
	
	</script> 
	<?php
}
else
{
	echo "Failed: ".mysqli_error($conn);
}
?>