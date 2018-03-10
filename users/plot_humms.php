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

<link rel='stylesheet' href='calendar/fullcalendar.css' />
<script src='calendar/lib/jquery.min.js'></script>
<script src='calendar/lib/moment.min.js'></script>
<script src='calendar/fullcalendar.js'></script>


<script type="text/javascript">
  $(document).ready(function(){
    $("#up").click(function(){
      $("#body1").slideUp("slow");
    });
    $("#down").click(function(){
      $("#body1").slideDown("slow");
    });   


});




</script>
    <title>User Account</title>

</head>

<style>

#search{
  width: 300px;
  border-radius: 10px;
}

.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}

</style>

<body>

    
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header"> <center> Manage User Account</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">User Account</li>
      </ul>
    
       <!-- Add New User -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading"> Create Course Subject
            </div>

            <div class="panel-body">
            <div class="col-lg-12">

             <ul class="nav nav-tabs">
                   <li><a href="plot_bsba.php"> BSBA</a></li>
                  <li><a href="plot_bsit.php">BSIT</a></li>
                  <li  class="active"><a href="plot_humms.php"> HUMSS</a></li>
                  <li><a href="plot_ict.php">ICT</a></li> 
                  <li><a href="plot_abm.php"> ABM</a></li>                   
              </ul>
              </br>

               <div id="calendar_humss"></div> 

            <script type="text/javascript">
                
                $('#calendar_humss').fullCalendar({
                  
                  hiddenDays: [ 0 ],
                  defaultView: 'agendaWeek',
                  minTime: '7:15:00',
                  maxTime: '22:00:00'
                });             
            </script>        
</body>
</html>