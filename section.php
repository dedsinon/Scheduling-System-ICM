<?php 
include ("dashboard.php");
include('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

  <!-- Show / Hide Panel -->
  <script type="text/javascript" src="js/js_show_hide.js"></script>
 <!-- Page level plugin CSS-->
<link href="bootstrap/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <title> Section </title>

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
          <h2 class="page-header"> <center>Manage Section</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active">Section</li>
      </ul>
    
          <!-- Add New Section -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading" id="head-add"> Create Section Details 
              <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

            <div class="panel-body" id="body1">
            <div class="col-lg-12">

            <?php if(isset($_SESSION['success_add_section'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_add_section'];?></div>
                    
                  <?php $_SESSION['success_add_section'] = null; }?> 

                  <?php if(isset($_SESSION['error_add_section'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_add_section'];?></div>
                    
                  <?php $_SESSION['error_add_section'] = null; }?> 

                <form action="server/p_add_section.php" method="POST" autocomplete="off" id="form">
                <div class="alert alert-warning">
                    <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please fill out the form completely:</p>
                     <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span>Ex. Section Name: <b> Bachelor of Science in Information Technology Night Class 3-1</b></p>
                      <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Section Code: <b> BSIT NC 3-1 </b></p>
                </div>
                </br>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-users"></span>
                        </span>
                        <input type="text" name="section_name" class="form-control" placeholder="Section Name" autofocus required />
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-users"></span>
                        </span>
                        <input type="text" name="section_code" class="form-control" placeholder="Section Code" required />
                      </div>
                    </div>

                    <div hidden> <input type="text" name="status" class="form-control" value="Activated" readonly />
                        </div>

                     <div class="form-group col-md-12s">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-users"></span>
                        </span>
                        <select class="form-control" name="section_sc" placeholder="Strand Course" type="text" required>
                          <option value=""> Strand / Course Description:</option>
                          
                           <?php
                      $sc_retrieve ="SELECT * FROM strand_course";
                      $sc_query = mysqli_query($conn, $sc_retrieve);
                  
                      if($sc_query){
                        while ($sc_result = mysqli_fetch_assoc($sc_query)){

                        echo '<option value='.$sc_result['sc_id'].'>'.$sc_result['sc_name'].'</option>';
                        }                 
                      }
                    ?>
                        </select>
                      </div>
                    </div>


                    <button type="submit" class="btn btn-primary" name="submit" value='submit'><i class="fa fa-plus-circle"></i> Add New Section</button>

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
                    <th style="text-align: center;">Section Name</th>
                    <th style="text-align: center;">Section Code</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Section Name</th>
                    <th style="text-align: center;">Section Code</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </tfoot>

                <!-- View Users -->
                <?php 
                  $section_retrieve = 'SELECT * FROM section as sec LEFT JOIN strand_course as sc ON sec.sc_id_fk = sc.sc_id';
                  $section_query = mysqli_query($conn, $section_retrieve);

                  if($section_query){
                    while ($section_result = mysqli_fetch_assoc($section_query)){
                ?>

              <tbody>
                <tr>
                  
                  <?php if($section_result['sec_status'] == "Activated") { ?> 
                  <td><?php echo $section_result['sec_name']; ?></td>
                  <td><?php echo $section_result['sec_code']; ?></td>
                  
                                    
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $section_result['sec_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div id="update<?php echo $section_result['sec_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Section</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/p_update_section.php">

                        <div hidden> <input type="number" name="update_section_id" class="form-control" value="<?php echo $section_result['sec_id']; ?>" readonly>
                        </div>

                       <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"> <label style="width: 100px;">Name:</label></span>
                          </span>
                            <input type="text" name="update_section_name" class="form-control" placeholder="Section Name" value="<?php echo $section_result['sec_name']; ?>" autofocus required>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-users"> <label style="width: 100px;"> Code:</label></span>
                          </span>
                            <input type="text" name="update_section_code" class="form-control" placeholder="Section Code" value="<?php echo $section_result['sec_code']; ?>" required>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-users"> <label style="width: 100px;">  Strand/Course:</label></span>
                            </span>
                          <select class="form-control" name="update_section_sc" placeholder="Course & Strand" type="text" required>
                          
                          <option value="<?php echo $section_result['sc_id_fk']; ?>"><?php echo $section_result['sc_name']; ?></option>
                          
                          <?php
                      $sc_retrieve ="SELECT * FROM strand_course";
                      $sc_query = mysqli_query($conn, $sc_retrieve);
                  
                      if($sc_query){
                        while ($sc_result = mysqli_fetch_assoc($sc_query)){

                        echo '<option value='.$sc_result['sc_id'].'>'.$sc_result['sc_name'].'</option>';
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
                  
                  <td style="color: red;"><?php echo $section_result['sec_name']; ?></td>
                  <td style="color: red;"><?php echo $section_result['sec_code']; ?></td>
                 
                                    
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update<?php echo $section_result['sec_id']; ?>" disabled>
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>
                    <?php } ?>
                            
                 <td style="text-align: center;">
                  <?php if($section_result['sec_status'] != "Activated") { ?>
                            <button type="button" class="btn btn-primary btn-xs" id="<?php echo $section_result['sec_id']; ?>" onclick="window.location.href='server/activate_account_section.php?status=Activated&sectionid=<?php echo $section_result['sec_id'] ?>'"><span class="glyphicon glyphicon-thumbs-up"></span>Activate</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-danger btn-xs" id="<?php echo $section_result['user_id']; ?>" onclick="window.location.href='server/activate_account_section.php?status=Deactivated&sectionid=<?php echo $section_result['sec_id'] ?>'"><span class="glyphicon glyphicon-thumbs-down"></span>Deactivate</button>
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