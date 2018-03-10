<?php
require('../server/p_db_connection.php');

if (!empty($_POST["e_term_grading"])){
	$term = $_POST["e_term_grading"];
		$query_year = "SELECT * FROM school_year WHERE status='Activated'";
	
	$year_results = mysqli_query($conn, $query_year);

	while($year = mysqli_fetch_assoc($year_results)) {
		$activated_year = $year["school_year"];
}
	$query = "SELECT * FROM schedule as sc LEFT JOIN subject as subj ON sc.subject_id_fk = subj.subj_id LEFT JOIN section as sec ON sc.section_id_fk = sec.sec_id WHERE term_grading = '".$term."' AND sc.school_year = '$activated_year' AND course_strand = 'Strand' ";


	$results = mysqli_query($conn, $query);

	while($sc = mysqli_fetch_assoc($results)) {


?>
		<option value="<?php echo $sc["schedule_id"] ;?>">  <?php echo $sc["subj_name"]?> [<?php echo $sc["subj_code"]; ?>] [<?php echo $sc["sec_code"]; ?>]</option>
<?php
	}
}

?>