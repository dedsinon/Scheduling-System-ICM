<?php 
require ("dashboard.php");
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

  <!-- Show / Hide Panel -->
  <script type="text/javascript" src="js/js_show_hide.js"></script>
 <!-- Page level plugin CSS-->
<link href="bootstrap/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <title> Room </title>

</head>

<style>

.usertable th {
    text-align: center;
}


</style>

<body>

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header"> <center>Manage Room</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active" title="Room"><a href="room.php">Room</a></li>
      </ul>
    
          <!-- Add Room -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading" id="head-add"> Create Room Details 
             <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

            <div class="panel-body" id="body1">
            <div class="col-lg-12">

            <?php if(isset($_SESSION['success_add_room'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_room'];?></div>
                    
                  <?php $_SESSION['success_add_room'] = null; }?> 

                  <?php if(isset($_SESSION['error_add_room'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_add_room'];?></div>
                    
                  <?php $_SESSION['error_add_room'] = null; }?> 

                <form action="server/p_add_room.php" method="POST" autocomplete="off" id="form">
                <div class="alert alert-warning">
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please fill out the form completely:</p>
                     <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Room Name: <b> Steve Jobs </b></p>
                      <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Room Number: <b> 303</b></p>
                </div>
                    </br>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-users"></span>
                        </span>
                        <input type="text" name="room_name" class="form-control" placeholder="Room Name" autofocus required>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-users"></span>
                        </span>
                        <input type="number" name="room_number" min="1" max="404" class="form-control" placeholder="Room Number" required>
                      </div>
                    </div>

                    <div hidden> <input type="text" name="status" class="form-control" value="Activated" readonly>
                        </div>

                     <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-users"></span>
                        </span>
                        <select class="form-control" name="room_class" placeholder="Room Classification" type="text" required>
                          <option value=""> Room Classification:</option>
                          <option value="1">Lecture Room</option>
                          <option value="2">Computer Laboratory</option>
                        </select>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit" value='submit'><i class="fa fa-plus-circle"></i> Add New Room</button>

                    <!-- Reset Button -->
                    <button class="btn btn-warning" type="button" onclick="myFunction()"><i class="fa fa-eraser"></i> Reset Form</button>
                

                <!-- ResetFunction -->
                <script>
                function myFunction() {
                document.getElementById("form").reset();
                }
                </script>
        </form>
        </div>
        <!-- End Container Fluid -->
        </div>
        <!-- End Row -->
        </div>
        <!-- End col-lg-12 -->
        </div>
        <!-- End Panel Default -->
        </div>
        <!-- End Panel Body -->
        </div>
        <!-- End col-lg-12 -->
                               

        <!-- View Users -->
       <div class="container-fluid">
        <div class="panel panel-default">
        <div class="panel-header">
        <div class="panel-body">
        <div class="table-responsive">        
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Room Name</th>
                    <th style="text-align: center;">Room Number</th>
                    <th style="text-align: center;">Room Classification</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Room Name</th>
                    <th style="text-align: center;">Room Number</th>
                    <th style="text-align: center;">Room Classification</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </tfoot>

                <!-- View Users -->
                <?php 
                  $room_retrieve = 'SELECT * FROM rooms LEFT JOIN room_class as rc ON rooms.room_classification=rc.room_class_id';
                  $room_query = mysqli_query($conn, $room_retrieve);

                  if($room_query){
                    while ($room_result = mysqli_fetch_assoc($room_query)){
                ?>

              <tbody>
                <tr>
                  
                  <?php if($room_result['room_status'] == "Activated") { ?> 
                  <td><?php echo $room_result['room_name']; ?></td>
                  <td><?php echo $room_result['room_number']; ?></td>
                  <td><?php echo $room_result['room_class']; ?></td>
                                    
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $room_result['room_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $room_result['room_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Room</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/p_update_room.php">

                        <div hidden> <input type="number" name="update_room_id" class="form-control" value="<?php echo $room_result['room_id']; ?>" readonly>
                        </div>

                       <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"> <label style="width: 90px;">Name:</label></span>
                          </span>
                            <input type="text" name="update_room_name" class="form-control" placeholder="Room Name" value="<?php echo $room_result['room_name']; ?>" autofocus required>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"> <label style="width: 90px;"> Number:</label></span>
                          </span>
                            <input type="text" name="update_room_number" class="form-control" placeholder="Room Number" value="<?php echo $room_result['room_number']; ?>" required>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-users"> <label style="width: 90px;">Classification:</label></span>
                            </span>
                          <select class="form-control" name="update_room_class" placeholder="Room Classification" type="text" required>
                          
                          <option value="<?php echo $room_result['room_classification']; ?>"> <?php echo $room_result['room_class']; ?></option>
                          
                          <option value="1"> Lecture Room</option>
                          <option value="2"> Computer Laboratory Rooms</option>
                          </select>
                          </div>
                      </div>
                   
                    
                      </br></br></br></br></br></br></br></br>
                      <div class="modal-footer">
                      <div class="btn-group">
                        <button type="submit" id="update" name="update" class="btn btn-primary" data-action="save" role="button">Save
                        </button>
                      </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                       </div> 
                    
                    </form>
                    <!-- End Form -->
                    </div>
                    <!-- End Modal Body -->
                    </div>
                    <!-- End Modal Content -->
                    </div>
                    <!-- End col-lg-12 -->
                    </div>
                    <!-- End Modal Dialog -->
                    </div>
                    <!-- End Modal ID Update -->
                  </td>

                   <?php } else { ?>
                  
                  <td style="color: red;"><?php echo $room_result['room_name']; ?></td>
                  <td style="color: red;"><?php echo $room_result['room_number']; ?></td>
                  <td style="color: red;"><?php echo $room_result['room_classification']; ?></td>
                                    
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update<?php echo $room_result['room_id']; ?>" disabled>
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>
                    <?php } ?>
                  </td>       
                 <td style="text-align: center;">
                  <?php if($room_result['room_status'] != "Activated") { ?>
                            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $room_result['room_id']; ?>" onclick="window.location.href='server/activate_account_room.php?status=Activated&roomid=<?php echo $room_result['room_id'] ?>'"><span class="glyphicon glyphicon-thumbs-up"></span>Activate</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-danger btn-xs" id="<?php echo $room_result['room_id']; ?>" onclick="window.location.href='server/activate_account_room.php?status=Deactivated&roomid=<?php echo $room_result['room_id'] ?>'"><span class="glyphicon glyphicon-thumbs-down"></span>Deactivate</button>
                            <?php } ?>
                </tr>  
              </tbody>

              <?php
              }
              }
              ?>  

            </div>
            <!-- End Table Responsive -->
          </table>
          <!-- End Table -->
        </div>
        <!-- End Panel Body -->
        </div>
        <!-- End Panel Default -->
        </div>  
        <!-- End col-lg-12 -->    

                               
<!-- Page level plugin JavaScript-->
  <script src="bootsrap/chart.js/Chart.min.js"></script>
  <script src="bootstrap/datatables/jquery.dataTables.js"></script>
  <script src="bootstrap/datatables/dataTables.bootstrap4.js"></script>  
  <!-- Custom scripts for this page-->
  <script src="bootstrap/js/sb-admin-datatables.min.js"></script>
  <script src="bootstrap/js/sb-admin-charts.min.js"></script>
                                              
</body>
</html>