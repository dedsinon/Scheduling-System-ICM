<?php
session_start();
include('p_db_connection.php');

$id = $_GET['delete'];
echo $id;

$delete_info = "DELETE FROM useraccount WHERE user_id='$id'";

$delete_info_query = mysqli_query($conn, $delete_info);
echo "<br>";
echo "<br>";
echo $delete_info;

	if ($delete_info_query){

	?>
	<script>
	window.location.href='../useraccount.php';
	alert('Successfully Deleted');
	
	</script> 
	<?php
}
else
{
	echo "Failed: ".mysqli_error($conn);
}
?>