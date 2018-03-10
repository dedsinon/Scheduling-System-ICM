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

  <title> Teacher </title>

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
          <h2 class="page-header"> <center>Manage Teacher</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">Teacher</li>
      </ul>
    
          <!-- Add New User -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading"> Create Teacher Details 
              <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

            <div class="panel-body" id="body1">
            <div class="col-lg-12">


              <?php if(isset($_SESSION['success_add_teacher'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_teacher'];?></div>
                    
                  <?php $_SESSION['success_add_teacher'] = null; }?> 

                  <?php if(isset($_SESSION['error_add_teacher'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_add_teacher'];?></div>
                    
                  <?php $_SESSION['error_add_teacher'] = null; }?> 

                <form action="server/p_add_teacher.php" method="POST" autocomplete="off" id="form">
                <div class="alert alert-warning">
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please fill out the form completely:</p>
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Teacher Fullname: <b> Rolan M. Macarang</b></p>
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Contact Number: <b> +639161234564</b> or <b> 09161234564</b></p>
                </div>
                    </br>

                    <div hidden> <input type="text" name="teacher_status" class="form-control" value="Activated" readonly>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span>
                        </span>
                        <input type="text" name="teacher_fullname" class="form-control" placeholder="Teacher Full Name" autofocus required>
                      </div>
                    </div>

                     <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span>
                        </span>
                        <input type="text" name="teacher_profession" class="form-control" placeholder="Masters / Profession" required>
                      </div>
                    </div>

                     <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-venus-mars"></span>
                        </span>
                        <select class="form-control" name="teacher_gender" placeholder="Unit" type="text" required>
                          <option value="">Select Gender:</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-phone"></span>
                        </span>
                        <input type="number" name="teacher_contact" class="form-control" size="11" placeholder="Contact Number" required>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-briefcase"></span>
                        </span>
                        <select class="form-control" name="teacher_workstatus" placeholder="Work Status" type="text" required>
                          <option value="">Select Work Status:</option>
                          <option>Full Time</option>
                          <option>Part Time</option>
                        </select>
                      </div>
                    </div>


                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-graduation-cap"></span>
                        </span>
                        <select class="form-control" name="teacher_subjmaj" placeholder="Work Status" type="text" required>
                          <option value="">Select Specialization:</option>
                          <option value="General Education">General Education</option>
                          <option value="Information Technology">Information Technology</option>
                          <option value="Business Administration">Business Administration</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-graduation-cap"></span>
                        </span>
                        <select class="form-control" name="teacher_restday" placeholder="Work Status" type="text">
                          <option value="">Select Rest Day:</option>
                          <option value="1">Monday</option>
                          <option value="2">Tuesday</option>
                          <option value="3">Wednesday</option>
                          <option value="4">Thursday</option>
                          <option value="5">Friday</option>
                          <option value="6">Saturday</option>
                        </select>
                      </div>
                    </div>
                   

                    <!-- <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-clock-o"></span>
                        </span>
                        <select class="form-control" name="teacher_subjmaj" placeholder="Work Status" type="text" required>
                          <option value="">Time Availability:</option>
                          <option>7:00</option>
                          <option>Information Technology</option>
                          <option>Business Administration</option>
                        </select>
                      </div>
                    </div> -->

                    <button type="submit" class="btn btn-primary" name="submit" value='submit'><i class="fa fa-plus-circle"></i> Add New Teacher</button>

                    <!-- Reset Button -->
                    <button class="btn btn-warning" type="button" onclick="myFunction()"> <i class="fa fa-eraser"></i> Reset Form</button>
                

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
                    
                    <th style="text-align: center;">Teacher Full Name</th>
                    <th style="text-align: center;">Gender</th>
                    <th style="text-align: center;">Contact Number</th>
                    <th style="text-align: center;">Work Status</th>
                    <th style="text-align: center;">Specialization</th>
                    <th style="text-align: center;">Masters / Profession:</th>
                    <th style="text-align: center;">Restday:</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    
                    <th style="text-align: center;">Teacher Full Name</th>
                    <th style="text-align: center;">Gender</th>
                    <th style="text-align: center;">Contact Number</th>
                    <th style="text-align: center;">Work Status</th>
                    <th style="text-align: center;">Specialization</th>
                    <th style="text-align: center;">Masters / Profession:</th>
                    <th style="text-align: center;">Restday:</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </tfoot>

                <!-- View Users -->
                <?php 
                  $teacher_retrieve = 'SELECT * FROM teacher LEFT JOIN day ON teacher.teacher_restday = day.day_id';
                  $teacher_query = mysqli_query($conn, $teacher_retrieve);

                  if($teacher_query){
                    while ($teacher_result = mysqli_fetch_assoc($teacher_query)){
                ?>

              <tbody>
                <tr>
                  
                  <?php if($teacher_result['teacher_status'] == "Activated") { ?> 
                  <td><?php echo $teacher_result['teacher_fullname']; ?></td>
                  <td><?php echo $teacher_result['teacher_gender']; ?></td>
                  <td><?php echo $teacher_result['teacher_contact']; ?></td>
                  <td><?php echo $teacher_result['teacher_workstatus']; ?></td>
                  <td><?php echo $teacher_result['teacher_subjmaj']; ?></td>
                  <td><?php echo $teacher_result['teacher_profession']; ?></td>
                  <td><?php echo $teacher_result['day_name']; ?></td>  
                    
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $teacher_result['teacher_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $teacher_result['teacher_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Teacher Details</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/p_update_teacher.php">

                        <div hidden> <input type="number" name="update_teacher_id" class="form-control" value="<?php echo $teacher_result['teacher_id']; ?>" readonly>
                        </div>

                       <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-user"> <label style="width: 140px;">Full Name:</label></span>
                          </span>
                            <input type="text" name="update_teacher_fullname" class="form-control" placeholder="Teacher Full Name" value="<?php echo $teacher_result['teacher_fullname']; ?>" autofocus required>
                        </div>
                      </div>

                        <div class="form-group col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-venus-mars"><label style="width: 130px;">Gender:</label></span>
                            </span>
                          <select class="form-control" name="update_teacher_gender" placeholder="Gender" type="text" required>
                          
                          <option><?php echo $teacher_result['teacher_gender']; ?></option>
                          
                          <?php
                              $services = array('Male', 'Female');
                              for($i=0; $i < 2; $i++){

                                  if ($teacher_result['teacher_gender'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                }
                            ?> 

                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-phone"> <label style="width: 140px;">Contact #:</label></span>
                          </span>
                            <input type="number" name="update_teacher_contact" class="form-control" placeholder="Contact Number" value="<?php echo $teacher_result['teacher_contact']; ?>" required>
                        </div>
                      </div>

                       <div class="form-group col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-briefcase"><label style="width: 140px;">Work Status:</label></span>
                            </span>
                          <select class="form-control" name="update_teacher_status" placeholder="Work Status" type="text" required>
                          
                          <option><?php echo $teacher_result['teacher_workstatus']; ?></option>
                          
                          <?php
                              $services = array('Full Time', 'Part Time');
                              for($i=0; $i < 2; $i++){

                                  if ($teacher_result['teacher_workstatus'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                } 
                            ?> 

                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-phone">  <label style="width: 140px;"> Masters / Profession:</label></span>
                          </span>
                            <input type="text" name="update_teacher_profession" class="form-control" placeholder="Masters / Profession" value="<?php echo $teacher_result['teacher_profession']; ?>" required>
                        </div>
                      </div>

                    <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-graduation-cap"><label style="width: 130px;">Specialization:</label></span>
                          </span>
                            <select class="form-control" name="update_teacher_subjmaj" placeholder="Specialization" type="text" required>
                          
                          <option><?php echo $teacher_result['teacher_subjmaj']; ?></option>
                          
                          <?php
                              $services = array('General Education', 'Information Technology', 'Business Administration');
                              for($i=0; $i < 3; $i++){

                                  if ($teacher_result['teacher_subjmaj'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                } 
                            ?> 

                        </select>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-graduation-cap"><label style="width: 130px;">Rest Day:</label></span>
                          </span>
                            <select class="form-control" name="update_teacher_restday" placeholder="Restday" type="text" required>
                          
                          <option value="<?php echo $teacher_result['teacher_restday']; ?>"><?php echo $teacher_result['day_name']; ?></option>
                    
                          <option value="1">Monday</option>
                          <option value="2">Tuesday</option>
                          <option value="3">Wednesday</option>
                          <option value="4">Thursday</option>
                          <option value="5">Friday</option>
                          <option value="6">Saturday</option>

                          ?>
                        </select>

                    
                        </div>
                      </div>
                   
                    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
                      <div class="modal-footer">
                      <div class="btn-group">
                        <button type="submit" id="update" name="update" class="btn btn-primary" data-action="save" role="button">Save
                        </button>
                      </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                       </div> 

                    </div>
                    <!-- End Modal Footer -->
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
                      
                  <td style="color: red;"><?php echo $teacher_result['teacher_fullname']; ?></td>
                  <td style="color: red;"><?php echo $teacher_result['teacher_gender']; ?></td>
                  <td style="color: red;"><?php echo $teacher_result['teacher_contact']; ?></td>
                  <td style="color: red;"><?php echo $teacher_result['teacher_workstatus']; ?></td>
                  <td style="color: red;"><?php echo $teacher_result['teacher_subjmaj']; ?></td>
                  <td style="color: red;"><?php echo $teacher_result['teacher_profession']; ?></td>
                  <td style="color: red;"><?php echo $teacher_result['day_name']; ?></td>       

                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update<?php echo $teacher_result['teacher_id']; ?>" disabled>
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>
                  <?php }?>


                   <td style="text-align: center;">
                    <?php if($teacher_result['teacher_status'] != "Activated") { ?>
                            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $teacher_result['teacher_id']; ?>" onclick="window.location.href='server/activate_account_teacher.php?status=Activated&teacherid=<?php echo $teacher_result['teacher_id'] ?>'"><span class="glyphicon glyphicon-thumbs-up"></span>Activate</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-danger btn-xs" id="<?php echo $teacher_result['teacher_id']; ?>" onclick="window.location.href='server/activate_account_teacher.php?status=Deactivated&teacherid=<?php echo $teacher_result['teacher_id'] ?>'"><span class="glyphicon glyphicon-thumbs-down"></span>Deactivate</button>
                             <?php } ?>
                    
                  </td>
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