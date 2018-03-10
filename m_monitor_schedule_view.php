<?php 
require('m_dashboard.php');
require('server/p_db_connection.php');


$day = $_POST ['day'];
$year = $_POST ['year'];
$term = $_POST ['term'];
$quarter = $_POST ['quarter'];


?>

<!DOCTYPE html>
<html>

<head>

    <title> Class Schedule </title>
   
</head>

<style>
    body {
        font-family: arial;
        overflow-x: hidden; 
    }
    #calendar {
        width: 100%;
        margin: 0 auto;
    }

    .form-control.error{
        border: 1px solid red;
    }
    #validate-notification-wrapper{
        float: left;
        text-align: left;
    }
    .fc-time-grid .fc-event, .fc-time-grid .fc-bgevent{
        cursor: pointer;
    }
    .sched_id_wrapper{
        position: absolute;
        right: 0;
        top: 0;
    }

    @media print{
  body{ background-color:#FFFFFF; background-image:none; color:#000000 }
  #ad{ display:none;}
  #leftbar{ display:none;}
  #contentarea{ width:100%;}
}
</style>

<body>
 <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-">
      <h2 class="page-header"> <center> Selected Class Schedule</center></h2>
    </div>
  </div> 

      <ul class="breadcrumb">
          <li>Click to return:</li>
          <li class="active" title="View Room"> <a href="m_monitor_schedule.php">Monitor Schedule</a></li>
      </ul>
<br/>

<div class="col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      View Selected Schedule
    </div>
    <div class="panel-body">
      <div class="table-responsive">        
          <table class="table table-bordered" width="100%" cellspacing="0">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>

              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
                    <th style="text-align: center;">Action</th>
                    
                </tr>
              </tfoot>
                <?php

                $get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id  LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN monitoring as mo ON sc.schedule_id = mo.m_schedule_id_fk LEFT JOIN section as sec ON sc.section_id_fk = sec.sec_id WHERE sc.day = '".$day."'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') ";

                //print_r($get_schedule_sql);

                $get_schedule_query = mysqli_query($conn, $get_schedule_sql);
               
                while ($schedule_result = mysqli_fetch_assoc($get_schedule_query)){

                    $section =  $schedule_result['sec_name'];

                    $start_time = explode(':', $schedule_result['start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $schedule_result['end_time']);

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

              <tbody>

              <tr>
                  <?php 




                  if($schedule_result['m_is_monitored'] != "1") { ?> 

                  <td><?php echo $schedule_result['school_year']?></td>
                  <td><?php echo $schedule_result['day_name']?></td>
                  <td><?php echo $schedule_result['sec_code']?></td>
                  <td><?php echo $schedule_result['teacher_fullname']?></td>
                  <td><?php echo $schedule_result['subj_name']?></td>
                  <td><?php echo $schedule_result['room_number']?></td>
                  <td><?php echo $new_start_time; ?></td>
                  <td><?php echo $new_end_time; ?></td>
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $schedule_result['schedule_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Remarks</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $schedule_result['schedule_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Monitor Schedules</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/m_p_monitor_schedule.php">

                        <div hidden> <input type="number" name="m_is_monitored" class="form-control" value='1' readonly>
                        </div>


                        <div hidden> <input type="number" name="schedule" class="form-control" value='<?php echo $schedule_result['schedule_id']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="subject" class="form-control" value='<?php echo $schedule_result['subject_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="teacher" class="form-control" value='<?php echo $schedule_result['teacher_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="room" class="form-control" value='<?php echo $schedule_result['room_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="sc" class="form-control" value='<?php echo $schedule_result['sc_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="section" class="form-control" value='<?php echo $schedule_result['section_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="day" class="form-control" value='<?php echo $schedule_result['day']?>' readonly>
                        </div>

                        <div hidden> <input type="text" name="school_year" class="form-control" value='<?php echo $schedule_result['school_year']?>' readonly>
                        </div>

                        <div hidden> <input type="text" name="term_grading" class="form-control" value='<?php echo $schedule_result['term_grading']?>' readonly>
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
                              <textarea row ="5" cols="50" name="m_comments" placeholder="Your Comment here. . ."></textarea>
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


                  <?php }else if($schedule_result['m_is_monitored'] == "1") { ?> 
                  <td style="color: red;"><?php echo $schedule_result['school_year']?></td>
                  <td style="color: red;"><?php echo $schedule_result['day_name']?></td>
                  <td style="color: red;"><?php echo $schedule_result['sec_code']?></td>
                  <td style="color: red;"><?php echo $schedule_result['teacher_fullname']?></td>
                  <td style="color: red;"><?php echo $schedule_result['subj_name']?></td>
                  <td style="color: red;"><?php echo $schedule_result['room_number']?></td>
                  <td style="color: red;"><?php echo $new_start_time; ?></td>
                  <td style="color: red;"><?php echo $new_end_time; ?></td>
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update<?php echo $schedule_result['schedule_id']; ?>" id="#edit" disabled>
                    <span class="glyphicon glyphicon-pencil"></span> Remarks</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $schedule_result['schedule_id']; ?>" class="modal fade" role="dialog">
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

                        <div hidden> <input type="number" name="m_is_monitored" class="form-control" value='1' readonly>
                        </div>


                        <div hidden> <input type="number" name="schedule" class="form-control" value='<?php echo $schedule_result['schedule_id']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="subject" class="form-control" value='<?php echo $schedule_result['subject_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="teacher" class="form-control" value='<?php echo $schedule_result['teacher_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="room" class="form-control" value='<?php echo $schedule_result['room_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="sc" class="form-control" value='<?php echo $schedule_result['sc_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="section" class="form-control" value='<?php echo $schedule_result['section_id_fk']?>' readonly>
                        </div>

                        <div hidden> <input type="number" name="day" class="form-control" value='<?php echo $schedule_result['day']?>' readonly>
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
                              <textarea row ="5" cols="50" name="m_comments" placeholder="Your Comment here. . ."></textarea>
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
              </tbody>
              </table>
              </div>
              </div>
              </div>
              </div>

            


</body>
</html>