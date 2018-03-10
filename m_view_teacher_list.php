<?php 
require ("m_dashboard.php");
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

    <title> Class Schedule </title>

    <link href='fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='fullcalendar/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <script src='fullcalendar/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/jquery.form.min.js'></script>
    <script src='fullcalendar/jquery.validate.js'></script>
    <script src='fullcalendar/bootstrap-colorpicker.js'></script>

    <?php


        $settings_school_year = mysqli_escape_string($conn, isset($_REQUEST['settings_school_year']) ? $_REQUEST['settings_school_year']: '2017-2018');
        $settings_schedule_of = mysqli_escape_string($conn, isset($_REQUEST['settings_schedule_of']) ? $_REQUEST['settings_schedule_of']: 'class');
        
        $settings = array(
            'settings_school_year' => $settings_school_year,
            'settings_schedule_of' => $settings_schedule_of,
        );
        
        $url_settings = '&'.http_build_query($settings);
        //echo $url_settings;
        
        $events = array();

        $filter_by = isset($_GET['filterBy']) ? $_GET['filterBy'] : '';
        $teacher_id = isset($_GET['teacher_id']) ? $_GET['teacher_id'] : '';
        $course_strand = isset($_GET['course_strand']) ? $_GET['course_strand'] : '';
        $term_grading = isset($_GET['term_grading']) ? $_GET['term_grading'] : '';
        $filter_school_year = isset($_GET['school_year']) ? $_GET['school_year'] : $settings_school_year;
        $teacher_course_strand = isset($_GET['course_strand']) ? $_GET['course_strand'] : '';
        $teacher_term_grading = isset($_GET['term_grading']) ? $_GET['term_grading'] : '';
        
        
        if($teacher_course_strand){

            $where_sql = '';
            if($teacher_id){
                $where_sql = "sc.teacher_id_fk = '$teacher_id' AND sc.term_grading = '$term_grading'";
            }
                
            $status = $settings_approved_not_approve == 'all' ? '': $settings_approved_not_approve;
            
            $where_settings_sql = '';
            if($status != ''){
                $where_settings_sql = " AND sc.is_approved = '$status'";
            }
            
            if($teacher_id){
                $get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id WHERE $where_sql $where_settings_sql AND sc.school_year = '$filter_school_year' ";
                //print_r($get_schedule_sql);
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


                    $start_time_new = $new_start_time;
                    $end_time_new = $new_end_time;
                    $schedule_id = $schedule_result['schedule_id'];
                    $day = $schedule_result['day_name'];
                    $room = $schedule_result['room_number'];
                    $subject_name = $schedule_result['subj_name'];
                    $subject_code = $schedule_result['subj_code'];
                    /*$events[] = array(

                        //'start'             => $schedule_result['start_time'],
                        //'end'               => $schedule_result['end_time'],
                        'start'             => $new_start_time,
                        'end'               => $new_end_time,
                        'id'           => ' SCHED: ['. $schedule_result['schedule_id'].']',
                        'title'             => $schedule_result['subj_code'],
                        'room'           => $schedule_result['teacher_fullname'],
                        
                        'dow'               => '['.$schedule_result['day'].']',
                        'backgroundColor'   => $schedule_result['background_color'],
                        'borderColor'       => $schedule_result['is_approved'] == 'no' ? 'red':$schedule_result['border_color'],
                        'textColor'         => $schedule_result['is_approved'] == 'no' ? 'red' :$schedule_result['text_color'],
                    );*/
                }
                //echo json_encode($events);
            }
        }
    ?>
    <script>

        $(document).ready(function() {


// FILTER BY Teacher 
            $( "#filter_teacher_id" ).change(function() {
                var teacher_id = $(this).val();
                window.location.href = "m_view_teacher_list.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $teacher_course_strand; ?>&term_grading=<?php echo $teacher_term_grading; ?>&teacher_id="+teacher_id+"<?php echo $url_settings; ?>";

            });

             $( "#filter_teacher_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(filterBy);
                window.location.href = "m_view_teacher_list.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand="+course_strand+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_teacher_term_grading" ).change(function() {
                var term_grading = $(this).val();
                //alert(filterBy);
                window.location.href = "m_view_teacher_list.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading="+term_grading+"<?php echo $url_settings; ?>";

            });

    
            
        });

    </script>

</head>

<style>
    body {
        font-family: arial;
        overflow-x: hidden; 
    }
  
    .form-control.error{
        border: 1px solid red;
    }
    #validate-notification-wrapper{
        float: left;
        text-align: left;
    }
    
    .sched_id_wrapper{
        position: absolute;
        right: 0;
        top: 0;
    }
</style>

<body>

<br />
<div class="container-fluid">
  <ul class="nav nav-tabs">
    <li><a href="m_view_teacher_calendar.php" > Teacher Calendar View:</a></li>
    <li class="active"><a href="m_view_teacher_list.php" > Teacher List View</a></li>                  
  </ul>
</div>
<br />

  <div class="row">
    <div class="col-xs-12">
      <h4>Filter Schedule (<?php echo $filter_school_year; ?>)</h4>
  
  <!-- PAGE CONTENT BEGINS -->
    <div class="col-xs-4">
      <label>Filter by Degree</label>
        <select class="form-control" id="filter_teacher_course_strand" name="filter_teacher_course_strand">
          <option value="">Select</option>
          <option value="Course" <?php echo $teacher_course_strand == 'Course' ? 'selected':''; ?>>College</option>
          <option value="Strand" <?php echo $teacher_course_strand == 'Strand' ? 'selected':''; ?>>High School</option>
        </select>
    </div>
    
    <?php if($teacher_course_strand != ''){ ?> 

    <div class="col-xs-4">                  
      <label><?php echo ($teacher_course_strand == 'Course') ? 'Term':'Grading'; ?>  </label>
        <select class="form-control" id="filter_teacher_term_grading" name="filter_teacher_term_grading">
          <option value="">Select</option>
          
          <?php if($teacher_course_strand == 'Course'){ ?>  
            
            <option value="1st Term" <?php echo $teacher_term_grading == '1st Term' ? 'selected':''; ?>>1st Term</option>
            <option value="2nd Term" <?php echo $teacher_term_grading == '2nd Term' ? 'selected':''; ?>>2nd Term</option>
            <option value="3rd Term" <?php echo $teacher_term_grading == '3rd Term' ? 'selected':''; ?>>3rd Term</option>
          
          <?php }elseif($teacher_course_strand == 'Strand'){ ?>  
            
            <option value="1st Grading" <?php echo $teacher_term_grading == '1st Grading' ? 'selected':''; ?>>1st Grading</option>
            <option value="2nd Grading" <?php echo $teacher_term_grading == '2nd Grading' ? 'selected':''; ?>>2nd Grading</option>
                            
          <?php } ?>
        </select>
    </div>
    <?php } ?>
                          
    <?php if($teacher_term_grading != ''){ ?>

    <div class="col-xs-4">   
      <label>Teacher</label>
        <select class="form-control" name="filter_teacher_id" id="filter_teacher_id" onchange="getId(this.value);">
          <option value=""> Select</option>
            
            <?php
              $teach_retrieve ="SELECT * FROM teacher ORDER BY teacher_fullname";
              $teach_query = mysqli_query($conn, $teach_retrieve);
                                      
                if($teach_query){
                  while ($teach_result = mysqli_fetch_assoc($teach_query)){
                    $is_selected =  $teacher_id == $teach_result['teacher_id'] ? 'selected':''; 

                    echo '<option value="'.$teach_result['teacher_id'].'" '.$is_selected.'>'.$teach_result['teacher_fullname'].' </option>';
                  }
                }
            ?>
        </select>
    </div>
    <?php } ?>

    <script>
      function getId(val){
      //alert(val);
        $.ajax({
          type: "POST",
          url: "server/getdata_schedule.php",
          data: "teacher_id="+val,
          success: function(data){
            $("#teacher_schedule").html(data);
          }
        });
      }
    </script>
    <br />           
            

   <div class="container">
    <br /><br /><br />

      <button style="position: absolute;" type="button" class="btn btn-info" onclick="myFunction()"><i class="fa fa-print"></i> Print Schedule</button>

      <button style="position: absolute; right: 15px;" alt="Calender Settings" type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalSettings"><i class="fa fa-cog"></i> Settings</button>
      </br>

      <div id='calendar'></div>
    </div>
    
     <script>
        function myFunction(){
          window.print();
        }
      </script>
    
    <!-- Modal Settings -->
    <div class="modal fade" id="myModalSettings" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <form id="frm_update_settings" method="POST" action="m_view_teacher_list.php">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Calendar Settings</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <div class="form-group col-lg-6">
                        <label>School Year</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-calendar"></span>
                          </span>
                    <?php 
                        $yt_retrieve ="SELECT DISTINCT(school_year) FROM school_year";
                        $yt_query = mysqli_query($conn, $yt_retrieve);
                          
                          if($yt_query){
                          ?>

                          <select class="form-control" name="settings_school_year">
                            <?php
                            while ($yt_result = mysqli_fetch_assoc($yt_query)){
                              $is_current = $yt_result['school_year'] == $filter_school_year ? 'selected':'';

                            echo '<option '.$is_current.' value="'.$yt_result['school_year'].'"">'.$yt_result['school_year'].' </option>';
                            }
                          
                            }
                      ?>
                          </select>
                        </div>
                    </div>
                   
                    <div class="form-group col-lg-6">
                        <label>Schedule of</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="settings_schedule_of">
                            <option <?php echo ($settings_schedule_of == 'class') ? 'selected':''; ?>  value="class">Class</option>
                            <option <?php echo ($settings_schedule_of == 'exam') ? 'selected':''; ?> value="exam">Exam</option>                            
                          </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
              <div id="update-settings-validate-notification-wrapper"></div>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Set Settings" name="submit" class="btn btn-primary" />
            </div>
        </div>
        </form>  
        </div>
    </div>
<br /><br />

<div class="col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      Faculty Loading
    </div>
    <div class="panel-body">
      <div class="table-responsive">        
          <table class="table table-bordered" width="100%" cellspacing="0" id="teacher_schedule">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Subject Code</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room Number</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
              </thead>

              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Subject Code</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room Number</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
                </tr>
              </tfoot>
              <tbody id="teacher_schedule">

              </tbody>
          </table>
      </div>
    </div>
    <div class="panel-footer">
    Hey
    </div>
  </div>
</div>


</body>
</html>