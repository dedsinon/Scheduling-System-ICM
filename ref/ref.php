 <?php
 require('../server/p_db_connection.php');

  $current_yt_sql =" SELECT *FROM school_year WHERE is_current = 1 LIMIT 1";
  $current_yt_query = mysqli_query($conn, $current_yt_sql);
  $current_yt_result = mysqli_fetch_assoc($current_yt_query);
    print_r($current_yt_result['school_year_id']);
  $current_school_year_id = $current_yt_result['school_year_id'];

  $events = array();
    $filter_by = isset($_GET['filterBy']) ? $_GET['filterBy'] : ''
    $section_id = isset($_GET['section_id']) ? $_GET['section_id'] : '';
    $teacher_id = isset($_GET['teacher_id']) ? $_GET['teacher_id'] : '';
    $room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';
    $school_year_id = isset($_GET['school_year_id']) ? $_GET['school_year_id'] : '';

  if($filter_by) {

    $where_sql = '';

    if($section_id){
      $where_sql = "sc.section_id = '$section_id'";
    }
    else if($teacher_id){
      $where_sql = "sc.teacher_id = '$teacher_id'";
    }
    else if($room_id){
      $where_sql = "sc.room_id = '$room_id'";
    }
    else if($school_year_id){
      $where_sql = "sc.sy_id = '$school_year_id'";
    }

    
    if($section_id || $teacher_id ||$room_id || $school_year_id){

    $get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id = ro.room_id LEFT JOIN teacher as te ON sc.teacher_id = te.teacher_fullname LEFT JOIN section as sec ON sc.section_id = sec.section_id WHERE $where_sql";

    $get_schedule_query = mysqli_query($conn, $get_schedule_sql);
               
      while ($schedule_result = mysqli_fetch_assoc($get_schedule_query)){

        $start_time = explode(':', $schedule_result['start_time']);
        //print_r($start_time);
        $end_time = explode(':', $schedule_result['end_time']);
        //print_r($end_time);

        $new_start_minute = ((int)$start_time[1] - 1) < 10 ? '0'.((int)$start_time[1] - 1) : ((int)$start_time[1] - 1);
        $new_start_time = $start_time[0].':'.$new_start_minute.':00';

        $new_end_minute = ((int)$end_time[1] + 1) < 10 ? '0'.((int)$end_time[1] + 1) : ((int)$end_time[1] + 1);
        $new_end_time = $end_time[0].':'.$new_end_minute.':00';

        $events[] = array(
          'title'             => $schedule_result['subj_name'],
          'room'              => $schedule_result['room_name'],
          //'start'             => $schedule_result['start_time'],
          //'end'               => $schedule_result['end_time'],
          'start'             => $new_start_time,
          'end'               => $new_end_time,
          'dow'               => '['.$schedule_result['day'].']',
          'backgroundColor'   => $schedule_result['background_color'],
          'borderColor'       => $schedule_result['border_color'],
          'eventTextColor'    => $schedule_result['text_color'],
        );
      }
                //echo json_encode($events);
    }
  }
?>