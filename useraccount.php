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
<!-- Show / Hide Panel -->
<script type="text/javascript" src="js/js_show_hide.js"></script>
 <!-- Page level plugin CSS-->
<link href="bootstrap/datatables/dataTables.bootstrap4.css" rel="stylesheet">
     
    <title>User Account</title>

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
        <div class="col-lg-12">
          <h2 class="page-header"> <center> Manage User Account</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active" title="User Accounts"> <a href="useraccount.php">User Account</a></li>
      </ul>
    
          <!-- Add New User -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading" id="head1"> <b>Create New User Account: </b>
              <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

            <div class="panel-body"  id="body1">
            <div class="col-lg-12">
            <span id="result"></span>
            <?php if(isset($_SESSION['success_user_add'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_user_add'];?></div>
                    
                  <?php $_SESSION['success_user_add'] = null; }?> 

                  <?php if(isset($_SESSION['error_user_add'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_user_add'];?></div>
                    
                  <?php $_SESSION['error_user_add'] = null; }?> 

                  <?php if(isset($_SESSION['error_user_exist'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_user_exist'];?></div>
                    
                  <?php $_SESSION['error_user_exist'] = null; }?> 


                <form action="server/p_add_useraccount.php" method="POST" autocomplete="off" id="myform">
                <div class="alert alert-warning">
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please fill out the form completely: Username and Password must be unique.</p>
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. First Name: <b>Leandro Angelo</b>, Lastname: <b>Falculan</b></p>
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Email: <i><b>leifalculan@gmail.com</b></i></p>
                </div>
                </br>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user" aria-hidden="true"></span>
                        </span>
                        <input type="text" name="firstname" class="form-control" placeholder="First Name" autofocus required />
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user" aria-hidden="true"></span>
                        </span>
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-building" aria-hidden="true"></span>
                        </span>
                        <select class="form-control" name="department" placeholder="Department" type="text" required>
                          <option value="">Select Department:</option>
                          <option>Faculty Department</option>
                          <option>Services Department</option>
                          <option>Administrative Department</option>
                          <option>Student Council Department</option>
                          <option>Marketing Department</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-briefcase" aria-hidden="true"></span>
                        </span>
                        <select class="form-control" name="position" placeholder="Position" type="text" required>
                          <option value="">Select Position:</option>
                          <option>Officer In Charge</option>
                          <option>Head Officer</option>
                          <option>Admin Staff</option>
                          <option>Student Assistant</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-venus-mars" aria-hidden="true"></span>
                        </span>
                        <select class="form-control" name="gender" placeholder="Gender" type="text" required>
                          <option value="">Select Gender:</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-8">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-at" aria-hidden="true"></span>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user-circle" aria-hidden="true"></span>
                        </span>
                        <select class="form-control" name="usertype" placeholder="Usertype" type="text" required>
                          <option value="">Select User Type:</option>
                          <option value="Admin" title="The Administrator can control the entire system.">Administrator</option>
                          <option value="Monitoring" title="This user is mainly userd by Student Assistant to monitor the schedules.">Monitoring User</option>
                          <option value="Reporting" title="This user is mainly userd by Services to monitor and view reports of the schedules.">Reporting User</option>
                          <option value="External" title="This user is mainly used by the head of the school for approval and viewing of the schedules.">External User</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user-circle-o" aria-hidden="true"></span>
                        </span>
                        <input type="text" name="username" class="form-control" placeholder="Username Name" required>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user-circle-o" aria-hidden="true"></span>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-btn">
                                  <button type="button" id="showhide" data-val="1" class="btn btn-default btn-md"><span id='eye' class="glyphicon glyphicon-eye-open"></span>
                                  </button>
                            </div>
                      </div>
                    </div>

                    <div hidden> <input type="text" name="status" class="form-control" value="Activated" readonly>
                        </div>
          
                    <button type="submit" name="submit" class="btn btn-primary" value='submit' id="submit"><i class="fa fa-plus-circle"></i> Add New User</button>

                    <!-- Reset Button -->
                    <button class="btn btn-warning" type="button" onclick="myFunction()"><i class="fa fa-eraser"></i> Reset Form</button>

                     <!-- ResetFunction -->
                <script>
                function myFunction() {
                document.getElementById("myform").reset();
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


       
        <div class="container-fluid">
        <div class="panel panel-default">
        <div class="panel-header">
        <div class="panel-body">
        <div class="table-responsive">        
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">Department</th>
                    <th style="text-align: center;">Position</th>
                    <th style="text-align: center;">Gender</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">User Type</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">Department</th>
                    <th style="text-align: center;">Postion</th>
                    <th style="text-align: center;">Gender</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">User Type</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </tfoot>

                <!-- View Users -->
                <?php 
                  $info_retrieve = "SELECT * FROM useraccount where user_privileges != 'Admin'";
                  $info_query = mysqli_query($conn, $info_retrieve);



                  if($info_query){
                    while ($info_result = mysqli_fetch_assoc($info_query)){
                ?>

              <tbody>
                <tr>
                  
                  <?php if($info_result['user_status'] == "Activated") { ?> 
                      <td><?php echo $info_result['user_fname'];?></td>
                      <td><?php echo $info_result['user_lname'];?></td>
                      <td><?php echo $info_result['user_department'];?></td>
                      <td><?php echo $info_result['user_position'];?></td>
                      <td><?php echo $info_result['user_gender'];?></td>
                      <td><?php echo $info_result['user_email'];?></td>
                      <td><?php echo $info_result['user_privileges'];?></td>
                      <td><?php echo $info_result['user_name'];?></td>
                     
                      <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $info_result['user_id'];?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div class="modal fade" role="dialog" id="update<?php echo $info_result['user_id'];?>" >
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Update User Account</b></h4>
                    </div>

                    <div class="modal-body">

                      <form method="POST" action="server/p_update_useraccount.php">

                        <div hidden> <input type="number" name="update_user_id" class="form-control" value="<?php echo $info_result['user_id']; ?>" readonly>
                        </div>

                        <div class="form-group col-md-12">
                          <div class="input-group"> 
                            <span class="input-group-addon">
                             <span class="fa fa-user" aria-hidden="true"> 
                                <label style="width: 90px;">Firstname:
                                </label>
                              </span>
                            </span>
                            <input type="text" name="update_firstname" class="form-control" placeholder="First Name" value="<?php echo $info_result['user_fname']; ?>" required>
                          </div>
                        </div>

                        <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-user" aria-hidden="true"> <label style="width: 90px;">Lastname:</label></span>
                          </span>
                          <input type="text" name="update_lastname" class="form-control" placeholder="Last Name" value="<?php echo $info_result['user_lname']; ?>" required>
                        </div>
                        </div>

                        <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-building" aria-hidden="true"> <label style="width: 90px;">Department:</label></span>
                          </span>
                          <select class="form-control" name="update_department" placeholder="Department" type="text" required>

                            <option><?php echo $info_result['user_department']; ?></option>

                            <?php
                              $services = array('Faculty', 'Services', 'Admin', 'Student Assistant', 'Marketing');
                              for($i=0;$i < 5; $i++){

                                  if ($info_result['user_department'] != $services[$i]) {
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
                          <span class="input-group-addon"><span class="fa fa-venus-mars" aria-hidden="true"> <label style="width: 90px;">Gender:</label></span>
                          </span>
                          <select class="form-control" name="update_gender" placeholder="Gender" type="text" required>

                            <option><?php echo $info_result['user_gender']; ?></option>
                            
                            <?php
                              $services = array('Male', 'Female');
                              for($i=0;$i < 2; $i++){

                                  if ($info_result['user_gender'] != $services[$i]) {
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
                          <span class="input-group-addon"><span class="fa fa-briefcase" aria-hidden="true"> <label style="width: 90px;">Position:</label></span>
                          </span>
                          <select class="form-control" name="update_position" placeholder="Position" type="text" required>

                            <option><?php echo $info_result['user_position']; ?></option>

                            <?php
                              $services = array('Center Manager', 'Faculty Head', 'Services Head', 'Student Assistant', 'Marketing');
                              for($i=0;$i < 5; $i++){

                                  if ($info_result['user_position'] != $services[$i]) {
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
                          <span class="input-group-addon"><span class="fa fa-user-circle" aria-hidden="true"> <label style="width: 90px;">User-Type:</label></span>
                          </span>
                          <select class="form-control" name="update_usertype" placeholder="Usertype" type="text" required>

                            <option><?php echo $info_result['user_privileges']; ?></option>

                            <?php
                              $services = array('Monitoring', 'Reporting', 'External', 'Admin');
                              for($i=0;$i < 4; $i++){

                                  if ($info_result['user_privileges'] != $services[$i]) {
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
                          <span class="input-group-addon"><span class="fa fa-at" aria-hidden="true"> <label style="width: 90px;">Email:</label></span>
                          </span>
                          <input type="text" name="update_email" class="form-control" placeholder="Email Address" value="<?php echo $info_result['user_email']; ?>" required>
                        </div>
                        </div>

                        <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-user-circle-o" aria-hidden="true"> <label style="width: 90px;">Username:</label></span>
                          </span>
                          <input type="text" name="update_username" class="form-control" placeholder="Username Name" value="<?php echo $info_result['user_name']; ?>" required>
                        </div>
                        </div>

                      <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user-circle-o" aria-hidden="true"> <label style="width: 90px;">Password:</label></span>
                        </span>
                        <input type="password" id="password" name="update_password" class="form-control" placeholder="Password" title="Please re-type password for safety." required>
                      </div>
                      </div>

                    
                      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" data-action="save" id="update" name="update" role="button">Update User</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                      <td style="color: red;"><?php echo $info_result['user_fname'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_lname'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_department'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_position'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_gender'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_email'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_privileges'];?></td>
                      <td style="color: red;"><?php echo $info_result['user_name'];?></td>
                      <td style="text-align: center;"><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update<?php echo $info_result['user_id']; ?>" id="#edit" disabled>
                      <span class="glyphicon glyphicon-pencil"></span> Update</button></td>
                  <?php } ?>
                            
                 <td style="text-align: center;">
                  <?php if($info_result['user_status'] != "Activated") { ?>
                            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $info_result['user_id']; ?>" onclick="window.location.href='server/activate_account.php?status=Activated&userid=<?php echo $info_result['user_id'] ?>'"><span class="glyphicon glyphicon-thumbs-up"></span>Activate</button>
                            
                            <?php } else { ?>
                            <button type="button" class="btn btn-danger btn-xs" id="<?php echo $info_result['user_id']; ?>" onclick="window.location.href='server/activate_account.php?status=Deactivated&userid=<?php echo $info_result['user_id'] ?>'"><span class="glyphicon glyphicon-thumbs-down"></span>Deactivate</button>
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
      </div>
</div>

  

  <!-- Page level plugin JavaScript-->
  <script src="bootsrap/chart.js/Chart.min.js"></script>
  <script src="bootstrap/datatables/jquery.dataTables.js"></script>
  <script src="bootstrap/datatables/dataTables.bootstrap4.js"></script>  
  <!-- Custom scripts for this page-->
  <script src="bootstrap/js/sb-admin-datatables.min.js"></script>
  <script src="bootstrap/js/sb-admin-charts.min.js"></script>
</body>
</html>