<?php
require('../server/p_db_connection.php');

if (!empty($_POST["e_subject_id"])){
	$subject_id = $_POST["e_subject_id"];
		$query_year = "SELECT * FROM school_year WHERE status='Activated'";
	
	$year_results = mysqli_query($conn, $query_year);

	while($year = mysqli_fetch_assoc($year_results)) {
		$activated_year = $year["school_year"];
}
	$query = "SELECT * FROM schedule as sc LEFT JOIN section as sec ON sc.section_id_fk = sec.sec_id WHERE sc.subject_id_fk = '".$subject_id."' AND sc.school_year = '$activated_year' ";


	$results = mysqli_query($conn, $query);

	while($sc = mysqli_fetch_assoc($results)) {


?>
		<option value="<?php echo $sc["sec_id"]; ?>">  <?php echo $sc["sec_name"]?> [<?php echo $sc["sec_code"]; ?>]</option>
<?php
	}
}

?>