
<?php 
require ("s_dashboard.php");
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
      <h2 class="page-header"> <center> View Monitoring Schedule</center></h2>
    </div>
  </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active" title="View Room"> <a href="s_monitor_view.php">View Monitor Schedule</a></li>
      </ul>
  

<br />
   <!-- View Class -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading" id="head1"> <b>View Monitor Schedule  </b>
              <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

             <form method="POST" action="s_monitor_p_view.php" target="_top" id="myform">

            <div class="panel-body" id="body1">
            <div class="col-lg-12">

              

                    <div class="form-group col-lg-6">
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
                        <label>[ 2 ] Day </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="day">
                            <option value=""> Day:</option>
                            <option value="1"> Monday</option>
                            <option value="2"> Tuesday</option>
                            <option value="3"> Wednesday</option>
                            <option value="4"> Thursday</option>
                            <option value="5"> Friday</option>
                            <option value="6"> Saturday</option>
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
                            <option value="1st Quarter"> 1st Quarter</option>
                            <option value="2nd Quarter"> 2nd Quarter</option>
                          </select>
                        </div>
                    </div>

                    <!--<div class="form-group col-lg-12">
                        <label>[ 5 ] Remarks</label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"></span>
                          </span>
                          <select class="form-control" name="remark">
                            <option value=""> Remarks:</option>
                            <option value="1"> Present</option>
                            <option value="2"> Absent</option>
                            <option value="3"> Late</option>
                            <option value="4"> On Leave</option>
                            <option value="5"> No Class</option>
                            <option value="1,2,3,4,5"> Show All</option>
                          </select>
                        </div>
                    </div>-->

            </div>
            </div>
          
      <div class="panel-footer">
                    <button type="submit" name="submit" class="btn btn-primary" value='submit' id="submit"><i class="fa fa-plus-circle"></i> View Class Schedule</button>

                    <div class="pull-right"
                    <!-- Reset Button -->
                    <button class="btn btn-warning" type="button" onclick="myFunction()"><i class="fa fa-eraser"></i> Reset Form</button>
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
        </div>
        </div>
        <!-- End col-lg-12 -->
        </div>
        <!-- End Panel Default -->


       

  

  <!-- Page level plugin JavaScript-->
  <script src="bootsrap/chart.js/Chart.min.js"></script>
  <script src="bootstrap/datatables/jquery.dataTables.js"></script>
  <script src="bootstrap/datatables/dataTables.bootstrap4.js"></script>  
  <!-- Custom scripts for this page-->
  <script src="bootstrap/js/sb-admin-datatables.min.js"></script>
  <script src="bootstrap/js/sb-admin-charts.min.js"></script>
</body>
</html>