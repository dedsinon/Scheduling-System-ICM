<?php
include('p_db_connection.php');

$room_id = $_POST['update_room_id'];
$room_name = $_POST['update_room_name'];
$room_class = $_POST['update_room_class'];
$room_number = $_POST['update_room_number'];

if (isset($_POST['update'])){

$query ="SELECT * FROM rooms where room_name = '".$room_name."'";
$result = mysqli_query($conn, $query);

$update_room = "UPDATE rooms SET room_name ='".$room_name."', room_number ='".$room_number."', room_classification ='".$room_class."' WHERE room_id = '".$room_id."'";

$update_room_query = mysqli_query($conn, $update_room);


	if ($update_room_query) {
?>
	
		<script>
			window.location.href='../room.php';
			alert('Successfully Edited');
		</script> 

<?php
}
}
?>