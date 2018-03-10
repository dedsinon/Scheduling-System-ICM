<?php
require('../server/p_db_connection.php');


if (!empty($_POST["teacher_id"])){
	$teach_id = $_POST["teacher_id"];

	$query = "SELECT * FROM day LEFT JOIN teacher ON teacher.teacher_restday!=day.day_id WHERE teacher.teacher_id = '".$teach_id."' AND day.day_id != 0";
	
	$results = mysqli_query($conn, $query);

	while($teach = mysqli_fetch_assoc($results)) {

		
?>
		<option value="<?php echo $teach["day_id"] ;?>"><?php echo $teach["day_name"]; ?></option>
<?php
}

}
?>