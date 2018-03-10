<?php
require('../server/p_db_connection.php');

if (!empty($_POST["sc_id"])){
	$sc_id = $_POST["sc_id"];

	$query = "SELECT * FROM subject WHERE sc_id = '".$sc_id."' AND subj_status = 'Activated' ORDER BY subj_term ASC";


	$results = mysqli_query($conn, $query);

	while($sc = mysqli_fetch_assoc($results)) {


?>
		<option value="<?php echo $sc["subj_id"] ;?>"  data-id="<?php echo $sc["room_classification"] ;?>" >  <?php echo $sc["subj_name"]?> [<?php echo $sc["subj_code"]; ?>] [ Term/Quarter: <?php echo $sc["subj_term"]; ?> ]</option>
<?php
	}
}

?>