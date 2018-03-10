<?php 
include("s_dashboard.php");
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
          <h2 class="page-header"> <center>View Exam Schedule</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">Exam Schedule</li>
      </ul>


  <div class="form-group col-lg-12">
    <label>Section</label>
    <div class="input-group">
      <span class="input-group-addon"><span class="fa fa-book"></span></span>
        <?php 
          $query ="SELECT * FROM section";
          $sql = mysqli_query($conn, $query);
                          
            if($query){
        ?>
        <select class="form-control" name="section_id" id="section" onchange="getId(this.value);">
          <option value=""> Section:</option>

        <?php
          while ($result = mysqli_fetch_assoc($sql)){
            echo '<option value="'.$result['sec_id'].'">'.$result['sec_name'].' </option>';
          }
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
            url: "server/get_examschedule.php",
            data: "sec_id="+val,
            success: function(data){
                $("#exam_schedule").html(data);
              }
        });
    }
 </script>
<br>
<br>


</br>

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
                    <th style="text-align: center;">Schedule ID</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
                </tr>  
              </thead>

              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Schedule ID</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Start Time</th>
                    <th style="text-align: center;">End Time</th>
                </tr>
              </tfoot>

               <?php 
               $sql  = "SELECT * FROM exam as ex LEFT JOIN schedule as sc ON ex.exam_schedule_id_fk = sc.schedule_id LEFT JOIN day ON ex.exam_day = day.day_id LEFT JOIN rooms as ro ON ex.exam_room = ro.room_id LEFT JOIN teacher as te ON ex.exam_teacher = te.teacher_id LEFT JOIN section as sec ON sc.section_id_fk = sec.sec_id LEFT JOIN subject as subj ON sc.subject_id_fk = subj.subj_id";

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
              <tbody >
              <tr id="exam_schedule">
                  <tr>
                    <td><?php echo $result['exam_id'];?></td>
                    <td><?php echo $result['day_code'];?></td>
                    <td><?php echo $result['sec_code'];?></td>
                    <td><?php echo $result['teacher_fullname'];?></td>
                    <td><?php echo $result['subj_code'];?></td>
                    <td><?php echo $result['room_number'];?></td>
                    <td><?php echo $new_start_time;?></td>
                    <td><?php echo $new_end_time;?></td>
                   </tr> 
              </tr>
              </tbody>
              <?php }?>
              </table>
              </div>
              </div>
              </div>
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
</body>
</html>