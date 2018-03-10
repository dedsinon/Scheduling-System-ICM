<?php 
require('dashboard.php');
require('server/p_db_connection.php');


$teach_id = $_POST ['teach_id'];
$year = $_POST ['year'];
$term = $_POST ['Term'];
$quarter = $_POST ['Quarter'];

$teacher = "SELECT * FROM teacher WHERE teacher_id = '$teach_id' ";

$teacher_query = mysqli_query($conn, $teacher);
               
while ($teacher_result = mysqli_fetch_assoc($teacher_query)){

  $teacher_name = $teacher_result['teacher_fullname'];
   $teacher_special = $teacher_result['teacher_subjmaj'];
    $teacher_status = $teacher_result['teacher_workstatus'];
}
//Monday
           $schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') AND day='1' ORDER BY start_time, end_time ASC";
           
            $schedule_query = mysqli_query($conn, $schedule_sql);
               
                while ($result = mysqli_fetch_assoc($schedule_query)){

                   $section =  $result['sec_name'];

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

                  $monday = $new_start_time.' - '.$new_end_time; 
           }
//Tuesday
           $schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') AND sc.day='2' ORDER BY start_time, end_time ASC";
           
            $schedule_query = mysqli_query($conn, $schedule_sql);
               
                while ($result = mysqli_fetch_assoc($schedule_query)){

                   $section =  $result['sec_name'];

                    $start_time = explode(':', $result['start_time']);
                    //print_r($start_time);
                    $end_time = explode(':', $result['end_time']);

                    //print_r($end_time);

                    //START TIME
                    $new_start_minute = ((int)$start_time[1] - 1) < 10 ? '0'.((int)$start_time[1] - 1) : ((int)$start_time[1] - 1);

                     $start_hour = $start_time[0] > 12 ? '0'.($start_time[0] - 12) : $start_time[0] - 0;

                    if ($start_time[0] > 11){
                      $tnew_start_time = $start_hour.':'.$new_start_minute.':00 pm';
                    }
                    else{
                      $tnew_start_time = $start_hour.':'.$new_start_minute.':00 am';
                    }

                    //END TIME
                    $hour = ((int)$end_time[1] + 1) > 58 ? '0'.((int)$end_time[0] + 1) : ((int)$end_time[0] + 0 ); 

                   $new_end_minute = ((int)$end_time[1] + 1) > 58 ? '0'.((int)$end_time[1] - 59) : ((int)$end_time[1] + 1);
                   
                   $new_hour = $hour > 12 ? '0'.($hour - 12) : $hour - 0;

                    if ($hour > 11){
                      $tnew_end_time = $new_hour.':'.$new_end_minute.':00 pm';
                    }
                    else{
                      $tnew_end_time = $new_hour.':'.$new_end_minute.':00 am';
                    }  
                    
                    if ($tnew_end_time[0] > 12){ 
                      $final_end_time = ((int)$tnew_end_time[0] - 12);
                    }

                  $tuesday = $tnew_start_time.' - '.$tnew_end_time; 
           }
//Wednesday
           $schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') AND day='3' ORDER BY start_time, end_time ASC";
           
            $schedule_query = mysqli_query($conn, $schedule_sql);
               
                while ($result = mysqli_fetch_assoc($schedule_query)){

                   $section =  $result['sec_name'];

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

                  $wednesday = $new_start_time.' - '.$new_end_time; 
           }
//THURSDAY
           $schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') AND day='4' ORDER BY start_time, end_time ASC";
           
            $schedule_query = mysqli_query($conn, $schedule_sql);
               
                while ($result = mysqli_fetch_assoc($schedule_query)){

                   $section =  $result['sec_name'];

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

                  $thursday = $new_start_time.' - '.$new_end_time; 
           }
           //Friday
           $schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') AND day='5' ORDER BY start_time, end_time ASC";
           
            $schedule_query = mysqli_query($conn, $schedule_sql);
               
                while ($result = mysqli_fetch_assoc($schedule_query)){

                   $section =  $result['sec_name'];

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

                  $friday = $new_start_time.' - '.$new_end_time; 
           }
            //Saturday
           $schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter') AND day='6' ORDER BY start_time, end_time ASC";
           
            $schedule_query = mysqli_query($conn, $schedule_sql);
               
                while ($result = mysqli_fetch_assoc($schedule_query)){

                   $section =  $result['sec_name'];

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

                  $saturday = $new_start_time.' - '.$new_end_time; 
           }
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

hr{
    overflow: visible; /* For IE */
    border-style: solid;
    border-color: black;
    border-width: 2px 0 0 0;
   
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

<div class="col-xs-12">
<hr>
</div>

<div class="col-xs-12">
<center>
        <p style="font-size: 20px;">Academics Department</p>
<br/>
        <p style="color: red; font-size: 15px;">Faculty Loading</p>
</center>
</div>
<br/>
<div class="col-xs-12">
<hr>
</div>
<br />
      <div class="col-xs-12">
        <div class="table-responsive">        
          <table class="table table-bordered" width="100%" cellspacing="0">
              <tbody>
              <tr>
                  <td style="width: 150px">Lecturer</td>
                  <td><center><?php echo $teacher_name; ?></center></td>
                  <td style="width: 150px">Employee Status</td>
                  <td><center><?php echo $teacher_status; ?></center></td>
              </tr>
              <tr>
                  <td style="width: 150px">Specialization</td>
                  <td><center><?php echo $teacher_special; ?></center></td>
                  <td style="width: 150px">Academic Term</td>
                  <td><center><?php 
                             
                             if($term == ''){
                            echo $quarter.' SY '.$year;
                            }else if($quarter ==''){
                                echo $term.' SY '.$year;
                            }else if ($term AND $quarter != ''){
                                echo $term .' - '.$quarter.' SY '.$year;
                            }

                       ?></center></td>
              </tr>
              </tbody>
              </table>
              </div>
              </div>
<br/>
<div class="col-xs-12">
Here are the following subjects that you will be handling for this term:
<br/>
<br/>
</div> 

    <div class="col-xs-12">
      <div class="table-responsive">        
          <table class="table table-bordered" width="100%" cellspacing="0">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Code</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Units</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Days</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Room</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                    <th style="text-align: center;"></th>
                </tr>
              </tfoot>

              <!--
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Code</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Units</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Days</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Room</th>
                </tr>
              </tfoot>-->
                <?php

               $get_schedule_sql ="SELECT * FROM schedule as sc LEFT JOIN subject as su ON sc.subject_id_fk = su.subj_id LEFT JOIN rooms AS ro ON sc.room_id_fk = ro.room_id LEFT JOIN day ON sc.day = day.day_id LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN section AS sec ON sc.section_id_fk = sec.sec_id WHERE sc.teacher_id_fk = '$teach_id'  AND school_year = '$year' AND term_grading IN ('$term','$quarter')";

                //print_r($get_schedule_sql);

                $get_schedule_query = mysqli_query($conn, $get_schedule_sql);
               
                while ($schedule_result = mysqli_fetch_assoc($get_schedule_query)){

                    $section =  $schedule_result['sec_name'];
                    $day = $schedule_result['day'];


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
               

                  <td><?php echo $schedule_result['subj_code']?></td>
                  <td><?php echo $schedule_result['subj_name']?></td>
                  <td><?php echo $schedule_result['subj_unit'] == '0' ? 'N/A' : $schedule_result['subj_unit']; ?></td>
                  <td><?php echo $schedule_result['sec_code']?></td>
                  <td><?php echo $schedule_result['day_code']?></td>
                  <td><?php echo $new_start_time.' - '.$new_end_time ?></td>
                  <td><?php echo $schedule_result['room_number']; ?></td>
                  
                  
              </tr>
               <?php
             
             
              }
              ?>
              </tbody>
              </table>
              </div>
              </div>

             <!-- <div class="col-xs-12">
        <div class="table-responsive">        
          <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th></th>
              <th><center>Teaching Hours</center></th>
              <th></th>
              <th></th>
              <th><center>Working Hours</center></th>
              <th></th>
            </tr>
          </thead>
            
              <tbody>
              <tr>
                  <td style="width: 150px">Day</td>
                  <td><center>Time</center></td>
                  <td style="width: 150px">Hours</td>
                  <td></td>
                  <td style="width: 300px">Time</td>
                  <td>Hours</td>
              </tr>
              <tr>
                  <td style="width: 150px">Monday</td>
                  <td><?php //if($day =="1"){echo $monday;}else{echo 'No Schedule';}?></td></td>
                  <td></td>
                  <td></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Hours" autofocus required /></td>
              </tr>
              <tr>
                  <td style="width: 150px">Tuesday</td>
                  <td><?php //if($day =="2"){echo $tuesday;}else{echo 'No Schedule';}?></td>
                  <td></td>
                  <td></td>
                   <td><input type="text" name="firstname" class="form-control" placeholder="Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Hours" autofocus required /></td>
              </tr>
              <tr>
                  <td style="width: 150px">Wednesday</td>
                  <td><?php //if($day =="3"){echo $wednesday;}else{echo 'No Schedule';}?></td>
                  <td></td>
                  <td></td>
                   <td><input type="text" name="firstname" class="form-control" placeholder="Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Hours" autofocus required /></td>
              </tr>
              <tr>
                  <td style="width: 150px">Thursday</td>
                  <td><?php //if($day =="4"){echo $thursday;}else{echo 'No Schedule';}?></td>
                  <td></td>
                  <td></td>
                   <td><input type="text" name="firstname" class="form-control" placeholder="Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Hours" autofocus required /></td>
              </tr>
              <tr>
                  <td style="width: 150px">Friday</td>

                  <td><?php //if($day =="5"){echo $friday;}else{echo 'No Schedule';}?></td>
                  <td></td>
                  <td></td>
                   <td><input type="text" name="firstname" class="form-control" placeholder="Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Hours" autofocus required /></td>
              </tr>
              <tr>
                  <td style="width: 150px">Saturday</td>
                  <td><?php //if($day =="5"){echo $saturday;}else{echo 'No Schedule';}?></td>
                  <td></td>
                  <td></td>
                   <td><input type="text" name="firstname" class="form-control" placeholder="Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Hours" autofocus required /></td>
              </tr>
              <tr>
                  <td style="width: 150px"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                   <td></td>
                  <td></td>
              </tr>
              <tr>
                  <td style="width: 150px">Remarks</td>
                  <td></td>
                  <td></td>
                  <td></td>
                   <td><input type="text" name="firstname" class="form-control" placeholder="Total Time" autofocus required /></td>
                  <td><input type="text" name="firstname" class="form-control" placeholder="Toal Hours" autofocus required /></td>
              </tr>
              </tbody>
             
              </table>
              </div>
              </div> -->
              
<br/><br/><br/>   
<div class="col-xs-12">
<div class="panel panel-default">
    <div class="panel-body">
         <div class="col-xs-3">
            <label> In Conforme:</label><br /><br />
            <input type="text" value="<?php echo $teacher_name; ?>" style="border: none;" disabled/><br />
            <label>Lecturer &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-3">
            <label> Prepared by:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;"/><br />
            <label>Academic Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-3">
            <label> Noted:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;" /><br />
            <label>Services Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-3">
            <label> Approved for Posting:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;" /><br />
            <label>Asst. Center Manager &nbsp;&nbsp;</label>
        </div>
    </div>
</div>
</div>

            


</body>
</html>