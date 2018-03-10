<?php 
include("dashboard.php");
include('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

    <title> User Logs</title>

</head>

<style>


</style>

<body>

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header"> <center>User Logs</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">User Logs</li>
      </ul>

      <div class="container-fluid">
      <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          View User Logs
        </div>

       

        <div class="panel-body">
          <table class="table table-bordered table-hover table-striped table-sm results" id="table">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Date & Time</th>
                    <th style="text-align: center;">Description</th>  
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Date & Time</th>
                    <th style="text-align: center;">Description</th>  
                </tr>
              </tfoot>

              <?php
                $info = "SELECT * FROM log LEFT JOIN useraccount ON log.log_user = useraccount.user_name ORDER BY log.log_time ASC";
                $query = mysqli_query($conn, $info); 
                  while ($result = mysqli_fetch_assoc($query)){
              ?>

               <tbody>
                <tr>
                    <td><?php echo $result ['user_fname'] ;?></td>
                    <td><?php echo $result ['user_lname'] ;?></td>
                    <td><?php echo $result ['user_name'] ;?></td>
                    <td><?php echo $result ['log_time'] ;?></td>
                    <td><?php echo $result ['log_entry'] ;?></td>
                     
                </tr>
                </tbody>
                <?php
              }
              ?>

            </table>
        </div>

      </div>
      </div>
      </div>
             


</body>
</html>