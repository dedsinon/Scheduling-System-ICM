<?php

require('p_db_connection.php');

$id = $_GET['delete'];
echo $id;

$delete_room = "DELETE FROM room WHERE room_id ='$id'";

$delete_room_query = mysqli_query($conn, $delete_room);


if ($delete_room_query) {
	?>
	<script>
	window.location.href='../room.php';
	alert('Successfully Deleted');
	
	</script> 
	<?php
}
else
{
	echo "Failed: ".mysqli_error($conn);
}
?>