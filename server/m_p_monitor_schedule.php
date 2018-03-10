<?php
session_start();
require('p_db_connection.php');

$remarks = mysqli_escape_string($conn, $_POST ['m_remarks']);
$comments = mysqli_escape_string($conn, $_POST ['m_comments']);
$is_monitored = mysqli_escape_string($conn, $_POST ['m_is_monitored']);
$username = $_SESSION['user_name'];

$schedule = mysqli_escape_string($conn, $_POST ['schedule']);
$subject = mysqli_escape_string($conn, $_POST ['subject']);
$teacher = mysqli_escape_string($conn, $_POST ['teacher']);
$room = mysqli_escape_string($conn, $_POST ['room']);
$sc = mysqli_escape_string($conn, $_POST ['sc']);
$section = mysqli_escape_string($conn, $_POST ['section']);
$day = mysqli_escape_string($conn, $_POST ['day']);
$school_year = mysqli_escape_string($conn, $_POST ['school_year']);
$term_grading = mysqli_escape_string($conn, $_POST ['term_grading']);

if (isset($_POST['submit'])){

$query ="SELECT * FROM monitoring";
$result = mysqli_query($conn, $query) or die ('failed add remarks, on line 14');

$add = "INSERT INTO monitoring (m_username, m_remarks, m_comments, m_is_monitored, m_schedule_id_fk, m_subject_id_fk, m_teacher_id_fk, m_room_id_fk, m_sc_id_fk, m_section_id_fk, m_day_id_fk, m_school_year_fk, m_term_grading_fk)";
$add .= "VALUES ('".$username."', '".$remarks."', '".$comments."', '".$is_monitored."', '".$schedule."', '".$subject."', '".$teacher."', '".$room."', '".$sc."', '".$section."', '".$day."', '".$school_year."', '".$term_grading."')";

$add_query = mysqli_query($conn, $add) or die ('failed add remarks, on line 28'); 
	
if ($add_query){

	$_SESSION['success_add_remarks'] = "New Remarks Added";
	header("Location: ../monitor_schedule.php?success=added");
	
}
}
?>