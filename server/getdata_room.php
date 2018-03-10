<?php
require('../server/p_db_connection.php');


if (!empty($_POST["subj_id"])){
	$subj_id = $_POST["subj_id"];

	$query = "SELECT * FROM subject as sub  LEFT JOIN LEFT JOIN rooms as ro ON sub.room_classification = ro.room_classification WHERE room_classification = '".$subj_id."' ";
	
	$results = mysqli_query($conn, $query);

	while($room = mysqli_fetch_assoc($results)) {

		
?>
		<option value="<?php echo $room["room_id"] ;?>">[<?php echo $room["room_number"]; ?>] <?php echo $room["room_name"]; ?></option>
<?php
}

}
?>