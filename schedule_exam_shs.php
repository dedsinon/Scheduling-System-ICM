<?php 
require ("dashboard.php");
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>
<!-- Show / Hide Password -->
<script type="text/javascript" src="js/js_show_password.js"></script>
<!-- Live Search Bar -->
<script type="text/javascript" src="js/js_live_search.js"></script>
<!-- Show / Hide Panel -->
<script type="text/javascript" src="js/js_show_hide.js"></script>

 <!-- Page level plugin CSS-->
<link href="bootstrap/datatables/dataTables.bootstrap4.css" rel="stylesheet">
     
  <title>Monitor Schedule</title>

</head>

<style>



.counter{
  padding:8px; 
  color:#ccc;
}



</style>

<body>
   
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-">
      <h2 class="page-header"> <center> Examination Schedule</center></h2>
    </div>
  </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active" title="View Room"> <a href="schedule_exam_shs.php">Senior Highschool Examination Schedule</a></li>
      </ul>
    
                  <?php if(isset($_SESSION['success_add_remarks'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_remarks'];?></div>
                    
                  <?php $_SESSION['success_add_remarks'] = null; }?> 

                  <?php if(isset($_SESSION['success_reset'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_reset'];?></div>
                    
                  <?php $_SESSION['success_reset'] = null; }?> 



<div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading" id="head-add"> Add Exam Schedule 
            <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
            <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
          </div>

          <form id="myform" method="POST" action="server/p_add_exam_schedule.php">
          <div class="panel-body" id="body1">
            <div class="col-lg-12">
              <div class="row"> 

              <?php if(isset($_SESSION['success_add_exam'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_exam'];?></div>
                    
                  <?php $_SESSION['success_add_exam'] = null; }?> 

                  <?php if(isset($_SESSION['error_add_exam'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_add_exam'];?></div>
                    
                  <?php $_SESSION['error_add_exam'] = null; }?> 

                  <br />
              <div class="container-fluid">
                <ul class="nav nav-tabs">
                  <li><a href="schedule_exam.php" > College Exam Schedule:</a></li>
                  <li  class="active"><a href="schedule_exam_shs.php" > Senior Highschool Exam Schedule</a></li>
                                  
                </ul>
              </div>
            <br />

                  <div class="form-group col-lg-6">
                  <label>[ 1 ] Term </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="e_term_grading" onchange="getTerm(this.value);" required>
                            <option value=""> Quarter:</option>
                            <option value="1st Grading"> 1st Quarter </option>
                            <option value="2nd Grading"> 2nd Quarter </option>
                            
                          </select>
                        </div>
                    </div>

                    <script>
                        function getTerm(val){
                            //alert(val);
                            $.ajax({
                                type: "POST",
                                url: "server/getdata_termSHS.php",
                                data: "e_term_grading="+val,
                                success: function(data){
                                    $("#subject1").html(data);
                                }
                            });
                        }
                    </script> 

                    <div class="form-group col-lg-6">
                        <label>[ 2 ] Subject Name</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-th-list"></span>
                          </span>
                    
                          <select class="form-control" name="e_subject" required id="subject1">
                            <option value=""> Select Subject:</option>

                          </select>
                        </div>
                    </div>
                  
                  
                    <div class="form-group col-lg-6">
                        <label>[ 3 ] Day</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                    <?php 
                        $retrieve ="SELECT * FROM day WHERE day_id != '0'";
                        $query = mysqli_query($conn, $retrieve);
                          
                          
                          ?>
                          <select class="form-control" name="e_day" required>
                            <option value=""> Select Day:</option>

                            <?php
                            while ($result = mysqli_fetch_assoc($query)){

                            echo '<option value="'.$result['day_id'].'">'.$result['day_name'].' </option>';
                            
                        }
                      ?>
                      </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>[ 4 ] Room</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                        <?php 
                        $room_retrieve ="SELECT * FROM rooms WHERE room_status ='Activated'";
                        $room_query = mysqli_query($conn, $room_retrieve);
                          
                          if($room_query){
                          ?>

                          <select class="form-control" name="e_room" required>
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

                     <div class="form-group col-lg-6">
                        <label>[ 5 ] Teacher</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                        <?php 
                        $room_retrieve ="SELECT * FROM teacher WHERE teacher_status ='Activated'";
                        $room_query = mysqli_query($conn, $room_retrieve);
                          
                          if($room_query){
                          ?>

                          <select class="form-control" name="e_teacher" required>
                            <option value=""> Select Teacher:</option>

                            <?php
                            while ($room_result = mysqli_fetch_assoc($room_query)){
                                ?>

                            <option value="<?php echo $room_result['teacher_id']; ?>"> <?php echo $room_result['teacher_fullname']; ?> </option>;
                            <?php
                        }
                        }
                      ?>
                      </select>
                        </div>
                    </div>
                    
                     <div class="form-group col-lg-6">
                        <label>[ 6 ] Exam Classification</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                       <select class="form-control" name="e_classification" required>
                            <option value=""> Exam Classification</option>
                            <option value="1st Grading"> 1st Grading </option>
                            <option value="2nd Grading"> 2nd Grading </option>
                            <option value="3rd Grading"> 3rd Grading </option>
                            <option value="4th Grading"> 4th Grading </option>
                          </select>
                     
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>[ 7 ] Assign Start Time and Start End</label>
                    </div>
                   

                    <div class="form-group col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="e_start_hour" id="start_hour" required>
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
                          <select class="form-control" name="e_start_minute" required>
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
                          <select class="form-control" name="e_end_hour" id="end_hour" required>
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
                          <select class="form-control" name="e_end_minute" required>
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
              <button type="submit" name="submit" class="btn btn-primary" value='submit' id="submit"><i class="fa fa-plus-circle"></i> Add Exam Schedule</button>

                    <!-- Reset Button -->
                    <button class="btn btn-warning" type="button" onclick="myFunction()"><i class="fa fa-eraser"></i> Reset Form</button>

              <div class="pull-right">
                 <button class="btn btn-info" type="button" onclick="window.open('view_reports_class.php')"><i class="fa fa-calendar"></i> View Class Schedule </button>
                 </div> 

                     <!-- ResetFunction -->
                <script>
                function myFunction() {
                document.getElementById("myform").reset();
                }
                </script>
          </div>
          </form>
        </div>
        <!-- End panel panel-default -->
      </div>
      <!-- End col-lg-12 -->


    <!-- Modal -->
<div id="show_class_schedule" class="modal fade" role="dialog">
  <div class="modal-dialog">
     <form method="POST" action="schedule_exam_view.php" target="_blank" id="myform">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Show Class Schedule</h4>
      </div>
      <div class="modal-body">
          <div class="row"> 

            <div class="form-group col-lg-12">
                <label>[ 1 ] Year</label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-users"></span>
                    </span>
                    <?php 
                        $sy_retrieve ="SELECT * FROM school_year WHERE status ='Activated'";
                        $sy_query = mysqli_query($conn, $sy_retrieve);
                          
                          if($sy_query){
                          ?>
                          <select class="form-control" name="year" required>
                            <option value=""> School Year:</option>

                            <?php
                            while ($sy_result = mysqli_fetch_assoc($sy_query)){
                              ?>

                            <option value="<?php echo $sy_result['school_year']; ?>"> <?php echo $sy_result['school_year']; ?> </option>

                      <?php
                            }
                           
                        }
                      ?>
                      </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>[ 3 ] College Term</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="term">
                            <option value=""> Term:</option>
                            <option value="1st Term"> 1st Term</option>
                            <option value="2nd Term"> 2nd Term</option>
                            <option value="3rd Term"> 3rd Term</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>[ 4 ] Senior High Quarter</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="quarter">
                            <option value=""> Quarter:</option>
                            <option value="1st Grading"> 1st Quarter</option>
                            <option value="2nd Grading"> 2nd Quarter</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>[ 5 ] Course / Strand </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="strand_course" required onchange="getId(this.value);">
                            <option value=""> Course / Strand:</option>
                            <?php 
                        $sc_retrieve ="SELECT * FROM strand_course WHERE sc_status ='Activated'";
                        $sc_query = mysqli_query($conn, $sc_retrieve);
                          
          
                            while ($sc_result = mysqli_fetch_assoc($sc_query)){
                              ?>

                            <option value="<?php echo $sc_result['sc_id']; ?>"> <?php echo $sc_result['sc_code']; ?> </option>

                      <?php
                            
                          
                        }
                      ?>
                          </select>
                        </div>
                    </div>

                    <script>
                        function getId(val){
                            //alert(val);
                            $.ajax({
                                type: "POST",
                                url: "server/getdata.php",
                                data: "sc_id="+val,
                                success: function(data){
                                    $("#subject").html(data);
                                }
                            });
                        }
                    </script> 

                    <div class="form-group col-lg-6">
                        <label>[ 6 ] Subject </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="subject" required id="subject">
                            <option value=""> Subject:</option>
                            <?php 
                        $subj_retrieve ="SELECT * FROM subject WHERE subj_status ='Activated'";
                        $subj_query = mysqli_query($conn, $subj_retrieve);
                          
          
                            while ($subj_result = mysqli_fetch_assoc($subj_query)){
                              ?>

                            <option value="<?php echo $subj_result['subj_id']; ?>"> <?php echo $subj_result['subj_name']; ?> </option>

                      <?php
                            
                          
                        }
                      ?>
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

<div class="col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      View Exam Schedule
    </div>
    <div class="panel-body">
      <div class="table-responsive">

        
          <table class="table table-bordered" width="100%" cellspacing="0" id="teacher_schedule">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Term</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Subject Code</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Exam Classification</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Delete</th>
                </tr>  
              </thead>

              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Term</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Subject Code</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Exam Classification</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Delete</th>
                </tr>  
                </tr>
              </tfoot>
            <?php

         $sql  = "SELECT * FROM exam as ex LEFT JOIN schedule as sc ON ex.exam_schedule_id_fk = sc.schedule_id LEFT JOIN day ON ex.exam_day = day.day_id LEFT JOIN rooms as ro ON ex.exam_room = ro.room_id LEFT JOIN teacher as te ON ex.exam_teacher = te.teacher_id LEFT JOIN section as sec ON sc.section_id_fk = sec.sec_id LEFT JOIN subject as subj ON sc.subject_id_fk = subj.subj_id WHERE exam_term = '1st Quarter' AND '2nd Quarter' ";

      $query = mysqli_query($conn, $sql);

      while ($result = mysqli_fetch_assoc($query)){
      
        $start_time = explode(':', $result['exam_start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $result['exam_end_time']);

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
                    <td><?php echo $result['school_year'];?></td>
                    <td><?php echo $result['exam_term'];?></td>
                    <td><?php echo $result['day_name'];?></td>
                    <td><?php echo $result['subj_code'];?></td>
                    <td><?php echo $result['subj_name'];?></td>
                    <td><?php echo $result['room_number'];?></td>
                    <td><?php echo $result['teacher_fullname'];?></td>
                    <td><?php echo $result['exam_class'];?></td>
                    <td><?php echo $new_start_time.' - '.$new_end_time;?></td>
                    <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $result['exam_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $result['exam_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update ICL Schedule</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="#.php">

                        <div hidden> <input type="number" name="update_exam_id" class="form-control" value="<?php echo $result['exam_id']; ?>" readonly>
                        </div>

                         <div class="form-group col-lg-6">
                  <label>[ 1 ] Term </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="update_e_term_grading" required>
                          <option value=""><?php echo $result['exam_term'];?></option>

                           <?php
                              $services = array('1st Term', '2nd Term', '3rd Term');
                              for($i=0; $i < 3; $i++){

                                  if ($result['exam_term'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                } 
                            ?> 

                          </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>[ 2 ] Subject Name</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-th-list"></span>
                          </span>
                    
                          <select class="form-control" name="update_e_subject" required>
                            <option value="<?php echo $result['subj_name']; ?>"><?php echo $result['subj_name']; ?></option>

                            <?php 
                        $retrieve ="SELECT * FROM subject WHERE subj_term = '1st Term' AND '2nd Term' AND '3rd Term' ";
                        $query = mysqli_query($conn, $retrieve);
                          
                          
                          ?>

                            <?php
                            while ($result_subj = mysqli_fetch_assoc($query)){

                            echo '<option value="'.$result_subj['subj_name'].'">'.$result_subj['subj_name'].' </option>';
                            
                        }
                      ?>

                          </select>
                        </div>
                    </div>
                  
                  
                    <div class="form-group col-lg-6">
                        <label>[ 3 ] Day</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                  
                          <select class="form-control" name="e_day" required>
                            <option value="<?php echo $result['day_id']; ?>"><?php echo $result['day_name']; ?></option>

                              <option value="1">Monday</option>
                              <option value="2">Tuesday</option>
                              <option value="3">Wednesday</option>
                              <option value="4">Thursday</option>
                              <option value="5">Friday</option>
                              <option value="6">Saturday</option>
                          
                      </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>[ 4 ] Room</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                        <?php 
                        $room_retrieve ="SELECT * FROM rooms WHERE room_status ='Activated'";
                        $room_query = mysqli_query($conn, $room_retrieve);
                          
                          if($room_query){
                          ?>

                          <select class="form-control" name="e_room" required>
                            <option value="<?php echo $result['room_id']; ?>"> [ <?php echo $result['room_number']; ?> ] <?php echo $result['room_name']; ?> </option>

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

                     <div class="form-group col-lg-6">
                        <label>[ 5 ] Teacher</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                        <?php 
                        $room_retrieve ="SELECT * FROM teacher WHERE teacher_status ='Activated'";
                        $room_query = mysqli_query($conn, $room_retrieve);
                          
                          if($room_query){
                          ?>

                          <select class="form-control" name="e_teacher" required>
                            <option value="<?php echo $result['teacher_id']; ?>"> <?php echo $result['teacher_fullname']; ?> </option>
                            <?php
                            while ($room_result = mysqli_fetch_assoc($room_query)){
                                ?>

                            <option value="<?php echo $room_result['teacher_id']; ?>"> <?php echo $room_result['teacher_fullname']; ?> </option>;
                            <?php
                        }
                        }
                      ?>
                      </select>
                        </div>
                    </div>
                    
                     <div class="form-group col-lg-6">
                        <label>[ 6 ] Exam Classification</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-home"></span>
                          </span>
                       <select class="form-control" name="e_classification" required>
                            <option value="<?php echo $result['exam_class']; ?>"> <?php echo $result['exam_class']; ?></option>
                            <option value="Prelim"> Prelim </option>
                            <option value="Midterm"> Midterm </option>
                            <option value="Finals"> Finals </option>
                          </select>
                     
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>[ 7 ] Assign Start Time and Start End</label>
                    </div>
                   

                    <div class="form-group col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="e_start_hour" id="start_hour" required>
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
                          <select class="form-control" name="e_start_minute" required>
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
                          <select class="form-control" name="e_end_hour" id="end_hour" required>
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
                          <select class="form-control" name="e_end_minute" required>
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
                   
                    
                      </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br> </br></br></br>
                      <div class="modal-footer">
                      <div class="btn-group">
                        <button type="submit" id="update" name="update" class="btn btn-primary" data-action="save" role="button">Save
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
                  <td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update<?php echo $result['exam_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Delete</button></td>
                   <!-- Update Modal -->
                    <div id="update<?php echo $result['exam_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you sure you want to delete the ICL Schedule?</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="p_delete_icl.php">
                      <center>
                      <button type="submit" id="submit" name="submit" class="btn btn-danger" data-dismiss="modal">Delete</button>
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                       </center>
                       </form>
                       </div> 
                       </div>
                       </div>
                       </div>
                       </div>
                   
    </tr>
</tbody>
<?php
            }
            ?>
</table>
</div>
</div>
</div>
</div>
<br />
  
  

  <!-- Page level plugin JavaScript-->
  <script src="bootsrap/chart.js/Chart.min.js"></script>
  <script src="bootstrap/datatables/jquery.dataTables.js"></script>
  <script src="bootstrap/datatables/dataTables.bootstrap4.js"></script>  
  <!-- Custom scripts for this page-->
  <script src="bootstrap/js/sb-admin-datatables.min.js"></script>
  <script src="bootstrap/js/sb-admin-charts.min.js"></script>
</body>
</html>