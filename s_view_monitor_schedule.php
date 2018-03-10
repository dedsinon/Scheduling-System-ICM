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
          <h3 class="page-header"><button style="position: absolute;" type="button" class="btn btn-info" onclick="myFunction()"><i class="fa fa-print"></i> Print Report</button>  <center>View Monitoring Report
          </center></h3>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">View Monitoring Report </li>
      </ul>


<div class="container-fluid col-md-2">
 

<script>
        function myFunction(){
          window.print();
        }
      </script>
</div>

<!-- Page Heading -->


<div class="form-group col-md-12">
<form method="POST" action="#">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-th-list"></span>
                        </span>
                        <select class="form-control" name="term" onchange="getId(this.value);" required>
                          <option value="">Select Term / Grading:</option>
                          <option value="1st Term">1st Term</option>
                          <option value="2nd Term">2nd Term</option>
                          <option value="3rd Term">3rd Term</option>
                          <option value="1st Grading">1st Grading</option>
                          <option value="2nd Grading">2nd Grading</option>
                          </select>
                      </div>
                      </form>
                    </div> 
                   



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
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Remarks</th>
                    <th style="text-align: center;">Comments</th>
                    <th style="text-align: center;">Monitored Date / Time</th>
                </tr>
              </thead>

              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Day</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Teacher</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Remarks</th>
                    <th style="text-align: center;">Comments</th>
                    <th style="text-align: center;">Monitored Date / Time</th>
                </tr>
              </tfoot>
             

              <tbody id="schedule">
              
              </tbody>
             </table>
             </div>
             </div>
             </div>
             </div>

<br /><br />
 <script>
function getId(val){
    $.ajax({
    type: "POST",
    url: "server/filter_table_view.php",
    data: "term="+val,
    success: function(data){
    $("#schedule").html(data);
    }
    });
    }
 </script>

<br><br><br>
    <div class="col-xs-12">
<div class="panel panel-default">
    <div class="panel-body">

        <div class="col-xs-3">
            <label> Monitored By:</label><br /><br />
            <input type="text" placeholder="Enter Name:" style="border: none;"  /><br />
            <label>Student Assistant &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-3">
            <label> Prepared:</label><br /><br />
            <input type="text" value="Mr.Rolan Macarang" style="border: none;" disabled/><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;Academic Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-3">
            <label> Noted:</label><br /><br />
            <input type="text" value="Mrs.Zenobia Oseo" style="border: none;" disabled /><br />
            <label>&nbsp;&nbsp;&nbsp;&nbsp;Services Head &nbsp;&nbsp;</label>
        </div>

        <div class="col-xs-3">
            <label> Approved for Posting:</label><br /><br />
            <input type="text" value="Ms. Dianne Gabriel" style="border: none;" disabled /><br />
            <label>Asst. Center Manager &nbsp;&nbsp;</label>
        </div>

    </div>
</div>
</div>





</body>
</html>