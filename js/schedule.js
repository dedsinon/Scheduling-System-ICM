
        $(document).ready(function() {

            $( "#filter_by" ).change(function() {
                var filterBy = $(this).val();
                //alert(filterBy);
                window.location.href = "create_schedule.php?filterBy=" + filterBy +"&school_year=<?php echo $filter_school_year; ?><?php echo $url_settings; ?>";

            });

            $( "#filter_section_id" ).change(function() {
                var section_id = $(this).val();
                //alert(filterBy);
                window.location.href = "create_schedule.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading=<?php echo $term_grading; ?>&section_id="+section_id+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_course_strand" ).change(function() {
                var course_strand = $(this).val();
                //alert(filterBy);
                window.location.href = "create_schedule.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand="+course_strand+"<?php echo $url_settings; ?>";

            });
            
            $( "#filter_term_grading" ).change(function() {
                var term_grading = $(this).val();
                //alert(filterBy);
                window.location.href = "create_schedule.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&course_strand=<?php echo $course_strand; ?>&term_grading="+term_grading+"<?php echo $url_settings; ?>";

            });

            $( "#filter_teacher_id" ).change(function() {
                var teacher_id = $(this).val();
                window.location.href = "create_schedule.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&teacher_id="+teacher_id+"<?php echo $url_settings; ?>";

            });

            $( "#filter_room_id" ).change(function() {
                var room_id = $(this).val();
                window.location.href = "create_schedule.php?filterBy=<?php echo $filter_by; ?>&school_year=<?php echo $filter_school_year; ?>&room_id="+room_id+"<?php echo $url_settings; ?>";

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
                            $('#add_term_grading').append('<option value="1st Grading">1st Grading</option>');
                            $('#add_term_grading').append('<option value="2nd Grading">2nd Grading</option>');
                            $('#add_term_grading').append('<option value="3rd Grading">3rd Grading</option>');
                            $('#add_term_grading').append('<option value="4th Grading">4th Grading</option>');
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
                            $('#edit_term_grading').append('<option value="1st Grading">1st Grading</option>');
                            $('#edit_term_grading').append('<option value="2nd Grading">2nd Grading</option>');
                            $('#edit_term_grading').append('<option value="3rd Grading">3rd Grading</option>');
                            $('#edit_term_grading').append('<option value="4th Grading">4th Grading</option>');
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
                                $('#frm_edit_schedule .modal-header .modal-title .action-wrapper').html('<a style="font-size: 10px; margin: -2px 10px 0;" id="btn-action-delete" onclick="deleteSchedule('+obj.schedule_id+');" href="javascript:;" class="btn btn-danger">Delete Permanently</a>');
                                $('#frm_edit_schedule .modal-header .modal-title .action-wrapper').append('<a style="font-size: 10px; margin: -2px 10px 0;" id="btn-action-approve" onclick="approveSchedule('+obj.schedule_id+');" href="javascript:;" class="btn btn-success">Approve Schedule Now</a>');
                                $('#frm_edit_schedule select[name=school_year]').val(obj.school_year).change();
                                $('#frm_edit_schedule select[name=course_strand]').val(obj.course_strand).trigger('change');
                                
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
                                            $('#edit_term_grading').append('<option value="1st Grading">1st Grading</option>');
                                            $('#edit_term_grading').append('<option value="2nd Grading">2nd Grading</option>');
                                            $('#edit_term_grading').append('<option value="3rd Grading">3rd Grading</option>');
                                            $('#edit_term_grading').append('<option value="4th Grading">4th Grading</option>');
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

   