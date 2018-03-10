<?php 
require('../server/p_db_connection.php');
if (!empty($_POST["term"])){
	$term = $_POST["term"];

	$query_year = "SELECT * FROM school_year WHERE status='Activated'";
	
	$year_results = mysqli_query($conn, $query_year);

	while($year = mysqli_fetch_assoc($year_results)) {
		$activated_year = $year["school_year"];
}

 $day = date('l');

      $sql  = "SELECT * FROM monitoring as mo LEFT JOIN schedule AS sch ON mo.m_schedule_id_fk = sch.schedule_id LEFT JOIN day ON mo.m_day_id_fk = day.day_id LEFT JOIN section as sec ON mo.m_section_id_fk = sec.sec_id LEFT JOIN teacher as te ON mo.m_teacher_id_fk = te.teacher_id LEFT JOIN subject as sub ON mo.m_subject_id_fk = sub.subj_id LEFT JOIN rooms as ro ON mo.m_room_id_fk = ro.room_id LEFT JOIN monitor_legend as ml ON mo.m_remarks = ml.legend_id WHERE school_year='".$activated_year."' AND term_grading ='".$term."' ORDER BY school_year, term_grading, day, start_time ASC";

      $query = mysqli_query($conn, $sql) or die('ERASED SCHEDULE');

      while ($result = mysqli_fetch_assoc($query)){

                    $start_time = explode(':', $result['start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $result['end_time']);

                    //print_r($end_time);

                    //START TIME
                    $new_start_minute = ((int)$start_time[1] - 1) < 10 ? '0'.((int)$start_time[1] - 1) : ((int)$start_time[1] - 1);

                     $start_hour = $start_time[0] > 12 ? '0'.($start_time[0] - 12) : $start_time[0] - 0;

                    if ($start_time[0] > 11){
                      $new_start_time = $start_hour.':'.$new_start_minute.':00 pm';
                    }
                    else{
                      $new_start_time = $start_hour.':'.$new_start_minute.':00 am';
                    }

                    //END TIME
                    $hour = ((int)$end_time[1] + 1) > 58 ? '0'.((int)$end_time[0] + 1) : ((int)$end_time[0] + 0 ); 

                   $new_end_minute = ((int)$end_time[1] + 1) > 58 ? '0'.((int)$end_time[1] - 59) : ((int)$end_time[1] + 1);
                   
                   $new_hour = $hour > 12 ? '0'.($hour - 12) : $hour - 0;

                    if ($hour > 11){
                      $new_end_time = $new_hour.':'.$new_end_minute.':00 pm';
                    }
                    else{
                      $new_end_time = $new_hour.':'.$new_end_minute.':00 am';
                    }  
                    
                    if ($new_end_time[0] > 12){ 
                      $final_end_time = ((int)$new_end_time[0] - 12);
                    }
	   
?>
		            <tr>
                    <td><?php echo $result['school_year'];?></td>
                    <td><?php echo $result['day_code'];?></td>
                    <td><?php echo $result['sec_code'];?></td>
                    <td><?php echo $result['teacher_fullname'];?></td>
                    <td><?php echo $result['subj_code'];?></td>
                    <td><?php echo $result['room_number'];?></td>
                    <td><?php echo $new_start_time .' - '.$new_end_time;?></td>
                    <td><?php echo $result['m_username'];?></td>
                    <td><?php echo $result['legend_name'];?></td>
                    <td><?php echo $result['m_comments'];?></td>
                    <td><?php echo $result['m_date'];?></td>
                   </tr> 

                    

             
<?php
}
}
?>