<?php 
include("dashboard.php");
include('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="with draggable and editable events" />

    <link href='fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='fullcalendar/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <script src='fullcalendar/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/jquery.form.min.js'></script>
    <script src='fullcalendar/jquery.validate.js'></script>
    <script src='fullcalendar/bootstrap-colorpicker.js'></script>

    <title> </title>


</head>

<style>


</style>

<body>

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header"> <center>Monitor Class Schedule</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">Monitor Schedule</li>
      </ul>

<!-- Page Heading -->
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
  <center><b>TERM</b></center>
</div>
<div class="panel-body">

<div class="form-group col-md-12">
<form method="POST" action="#">
<label>Term</label>
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-graduation-cap"></span>
                        </span>
                        <select class="form-control" name="year" onchange="getID(this.value);" required>
                          <option value="">Select Day:</option>
                          <option value="1st Term">1st Term</option>
                          <option value="2nd Term">2nd Term</option>
                          <option value="3rd Term">3rd Term</option>
                          <option value="1st Grading">1st Grading</option>
                          <option value="2nd Grading">2nd Grading</option>
                          </select>
                      </div>
                    </div> 

<div class="form-group col-md-12">
    <label>Schedule</label>
    <div class="input-group">
      <span class="input-group-addon"><span class="fa fa-book"></span></span>
        <?php 
          $query ="SELECT * FROM schedule";
          $sql = mysqli_query($conn, $query);
                          
            if($query){
        ?>
        <select class="form-control" name="schedule_id" id="schedule" onchange="getId(this.value);">
          <option value=""> Schedule:</option>

        <?php
          while ($result = mysqli_fetch_assoc($sql)){
            echo '<option value="'.$result['sec_id'].'">'.$result['sec_name'].' </option>';
          }
            }
        ?>
        </select>
    </div>
  </div>
  </div>
  </div>
<br />
<br />-->
                <?php if(isset($_SESSION['success_add_monitor'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_monitor'];?></div>
                    
                  <?php $_SESSION['success_add_monitor'] = null; }?> 

                  <?php if(isset($_SESSION['error_monitor'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_monitor'];?></div>
                    
                  <?php $_SESSION['error_monitor'] = null; }?> 


<div class="col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      Monitoring
    </div>
    <div class="panel-body">
      <div class="table-responsive">        
          <table class="table table-bordered" width="100%" cellspacing="0" id="teacher_schedule">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Term</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
                    <th style="text-align: center;">Action</th>
              </thead>

              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Term</th>
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
      $sql  = "SELECT * FROM schedule as sch LEFT JOIN teacher as te ON sch.teacher_id_fk = te.teacher_id LEFT JOIN day ON sch.day = day.day_id LEFT JOIN section as sec ON sch.section_id_fk = sec.sec_id LEFT JOIN subject as sub ON sch.subject_id_fk = sub.subj_id LEFT JOIN rooms as ro ON sch.room_id_fk = ro.room_id  ORDER BY school_year, term_grading, day, start_time ASC";

      $query = mysqli_query($conn, $sql);


      while ($result = mysqli_fetch_assoc($query)){

         $day = date('l');
         $year = date('Y');
         

         $start_time = explode(':', $result['start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $result['end_time']);

                    //print_r($end_time);

                    //START TIME
                    $new_start_minute = ((int)$start_time[1] - 1) < 10 ? '0'.((int)$start_time[1] - 1) : ((int)$start_time[1] - 1);

                    if ($start_time[0] > 11){
                      $new_start_time = $start_time[0].':'.$new_start_minute.':00 pm';
                    }
                    else{
                      $new_start_time = $start_time[0].':'.$new_start_minute.':00 am';
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
                    <td><?php echo $result['school_year'];?></td>
                    <td><?php echo $result['term_grading'];?></td>
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
              </tbody>
              <?php
                }

              ?>
          </table>
      </div>
    </div>
    


<br />

</body>
</html>