<?php 
require ("e_dashboard.php");
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
        $settings_day_start = mysqli_escape_string($conn, isset($_REQUEST['settings_day_start']) ? $_REQUEST['settings_day_start']: 1);
        $settings_hour_start = mysqli_escape_string($conn, isset($_REQUEST['settings_hour_start']) ? $_REQUEST['settings_hour_start']: '07');
        $settings_approved_not_approve = mysqli_escape_string($conn, isset($_REQUEST['settings_approved_not_approve']) ? $_REQUEST['settings_approved_not_approve']: 'all');
        $settings_schedule_of = mysqli_escape_string($conn, isset($_REQUEST['settings_schedule_of']) ? $_REQUEST['settings_schedule_of']: 'class');
        
        $settings = array(
            'settings_school_year' => $settings_school_year,
            'settings_day_start' => $settings_day_start,
            'settings_hour_start' => $settings_hour_start,
            'settings_approved_not_approve' => $settings_approved_not_approve,
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

                    $events[] = array(

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
                    );
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
                window.location.href = "e_view_teacher_calendar.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $teacher_course_strand; ?>&term_grading=<?php echo $teacher_term_grading; ?>&teacher_id="+teacher_id+"<?php echo $url_settings; ?>";

            });

             $( "#filter_teacher_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_teacher_calendar.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand="+course_strand+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_teacher_term_grading" ).change(function() {
                var term_grading = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_teacher_calendar.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading="+term_grading+"<?php echo $url_settings; ?>";

            });

            $('#calendar').fullCalendar({
                header: {
                    left: '',
                    center: '',
                    right: ''
                },
                titleFormat: 'MMMM YYYY',
                //defaultView: 'agendaWeek',
                views: {
                    settimana: {
                        type: 'agendaWeek',
                        duration: {
                            days: 7
                        },
                        title: 'Apertura',
                        columnFormat: 'dddd', // Format the day to only show like 'Monday'
                        hiddenDays: [0, 7] // Hide Sunday and Saturday?
                    }
                },
                defaultView: 'settimana',
                firstDay: <?php echo $settings_day_start; ?>,
                minTime: '<?php echo $settings_hour_start; ?>:00:00',
                //defaultDate: '2017-09-12',
                navLinks: false, // can click day/week names to navigate views
                editable: false,
                eventLimit: false, // allow "more" link when too many events
                events: <?php echo json_encode($events); ?>,
                /*events:[
                    {
                        title: 'Lunch',
                        start: '13:00:00',
                        end: '13:30:00',
                        dow:[1],
                        backgroundColor: '#ff0000',
                        borderColor: '#ff0000',
                    },
                    {
                        title: 'Meeting',
                        start: '14:30:00',
                        end: '15:30:00',
                        dow:[2,3],
                    }
                ],*/

                eventRender: function(event, element) { 
                    element.find('.fc-title').append("<br/>" + event.room+"<span class='sched_id_wrapper'>#" + event.id+"</span>"); 
                },
                
            });
            
            //$('.fc-toolbar .fc-center h2').text('My Schedule');
            $('.fc-agenda-view .fc-day-grid').hide();

            
        });
function approveSchedule(schedule_id){
    if (confirm('Are you sure you want to APPROVE Schedule #'+schedule_id+'?')) {
        $.ajax({
            type: "POST",
            url: "fullcalendar/schedule.php?action=approve-schedule&schedule_id="+schedule_id,
            success: function(data){
                location.reload();
            }
        });
    }
}

function deleteSchedule(schedule_id){
    if (confirm('Are you sure you want to DELETE Schedule #'+schedule_id+'?')) {
        $.ajax({
            type: "POST",
            url: "fullcalendar/schedule.php?action=delete-schedule&schedule_id="+schedule_id,
            success: function(data){
                location.reload();
            }
        });
    }
}

    </script>

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
</style>

<body>

<br />
<div class="container-fluid">
  <ul class="nav nav-tabs">
    <li class="active"><a href="e_view_teacher_calendar.php" > Teacher Calendar View:</a></li>
    <li><a href="e_view_teacher_list.php" > Teacher List View</a></li>                  
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
        <select class="form-control" name="filter_teacher_id" id="filter_teacher_id">
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
    <br />           
            

   <div class="container">
    <br /><br /><br />

      <button style="position: absolute;" type="button" class="btn btn-info" onclick="myFunction()"><i class="fa fa-print"></i> Print Schedule</button>

      <button style="position: absolute; right: 15px;" alt="Calender Settings" type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalSettings"><i class="fa fa-cog"></i> Settings</button>
      </br>

      <div id='calendar'></div>
    </div>
    
    <br><br><br>
    <div class="col-xs-12">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-xs-4">
            <label> Prepared:</label><br /><br />
            <input type="text" value="Mr.Rolan Macarang" placeholder="Enter Name:" style="border: none;"/><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;Academic Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-4">
            <label> Noted:</label><br /><br />
            <input type="text" value="Mrs.Zenobia Oseo" style="border: none;" disabled /><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;Services Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-4">
            <label> Approved for Posting:</label><br /><br />
            <input type="text" value="Ms. Dianne Gabriel" style="border: none;" disabled /><br />
            <label>Asst. Center Manager &nbsp;&nbsp;</label>
        </div>
    </div>
</div>
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
        <form id="frm_update_settings" method="POST" action="e_view_teacher_calendar.php">
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
                        <label>Day Start</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-th-list"></span>
                          </span>
                          <select class="form-control" name="settings_day_start">
                              <option value="1" <?php echo ($settings_day_start == 1) ? 'selected':''; ?>>Monday</option>
                              <option value="2" <?php echo ($settings_day_start == 2) ? 'selected':''; ?>>Tuesday</option>
                              <option value="3" <?php echo ($settings_day_start == 3) ? 'selected':''; ?>>Wednesday</option>
                              <option value="4" <?php echo ($settings_day_start == 4) ? 'selected':''; ?>>Thursday</option>
                              <option value="5" <?php echo ($settings_day_start == 5) ? 'selected':''; ?>>Friday</option>
                              <option value="6" <?php echo ($settings_day_start == 6) ? 'selected':''; ?>>Saturday</option>
               
                          </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label>Hour Start</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="settings_hour_start">
                            <option value=""> Start Hour:</option>
                            <?php
                                for($start_hour=0; $start_hour <= 23; $start_hour++){   
                                   $start_hour = $start_hour < 10 ? '0'.$start_hour : $start_hour;
                                   $is_selected = ($settings_hour_start == $start_hour) ? 'selected':'';
                                   echo '<option '.$is_selected.' value="'.$start_hour.'">'.$start_hour.'</option>'; 
                                }
                            ?> 
                          </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label>Show Schedule</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="settings_approved_not_approve">
                            <option <?php echo ($settings_approved_not_approve == 'all') ? 'selected':''; ?>  value="all">Approved/Not Approve</option>
                            <option <?php echo ($settings_approved_not_approve == 'yes') ? 'selected':''; ?> value="yes">Approved Only</option>
                            <option <?php echo ($settings_approved_not_approve == 'no') ? 'selected':''; ?> value="no">Not Approve Only</option>
                            
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

</body>
</html>