<?php 
require ('dashboard.php');
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

  <title>ICL SCHEDULE</title>

  <!-- Show / Hide Password -->
  <script type="text/javascript" src="js/js_show_password.js"></script>
  <script type="text/javascript" src="js/js_live_search.js"></script>

</head>

<body>

  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header"><center>ICL SCHEDULE</center></h2>
    </div>
  </div> 

  <ul class="breadcrumb">
    <li>You are here:</li>
      <li class="active">ICL Schedule</li>
  </ul>

   
  <!-- Add ICL Schedule -->
  <div class="container-fluid">
    <div class="row">         
      

         <?php if(isset($_SESSION['success_add_icl_schedule'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_icl_schedule'];?></div>
                    
                  <?php $_SESSION['success_add_icl_schedule'] = null; }?> 

                  <?php if(isset($_SESSION['failed_add_icl_schedule'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['failed_add_icl_schedule'];?></div>
                    
                  <?php $_SESSION['failed_add_icl_schedule'] = null; }?> 

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading" id="head-add"> Add ICL Schedule 
            <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
            <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
          </div>

          <form id="myform" method="POST" action="server/add_icl_schedule.php">
          <div class="panel-body" id="body1">
            <div class="col-lg-12">
              <div class="row"> 
                    <div class="form-group col-lg-4">
                        <label>[ 1 ] School Year</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-th-list"></span>
                          </span>
                     <?php 
                        $yt_retrieve ="SELECT DISTINCT(school_year) FROM school_year WHERE status ='Activated'";
                        $yt_query = mysqli_query($conn, $yt_retrieve);
                          
                          if($yt_query){
                          ?>

                          <select class="form-control" name="school_year" required>
                            <option value=""> School Year:</option>

                            <?php
                            while ($yt_result = mysqli_fetch_assoc($yt_query)){
                              //$is_current = $yt_result['school_year_id'] == 1 ? 'selected':'';

                            echo '<option value="'.$yt_result['school_year'].'"">'.$yt_result['school_year'].' </option>';
                            }
                          
                            }
                      ?>
                          </select>
                        </div>
                    </div>
                  
                    <div class="form-group col-lg-4">
                        <label>[ 2 ] Teacher</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                    <?php 
                        $teach_retrieve ="SELECT * FROM teacher WHERE teacher_status ='Activated'";
                        $teach_query = mysqli_query($conn, $teach_retrieve);
                          
                          if($teach_query){
                          ?>
                          <select class="form-control" name="teacher_id" required>
                            <option value=""> Teacher:</option>

                            <?php
                            while ($teach_result = mysqli_fetch_assoc($teach_query)){

                            echo '<option value="'.$teach_result['teacher_id'].'">'.$teach_result['teacher_fullname'].' </option>';
                            }
                           
                        }
                      ?>
                      </select>
                        </div>

                    </div>


                    <div class="form-group col-lg-4">
                        <label>[ 3 ] Room</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                        <?php 
                        $room_retrieve ="SELECT * FROM rooms WHERE room_status ='Activated'";
                        $room_query = mysqli_query($conn, $room_retrieve);
                          
                          if($room_query){
                          ?>

                          <select class="form-control" name="room_id" required>
                            <option value=""> Room:</option>

                            <?php
                            while ($room_result = mysqli_fetch_assoc($room_query)){
                                ?>

                            <option value="<?php echo $room_result['room_id']; ?>"> [ <?php echo $room_result['room_number']; ?> ] <?php echo $room_result['room_name']; ?> </option>;
                            <?php
                        }
                        }
                      ?>
                      </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                      <label>[ 4 ] Course Name</label>
                      <div class="input-group"> 
                          <span class="input-group-addon">
                              <span class="fa fa-book" aria-hidden="true"> 
                              </span>
                          </span>
                          <input type="text" name="course_name" class="form-control" placeholder="Course Name" required>
                      </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>[ 5 ] Assign Day / Time Start and End</label>
                        <div class="checkbox">
                            <label>
                              <input name="day[]" type="checkbox" value="1" /> Monday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="2" /> Tuesday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                              <input name="day[]" type="checkbox" value="3" /> Wednesday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="4" /> Thursday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="5" /> Friday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="6" /> Saturday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="start_hour" id="start_hour" required>
                            <option value=""> Start Hour:</option>
                            <?php
                                for($start_hour=0; $start_hour <= 23; $start_hour++){   
                                   $start_hour = $start_hour < 10 ? '0'.$start_hour : $start_hour;
                                   echo '<option value="'.$start_hour.'">'.$start_hour.'</option>'; 
                                }
                            ?> 
                          </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-1">
                        <label>:</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="start_minute" required>
                            <option value="">  Start Minute:</option>
                            <?php
                                for($start_minute=0; $start_minute <= 59; $start_minute++){   
                                   $start_minute = $start_minute < 10 ? '0'.$start_minute : $start_minute;

                                    if ($start_minute % 15 == 0){
                                   echo '<option value="'.$start_minute.'">'.$start_minute.'</option>'; 
                                }
                            }
                            ?> 
                          </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="end_hour" id="end_hour" required>
                            <option value=""> End Hour:</option>
                            <?php
                                for($end_hour=0; $end_hour <= 23; $end_hour++){ 
                                   $end_hour = $end_hour < 10 ? '0'.$end_hour : $end_hour;
                                   echo '<option value="'.$end_hour.'">'.$end_hour.'</option>'; 
                                }
                            ?> 
                          </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-1">
                        <label>:</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="end_minute" required>
                            <option value="">  End Minute:</option>
                            <?php
                                for($end_minute=0; $end_minute <= 59; $end_minute++){   
                                   $end_minute = $end_minute < 10 ? '0'.$end_minute : $end_minute;

                                   if ($end_minute % 15 == 0){
                                   echo '<option value="'.$end_minute.'">'.$end_minute.'</option>'; 
                                }
                            }
                            ?> 
                          </select>
                        </div>
                    </div>

               
            </div>
            </div>
            <!-- End col-lg-12 -->
          </div>
          <!-- End Panel Body -->
          <div class="panel-footer">
              <button type="submit" name="submit" class="btn btn-primary" value='submit' id="submit"><i class="fa fa-plus-circle"></i> Add New Schedule</button>

                    <!-- Reset Button -->
                    <button class="btn btn-warning" type="button" onclick="myFunction()"><i class="fa fa-eraser"></i> Reset Form</button>

                     <!-- ResetFunction -->
                <script>
                function myFunction() {
                document.getElementById("myform").reset();
                }
                </script>
                <div class="pull-right">
                 <button class="btn btn-info" type="button" data-toggle="modal" data-target="#show_teacher_sche"><i class="fa fa-calendar"></i> View Teacher Schedule </button>
                 </div>
          </div>

          </form>

          <!-- Modal -->
<div id="show_teacher_sche" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form method="POST" action="show_teacher_schedule.php" target="_blank">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Show Teacher Schedule</h4>
      </div>
      <div class="modal-body">
          <div class="row"> 

         <div class="form-group col-lg-12">
                        <label>[ 1 ] Teacher</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                    <?php 
                        $teach_retrieve ="SELECT * FROM teacher WHERE teacher_status ='Activated'";
                        $teach_query = mysqli_query($conn, $teach_retrieve);
                          
                          if($teach_query){
                          ?>
                          <select class="form-control" name="teacher_id" required>
                            <option value=""> Teacher:</option>

                            <?php
                            while ($teach_result = mysqli_fetch_assoc($teach_query)){

                            echo '<option value="'.$teach_result['teacher_id'].'">'.$teach_result['teacher_fullname'].' </option>';
                            }
                           
                        }
                      ?>
                      </select>
                        </div>

                    </div>
                    <div class="form-group col-lg-6">
                        <label>[ 2 ] College Term</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="Term">
                            <option value=""> Term:</option>
                            <option value="1st Term"> 1st Term</option>
                            <option value="2nd Term"> 2nd Term</option>
                            <option value="3rd Term"> 3rd Term</option>
                          </select>
                        </div>

                    </div>
                    <div class="form-group col-lg-6">
                        <label>[ 3 ] Senior High Quarter</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="Quarter">
                            <option value=""> Quarter:</option>
                            <option value="1st Quarter"> 1st Quarter</option>
                            <option value="2nd Quarter"> 2nd Quarter</option>
                          </select>
                        </div>

                    </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit" value='submit'><i class="fa fa-plus-circle"></i>View</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
  </div>
</div>
        </div>
        <!-- End panel panel-default -->
      </div>
      <!-- End col-lg-12 -->
    </div>
    <!-- End row -->
  </div>
  <!-- End container-fluid -->
                               

  <!-- View Users -->
  <div class="container-fluid">

    <div class="panel panel-default">

      <div class="panel-header">
      </div>

      <div class="panel-body">
        <div class="table-responsive">        
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead class="thead-inverse">
              <tr>
                <th style="text-align: center;">School Year</th>
                <th style="text-align: center;">Teacher</th>
                <th style="text-align: center;">Room</th>
                <th style="text-align: center;">Course Name</th>
                <th style="text-align: center;">Day</th>
                <th style="text-align: center;">Start Time</th>
                <th style="text-align: center;">End Time</th>
                <th style="text-align: center;">Update</th>
              </tr>
            </thead>
            <tfoot class="thead-inverse">
              <tr>
                <th style="text-align: center;">School Year</th>
                <th style="text-align: center;">Teacher</th>
                <th style="text-align: center;">Room</th>
                <th style="text-align: center;">Course Name</th>
                <th style="text-align: center;">Day</th>
                <th style="text-align: center;">Start Time</th>
                <th style="text-align: center;">End Time</th>
                <th style="text-align: center;">Update</th>
              </tr>
            </tfoot>

              <!-- View Users -->
              <?php 

                $retrieve = 'SELECT * FROM schedule_icl as icl LEFT JOIN teacher as te ON icl.icl_teacher_id_fk = te.teacher_id LEFT JOIN rooms as ro ON icl.icl_room_id_fk = ro.room_id LEFT JOIN day ON day.day_id = icl.icl_day LEFT JOIN school_year as sy ON icl.icl_school_year = sy.school_year ORDER BY icl_school_year, icl_day, icl_start_time  ASC';
                  $query = mysqli_query($conn, $retrieve);

                  if($query){
                    while ($result = mysqli_fetch_assoc($query)){

                    $start_time = explode(':', $result['icl_start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $result['icl_end_time']);

                    $start_hour_new = $start_time[0];
                    $end_hour_new = $end_time[0];
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

               
                <td><?php echo $result['icl_school_year']; ?></td>
                <td><?php echo $result['teacher_fullname']; ?></td> 
                <td>[ <?php echo $result['room_number']; ?> ] <?php echo $result['room_name']; ?></td> 
                <td><?php echo $result['icl_course_name']; ?></td> 
                <td><?php 
                        
                        $days = $result['icl_day'];
                        $day = explode(',', $days);

                          if($day[0] = 1  || $day[1] = 1){
                              $d = "Monday";
                          }
                          else if ( $day[0] = 2 || $day[1] = 2){
                              $d = "Tuesday";
                          }
                          
                          echo $d;  
                    ?>
                </td> 
                <td><?php echo $new_start_time; ?></td> 
                <td><?php echo $new_end_time; ?></td>           
                <td style="text-align: center;">

                  <!-- Update Button -->
                  <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $result['icl_id']; ?>" id="#edit">
                  <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $result['icl_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update ICL Schedule</h4>
                      </div>

                      <div class="modal-body">

                       <form method="POST" action="server/p_update_schedule_icl.php">

                          <div class="col-lg-12">
                    <div class="row"> 
                    <div class="form-group col-lg-4">
                        <label>[ 1 ] School Year</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-th-list"></span>
                          </span>
                          <select class="form-control" name="update_school_year" required>
                            <option value="<?php echo $result['icl_school_year']; ?>"> <?php echo $result['icl_school_year']; ?></option>

                            
                            
                          </select>
                        </div>
                    </div>
                  
                    <div class="form-group col-lg-4">
                        <label>[ 2 ] Teacher</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                
                          <select class="form-control" name="update_teacher_id" required>
                            <option value="<?php echo $result['icl_teacher_id_fk']; ?>"> <?php echo $result['teacher_fullname']; ?></option>

                            <?php

                              $teach_retrieve ="SELECT * FROM teacher";
                        $teach_query = mysqli_query($conn, $teach_retrieve);
                          
                          if($teach_query){
                            while ($teach_result = mysqli_fetch_assoc($teach_query)){

                            echo '<option value="'.$teach_result['teacher_id'].'">'.$teach_result['teacher_fullname'].' </option>';
                            }
                           
                        }
                      ?>
                      </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>[ 3 ] Room</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>

                          <select class="form-control" name="update_room_id" required>
                            <option value="<?php echo $result['room_id']; ?>"><?php echo $result['room_number']; ?></option>

                            <?php

                             $room_retrieve ="SELECT * FROM rooms";
                        $room_query = mysqli_query($conn, $room_retrieve);
                          
                          if($room_query){
                            while ($room_result = mysqli_fetch_assoc($room_query)){
                                ?>

                            <option value="<?php echo $room_result['room_id']; ?>"> [ <?php echo $room_result['room_number']; ?> ] <?php echo $room_result['room_name']; ?> </option>;
                            <?php
                        }
                        }
                      ?>
                      </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                      <label>[ 4 ] Course Name </label>
                      <div class="input-group"> 
                          <span class="input-group-addon">
                              <span class="fa fa-book" aria-hidden="true"> 
                              </span>
                          </span>
                          <input type="text" name="course_name" class="form-control" value="<?php echo $result['icl_course_name']; ?>" placeholder="Course Name" required>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>[ 5 ] Assign Day / Time Start and End</label>
                        <div class="checkbox">
                            <label>
                              <input name="day[]" type="checkbox" value="1" /> Monday 
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="2" /> Tuesday 
                            </label>
                            <label>
                              <input name="day[]" type="checkbox" value="3" /> Wednesday 
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="4" /> Thursday 
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="5" /> Friday 
                            </label> 
                            <label>
                              <input name="day[]" type="checkbox" value="6" /> Saturday 
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="update_start_hour" id="start_hour" required>
                            <option value="<?php echo $start_hour_new; ?>"> <?php echo $start_hour_new; ?></option>
                            <?php
                                for($start_hour=0; $start_hour <= 23; $start_hour++){   
                                   $start_hour = $start_hour < 10 ? '0'.$start_hour : $start_hour;
                                   echo '<option value="'.$start_hour.'">'.$start_hour.'</option>'; 
                                }
                            ?> 
                          </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-1">
                        <label>:</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="update_start_minute" required>
                            <option value="<?php echo $new_start_minute ?>"> <?php echo $new_start_minute ?></option>
                            <?php
                                for($start_minute=0; $start_minute <= 59; $start_minute++){   
                                   $start_minute = $start_minute < 10 ? '0'.$start_minute : $start_minute;

                                    if ($start_minute % 15 == 0){
                                   echo '<option value="'.$start_minute.'">'.$start_minute.'</option>'; 
                                }
                            }
                            ?> 
                          </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="update_end_hour" id="end_hour" required>
                            <option value="<?php echo $new_hour ?>"> <?php echo $new_hour ?></option>
                            <?php
                                for($end_hour=0; $end_hour <= 23; $end_hour++){ 
                                   $end_hour = $end_hour < 10 ? '0'.$end_hour : $end_hour;
                                   echo '<option value="'.$end_hour.'">'.$end_hour.'</option>'; 
                                }
                            ?> 
                          </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-1">
                        <label>:</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="update_end_minute" required>
                            <option value="<?php echo $new_end_minute ?>">  <?php echo $new_end_minute ?></option>
                            <?php
                                for($end_minute=0; $end_minute <= 59; $end_minute++){   
                                   $end_minute = $end_minute < 10 ? '0'.$end_minute : $end_minute;

                                   if ($end_minute % 15 == 0){
                                   echo '<option value="'.$end_minute.'">'.$end_minute.'</option>'; 
                                }
                            }
                            ?> 
                          </select>
                        </div>
                    </div>

               
            </div>
            </div>
            </div>
             <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>      
                      <div class="modal-footer">
                        <div class="btn-group">
                          <button type="submit" id="update" name="update" class="btn btn-primary" data-action="save" role="button">Save
                          </button>
                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div> 
                    </td>
                   
                   
                    </div>
                    <!-- End Modal Content -->
                    </div>
                    <!-- End col-lg-12 -->
                    </div>
                    <!-- End Modal Dialog -->
                    </div>
                    <!-- End Modal ID Update -->
                 
              </tr>  
            </tbody>

              <?php
              }
              }
              ?>  
          </table>
          <!-- End Table -->
        </div>
        <!-- End Table Responsive -->
      </div>
      <!-- End Panel Body -->
    </div>
    <!-- End Panel Default -->
  </div>  
  <!-- End container-fluid -->    

                               
<!-- Page level plugin JavaScript-->
  <script src="bootsrap/chart.js/Chart.min.js"></script>
  <script src="bootstrap/datatables/jquery.dataTables.js"></script>
  <script src="bootstrap/datatables/dataTables.bootstrap4.js"></script>  
  <!-- Custom scripts for this page-->
  <script src="bootstrap/js/sb-admin-datatables.min.js"></script>
  <script src="bootstrap/js/sb-admin-charts.min.js"></script>
      
    
</br>

          

</body>
</html>