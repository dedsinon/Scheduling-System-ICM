<?php
session_start();
require('p_db_connection.php');

$term = mysqli_escape_string($conn, $_POST ['e_term_grading']);
$subject = mysqli_escape_string($conn, $_POST ['e_subject']);
$class = mysqli_escape_string($conn, $_POST ['e_classification']);
$day = mysqli_escape_string($conn, $_POST ['e_day']);
$teacher = mysqli_escape_string($conn, $_POST ['e_teacher']);
$room = mysqli_escape_string($conn, $_POST ['e_room']);
$start_hour_post 	= mysqli_escape_string($conn, isset($_POST ['e_start_hour']) ? $_POST ['e_start_hour']: '');
	$start_minute_post 	= mysqli_escape_string($conn, isset($_POST ['e_start_minute']) ? $_POST ['e_start_minute']: '');
	$end_hour_post 		= mysqli_escape_string($conn, isset($_POST ['e_end_hour']) ? $_POST ['e_end_hour']: '');
	$end_minute_post 	= mysqli_escape_string($conn, isset($_POST ['e_end_minute']) ? $_POST ['e_end_minute']: '');

$start_hour 	= (int)$start_hour_post;
	$start_minute 	= (int)$start_minute_post;
	$test_start_time = 0;
	$test_end_time = 0;
	
	if($start_minute < 59 ){
		$start_minute = ($start_minute + 1);
		$test_start_time = $start_hour + $start_minute;
		$start_minute = $start_minute < 10 ? '0'.$start_minute : $start_minute;
		$start_hour = $start_hour < 10 ? '0'.$start_hour : $start_hour;
		$start_time 	= $start_hour.':'.$start_minute.':00';
	
	}
	else{
		$start_hour = ($start_hour + 1);
		$test_start_time = $start_hour + $start_minute;
		$start_minute = $start_minute < 10 ? '0'.$start_minute : $start_minute;
		$start_hour = $start_hour < 10 ? '0'.$start_hour : $start_hour;
		$start_minute = '00';
		$start_time 	= $start_hour.':'.$start_minute.':00';
	}
	
	$end_hour 		= (int)$end_hour_post;
	$end_minute 	= (int)$end_minute_post;
	
	if($end_minute > 0 ){
		$end_minute = ($end_minute - 1);
		$test_end_time = $end_hour + $end_minute;
		$end_minute = $end_minute < 10 ? '0'.$end_minute : $end_minute;
		$end_hour = $end_hour < 10 ? '0'.$end_hour : $end_hour;
		$end_time 	= $end_hour.':'.$end_minute.':00';
	}
	else{
		$end_hour = $end_hour - 1;
		$test_end_time = $end_hour + 59;
		$end_minute = $end_minute < 10 ? '0'.$end_minute : $end_minute;
		$end_hour = $end_hour < 10 ? '0'.$end_hour : $end_hour;
		$end_minute = '59';
		$end_time 	= $end_hour.':'.$end_minute.':00';
	}
	
	//$start_time 	= $start_hour.':'.($start_minute + 1).':00';
	//$end_time 		= $end_hour.':'.($end_minute - 1).':00';
	
	$start_date = $start_time;
	$end_date = $end_time;

	$check_start_time = (int)str_replace(':', '', $start_date); 
	$check_end_time = (int)str_replace(':', '', $end_date);

if (isset($_POST['submit'])){

$query ="SELECT * FROM exam ";

$result = mysqli_query($conn, $query) or die ('failed add exam, on line 20');
$count = mysqli_num_rows($result);

	

$add = "INSERT INTO exam (exam_term, exam_schedule_id_fk, exam_day, exam_room, exam_teacher, exam_class, exam_start_time, exam_end_time)";
$add .= "VALUES ('".$term."', '".$subject."', '".$day."', '".$room."', '".$teacher."', '".$class."','".$start_time."','".$end_time."')";

$add_query = mysqli_query($conn, $add) or die ('failed add room, on line 34'); 

if ($add_query){

	$_SESSION['success_add_exam'] = "New Exam Schedule Added.";
	header("Location: ../schedule_exam.php?success=added");
	
}
}


?>