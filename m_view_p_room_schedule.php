<?php 
require('m_dashboard.php');
require('server/p_db_connection.php');



$room_id = $_POST ['room_id'];
$year = $_POST ['year'];
$term = $_POST ['Term'];
$quarter = $_POST ['Quarter'];


?>

<!DOCTYPE html>
<html>

<head>

    <title> Room Schedule Report</title>


    <link href='fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='fullcalendar/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <script src='fullcalendar/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/jquery.form.min.js'></script>
    <script src='fullcalendar/jquery.validate.js'></script>
    <script src='fullcalendar/bootstrap-colorpicker.js'></script>

    <?php

        $events = array();
                $get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.room_id_fk = '$room_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter')";
                //print_r($get_schedule_sql);
                $get_schedule_query = mysqli_query($conn, $get_schedule_sql);
               
                while ($schedule_result = mysqli_fetch_assoc($get_schedule_query)){

                    $room_name =  $schedule_result['room_name'];
                    $room_number =  $schedule_result['room_number'];

                    $start_time = explode(':', $schedule_result['start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $schedule_result['end_time']);
                    //print_r($end_time);

                    $new_start_minute = ((int)$start_time[1] - 1) < 10 ? '0'.((int)$start_time[1] - 1) : ((int)$start_time[1] - 1);
                    $new_start_time = $start_time[0].':'.$new_start_minute.':00';

                    $new_end_minute = ((int)$end_time[1] + 1) < 10 ? '0'.((int)$end_time[1] + 1) : ((int)$end_time[1] + 1);
                    $new_end_time = $end_time[0].':'.$new_end_minute.':00';

                    $events[] = array(
                        'id'                => 'Rm:'. ' '. $schedule_result['room_number'],
                        'title'             => $schedule_result['subj_name'],
                        'room'              => $schedule_result['term_grading'],
                        'section'           => $schedule_result['sec_code'],
                        //'start'             => $schedule_result['start_time'],
                        //'end'               => $schedule_result['end_time'],
                        'start'             => $new_start_time,
                        'end'               => $new_end_time,
                        'dow'               => '['.$schedule_result['day'].']',
                        'backgroundColor'   => $schedule_result['background_color'],
                        'borderColor'       => $schedule_result['is_approved'] == 'no' ? 'red':$schedule_result['border_color'],
                        'textColor'         => $schedule_result['is_approved'] == 'no' ? 'red' :$schedule_result['text_color'],
                    );
                }
                //echo json_encode($events);

        
    ?>
    <script>

        $(document).ready(function() {
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
                allDaySlot: false,
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
                eventClick: function(calEvent, jsEvent, view) {
                    //console.log(calEvent.id);
                    $('#myModalEdit').modal("toggle");
                    
                    
                }
            });

        });



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

    <div class="container">
    <div class="col-xs-8">
        <img src="images/info1.png" class="img-responsive">
    </div>
    <div class="col-xs-4">
        <p style="font-size: 15px;">Informatics College Manila<br/>
        BDO Building 2070 Claro M. Recto Avenue <br/>
        Quiapo, Manila 1008 Philippines <br/><br/>
        Tel. No: (02)488-3033<br/>
        www.informatics.edu.ph

        </p>
        
    </div>
    </div>

    <br />
    <div class="col-xs-12">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-xs-5">
            <label> Room:</label><br/>
            <label> <?php echo '['.$room_number.'] '.$room_name ?></label>
        </div>

        <div class="col-xs-3">
            <label> School Year: </label>
            <label> School Year: <?php echo $year ?></label>
        </div>

        <div class="col-xs-3">
            <label>Term/Quarter:</label>
            <label>Term/Quarter:<?php echo $term ?></label>
        </div>
    </div>
</div>
</div>

  
    <div class="row">
        <div class="col-xs-12">

        <center></center>
            <div class="col-xs-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

   
<br/><br/><br/>   
<div class="col-xs-12">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-xs-4">
            <label> Prepared:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;"/><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;Academic Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-4">
            <label> Noted:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;" /><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;Services Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-4">
            <label> Approved for Posting:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;" /><br />
            <label>Asst. Center Manager &nbsp;&nbsp;</label>
        </div>
    </div>
</div>
</div>

   

</body>
</html>