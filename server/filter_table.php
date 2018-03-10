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

      $sql  = "SELECT * FROM schedule as sch LEFT JOIN teacher as te ON sch.teacher_id_fk = te.teacher_id LEFT JOIN day ON sch.day = day.day_id LEFT JOIN section as sec ON sch.section_id_fk = sec.sec_id LEFT JOIN subject as sub ON sch.subject_id_fk = sub.subj_id LEFT JOIN rooms as ro ON sch.room_id_fk = ro.room_id WHERE day_name = '$day' AND school_year='".$activated_year."' AND term_grading ='".$term."' ORDER BY school_year, term_grading, day, start_time ASC";

      $query = mysqli_query($conn, $sql);

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
                    <td><?php echo $result['day_name'];?></td>
                    <td><?php echo $result['sec_code'];?></td>
                    <td><?php echo $result['teacher_fullname'];?></td>
                    <td><?php echo $result['subj_code'];?></td>
                    <td><?php echo $result['room_number'];?></td>
                    <td><?php echo $new_start_time;?></td>
                    <td><?php echo $new_end_time;?></td>
                    <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $result['schedule_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Remarks</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $result['schedule_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Monitor Schedules</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/p_monitor_schedule.php">

                        <div hidden> <input type="number" name="m_schedule_id" class="form-control" value="<?php echo $result['schedule_id']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="m_subject_id" class="form-control" value="<?php echo $result['subject_id_fk']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="m_teacher_id" class="form-control" value="<?php echo $result['teacher_id_fk']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="m_room_id" class="form-control" value="<?php echo $result['room_id_fk']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="m_sc_id" class="form-control" value="<?php echo $result['sc_id_fk']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="m_section_id" class="form-control" value="<?php echo $result['section_id_fk']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="m_day_id" class="form-control" value="<?php echo $result['day']; ?>" readonly>
                        </div>

                        <div hidden> <input type="number" name="is_marked" class="form-control" value="1" readonly>
                        </div>

                        <div class="form-group col-md-12">
                        <label>Remarks:</label>
                          <div class="radio" required>
                            <label>
                              <input name="m_remarks" type="radio" value="1" required="" /> Present &nbsp;&nbsp;
                            </label> 
                            <label>
                              <input name="m_remarks" type="radio" value="2" required="" /> Absent &nbsp;&nbsp;
                            </label>
                            <label>
                              <input name="m_remarks" type="radio" value="3" required="" /> Late &nbsp;&nbsp;
                            </label>
                             <label>
                              <input name="m_remarks" type="radio" value="4" required="" /> On Leave &nbsp;&nbsp;
                            </label>
                             <label>
                              <input name="m_remarks" type="radio" value="5" required="" /> No Class &nbsp;&nbsp;
                            </label>   
                        </div>
                        </div>

                        <div class="form-group col-md-12">
                        <label>Comments:</label>
                          <div class="checkbox">
                            <label>
                              <textarea row ="5" cols="50" name="comment" placeholder="Your Comment here. . ."></textarea>
                            </label>  
                        </div>
                        </div>
                       
                      <br /><br /><br /><br /><br /><br /><br /><br /><br />

                      <div class="modal-footer">
                      <div class="btn-group">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary" data-action="save" role="button">Save
                        </button>
                      </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                       </div> 
                    
                    </form>
                    <!-- End Form -->
                    </div>
                    <!-- End Modal Body -->
                    </div>
                    <!-- End Modal Content -->
                    </div>
                    <!-- End col-lg-12 -->
                    </div>
                    <!-- End Modal Dialog -->
                    </div>
                    <!-- End Modal ID Update -->
                  </td>
                  </tr>
             
<?php
}
}
?>