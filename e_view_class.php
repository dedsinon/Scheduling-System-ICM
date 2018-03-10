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

    $sy ="SELECT * FROM school_year WHERE status = 'Activated' ";
    $sy_query = mysqli_query($conn, $sy);

        while ($sy_result = mysqli_fetch_assoc($sy_query)){

            $schoolyear = $sy_result['school_year'];
        


        $settings_school_year = mysqli_escape_string($conn, isset($_REQUEST['settings_school_year']) ? $_REQUEST['settings_school_year'] : $sy_result['school_year']);

    }
         $settings_term = mysqli_escape_string($conn, isset($_REQUEST['settings_term']) ? $_REQUEST['settings_term']: '1');
        $settings_day_start = mysqli_escape_string($conn, isset($_REQUEST['settings_day_start']) ? $_REQUEST['settings_day_start']: 1);
        $settings_hour_start = mysqli_escape_string($conn, isset($_REQUEST['settings_hour_start']) ? $_REQUEST['settings_hour_start']: '07');
        $settings_approved_not_approve = mysqli_escape_string($conn, isset($_REQUEST['settings_approved_not_approve']) ? $_REQUEST['settings_approved_not_approve']: 'all');
        $settings_schedule_of = mysqli_escape_string($conn, isset($_REQUEST['settings_schedule_of']) ? $_REQUEST['settings_schedule_of']: 'class');
        
        $settings = array(
            'settings_school_year' => $settings_school_year,
            'settings_term' => $settings_term,
            'settings_day_start' => $settings_day_start,
            'settings_hour_start' => $settings_hour_start,
            'settings_approved_not_approve' => $settings_approved_not_approve,
            'settings_schedule_of' => $settings_schedule_of,
        );
        
        $url_settings = '&'.http_build_query($settings);
        //echo $url_settings;
        
        $events = array();
        $filter_by = isset($_GET['filterBy']) ? $_GET['filterBy'] : '';
        $section_id = isset($_GET['section_id']) ? $_GET['section_id'] : '';
        $teacher_id = isset($_GET['teacher_id']) ? $_GET['teacher_id'] : '';
        $room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';
        $course_strand = isset($_GET['course_strand']) ? $_GET['course_strand'] : '';
        $term_grading = isset($_GET['term_grading']) ? $_GET['term_grading'] : '';
        $filter_school_year = isset($_GET['school_year']) ? $_GET['school_year'] : $settings_school_year;
        $teacher_course_strand = isset($_GET['course_strand']) ? $_GET['course_strand'] : '';
        $teacher_term_grading = isset($_GET['term_grading']) ? $_GET['term_grading'] : '';
        $room_course_strand = isset($_GET['course_strand']) ? $_GET['course_strand'] : '';
        $room_term_grading = isset($_GET['term_grading']) ? $_GET['term_grading'] : '';
        
        if($filter_by){

            $where_sql = '';
            if($section_id){
                $where_sql = "sc.section_id_fk = '$section_id' AND sc.term_grading = '$term_grading'";
            }else if($teacher_id){
                $where_sql = "sc.teacher_id_fk = '$teacher_id' AND sc.term_grading = '$term_grading'";
            }else if($room_id){
                $where_sql = "sc.room_id_fk = '$room_id' AND sc.term_grading = '$term_grading'";
            }
                
            $status = $settings_approved_not_approve == 'all' ? '': $settings_approved_not_approve;
            
            $where_settings_sql = '';
            if($status != ''){
                $where_settings_sql = " AND sc.is_approved = '$status'";
            }
            
            if($section_id || $teacher_id ||$room_id){
                $get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE $where_sql $where_settings_sql AND sc.school_year = '$filter_school_year' ";
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

                    $status = $schedule_result['is_approved'] == 'no' ?  'Not Approved' : 'Approved';

                    $events[] = array(
                        'id'                => $schedule_result['schedule_id'],
                        'title'             => ' Room: ['.$schedule_result['room_number'].'] '.$schedule_result['subj_code'],
                        'room'              => $schedule_result['teacher_fullname'].' ['.$schedule_result['sec_code'].'] Status:'.$status,
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
            }
        }
    ?>
    <script>

        $(document).ready(function() {

            $( "#filter_by" ).change(function() {
                var filterBy = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=" + filterBy +"&school_year=<?php echo $filter_school_year; ?><?php echo $url_settings; ?>";

            });

// FILTER BY Section 
            $( "#filter_section_id" ).change(function() {
                var section_id = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading=<?php echo $term_grading; ?>&section_id="+section_id+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand="+course_strand+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_term_grading" ).change(function() {
                var term_grading = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading="+term_grading+"<?php echo $url_settings; ?>";

            });

// FILTER BY Teacher 
            $( "#filter_teacher_id" ).change(function() {
                var teacher_id = $(this).val();
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $teacher_course_strand; ?>&term_grading=<?php echo $teacher_term_grading; ?>&teacher_id="+teacher_id+"<?php echo $url_settings; ?>";

            });

             $( "#filter_teacher_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand="+course_strand+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_teacher_term_grading" ).change(function() {
                var term_grading = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading="+term_grading+"<?php echo $url_settings; ?>";

            });

            
// FILTER BY ROOM 
            $( "#filter_room_id" ).change(function() {
                var room_id = $(this).val();
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $room_course_strand; ?>&term_grading=<?php echo $room_term_grading; ?>&room_id="+room_id+"<?php echo $url_settings; ?>";

            });

             $( "#filter_room_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand="+course_strand+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_room_term_grading" ).change(function() {
                var term_grading = $(this).val();
                //alert(filterBy);
                window.location.href = "e_view_class.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading="+term_grading+"<?php echo $url_settings; ?>";

            });
            
            $( "#add_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(course_strand);
                $.ajax({
                    type: "GET",
                    url: "fullcalendar/schedule.php?action=get-strand-course&sc_sc="+course_strand,
                    success: function(data){
                        //console.log(data);
                        $('#add_sc_id option').remove();
                        $('#add_sc_id').append('<option value="">Loading...</option>');
                        if(data.class == 'success'){
                            $('#add_sc_id option').remove();
                            $('#add_sc_id').append('<option value="">Select Strand / Course: </option>');
                            $.each(data.data, function(x, obj) {
                                $('#add_sc_id').append('<option value="'+obj.sc_id+'">['+obj.sc_code+'] '+obj.sc_name+'</option>');
                            });
                        }else if(data.class == 'error'){
                            $('#add_sc_id option').remove();
                            $('#add_sc_id').append('<option value="">No result</option>');
                        }
                        
                        $('#add_term_grading option').remove();
                        $('#add_term_grading').append('<option value="">Select Term / Grading:</option>');
                        if(course_strand == 'Course'){                      
                            $('#add_term_grading').append('<option value="1st Term">1st Term</option>');
                            $('#add_term_grading').append('<option value="2nd Term">2nd Term</option>');
                            $('#add_term_grading').append('<option value="3rd Term">3rd Term</option>');
                        }else if(course_strand == 'Strand'){
                            $('#add_term_grading').append('<option value="1st Quarter">1st Quarter</option>');
                            $('#add_term_grading').append('<option value="2nd Quarter">2nd Quarter</option>');
                           // $('#add_term_grading').append('<option value="3rd Grading">3rd Grading</option>');
                            //$('#add_term_grading').append('<option value="4th Grading">4th Grading</option>');
                        }
                    }
                });
            });
            
            $( "#add_sc_id" ).change(function() {
                var sc_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "fullcalendar/schedule.php?action=get-section-by-strand-course&sc_id="+sc_id,
                    success: function(data){
                        //console.log(data);
                        $('#add_section_id option').remove();
                        $('#add_section_id').append('<option value="">Loading...</option>');
                        if(data.class == 'success'){
                            $('#add_section_id option').remove();
                            $('#add_section_id').append('<option value="">Select</option>');
                            $.each(data.data, function(x, obj) {
                                $('#add_section_id').append('<option value="'+obj.sec_id+'">['+obj.sec_code+'] '+obj.sec_name+'</option>');
                            });
                        }else if(data.class == 'error'){
                            $('#add_section_id option').remove();
                            $('#add_section_id').append('<option value="">No section found</option>');
                        }
                        
                    }
                });
            });
            
            
            $( "#edit_course_strand" ).change(function(e) {
                
                var course_strand = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "fullcalendar/schedule.php?action=get-strand-course&sc_sc="+course_strand,
                    success: function(data){
                        //console.log(data);
                        $('#edit_sc_id option').remove();
                        $('#edit_sc_id').append('<option value="">Loading...</option>');
                        if(data.class == 'success'){
                            $('#edit_sc_id option').remove();
                            $('#edit_sc_id').append('<option value="">Select</option>');
                            $.each(data.data, function(x, obj) {
                                $('#edit_sc_id').append('<option value="'+obj.sc_id+'">['+obj.sc_code+'] '+obj.sc_name+'</option>');
                            });
                        }else if(data.class == 'error'){
                            $('#edit_sc_id option').remove();
                            $('#edit_sc_id').append('<option value="">No result</option>');
                        }
                        
                        $('#edit_term_grading option').remove();
                        $('#edit_term_grading').append('<option value="">Select</option>');
                        if(course_strand == 'Course'){                      
                            $('#edit_term_grading').append('<option value="1st Term">1st Term</option>');
                            $('#edit_term_grading').append('<option value="2nd Term">2nd Term</option>');
                            $('#edit_term_grading').append('<option value="3rd Term">3rd Term</option>');
                        }else if(course_strand == 'Strand'){
                            $('#edit_term_grading').append('<option value="1st Quarter">1st Quarter</option>');
                            $('#edit_term_grading').append('<option value="2nd Quarter">2nd Quarter</option>');
                            //$('#edit_term_grading').append('<option value="3rd Grading">3rd Grading</option>');
                            //$('#edit_term_grading').append('<option value="4th Grading">4th Grading</option>');
                        }
                    }
                });
            });
            
            $( "#edit_sc_id" ).change(function() {
                var sc_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "fullcalendar/schedule.php?action=get-section-by-strand-course&sc_id="+sc_id,
                    success: function(data){
                        //console.log(data);
                        $('#edit_section_id option').remove();
                        $('#edit_section_id').append('<option value="">Loading...</option>');
                        if(data.class == 'success'){
                            $('#edit_section_id option').remove();
                            $('#edit_section_id').append('<option value="">Select</option>');
                            $.each(data.data, function(x, obj) {
                                $('#edit_section_id').append('<option value="'+obj.sec_id+'">['+obj.sec_code+'] '+obj.sec_name+'</option>');
                            });
                        }else if(data.class == 'error'){
                            $('#edit_section_id option').remove();
                            $('#edit_section_id').append('<option value="">No section found</option>');
                        }
                        
                    }
                });
            });
            
            
            $('#calendar').fullCalendar({
                header: {
                    left: '',
                    center: 'title',
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
                eventClick: function(calEvent, jsEvent, view) {
                    //console.log(calEvent.id);
                    $('#myModalEdit').modal("toggle");
                    $.ajax({
                        type: "GET",
                        url: "fullcalendar/schedule.php?action=get-schedule&schedule_id="+calEvent.id,
                        beforeSend: function() {
                            $('#edit-validate-notification-wrapper').html('Fetching details of schedule....');
                        },
                        success: function(data){
                            console.log(data);
                            var obj = data.data; 
                            
                            //$.each(data.data, function(x, obj) {
                                //alert(obj.school_year);
                                $('#frm_edit_schedule input[name=schedule_id]').val(obj.schedule_id);

                                $('#frm_edit_schedule .modal-header .modal-title').html('Edit Schedule #'+obj.schedule_id+'<div class="action-wrapper" style="width: 360px; float: right;"></div>');

                                //$('#frm_edit_schedule .modal-header .modal-title .action-wrapper').html('<a style="font-size: 15px; margin: -2px 10px 0;" id="btn-action-delete" onclick="deleteSchedule('+obj.schedule_id+');" href="javascript:;" class="btn btn-danger">Delete Permanently</a>');

                                $('#frm_edit_schedule .modal-header .modal-title .action-wrapper').append('<a style="font-size: 14px;  width: 300px; margin: -2px 10px 0;" id="btn-action-approve" onclick="approveSchedule('+obj.schedule_id+');" href="javascript:;" class="btn btn-success">Approve Schedule Now</a><br/><br/>');

                                $('#frm_edit_schedule .modal-header .modal-title .action-wrapper').append('<a style="font-size: 14px; width: 300px; margin: -2px 10px 0;" id="btn-action-approve" onclick="disapproveSchedule('+obj.schedule_id+');" href="javascript:;" class="btn btn-danger">Disapprove Schedule Now</a>');

                              

                                $('#frm_edit_schedule select[name=school_year]').val(obj.school_year).change();
                                $('#frm_edit_schedule select[name=course_strand]').val(obj.course_strand).trigger('change');
                                 $('#frm_edit_schedule select[name=comments]').val(obj.comments).trigger('change');
                                
                                $.ajax({
                                    type: "GET",
                                    url: "fullcalendar/schedule.php?action=get-strand-course&sc_sc="+obj.course_strand,
                                    success: function(data){
                                        //console.log(data);
                                        $('#edit_sc_id option').remove();
                                        $('#edit_sc_id').append('<option value="">Loading...</option>');
                                        if(data.class == 'success'){
                                            $('#edit_sc_id option').remove();
                                            $('#edit_sc_id').append('<option value="">Select</option>');
                                            $.each(data.data, function(x, obj) {
                                                $('#edit_sc_id').append('<option value="'+obj.sc_id+'">['+obj.sc_code+'] '+obj.sc_name+'</option>');
                                            });
                                        }else if(data.class == 'error'){
                                            $('#edit_sc_id option').remove();
                                            $('#edit_sc_id').append('<option value="">No result</option>');
                                        }
                                        
                                        $('#edit_term_grading option').remove();
                                        $('#edit_term_grading').append('<option value="">Select</option>');
                                        if(obj.course_strand == 'Course'){                      
                                            $('#edit_term_grading').append('<option value="1st Term">1st Term</option>');
                                            $('#edit_term_grading').append('<option value="2nd Term">2nd Term</option>');
                                            $('#edit_term_grading').append('<option value="3rd Term">3rd Term</option>');
                                        }else if(obj.course_strand == 'Strand'){
                                            $('#edit_term_grading').append('<option value="1st Quarter">1st Quarter</option>');
                                            $('#edit_term_grading').append('<option value="2nd Quarter">2nd Quarter</option>');
                                            //$('#edit_term_grading').append('<option value="3rd Grading">3rd Grading</option>');
                                           // $('#edit_term_grading').append('<option value="4th Grading">4th Grading</option>');
                                        }
                                        
                                        $('#frm_edit_schedule select[name=sc_id]').val(obj.sc_id_fk).trigger('change');
                                        $('#frm_edit_schedule select[name=term_grading]').val(obj.term_grading).trigger('change');
                                        
                                        $.ajax({
                                            type: "GET",
                                            url: "fullcalendar/schedule.php?action=get-section-by-strand-course&sc_id="+obj.sc_id_fk,
                                            success: function(data){
                                                //console.log(data);
                                                $('#edit_section_id option').remove();
                                                $('#edit_section_id').append('<option value="">Loading...</option>');
                                                if(data.class == 'success'){
                                                    $('#edit_section_id option').remove();
                                                    $('#edit_section_id').append('<option value="">Select</option>');
                                                    $.each(data.data, function(x, obj) {
                                                        $('#edit_section_id').append('<option value="'+obj.sec_id+'">['+obj.sec_code+'] '+obj.sec_name+'</option>');
                                                    });
                                                }else if(data.class == 'error'){
                                                    $('#edit_section_id option').remove();
                                                    $('#edit_section_id').append('<option value="">No section found</option>');
                                                }
                                                $('#frm_edit_schedule select[name=section_id]').val(obj.section_id_fk).trigger('change');
                                                $('#frm_edit_schedule select[name=subject_id]').val(obj.subject_id_fk).trigger('change');
                                                $('#frm_edit_schedule select[name=teacher_id]').val(obj.teacher_id_fk).trigger('change');
                                                $('#frm_edit_schedule select[name=room_id]').val(obj.room_id_fk).trigger('change');
                                                
                                            }
                                        });
                                        
                                        
                                    }
                                });
                                
                                var days = obj.day;
                                var selectedDays = new Array();
                                selectedDays = days.split(",");
                                $('#frm_edit_schedule input[type=checkbox]').prop('checked', false);
                                for (day in selectedDays ) {
                                    //console.log(selectedDays[day]);
                                    $('#frm_edit_schedule #day-'+selectedDays[day]).prop('checked', true);
                                }
                                
                                var startTime = obj.start_time;
                                var startTimeArray = new Array();
                                startTimeArray = startTime.split(":");
                                console.log("Start Time => "+startTime);
                                for (time in startTimeArray ) {
                                    //console.log(startTimeArray[time]);    
                                    var startHour = startTimeArray[0];
                                    var startMinute = startTimeArray[1];
                                    //console.log(startMinute);  for report
                                    if(startMinute < 59 ){
                                        startMinute = parseInt(startMinute) - 1;
                                    }else{
                                        startHour = parseInt(startHour) - 1;
                                        startMinute = 0;
                                    }
                                    startHour   = startHour < 10 ? '0'+startHour : startHour;
                                    startMinute = startMinute < 10 ? '0'+startMinute : startMinute;
                                }
                                console.log("Start Time => "+startHour+":"+startMinute);
                                $('#frm_edit_schedule select[name=start_hour]').val(startHour).trigger('change');
                                $('#frm_edit_schedule select[name=start_minute]').val(startMinute).trigger('change');
                                
                                var endTime = obj.end_time;
                                var endTimeArray = new Array();
                                endTimeArray = endTime.split(":");
                                console.log("End Time => "+endTime);
                                for (time in endTimeArray ) {
                                    //console.log(endTimeArray[time]);  
                                    var endHour = endTimeArray[0];
                                    var endMinute = endTimeArray[1];
                                    console.log(endMinute);
                                    if(endMinute > 0 ){
                                        endMinute = parseInt(endMinute) + 1;
                                        if(endMinute == 60){
                                            endMinute = 0;
                                            endHour = parseInt(endHour) + 1;
                                        }
                                    }else{
                                        endHour = parseInt(endHour) + 1;
                                        endMinute = 59;
                                    }
                                    endHour     = endHour < 10 ? '0'+endHour : endHour;
                                    endMinute   = endMinute < 10 ? '0'+endMinute : endMinute;
                                }
                                console.log("End Time => "+endHour+":"+endMinute);
                                $('#frm_edit_schedule select[name=end_hour]').val(endHour).trigger('change');
                                $('#frm_edit_schedule select[name=end_minute]').val(endMinute).trigger('change');
                                
                                $('#edit_text_color').colorpicker('setValue', obj.text_color);
                                $('#edit_background_color').colorpicker('setValue', obj.background_color);
                                $('#edit_border_color').colorpicker('setValue', obj.border_color);
                                
                            //});
                            
                            $('#edit-validate-notification-wrapper').html('');
                        }
                    });
                    
                }
            });
            
            //$('.fc-toolbar .fc-center h2').text('My Schedule');
            $('.fc-agenda-view .fc-day-grid').hide();

            $('#text_color').colorpicker();
            $('#background_color').colorpicker();
            $('#border_color').colorpicker();
            
            $('#edit_text_color').colorpicker();
            $('#edit_background_color').colorpicker();
            $('#edit_border_color').colorpicker();

             $.validator.addMethod('le', function(value, element, param) {
                  return this.optional(element) || value <= $(param).val();
            }, 'Invalid value');
            $.validator.addMethod('ge', function(value, element, param) {
                  return this.optional(element) || value >= $(param).val();
            }, 'Invalid value');


            $('#frm_add_schedule').validate({
                rules:{                       
                    "school_year":{
                        required:true
                    },
                    "course_strand":{
                        required:true
                    },
                    "sc_id":{
                        required:true,
                    },
                    "term_grading":{
                        required:true,
                    },
                    "section_id":{
                        required:true
                    },
                    "subject_id":{
                        required:true
                    },
                    "teacher_id":{
                        required:true
                    },
                    "room_id":{
                        required:true
                    },
                    "day":{
                        required:true
                    },
                    "start_hour":{
                        required:true,
                        le: "#end_hour"
                    },
                    "start_minute":{
                        required:true
                    },
                    "end_hour":{
                        required:true,
                        ge: "#start_hour"
                    },
                    "end_minute":{
                        required:true
                    }
                },
                messages:{                        
                    "school_year":{
                        required:""
                    },
                    "course_strand":{
                        required:""
                    },
                    "sc_id":{
                        required:"",
                    },
                    "term_grading":{
                        required:"",
                    },
                    "section_id":{
                        required:""
                    },
                    "subject_id":{
                        required:""
                    },
                    "teacher_id":{
                        required:""
                    },
                    "room_id":{
                        required:""
                    },
                    "day":{
                        required:""
                    },
                    "start_hour":{
                        required:"",
                        le:""
                    },
                    "start_minute":{
                        required:""
                    },
                    "end_hour":{
                        required:"",
                        ge:"",
                    },
                    "end_minute":{
                        required:""
                    }
                },
                submitHandler: function(form){
                    $('#validate-notification-wrapper').html('');
                    $.ajax({
                        type: "POST",
                        url: "fullcalendar/schedule.php",
                        data: $('#frm_add_schedule').serialize(),
                        beforeSend: function() {
                            $('input[type=submit]').addClass('disabled');
                            $('#validate-notification-wrapper').html('Validating New Schedule....');
                        },
                        success: function(data){
                            //alert(data);
                            //console.log(data);
                            $('#validate-notification-wrapper').html('<div class="alert alert-'+data.class+'">'+data.content+'</div>');
                            $(this).closest('form').find("input[type=text], textarea, select").val("");
                            $('input[type=submit]').removeClass('disabled');
                        }
                    });

                }
            });
            
            $('#frm_edit_schedule').validate({
                rules:{                       
                    "school_year":{
                        required:true,
                    },
                    "course_strand":{
                        required:true,
                    },
                    "sc_id":{
                        required:true,
                    },
                    "term_grading":{
                        required:true,
                    },
                    "section_id":{
                        required:true,
                    },
                    "subject_id":{
                        required:true,
                    },
                    "teacher_id":{
                        required:true,
                    },
                    "room_id":{
                        required:true,
                    },
                    "day":{
                        required:true,
                    },
                    "edit_start_hour":{
                        required:true,
                        le: "#end_hour"
                    },
                    "edit_start_minute":{
                        required:true
                    },
                    "edit_end_hour":{
                        required:true,
                        ge: "#start_hour"
                    },
                    "edit_end_minute":{
                        required:true
                    }
                },
                messages:{                        
                    "school_year":{
                        required:"",
                    },
                    "course_strand":{
                        required:""
                    },
                    "sc_id":{
                        required:"",
                    },
                    "term_grading":{
                        required:"",
                    },
                    "section_id":{
                        required:"",
                    },
                    "subject_id":{
                        required:"",
                    },
                    "teacher_id":{
                        required:"",
                    },
                    "room_id":{
                        required:"",
                    },
                    "day":{
                        required:"",
                    },
                    "edit_start_hour":{
                        required:"",
                        le:""
                    },
                    "edit_start_minute":{
                        required:""
                    },
                    "edit_end_hour":{
                        required:"",
                        ge:"",
                    },
                    "edit_end_minute":{
                        required:"",
                    }
                },
                submitHandler: function(form){
                    $('#edit-validate-notification-wrapper').html('');
                    $.ajax({
                        type: "POST",
                        url: "fullcalendar/schedule.php",
                        data: $('#frm_edit_schedule').serialize(),
                        beforeSend: function() {
                            $('input[type=submit]').addClass('disabled');
                            $('#edit-validate-notification-wrapper').html('Validating New Schedule....Test');
                        },
                        success: function(data){
                            //alert(data);
                            console.log(data);
                            $('#edit-validate-notification-wrapper').html('<div class="alert alert-'+data.class+'">'+data.content+'</div>');
                            $(this).closest('form').find("input[type=text], textarea, select").val("");
                            $('input[type=submit]').removeClass('disabled');
                            if(data.class == 'success'){
                                location.reload();
                            }
                        }
                    });

                }
            });
            
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

function disapproveSchedule(schedule_id){
    if (confirm('Are you sure you want to dissapprove Schedule #'+schedule_id+'?')) {
        $.ajax({
            type: "POST",
            url: "fullcalendar/schedule.php?action=disapprove-schedule&schedule_id="+schedule_id,
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
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="col-xs-3">
                <h4>Filter Schedule (<?php echo $filter_school_year; ?>)</h4>
                    <label>Filter by</label>
                    <select name="filter_by" id="filter_by" class="form-control">
                        <option value="">Select</option>
                        <option value="Section" <?php echo $filter_by == 'Section' ? 'selected':''; ?>>Section/Course/Strand</option>
                        <option value="Room" <?php echo $filter_by == 'Room' ? 'selected':''; ?>>Room</option>
                        <option value="Teacher" <?php echo $filter_by == 'Teacher' ? 'selected':''; ?>>Teacher</option>
                    </select>
<!-- FILTER BY SECTION -->
                    <?php 
                    if($filter_by == 'Section'){
                    ?> 
                        <br />
                        <label>Degree</label>
                        <select class="form-control" id="filter_course_strand" name="filter_course_strand">
                            <option value="">Select</option>
                              <option value="Course" <?php echo $course_strand == 'Course' ? 'selected':''; ?>>College</option>
                              <option value="Strand" <?php echo $course_strand == 'Strand' ? 'selected':''; ?>>Senior High School</option>                     
                          </select>
                        <?php if($course_strand != ''){ ?>  
                        <br />
                        <label><?php echo ($course_strand == 'Course') ? 'Term':'Grading'; ?>  </label>
                        <select class="form-control" id="filter_term_grading" name="filter_term_grading">
                            <option value="">Select</option>
                              <?php if($course_strand == 'Course'){ ?>  
                              <option value="1st Term" <?php echo $term_grading == '1st Term' ? 'selected':''; ?>>1st Term</option>
                              <option value="2nd Term" <?php echo $term_grading == '2nd Term' ? 'selected':''; ?>>2nd Term</option>
                              <option value="3rd Term" <?php echo $term_grading == '3rd Term' ? 'selected':''; ?>>3rd Term</option>
                             <?php }elseif($course_strand == 'Strand'){ ?>  
                              <option value="1st Quarter" <?php echo $term_grading == '1st Quarter' ? 'selected':''; ?>>1st Quarter</option>
                              <option value="2nd Quarter" <?php echo $term_grading == '2nd Quarter' ? 'selected':''; ?>>2nd Quarter</option>
                              <!--<option value="3rd Grading" //<?php echo $term_grading == '3rd Grading' ? 'selected':''; ?>>3rd Grading</option>
                              <option value="4th Grading" //<?php echo $term_grading == '4th Grading' ? 'selected':''; ?>>4th Grading</option> -->
                               <?php } ?>
                          </select>
                          <?php } ?>
                          <br />
                          <?php if($term_grading != ''){ ?>
                          <label>Section</label>
                          <select class="form-control" name="filter_section_id" id="filter_section_id">
                            <option value=""> Select</option>
                            <?php
                                $sec_retrieve ="SELECT * FROM section, strand_course WHERE strand_course.sc_id = section.sc_id_fk AND strand_course.sc_sc = '$course_strand' ORDER BY section.sec_name ";
                                $sec_query = mysqli_query($conn, $sec_retrieve);
                                      
                                if($sec_query){

                                        while ($sec_result = mysqli_fetch_assoc($sec_query)){
                                            $is_selected =  $section_id == $sec_result['sec_id'] ? 'selected':''; 

                                        echo '<option value="'.$sec_result['sec_id'].'" '.$is_selected.'>'.$sec_result['sec_name'].' </option>';
                                        }
                                }
                            ?>
                          </select>
                          <?php } ?>
                    <?php
                    }
                    ?>

<!-- FILTER BY TEACHER -->
                    <?php 
                    if($filter_by == 'Teacher'){
                    ?> 
                        <br />
                        <label>Degree</label>
                        <select class="form-control" id="filter_teacher_course_strand" name="filter_teacher_course_strand">
                            <option value="">Select</option>
                              <option value="Course" <?php echo $teacher_course_strand == 'Course' ? 'selected':''; ?>>College</option>
                              <option value="Strand" <?php echo $teacher_course_strand == 'Strand' ? 'selected':''; ?>>High School</option>                     
                          </select>
                        <?php if($teacher_course_strand != ''){ ?>  
                        <br />
                        <label><?php echo ($teacher_course_strand == 'Course') ? 'Term':'Grading'; ?>  </label>
                        <select class="form-control" id="filter_teacher_term_grading" name="filter_teacher_term_grading">
                            <option value="">Select</option>
                              <?php if($teacher_course_strand == 'Course'){ ?>  
                              <option value="1st Term" <?php echo $teacher_term_grading == '1st Term' ? 'selected':''; ?>>1st Term</option>
                              <option value="2nd Term" <?php echo $teacher_term_grading == '2nd Term' ? 'selected':''; ?>>2nd Term</option>
                              <option value="3rd Term" <?php echo $teacher_term_grading == '3rd Term' ? 'selected':''; ?>>3rd Term</option>
                             <?php }elseif($teacher_course_strand == 'Strand'){ ?>  
                              <option value="1st Quarter" <?php echo $teacher_term_grading == '1st Quarter' ? 'selected':''; ?>>1st Quarter</option>
                              <option value="2nd Quarter" <?php echo $teacher_term_grading == '2nd Quarter' ? 'selected':''; ?>>2nd Quarter</option>
                              <!--<option value="3rd Grading" //<?php echo $term_grading == '3rd Grading' ? 'selected':''; ?>>3rd Grading</option>
                              <option value="4th Grading" //<?php echo $term_grading == '4th Grading' ? 'selected':''; ?>>4th Grading</option> -->
                               <?php } ?>
                          </select>
                          <?php } ?>
                          <br />
                          <?php if($teacher_term_grading != ''){ ?>
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
                          <?php } ?>
                    <?php
                    }
                    ?>
                  
<!-- FILTER BY Room -->
                <?php 
                    if($filter_by == 'Room'){
                    ?> 
                        <br />
                        <label>Degree</label>
                        <select class="form-control" id="filter_room_course_strand" name="filter_room_course_strand">
                            <option value="">Select</option>
                              <option value="Course" <?php echo $room_course_strand == 'Course' ? 'selected':''; ?>>College</option>
                              <option value="Strand" <?php echo $room_course_strand == 'Strand' ? 'selected':''; ?>>High School</option>                     
                          </select>
                        <?php if($room_course_strand != ''){ ?>  
                        <br />
                        <label><?php echo ($room_course_strand == 'Course') ? 'Term':'Grading'; ?>  </label>
                        <select class="form-control" id="filter_room_term_grading" name="filter_room_term_grading">
                            <option value="">Select</option>
                              <?php if($room_course_strand == 'Course'){ ?>  
                              <option value="1st Term" <?php echo $room_term_grading == '1st Term' ? 'selected':''; ?>>1st Term</option>
                              <option value="2nd Term" <?php echo $room_term_grading == '2nd Term' ? 'selected':''; ?>>2nd Term</option>
                              <option value="3rd Term" <?php echo $room_term_grading == '3rd Term' ? 'selected':''; ?>>3rd Term</option>
                             <?php }elseif($room_course_strand == 'Strand'){ ?>  
                              <option value="1st Quarter" <?php echo $room_term_grading == '1st Quarter' ? 'selected':''; ?>>1st Quarter</option>
                              <option value="2nd Quarter" <?php echo $room_term_grading == '2nd Quarter' ? 'selected':''; ?>>2nd Quarter</option>
                              <!--<option value="3rd Grading" //<?php echo $term_grading == '3rd Grading' ? 'selected':''; ?>>3rd Grading</option>
                              <option value="4th Grading" //<?php echo $term_grading == '4th Grading' ? 'selected':''; ?>>4th Grading</option> -->
                               <?php } ?>
                          </select>
                          <?php } ?>
                          <br />
                          <?php if($room_term_grading != ''){ ?>
                          <label>Room</label>
                          <select class="form-control" name="filter_room_id" id="filter_room_id">
                            <option value=""> Select</option>
                            <?php
                               $room_retrieve ="SELECT * FROM rooms ORDER BY room_name";
                                $room_query = mysqli_query($conn, $room_retrieve);
                                      
                                if($room_query){

                                         
                           while ($room_result = mysqli_fetch_assoc($room_query)){
                                $is_selected =  $room_id == $room_result['room_id'] ? 'selected':''; 

                                echo '<option value="'.$room_result['room_id'].'" '.$is_selected.'>'.$room_result['room_name'].' </option>';
                            }
                                }
                            ?>
                          </select>
                          <?php } ?>
                    <?php
                    }
                    ?>


            </div>
            <div class="col-xs-9">
                <button style="position: absolute;" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add Comments</button>
                <button style="position: absolute; left: 160px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalComments"><i class="fa fa-search"></i> View Comments</button>
                <button style="position: absolute; right: 15px;" alt="Calender Settings" type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalSettings"><i class="fa fa-cog"></i> Settings</button>
                <div id='calendar'></div>
            </div>
        </div>
    </div>

   <!-- Modal Add -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <form method="POST" action="server/add_chat.php">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Comment Section for Changes</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 

                    <div class="form-group col-lg-12">
                        <label>School Year</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-calendar"></span>
                          </span>
                    
                          <select class="form-control" name="schedule_id">

                          <?php 
                                $sched_retrieve ="SELECT * FROM schedule as sc LEFT JOIN subject as subj ON sc.subject_id_fk = subj.subj_id LEFT JOIN teacher as teach ON sc.teacher_id_fk = teach.teacher_id";
                                $sched_query = mysqli_query($conn, $sched_retrieve);

                                while ($sched_result = mysqli_fetch_assoc($sched_query)){
                            ?>
                            <option value="<?php echo $sched_result['schedule_id']; ?>">
                                Schedule # [<?php echo $sched_result['subj_name']; ?>] [<?php echo $sched_result['teacher_fullname']; ?>]
                            </option>
                            <?php } ?>
                          </select>
                    
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>[ 1 ] Add Comment:</label>
                        <div class="input-group">
                            <textarea rows="4" cols="78" name="comments"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
              <div id="validate-notification-wrapper"></div>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
              <input type="hidden" name="action" value="add-schedule" />
            </div>
        </div>
        </form>  
        </div>
    </div>
    

 <!-- Modal Comment -->
    <div class="modal fade" id="myModalComments" role="dialog">
        <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <form id="frm_add_schedule" method="POST" action="#">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">View Comments</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                     <div class="container-fluid">
       
        <div class="table-responsive">        
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Schedule ID</th>
                    <th style="text-align: center;">Comment/s</th>
                    <th style="text-align: center;">Date and Time Created</th>
                    <th style="text-align: center;">Remarks</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Schedule ID</th>
                    <th style="text-align: center;">Comment/s</th>
                    <th style="text-align: center;">Date and Time Created:</th>
                    <th style="text-align: center;">Remarks</th>
                </tr>
              </tfoot>

                <!-- View Users -->
                <?php 
                  $info_retrieve = "SELECT * FROM chat ORDER BY chat_status ASC";
                  $info_query = mysqli_query($conn, $info_retrieve);

                  while ($info_result = mysqli_fetch_assoc($info_query)){
                ?>

              <tbody>
                <tr>
                    <td style="width: 5px;"><center><?php echo $info_result['c_schedule_id_fk'];?></center></td>
                    <td><center><?php echo $info_result['chat_message'];?></center></td>
                    <td style="width: 50px;"><center><?php echo $info_result['chat_time'];?></center></td>
                    <td style="width: 10px;"><center><?php echo $info_result['chat_status'] == 'Done' ? 'Done' : 'Pending';?></center></td>
               
                </tr>  
              </tbody>
                  <?php
                    }
                ?> 
            </div>
            <!-- End Table Responsive -->
          </table>
          <!-- End Table -->                         
      </div>
                </div>
            </div>
           
        </form>  
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="myModalEdit" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <form id="frm_edit_schedule" method="POST" action="#">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Verify Schedule</h4>
            </div>
        </div>
        </form>  
        </div>
    </div>
    
    <!-- Modal Settings -->
    <div class="modal fade" id="myModalSettings" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <form id="frm_update_settings" method="POST" action="e_view_class.php">
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
                        $yt_retrieve ="SELECT DISTINCT(school_year) FROM school_year WHERE status ='Activated' ";
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

                    <!-- <div class="form-group col-lg-6">
                        <label>Term</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                          </span>
                          <select class="form-control" name="settings_term">
                            <option <?php //echo ($settings_schedule_of == '1') ? 'selected':''; ?>  value="1">Term 1</option>
                            <option <?php //echo ($settings_schedule_of == '2') ? 'selected':''; ?> value="2">Term 2</option>
                            <option <?php //echo ($settings_schedule_of == '3') ? 'selected':''; ?> value="3">Term 3</option>                            
                          </select>
                        </div>
                    </div> -->
                    
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