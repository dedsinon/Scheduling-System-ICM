<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
session_start();
require('../server/p_db_connection.php');
// $action = strip_tags(html_entity_decode(isset($_REQUEST['action']) ? $_REQUEST['action'] : ''));
$response = array(
	'class' => 'error', 
	'content' => 'No Action!', 
);

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

if($action == 'add-schedule'){

// $course_id 		= mysqli_escape_string($conn, isset($_POST ['course_id']) ? $_POST ['course_id']: '');
	$school_year_id = mysqli_escape_string($conn, isset($_POST ['school_year_id']) ? $_POST ['school_year_id']: '');
	$section_id 	= mysqli_escape_string($conn, isset($_POST ['section_id']) ? $_POST ['section_id']: '');
	$subject_id 	= mysqli_escape_string($conn, isset($_POST ['subject_id']) ? $_POST ['subject_id']: '');
	$teacher_id 	= mysqli_escape_string($conn, isset($_POST ['teacher_id']) ? $_POST ['teacher_id']: '');
	$room_id 		= mysqli_escape_string($conn, isset($_POST ['room_id']) ? $_POST ['room_id']: '');
	$day 			= mysqli_escape_string($conn, isset($_POST ['day']) ? $_POST ['day']: '');
	$start_hour 	= mysqli_escape_string($conn, isset($_POST ['start_hour']) ? $_POST ['start_hour']: '');
	$start_minute 	= mysqli_escape_string($conn, isset($_POST ['start_minute']) ? $_POST ['start_minute']: '');
	$end_hour 		= mysqli_escape_string($conn, isset($_POST ['end_hour']) ? $_POST ['end_hour']: '');
	$end_minute 	= mysqli_escape_string($conn, isset($_POST ['end_minute']) ? $_POST ['end_minute']: '');
	$text_color 	= mysqli_escape_string($conn, isset($_POST ['text_color']) ? $_POST ['text_color']: '');
	$background_color 	= mysqli_escape_string($conn, isset($_POST ['background_color']) ? $_POST ['background_color']: '');
	$border_color 	= mysqli_escape_string($conn, isset($_POST ['border_color']) ? $_POST ['border_color']: '');

	$start_time 	= $start_hour.':'.($start_minute + 1).':00';
	$end_time 		= $end_hour.':'.($end_minute - 1).':00';

	$start_date = $start_time;
	$end_date = $end_time;

	$check_start_time = (int)str_replace(':', '', $start_time); 
	$check_end_time = (int)str_replace(':', '', $end_time);
	

	if (isset($_POST['submit'])){
		//echo $course_id. ' '.$school_year_id;
		$count_conflict = 0;
		$conflict_text = '';   	

		$is_room_conflict_sql ="SELECT * FROM schedule WHERE room_id = '$room_id' AND day = '$day' AND (start_time BETWEEN '$start_date' AND '$end_date' OR end_time BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
        $is_room_conflict_query = mysqli_query($conn, $is_room_conflict_sql);
        $is_room_conflict_result = mysqli_fetch_assoc($is_room_conflict_query);
        if($is_room_conflict_result){
        	$count_conflict += 1;

        	$conflict_room_text = '';
        	$room_name = '';
        	$schedules = $is_room_conflict_result;
        	foreach ($schedules as $key => $schedule) {
        		if($key == 'schedule_id'){
	        		$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id = ro.room_id WHERE sc.schedule_id = '$schedule' ";
	        		$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
			        $schedule_result = mysqli_fetch_assoc($get_schedule_query);
			        $conflict_room_text .= $schedule_result['subj_name'].', ';
			        $room_name =  $schedule_result['room_name'];
        		}
        	}
        	
        	$conflict_room_text = substr($conflict_room_text, 0, -2);
        	$conflict_room_text = str_lreplace(',', ' and ', $conflict_room_text);   

        	$conflict_text  .= 'Room Schedule conflict with subject '.json_encode($conflict_room_text).'. ';
        }

        $is_section_conflict_sql ="SELECT * FROM schedule WHERE section_id = '$section_id' AND day = '$day' AND (start_time BETWEEN '$start_date' AND '$end_date' OR end_time BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
        $is_section_conflict_query = mysqli_query($conn, $is_section_conflict_sql);
        $is_section_conflict_result = mysqli_fetch_assoc($is_section_conflict_query);
        if($is_section_conflict_result){
        	$count_conflict += 1;

        	$conflict_section_text = '';
        	$room_name = '';
        	$schedules = $is_section_conflict_result;
        	foreach ($schedules as $key => $schedule) {
        		if($key == 'schedule_id'){
	        		$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id = ro.room_id WHERE sc.schedule_id = '$schedule' ";
	        		$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
			        $schedule_result = mysqli_fetch_assoc($get_schedule_query);
			        $conflict_section_text .= $schedule_result['subj_name'].', ';
			        $room_name =  $schedule_result['room_name'];
        		}
        	}
        	
        	$conflict_section_text = substr($conflict_section_text, 0, -2);
        	$conflict_section_text = str_lreplace(',', ' and ', $conflict_section_text);   

        	$conflict_text  .= 'Section Schedule conflict to subject '.json_encode($conflict_section_text).' in room '.$room_name.'. ';
        }

        $is_teacher_conflict_sql ="SELECT * FROM schedule WHERE teacher_id = '$teacher_id' AND day = '$day' AND (start_time BETWEEN '$start_date' AND '$end_date' OR end_time BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
        $is_teacher_conflict_query = mysqli_query($conn, $is_teacher_conflict_sql);
        $is_teacher_conflict_result = mysqli_fetch_assoc($is_teacher_conflict_query);
        if($is_teacher_conflict_result){
        	$count_conflict += 1;

        	$conflict_teacher_text = '';
        	$room_name = '';
        	$schedules = $is_teacher_conflict_result;
        	foreach ($schedules as $key => $schedule) {
        		if($key == 'schedule_id'){
	        		$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id = ro.room_id WHERE sc.schedule_id = '$schedule' ";
	        		$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
			        $schedule_result = mysqli_fetch_assoc($get_schedule_query);
			        $conflict_teacher_text .= $schedule_result['subj_name'].', ';
			        $room_name =  $schedule_result['room_name'];
        		}
        	
        	$conflict_teacher_text = substr($conflict_teacher_text, 0, -2);
        	$conflict_teacher_text = str_lreplace(',', ' and ', $conflict_teacher_text);   

        	$conflict_text  .= 'Teacher\'s Schedule conflict to subject '.json_encode($conflict_teacher_text).' in room '.$room_name.'. ';
        }

        if($check_start_time >= $check_end_time){
        	$response = array(
					'class' => 'danger', 
					'content' => 'Invalid Start and End Time or Too short!', 
				);
        }else{        
	        if($count_conflict > 0){
	        	$response = array(
					'class' => 'danger', 
					'content' => $conflict_text, 
				);
	        	
	        }else{
				$add = "INSERT INTO schedule (subject_id, teacher_id, room_id, course_id, school_year_id, section_id, day, start_time, end_time, text_color, background_color, border_color)";
				$add .= "VALUES ('".$subject_id."', '".$teacher_id."', '".$room_id."', '".$course_id."', '".$school_year_id."', '".$section_id."', '".$day."', '".$start_time."', '".$end_time."', '".$text_color."', '".$background_color."', '".$border_color."')";

				$add_query = mysqli_query($conn, $add); 

				if ($add_query){
					$response = array(
						'class' => 'success', 
						'content' => 'New Schedule Added!', 
					);
				}
			}
		}

/*
	$query ="SELECT * FROM schedule WHERE strand_course = '".$sc."' ";

	$result = mysqli_query($conn, $query) or die ('failed query');
	$count = mysqli_num_rows($result);

		if ($count > 0) {

			$_SESSION['error_schedule'] = "Information Already Exist! Please try again.";
			header("Location: ../create_schedule.php?error_add");
		}else{

			$add = "INSERT INTO schedule (subject_id, teacher_id, room_id, course_id, school_year_id, section_id, day, start_time, end_time)";
			$add .= "VALUES ('".$secure_subject."', '".$secure_teacher."', '".$secure_room."', '".$secure_sc."', '".$secure_sy."', '".$secure_sec."')";

			$add_query = mysqli_query($conn, $add); 

			if ($add_query){

				$_SESSION['success_schedule'] = "New Schedule Added.";
				header("Location: ../create_schedule.php?success=added");
				
			}
		}*/
	}
	
}

echo json_encode($response);

?>