<?php
require('../server/p_db_connection.php');


if (!empty($_POST["teacher_id"])){
	$teacher = $_POST["teacher_id"];

	$query = "SELECT * FROM schedule as sc LEFT JOIN  teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN rooms as ro ON sc.room_id_fk = ro.room_id LEFT JOIN subject as sub ON sc.subject_id_fk = sub.subj_id WHERE sc.teacher_id_fk = '".$teacher."' ";
	
	$results = mysqli_query($conn, $query);

	while ($schedule_result = mysqli_fetch_assoc($results)){
                    $start_time = explode(':', $schedule_result['start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $schedule_result['end_time']);
                    //print_r($end_time);

                    $new_start_minute = ((int)$start_time[1] - 1) < 10 ? '0'.((int)$start_time[1] - 1) : ((int)$start_time[1] - 1);
                    $new_start_time = $start_time[0].':'.$new_start_minute.':00';

                    $new_end_minute = ((int)$end_time[1] + 1) < 10 ? '0'.((int)$end_time[1] + 1) : ((int)$end_time[1] + 1);
                    $new_end_time = $end_time[0].':'.$new_end_minute.':00';


                    $start_time_new = $new_start_time;
                    $end_time_new = $new_end_time;
                    $schedule_id = $schedule_result['schedule_id'];
                    $day = $schedule_result['day_name'];
                    $room = $schedule_result['room_number'];
                    $subject_name = $schedule_result['subj_name'];
                    $subject_code = $schedule_result['subj_code'];

		
?>
	
             
                      <td><?php echo $schedule_result['day_name'];?></td>
                      <td><?php echo $schedule_result['subj_code'];?></td>
                      <td><?php echo $schedule_result['subj_name'];?></td>
                      <td><?php echo $schedule_result['room_number'];?></td>
                      <td><?php echo $schedule_result['start_time'];?></td>
                      <td><?php echo $schedule_result['end_time'];?></td>
                      
                      
                      



<?php
}
}
?>