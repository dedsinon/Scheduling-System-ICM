<?php 
require ("dashboard.php");
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

<!-- Show / Hide Panel -->
<script type="text/javascript" src="js/js_show_hide.js"></script>
<!-- Live Search Bar -->
<script type="text/javascript" src="js/js_live_search.js"></script>
 <!-- Page level plugin CSS-->
<link href="bootstrap/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <title> Strand & Course</title>

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
          <h2 class="page-header"> <center> Manage Strand & Course</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active" title="Strand & Course"><a href="strand_course.php">Strand & Course</a></li>
      </ul>
    
          <!-- Add New User -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading"> <b> Create Strand & Course </b>
              <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

            <div class="panel-body" id="body1">
            <div class="col-lg-12">

                <form action="server/p_add_sc.php" method="POST" autocomplete="off" id="form">

                   <?php if(isset($_SESSION['success_add'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add'];?></div>
                    
                  <?php $_SESSION['success_add'] = null; }?> 

                  <?php if(isset($_SESSION['error_add'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_add'];?></div>
                    
                  <?php $_SESSION['error_add'] = null; }?> 

                  <div class="alert alert-warning">
                  <p class="help-block">
                  <span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please out up the form completely:</p>
                  <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please follow the format: Ex. <b>Bachelor of Science in Information Technology</b></p>
                  <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Strand or Course Code: <b>BSIT</b></p>
                  </div>
                  </br>
                  
                    <div hidden> <input type="text" name="status" class="form-control" value="Activated" readonly>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"></span>
                        </span>
                        <input type="text" name="sc_name" class="form-control" placeholder="Strand & Course Name" autofocus required>
                      </div>
                    </div>

                     <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"></span>
                        </span>
                        <input type="text" name="sc_code" class="form-control" placeholder="Strand & Course Code" required>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"></span>
                        </span>
                        <select class="form-control" name="sc_sc" placeholder="Course & Strand" type="text" required>
                          <option value="">Course / Strand:</option>
                          <option>Course</option>
                          <option>Strand</option>
                        </select>
                      </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary" value='submit'><i class="fa fa-plus-circle"></i> Add New Strand & Course</button>

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
                    
                    <th style="text-align: center;">Strand & Course Name</th>
                    <th style="text-align: center;">Code</th>
                    <th style="text-align: center;">Course / Strand</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    
                    <th style="text-align: center;">Strand & Course Name</th>
                    <th style="text-align: center;">Code</th>
                    <th style="text-align: center;">Course / Strand</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </tfoot>


                <!-- View Users -->
                <?php 
                  $sc_retrieve ="SELECT *FROM strand_course";
                  $sc_query = mysqli_query($conn, $sc_retrieve);

                  if($sc_query){
                    while ($sc_result = mysqli_fetch_assoc($sc_query)){
                ?>

              <tbody>
                <tr>
                 
                  <?php if($sc_result['sc_status'] == "Activated") { ?> 
                  <td><?php echo $sc_result['sc_name']; ?></td>
                  <td><?php echo $sc_result['sc_code']; ?></td>
                  <td><?php echo $sc_result['sc_sc']; ?></td>
                        
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $sc_result['sc_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $sc_result['sc_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update User Strand & Course</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/p_update_sc.php">

                        <div hidden> <input type="number" name="update_sc_id" class="form-control" value="<?php echo $sc_result['sc_id']; ?>" readonly>
                        </div>

                      <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"> <label style="width: 70px;"> Name:</label></span>
                        </span>
                        <input type="text" name="update_sc_name" class="form-control" placeholder="Strand & Course Name" value="<?php echo $sc_result['sc_name']; ?>" autofocus required>
                      </div>
                    </div>

                      <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"> <label style="width: 70px;"> Code:  </label></span>
                        </span>
                        <input type="text" name="update_sc_code" class="form-control" placeholder="Strand & Course Code" value="<?php echo $sc_result['sc_code']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"> <label style="width: 70px;"> Course:</label></span>
                        </span>
                        <select class="form-control" name="update_sc" placeholder="Course & Strand" type="text" required>
                          
                          <option><?php echo $sc_result['sc_sc']; ?></option>
                          
                          <?php
                              $services = array('Course', 'Strand');
                              for($i=0;$i < 2; $i++){

                                  if ($sc_result['sc_sc'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                }
                            ?> 

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

                      <td style="color: red;"><?php echo $sc_result['sc_name']; ?></td>
                      <td style="color: red;"><?php echo $sc_result['sc_code']; ?></td>
                      <td style="color: red;"><?php echo $sc_result['sc_sc']; ?></td>
                        
                      <td style="text-align: center; color: red;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update" id="#edit" disabled>
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>
                    </td>
                     <?php } ?>

                    <td style="text-align: center;">
                    <?php if($sc_result['sc_status'] != "Activated") { ?>
                            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $sc_result['sc_id']; ?>" onclick="window.location.href='server/activate_account_sc.php?status=Activated&scid=<?php echo $sc_result['sc_id'] ?>'"><span class="glyphicon glyphicon-thumbs-up"></span>Activate</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-danger btn-xs" id="<?php echo $sc_result['sc_id']; ?>" onclick="window.location.href='server/activate_account_sc.php?status=Deactivated&scid=<?php echo $sc_result['sc_id'] ?>'"><span class="glyphicon glyphicon-thumbs-down"></span>Deactivate</button>
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
        </div></div>

<!-- Page level plugin JavaScript-->
  <script src="bootsrap/chart.js/Chart.min.js"></script>
  <script src="bootstrap/datatables/jquery.dataTables.js"></script>
  <script src="bootstrap/datatables/dataTables.bootstrap4.js"></script>  
  <!-- Custom scripts for this page-->
  <script src="bootstrap/js/sb-admin-datatables.min.js"></script>
  <script src="bootstrap/js/sb-admin-charts.min.js"></script>
                                              
</body>
</html>