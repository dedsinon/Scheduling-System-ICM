<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
session_start();
require('p_db_connection.php');

	
	$school_year = mysqli_escape_string($conn, isset($_POST ['school_year']) ? $_POST ['school_year']: '');
	$teacher_id 	= mysqli_escape_string($conn, isset($_POST ['teacher_id']) ? $_POST ['teacher_id']: '');
	$room_id 		= mysqli_escape_string($conn, isset($_POST ['room_id']) ? $_POST ['room_id']: '');
	$course_name 	= mysqli_escape_string($conn, isset($_POST ['course_name']) ? $_POST ['course_name']: '');
	$day 			= mysqli_escape_string($conn, isset($_POST ['day']) ? implode(',', $_POST ['day']): '');
	$start_hour_post 	= mysqli_escape_string($conn, isset($_POST ['start_hour']) ? $_POST ['start_hour']: '');
	$start_minute_post 	= mysqli_escape_string($conn, isset($_POST ['start_minute']) ? $_POST ['start_minute']: '');
	$end_hour_post 		= mysqli_escape_string($conn, isset($_POST ['end_hour']) ? $_POST ['end_hour']: '');
	$end_minute_post 	= mysqli_escape_string($conn, isset($_POST ['end_minute']) ? $_POST ['end_minute']: '');
	
	
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
		
			if( ($start_hour_post == $end_hour_post) && ($start_minute_post == $end_minute_post) ){
				 header("Location: ../schedule_icl.php");
				
			}
			else{
				$add = "INSERT INTO schedule_icl (icl_teacher_id_fk, icl_room_id_fk, icl_school_year, icl_day, icl_start_time, icl_end_time, icl_course_name)";
				$add .= "VALUES ('".$teacher_id."', '".$room_id."', '".$school_year."', '".$day."', '".$start_time."', '".$end_time."',  '".$course_name."')";

				$add_query = mysqli_query($conn, $add); 

				if ($add_query){
					
					$_SESSION['success_add_icl_schedule'] = "ICL Schedule Added.";
					 header("Location: ../schedule_icl.php");
					
				}
				else{
					$_SESSION['failed_add_icl_schedule'] = "Adding ICL Schedule Failed.";
					header("Location: ../schedule_icl.php");
				}
			}
		}




?>