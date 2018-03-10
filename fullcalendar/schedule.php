
<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
session_start();
require('../server/p_db_connection.php');

$action = strip_tags(html_entity_decode(isset($_REQUEST['action']) ? $_REQUEST['action'] : ''));
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
	
	$school_year = mysqli_escape_string($conn, isset($_POST ['school_year']) ? $_POST ['school_year']: '');
	$course_strand = mysqli_escape_string($conn, isset($_POST ['course_strand']) ? $_POST ['course_strand']: '');
	$term_grading = mysqli_escape_string($conn, isset($_POST ['term_grading']) ? $_POST ['term_grading']: '');


	if($term_grading=="1st Term"){
		$term_grading2nd ="1st Quarter";
	}
	else if($term_grading=="2nd Term"){
		$term_grading2nd ="1st Quarter";
	}
	else if($term_grading=="3rd Term"){
		$term_grading2nd ="2nd Quarter";
	}
	else if($term_grading=="1st Quarter"){
		$term_grading2nd ="1st Term";
	}
	else if($term_grading=="2nd Quarter"){
		$term_grading2nd ="2nd Term";
	}

	$sc_id 		= mysqli_escape_string($conn, isset($_POST ['sc_id']) ? $_POST ['sc_id']: '');
	$section_id 	= mysqli_escape_string($conn, isset($_POST ['section_id']) ? $_POST ['section_id']: '');
	$subject_id 	= mysqli_escape_string($conn, isset($_POST ['subject_id']) ? $_POST ['subject_id']: '');
	$teacher_id 	= mysqli_escape_string($conn, isset($_POST ['teacher_id']) ? $_POST ['teacher_id']: '');
	$room_id 		= mysqli_escape_string($conn, isset($_POST ['room_id']) ? $_POST ['room_id']: '');
	$day 			= mysqli_escape_string($conn, isset($_POST ['day']) ? implode(',', $_POST ['day']): '');
	$start_hour_post 	= mysqli_escape_string($conn, isset($_POST ['start_hour']) ? $_POST ['start_hour']: '');
	$start_minute_post 	= mysqli_escape_string($conn, isset($_POST ['start_minute']) ? $_POST ['start_minute']: '');
	$end_hour_post 		= mysqli_escape_string($conn, isset($_POST ['end_hour']) ? $_POST ['end_hour']: '');
	$end_minute_post 	= mysqli_escape_string($conn, isset($_POST ['end_minute']) ? $_POST ['end_minute']: '');
	$text_color 	= mysqli_escape_string($conn, isset($_POST ['text_color']) ? $_POST ['text_color']: '');
	$background_color 	= mysqli_escape_string($conn, isset($_POST ['background_color']) ? $_POST ['background_color']: '');
	$border_color 	= mysqli_escape_string($conn, isset($_POST ['border_color']) ? $_POST ['border_color']: '');
	$is_approved 	= 'no';
	
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
	}else{
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
	}else{
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
		//echo $course_id. ' '.$school_year_id;
		$count_conflict = 0;
		$conflict_text = '';   	
		$days = explode(',', $day);
		
		//room
		foreach ($days as $key => $day_id) {
			$is_room_conflict_sql ="SELECT * FROM schedule WHERE room_id_fk = '$room_id' AND term_grading IN ('$term_grading','$term_grading2nd') AND FIND_IN_SET('$day_id', day) AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";

			$is_room_conflict_query = mysqli_query($conn, $is_room_conflict_sql);
			$is_room_conflict_result = mysqli_fetch_assoc($is_room_conflict_query);

			if($is_room_conflict_result){
				$count_conflict += 1;

				$conflict_room_text = '';
				$room_name = '';
				$schedules = $is_room_conflict_result;

				foreach ($schedules as $key => $schedule) {

					if($key == 'schedule_id'){

						$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id WHERE sc.schedule_id = '$schedule' ";

						$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
						$schedule_result = mysqli_fetch_assoc($get_schedule_query);

						$conflict_room_text .= $schedule_result['subj_name'].', ';
						$room_name =  $schedule_result['room_name'];
						$schedule_id =  $schedule_result['schedule_id'];
					}
				}
				
				$conflict_room_text = substr($conflict_room_text, 0, -2);
				$conflict_room_text = str_lreplace(',', ' and ', $conflict_room_text);   

				$conflict_text  .= ' CONFLICT SC # '.$schedule_id.': '.json_encode($room_name).' Already has existing Room Schedule with subject '.json_encode($conflict_room_text).'. <br>';
			}
		}
		
		//section
		foreach ($days as $key => $day_id) {
			$is_section_conflict_sql ="SELECT * FROM schedule WHERE section_id_fk = '$section_id' AND term_grading IN ('$term_grading','$term_grading2nd') AND FIND_IN_SET('$day_id', day) AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";

			$is_section_conflict_query = mysqli_query($conn, $is_section_conflict_sql);
			$is_section_conflict_result = mysqli_fetch_assoc($is_section_conflict_query);

			if($is_section_conflict_result){
				$count_conflict += 1;

				$conflict_section_text = '';
				$room_name = '';
				$schedules = $is_section_conflict_result;

				foreach ($schedules as $key => $schedule) {

					if($key == 'schedule_id'){
						$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN section as sec ON sc.section_id_fk = sec.sec_id WHERE sc.schedule_id = '$schedule' ";

						$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
						$schedule_result = mysqli_fetch_assoc($get_schedule_query);

						$conflict_section_text .= $schedule_result['subj_name'].', ';
						$room_name =  $schedule_result['room_name'];
						$schedule_id =  $schedule_result['schedule_id'];
						$section_id = $schedule_result['sec_code'];
					}
				}
				
				$conflict_section_text = substr($conflict_section_text, 0, -2);
				$conflict_section_text = str_lreplace(',', ' and ', $conflict_section_text);   

				$conflict_text  .= 'CONFLICT SC # '.$schedule_id.': '.json_encode($section_id).' Already has existing Section Schedule with subject '.json_encode($conflict_section_text).' in room '.$room_name.'. <br>';
			}
		}
		
		//teacher
		foreach ($days as $key => $day_id) {
			$is_teacher_conflict_sql ="SELECT * FROM schedule WHERE teacher_id_fk = '$teacher_id' AND term_grading IN ('$term_grading','$term_grading2nd') AND FIND_IN_SET('$day_id', day) AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";

			$is_teacher_conflict_query = mysqli_query($conn, $is_teacher_conflict_sql);
			$is_teacher_conflict_result = mysqli_fetch_assoc($is_teacher_conflict_query);

			if($is_teacher_conflict_result){
				$count_conflict += 1;

				$conflict_teacher_text = '';
				$room_name = '';
				$schedules = $is_teacher_conflict_result;

				foreach ($schedules as $key => $schedule) {

					if($key == 'schedule_id'){
						$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN teacher ON sc.teacher_id_fk = teacher.teacher_id WHERE sc.schedule_id = '$schedule' ";

						$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
						$schedule_result = mysqli_fetch_assoc($get_schedule_query);
						$conflict_teacher_text .= $schedule_result['subj_name'].', ';
						$room_name =  $schedule_result['room_name'];
						$schedule_id =  $schedule_result['schedule_id'];
						$teacher =  $schedule_result['teacher_fullname'];
					}
				}
				
				$conflict_teacher_text = substr($conflict_teacher_text, 0, -2);
				$conflict_teacher_text = str_lreplace(',', ' and ', $conflict_teacher_text);   

				$conflict_text  .= 'CONFLICT SC # '.$schedule_id.': '.json_encode($teacher).' Already has existing Teacher\'s Schedule with subject '.json_encode($conflict_teacher_text).' in room '.$room_name.'. <br>';
			}
		}
		
		$is_acceptable = ((int)$test_start_time - (int)$test_end_time);
        
		if($count_conflict > 0){
			$response = array(
				'class' => 'danger', 
				'content' => $conflict_text, 
			);
			
		}else{
			if( ($start_hour_post == $end_hour_post) && ($start_minute_post == $end_minute_post) ){
				$response = array(
					'class' => 'danger', 
					'content' => 'Invalid Start and End Time or Too short!', //.$test_start_time .">=". $test_end_time." ".$is_acceptable
				);
				
			}else{
				$add = "INSERT INTO schedule (subject_id_fk, teacher_id_fk, room_id_fk, sc_id_fk, school_year, course_strand, term_grading, section_id_fk, day, start_time, end_time, text_color, background_color, border_color, is_approved)";
				$add .= "VALUES ('".$subject_id."', '".$teacher_id."', '".$room_id."', '".$sc_id."', '".$school_year."', '".$course_strand."', '".$term_grading."', '".$section_id."', '".$day."', '".$start_time."', '".$end_time."', '".$text_color."', '".$background_color."', '".$border_color."', '".$is_approved."')";

				$add_query = mysqli_query($conn, $add); 

				if ($add_query){
					$response = array(
						'class' => 'success', 
						'content' => 'New Schedule Added!', //.$test_start_time .">=". $test_end_time." ".$is_acceptable
					);
				}
			}
		}


	}
	
}else if($action == 'edit-schedule'){
	
	$current_schedule_id = mysqli_escape_string($conn, isset($_POST ['schedule_id']) ? $_POST ['schedule_id']: 0);
	$school_year = mysqli_escape_string($conn, isset($_POST ['school_year']) ? $_POST ['school_year']: '');
	$course_strand = mysqli_escape_string($conn, isset($_POST ['course_strand']) ? $_POST ['course_strand']: '');
	$term_grading = mysqli_escape_string($conn, isset($_POST ['term_grading']) ? $_POST ['term_grading']: '');

	if($term_grading=="1st Term"){
		$term_grading2nd ="1st Quarter";
	}
	else if($term_grading=="2nd Term"){
		$term_grading2nd ="1st Quarter";
	}
	else if($term_grading=="3rd Term"){
		$term_grading2nd ="2nd Quarter";
	}
	else if($term_grading=="1st Quarter"){
		$term_grading2nd ="1st Term";
	}
	else if($term_grading=="1st Quarter"){
		$term_grading2nd ="1st Term";
	}
	else if($term_grading=="2nd Quarter"){
		$term_grading2nd ="2nd Term";
	}

	$sc_id 		= mysqli_escape_string($conn, isset($_POST ['sc_id']) ? $_POST ['sc_id']: '');
	$section_id 	= mysqli_escape_string($conn, isset($_POST ['section_id']) ? $_POST ['section_id']: '');
	$subject_id 	= mysqli_escape_string($conn, isset($_POST ['subject_id']) ? $_POST ['subject_id']: '');
	$teacher_id 	= mysqli_escape_string($conn, isset($_POST ['teacher_id']) ? $_POST ['teacher_id']: '');
	$room_id 		= mysqli_escape_string($conn, isset($_POST ['room_id']) ? $_POST ['room_id']: '');
	$day 			= mysqli_escape_string($conn, isset($_POST ['day']) ? implode(',', $_POST ['day']): '');
	$start_hour_post 	= mysqli_escape_string($conn, isset($_POST ['start_hour']) ? $_POST ['start_hour']: '');
	$start_minute_post 	= mysqli_escape_string($conn, isset($_POST ['start_minute']) ? $_POST ['start_minute']: '');
	$end_hour_post 		= mysqli_escape_string($conn, isset($_POST ['end_hour']) ? $_POST ['end_hour']: '');
	$end_minute_post 	= mysqli_escape_string($conn, isset($_POST ['end_minute']) ? $_POST ['end_minute']: '');
	$text_color 	= mysqli_escape_string($conn, isset($_POST ['text_color']) ? $_POST ['text_color']: '');
	$background_color 	= mysqli_escape_string($conn, isset($_POST ['background_color']) ? $_POST ['background_color']: '');
	$border_color 	= mysqli_escape_string($conn, isset($_POST ['border_color']) ? $_POST ['border_color']: '');
	$is_approved 	= 'no';
	
	$start_hour 	= (int)$start_hour_post;
	$start_minute 	= (int)$start_minute_post;
	$test_start_time = 0;
	$test_end_time = 0;
	
	if($start_minute < 59 ){
		$start_minute = ($start_minute + 1);
		$test_start_time = $start_hour + $start_minute;
		$start_minute = $start_minute < 10 ? '0'.$start_minute : $start_minute;
		$start_time 	= $start_hour.':'.$start_minute.':00';
	}else{
		$start_hour = ($start_hour + 1);
		$test_start_time = $start_hour + $start_minute;
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
		$end_time 	= $end_hour.':'.$end_minute.':00';
	}else{
		$end_hour = $end_hour - 1;
		$test_end_time = $end_hour + 59;
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
	

	if ( isset($_POST['submit']) &&  ($current_schedule_id > 0) ){
		//echo $course_id. ' '.$school_year_id;
		$count_conflict = 0;
		$conflict_text = '';   	
		$days = explode(',', $day);
		
		foreach ($days as $key => $day_id) {
			//$is_room_conflict_sql ="SELECT * FROM schedule WHERE schedule_id != '$schedule_id' AND room_id_fk = '$room_id' AND term_grading = '$term_grading' AND day = '$day_id' AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
			$is_room_conflict_sql ="SELECT * FROM schedule WHERE schedule_id != '$current_schedule_id' AND room_id_fk = '$room_id' AND term_grading IN ('$term_grading','$term_grading2nd') AND FIND_IN_SET('$day_id', day) AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
			$is_room_conflict_query = mysqli_query($conn, $is_room_conflict_sql);
			$is_room_conflict_result = mysqli_fetch_assoc($is_room_conflict_query);
			if($is_room_conflict_result){
				$count_conflict += 1;

				$conflict_room_text = '';
				$room_name = '';
				$schedules = $is_room_conflict_result;
				foreach ($schedules as $key => $schedule) {
					if($key == 'schedule_id'){
						$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id WHERE sc.schedule_id = '$schedule' ";
						$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
						$schedule_result = mysqli_fetch_assoc($get_schedule_query);
						$conflict_room_text .= $schedule_result['subj_name'].', ';
						$room_name =  $schedule_result['room_name'];
						$schedule_id =  $schedule_result['schedule_id'];
					}
				}
				
				$conflict_room_text = substr($conflict_room_text, 0, -2);
				$conflict_room_text = str_lreplace(',', ' and ', $conflict_room_text);   

				$conflict_text  .= 'SC # '.$schedule_id.': Room Schedule conflict with subject '.json_encode($conflict_room_text).'. ';
			}
		}
		
		foreach ($days as $key => $day_id) {
			//$is_section_conflict_sql ="SELECT * FROM schedule WHERE schedule_id != '$schedule_id' AND section_id_fk = '$section_id' AND term_grading = '$term_grading' AND day = '$day_id' AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
			$is_section_conflict_sql ="SELECT * FROM schedule WHERE schedule_id != '$current_schedule_id' AND section_id_fk = '$section_id' AND term_grading IN ('$term_grading','$term_grading2nd') AND FIND_IN_SET('$day_id', day) AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
			$is_section_conflict_query = mysqli_query($conn, $is_section_conflict_sql);
			$is_section_conflict_result = mysqli_fetch_assoc($is_section_conflict_query);
			if($is_section_conflict_result){
				$count_conflict += 1;

				$conflict_section_text = '';
				$room_name = '';
				$schedules = $is_section_conflict_result;
				foreach ($schedules as $key => $schedule) {
					if($key == 'schedule_id'){
						$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id WHERE sc.schedule_id = '$schedule' ";
						$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
						$schedule_result = mysqli_fetch_assoc($get_schedule_query);
						$conflict_section_text .= $schedule_result['subj_name'].', ';
						$room_name =  $schedule_result['room_name'];
						$schedule_id =  $schedule_result['schedule_id'];
					}
				}
				
				$conflict_section_text = substr($conflict_section_text, 0, -2);
				$conflict_section_text = str_lreplace(',', ' and ', $conflict_section_text);   

				$conflict_text  .= 'SC # '.$schedule_id.': Section Schedule conflict to subject '.json_encode($conflict_section_text).' in room '.$room_name.'. ';
			}
		}
	
		foreach ($days as $key => $day_id) {	
			//$is_teacher_conflict_sql ="SELECT * FROM schedule WHERE schedule_id != '$schedule_id' AND teacher_id_fk = '$teacher_id' AND term_grading = '$term_grading' AND day = '$day_id' AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
			$is_teacher_conflict_sql ="SELECT * FROM schedule WHERE schedule_id != '$current_schedule_id' AND teacher_id_fk = '$teacher_id' AND term_grading IN ('$term_grading','$term_grading2nd') AND FIND_IN_SET('$day_id', day) AND (HOUR(start_time) BETWEEN '$start_date' AND '$end_date' OR HOUR(end_time) BETWEEN '$start_date' AND '$end_date') GROUP BY schedule_id ";
			$is_teacher_conflict_query = mysqli_query($conn, $is_teacher_conflict_sql);
			$is_teacher_conflict_result = mysqli_fetch_assoc($is_teacher_conflict_query);
			if($is_teacher_conflict_result){
				$count_conflict += 1;

				$conflict_teacher_text = '';
				$room_name = '';
				$schedules = $is_teacher_conflict_result;
				foreach ($schedules as $key => $schedule) {
					if($key == 'schedule_id'){
						$get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id WHERE sc.schedule_id = '$schedule' ";
						$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
						$schedule_result = mysqli_fetch_assoc($get_schedule_query);
						$conflict_teacher_text .= $schedule_result['subj_name'].', ';
						$room_name =  $schedule_result['room_name'];
						$schedule_id =  $schedule_result['schedule_id'];
					}
				}
				
				$conflict_teacher_text = substr($conflict_teacher_text, 0, -2);
				$conflict_teacher_text = str_lreplace(',', ' and ', $conflict_teacher_text);   

				$conflict_text  .= 'SC # '.$schedule_id.': Teacher\'s Schedule conflict to subject '.json_encode($conflict_teacher_text).' in room '.$room_name.'. ';
			}
		}
		
		$is_acceptable = ((int)$test_start_time - (int)$test_end_time);
        
		if($count_conflict > 0){
			$response = array(
				'class' => 'danger', 
				'content' => $conflict_text, 
			);
			
		}else{
			if( ($start_hour_post == $end_hour_post) && ($start_minute_post == $end_minute_post) ){
				$response = array(
					'class' => 'danger', 
					'content' => 'Invalid Start and End Time or Too short!', //.$test_start_time .">=". $test_end_time." ".$is_acceptable
				);
				
			}else{

				$edit = "UPDATE schedule"; 
				$edit .= " SET subject_id_fk = '".$subject_id."', teacher_id_fk = '".$teacher_id."', room_id_fk = '".$room_id."', sc_id_fk = '".$sc_id."', school_year = '".$school_year."', course_strand = '".$course_strand."', term_grading = '".$term_grading."', section_id_fk = '".$section_id."', day = '".$day."', start_time = '".$start_time."', end_time = '".$end_time."', text_color = '".$text_color."', background_color = '".$background_color."', border_color = '".$border_color."'";
				$edit .= " WHERE schedule_id = '".$current_schedule_id."'";
				
				$edit_query = mysqli_query($conn, $edit); 

				if ($edit_query){
					$response = array(
						'class' => 'success', 
						'content' => 'Schedule Now Updated!', //.$test_start_time .">=". $test_end_time." ".$is_acceptable
					);
				}
			}
		}


	}
	
}else if($action == 'get-schedule'){
	$schedule_id = strip_tags(html_entity_decode(isset($_REQUEST['schedule_id']) ? $_REQUEST['schedule_id'] : ''));	
	
	$schedule_sql ="SELECT * FROM schedule WHERE schedule_id = '".$schedule_id."' ";
	$schedule_query = mysqli_query($conn, $schedule_sql) or die ('failed query');
	$schedule_result = mysqli_fetch_assoc($schedule_query);
	//print_r($schedule_result);
	if($schedule_result){
		$response = array(
			'class' => 'success', 
			'content' => 'Schedule details found!', 
			'data' => $schedule_result, 
		);
	}else{
		$response = array(
			'class' => 'error', 
			'content' => 'Not found!', 
		);
	}
}else if($action == 'get-strand-course'){

	$sc_sc = strip_tags(html_entity_decode(isset($_REQUEST['sc_sc']) ? $_REQUEST['sc_sc'] : ''));	
	
	$sc_sql ="SELECT * FROM strand_course WHERE sc_sc = '".$sc_sc."' AND sc_status = 'Activated' ";
	$sc_query = mysqli_query($conn, $sc_sql);
	$sc_data = array();
	while ($sc_result = mysqli_fetch_assoc($sc_query)){
		$sc_data[] = $sc_result;
		//echo $sc_result['sc_name'];
	}
	
	//print_r($sc_data);
	if($sc_data){
		$response = array(
			'class' => 'success', 
			'content' => $sc_sc.' list found!', 
			'data' => $sc_data, 
		);
	}else{
		$response = array(
			'class' => 'error', 
			'content' => 'Not found!', 
		);
	}
}else if($action == 'get-section-by-strand-course'){

	$sc_id = strip_tags(html_entity_decode(isset($_REQUEST['sc_id']) ? $_REQUEST['sc_id'] : ''));	
	
	$section_sql ="SELECT * FROM section WHERE sc_id_fk = '".$sc_id."' AND sec_status = 'Activated' ";
	$section_query = mysqli_query($conn, $section_sql);
	$section_data = array();
	while ($section_result = mysqli_fetch_assoc($section_query)){
		$section_data[] = $section_result;
	}
	
	//print_r($sc_data);
	if($section_data){
		$response = array(
			'class' => 'success', 
			'content' => 'Section list found!', 
			'data' => $section_data, 
		);
	}else{
		$response = array(
			'class' => 'error', 
			'content' => 'Not found!', 
		);
	}
}else if($action == 'approve-schedule'){

	$schedule_id = strip_tags(html_entity_decode(isset($_REQUEST['schedule_id']) ? $_REQUEST['schedule_id'] : ''));	
	if($schedule_id){
		$approve_sql ="UPDATE schedule SET is_approved = 'yes' WHERE schedule_id = '".$schedule_id."'";
		$approve_query = mysqli_query($conn, $approve_sql);
	}
}else if($action == 'disapprove-schedule'){

	$schedule_id = strip_tags(html_entity_decode(isset($_REQUEST['schedule_id']) ? $_REQUEST['schedule_id'] : ''));	
	if($schedule_id){
		$approve_sql ="UPDATE schedule SET is_approved = 'no' WHERE schedule_id = '".$schedule_id."'";
		$approve_query = mysqli_query($conn, $approve_sql);
	}
}else if($action == 'delete-schedule'){

	$schedule_id = strip_tags(html_entity_decode(isset($_REQUEST['schedule_id']) ? $_REQUEST['schedule_id'] : ''));	
	if($schedule_id){
		$delete_sql ="DELETE FROM schedule WHERE schedule_id = '".$schedule_id."'";
		$delete_query = mysqli_query($conn, $delete_sql);
	}
}

echo json_encode($response);

?>