<?php

include('p_db_connection.php');

$id = $_GET['delete'];
echo $id;

$delete_teacher = "DELETE FROM teacher WHERE teacher_id ='$id'";

$delete_teacher_query = mysqli_query($conn, $delete_teacher);


if ($delete_teacher_query) {
	?>
	<script>
	window.location.href='../teacher.php';
	alert('Successfully Deleted');
	
	</script> 
	<?php
}
else
{
	echo "Failed: ".mysqli_error($conn);
}
?>