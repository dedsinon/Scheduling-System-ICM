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

  <title> Subject </title>

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
          <h2 class="page-header"> <center> Manage Subject</center></h2>
        </div>
      </div> 

      <ul class="breadcrumb">
          <li>You are here:</li>
          <li class="active" title="Course Subject"> <a href="subject_course.php">Course</a></li>
      </ul>
    
          <!-- Add New User -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading"> Create Course Subject
              <button class="fa fa-chevron-down col-md-0 pull-right" id="down"></button>
              <button class="fa fa-chevron-up col-md-0 pull-right" id="up"></button>
            </div>

            <div class="panel-body" id="body1">
            <div class="col-lg-12">

              <?php if(isset($_SESSION['success_add_subj'])){ ?>

                  <div class="alert alert-success">
                  <strong>Success!</strong>

              <?php echo $_SESSION['success_add_subj'];?></div>
              <?php $_SESSION['success_add_subj'] = null; }?> 
              <?php if(isset($_SESSION['error_add_subj_exist'])){ ?>

                  <div class="alert alert-danger">
                  <strong>Failed!</strong>

              <?php echo $_SESSION['error_add_subj_exist'];?></div>      
              <?php $_SESSION['error_add_subj_exist'] = null; }?> 

              <div class="alert alert-warning">
                <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Please fill out the form completely:</p>
                <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span> Ex. Subject Name: <b> Computer Programming</b></p>
                <p class="help-block"><span class="text-danger" style="margin-right:5px, padding-bottom: 5px; ">*</span>  Ex. Subject Code: <b> IT 122</b></p>
              </div>
              </br>
              
              <ul class="nav nav-tabs">
                  <li class="active"><a href="subject_course.php" > Course:</a></li>
                  <li><a href="subject_strand.php" >Strand</a></li>                  
              </ul>
              </br>

                <form action="server/p_add_subject_course.php" method="POST" autocomplete="off" id="form">
                  
                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"></span>
                        </span>
                        <input type="text" name="subj_name" class="form-control" placeholder="Subject Description" autofocus required autocomplete="on" />
                      </div>
                    </div>

                     <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"></span>
                        </span>
                        <input type="text" name="subj_code" class="form-control" placeholder="Subject Code" required autocomplete="on" />
                      </div>
                    </div>

              <div class="form-group col-lg-6">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-users"></span>
                  </span>
                  <select class="form-control" name="sc_id" placeholder="Strand Course" type="text" required autocomplete="on">
                    <option value=""> Course  Name:</option>
                    
                    <?php
                      $sc_retrieve ="SELECT * FROM strand_course WHERE sc_sc = 'Course' ";
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

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-home"></span>
                        </span>
                        <select class="form-control" name="subj_unit" placeholder="Unit" type="number" >
                          <option value="">Unit:</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar-check-o"></span>
                        </span>
                        <select class="form-control" name="subj_term" placeholder="Term" type="number" required>
                          <option value="">Term:</option>
                          <option value="1st Term">1</option>
                          <option value="2nd Term">2</option>
                          <option value="3rd Term">3</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar-check-o"></span>
                        </span>
                        <select class="form-control" name="room_class" placeholder="Room Classification" type="Text" required>
                          <option value="">Room Classification:</option>
                            <option value="Lecture Room">Lecture Room</option>
                          <option value="Computer Laboratory Room">Computer Laboratory Room</option>
                        </select>
                      </div>
                    </div>
                                
                    <div hidden> <input type="text" name="subj_status" class="form-control" value="Activated" readonly>
                    </div>


                    <button type="submit" name="submit" class="btn btn-primary" value='submit'><i class="fa fa-plus-circle"></i> Add New Subject</button>

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
                    <th style="text-align: center;">Subject Name</th>
                    <th style="text-align: center;">Subject Code</th>
                    <th style="text-align: center;">Subject Description</th>
                    <th style="text-align: center;">Unit</th>
                    <th style="text-align: center;">Term</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tfoot class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Subject Name</th>
                    <th style="text-align: center;">Subject Code</th>
                    <th style="text-align: center;">Subject Description</th>
                    <th style="text-align: center;">Unit</th>
                    <th style="text-align: center;">Term</th>
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </tfoot>

                <!-- View Users -->
                <?php 
                  $subj_retrieve = 'SELECT * FROM subject LEFT JOIN strand_course ON subject.sc_id = strand_course.sc_id WHERE strand_course.sc_sc = "Course"';
                  $subj_query = mysqli_query($conn, $subj_retrieve);

                  if($subj_query){
                    while ($subj_result = mysqli_fetch_assoc($subj_query)){
                ?>

              <tbody>
                <tr>
                 
                  <?php if($subj_result['subj_status'] == "Activated") { ?>
                  <td><?php echo $subj_result['subj_name']; ?></td>
                  <td><?php echo $subj_result['subj_code']; ?></td>
                  <td><?php echo $subj_result['sc_code']; ?></td>
                  <td><?php echo $subj_result['subj_unit']; ?></td>
                  <td><?php echo $subj_result['subj_term']; ?></td> 
                  <td><?php echo $subj_result['room_classification']; ?></td> 
                  <td style="text-align: center;">

                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#update<?php echo $subj_result['subj_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update</button>

                    <!-- Update Modal -->
                    <div class="modal fade" id="update<?php echo $subj_result['subj_id']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                            
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Subject</h4>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="server/p_update_subject.php">

                        <div hidden> <input type="number" name="update_subj_id" class="form-control" value="<?php echo $subj_result['subj_id']; ?>" readonly>
                        </div>

                      
                      <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"> <label style="width: 100px;"> Name:</label></span>
                        </span>
                        <input type="text" name="update_subj_name" class="form-control" placeholder="Subject Name" value="<?php echo $subj_result['subj_name']; ?>" autofocus required>
                      </div>
                    </div>

                   <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-book"> <label style="width: 100px;"> Code:</label></span>
                        </span>
                        <input type="text" name="update_subj_code" class="form-control" placeholder="Subject Code" value="<?php echo $subj_result['subj_code']; ?>" autofocus required>
                      </div>
                    </div>

                     <div class="form-group col-lg-12">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-institution"><label style="width: 100px;"> Strand/Course:</label></span>
                  </span>
                  <select class="form-control" name="update_sc_id" placeholder="Strand Course" type="text" required autocomplete="on">
                   
                    <option value="<?php echo $subj_result['sc_id']; ?>"><?php echo $subj_result['sc_name']; ?></option>
                    
                    <?php
                      $sc_retrieve ="SELECT * FROM strand_course WHERE sc_sc = 'Course' ";
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

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-home"> <label style="width: 100px;">Unit:</label></span>
                        </span>
                        <select class="form-control" name="update_subj_unit" placeholder="Unit" type="text" required>
                          
                          <option><?php echo $subj_result['subj_unit']; ?></option>
                          
                          <?php
                              $services = array('1', '2', '3', '4', '5', '6');
                              for($i=0;$i < 6; $i++){

                                  if ($subj_result['subj_unit'] != $services[$i]) {
                            ?>
                              <option value="<?php echo $services[$i] ?>"><?php echo $services[$i] ?></option>

                            <?php
                                }
                                }
                            ?> 

                        </select>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar-check-o"> <label style="width: 100px;">Term:</label></span>
                        </span>
                        <select class="form-control" name="update_subj_term" placeholder="Term" type="text" required>
                          
                          <option><?php echo $subj_result['subj_term']; ?></option>
                          
                          <?php
                              $services = array('1st Term', '2nd Term', '3rd Term');
                              for($i=0;$i <3 ; $i++){

                                  if ($subj_result['subj_term'] != $services[$i]) {
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
                        <span class="input-group-addon"><span class="fa fa-calendar-check-o"><label style="width: 100px;"> Room:</label></span>
                        </span>
                        <select class="form-control" name="update_room_class" placeholder="Room Classification" type="Text" value="<?php echo $subj_result['room_classification']; ?>" required>

                          <option value="<?php echo $subj_result['room_classification']; ?>"><?php echo $subj_result['room_classification']; ?></option>

                           <?php
                              $services = array('Lecture Room','Computer Laboratory Room');
                              for($i=0;$i < 2; $i++){

                                  if ($subj_result['room_classification'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                }
                            ?> 

                        </select>
                      </div>
                    </div>
                 
                  
                      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" data-action="save" id="update" name="update" role="button">Update Subject</button>
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

                  <td style="color: red;"><?php echo $subj_result['subj_name']; ?></td>
                  <td style="color: red;"><?php echo $subj_result['subj_code']; ?></td>
                  <td style="color: red;"><?php echo $subj_result['sc_code']; ?></td>
                  <td style="color: red;"><?php echo $subj_result['subj_unit']; ?></td>
                  <td style="color: red;"><?php echo $subj_result['subj_term']; ?></td>         
                  <td style="color: red;"><?php echo $subj_result['room_class']; ?></td>                    
                  <td style="text-align: center;"> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#update" disabled><span class="glyphicon glyphicon-pencil"></span> Update</button></td>

                  <?php } ?>

                  <td style="text-align: center;">
                    <?php if($subj_result['subj_status'] != "Activated") { ?>

                        <button type="button" class="btn btn-primary btn-xs" id="<?php echo $subj_result['subj_id']; ?>" onclick="window.location.href='server/activate_account_subject.php?status=Activated&subjid=<?php echo $subj_result['subj_id'] ?>'"><span class="glyphicon glyphicon-thumbs-up"></span>Activate</button>

                        <?php } else { ?>

                        <button type="button" class="btn btn-danger btn-xs" id="<?php echo $subj_result['subj_id']; ?>" onclick="window.location.href='server/activate_account_subject.php?status=Deactivated&subjid=<?php echo $subj_result['subj_id'] ?>'"><span class="glyphicon glyphicon-thumbs-down"></span>Deactivate</button>

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

  </div>                               
</body>
</html>