<?php 
require ("dashboard.php");
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>

<head>

    <title> Class Schedule </title>

</head>

<style>

  body {
    font-family: arial;
  }
  .room{
    height: 1000px;
  }
</style>

<body>

  <!-- Head Container Fluid -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header"><center> Create Schedule <br></center>
      </h2>
                
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-arrow-right"></i> You are here:
        </li>
        <li class="active">
          <i class="fa fa-file"></i> <a href="admin.php"> Create Schedule:</a>
        </li>
      </ol>
    </div>
    </div>
    <!-- Page Heading -->        
  </div>
  <!-- Head Container-fluid  -->
 
  <!-- Add New Section -->
          <div class="container-fluid">
          <div class="row">         
          <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading" id="head-add"> Create Schedule Details 
            </div>

            <div class="panel-body">
            <div class="col-lg-12">

               <?php if(isset($_SESSION['success_schedule'])){ ?>

                            <div class="alert alert-success">
                            <strong>Success!</strong>

                  <?php echo $_SESSION['success_schedule'];?></div>
                    
                  <?php $_SESSION['success_schedule'] = null; }?> 

                  <?php if(isset($_SESSION['error_schedule'])){ ?>

                            <div class="alert alert-danger">
                            <strong>Failed!</strong>

                  <?php echo $_SESSION['error_schedule'];?></div>
                    
                  <?php $_SESSION['error_schedule'] = null; }?> 


             

              <form action="server/add_schedule.php" method="POST" id="form">

              <div class="form-group col-lg-4">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-users"></span>
                  </span>
                  <select class="form-control" name="sc" placeholder="Strand Course" type="text" id="course_id" >
                  
                    <option disabled selected> Strand or Course Classification:</option>
                    
                    <?php
                      $sc_retrieve ="SELECT * FROM strand_course";
                      $sc_query = mysqli_query($conn, $sc_retrieve);
                  
                      if($sc_query){
                        while ($sc_result = mysqli_fetch_assoc($sc_query)){

                        echo '<option value="'.$sc_result['sc_id'].'">'.$sc_result['sc_name'].' </option>';
                        
                      }
                    }
                    ?>

                  </select>
                </div>
              </div>




              <?php 
                $yt_retrieve ="SELECT * FROM year_term";
                $yt_query = mysqli_query($conn, $yt_retrieve);
                  
                  if($yt_query){
                  ?>

              <div class="form-group col-lg-4">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-users"></span>
                  </span>
                  <select class="form-control" name="sy" placeholder="Strand Course" type="text" required>
                    <option disabled selected> School Year - Year Level - Term:</option>

                    <?php
                    while ($yt_result = mysqli_fetch_assoc($yt_query)){

                    echo '<option>'.$yt_result['year'].' - '.$yt_result['year_level'].' - '.$yt_result['term'].' </option>';
                    }
                  
                    echo '</select>';
                    }
              ?>
                  </select>
                </div>
              </div>

              <?php 
                $sec_retrieve ="SELECT * FROM section";
                $sec_query = mysqli_query($conn, $sec_retrieve);
                  
                  if($sec_query){
                  ?>

              <div class="form-group col-lg-4">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-users"></span>
                  </span>
                  <select class="form-control" name="sec" placeholder="Strand Course" type="text" required>
                    <option value=""> Section:</option>

                    <?php
                      while ($sec_result = mysqli_fetch_assoc($sec_query)){

                      echo '<option>'.$sec_result['sec_code'].' </option>';
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>                  

            <div class="col-lg-4">     
            <div class="panel panel-default" id="subjects" > 
            <div class="panel-heading">
              <center> <h4>Subject</h4  ></center>
            </div>
            <div class="panel-body" style="overflow-y: scroll; height: 300px;">


              <?php 

                
                  $subj_retrieve ="SELECT * FROM subject q LEFT JOIN strand_course e on q.sc_id = e.sc_id  where q.sc_id = '1' ";
                  $subj_query = mysqli_query($conn, $subj_retrieve);
  
                  if($subj_query){
                    while ($subj_result = mysqli_fetch_assoc($subj_query)){
              

               echo '<input type="radio" name="subject" value=" '.$subj_result['subj_name'].' "/>'; 
               echo $subj_result['subj_name']; 
               echo '<br>';
              }
              }
               ?>

            </div>
            </div>
            </div>

            <div class="col-lg-4">     
            <div class="panel panel-default" id="teach" >
            <div class="panel-heading">
                <center> <h4>Teacher</h4 ></center>
            </div>
            <div class="panel-body" style="overflow-y: scroll; height: 300px;">
              
              <select class="form-control " name="sec" placeholder="Strand Course" type="text" required >
                  <option value=""> Work Status:</option>
              </select>
              </br>
              
              <select class="form-control" name="sec" placeholder="Strand Course" type="text" required>
                  <option value=""> Specialization:</option>
              </select>
              </br>

               <?php 
                $teach_retrieve ="SELECT * FROM teacher";
                $teach_query = mysqli_query($conn, $teach_retrieve);
                  
                  if($teach_query){
                    while ($teach_result = mysqli_fetch_assoc($teach_query)){
              

               echo '<input type="radio" name="teacher" value=" '.$teach_result['teacher_fullname'].' "/>'; 
               echo $teach_result['teacher_fullname']; 
               echo '<br>';
               
               }
               }
               ?>
            </div>
            </div>
            </div>

           
             <div class="col-lg-4" id="room">     
            <div class="panel panel-default" >
            <div class="panel-heading">
            <center> <h4>Room</h4  ></center>
            </div>
            <div class="panel-body" style="overflow-y: scroll; height: 300px;">
            <select class="form-control" name="sec" placeholder="Strand Course" type="text" required>
                  <option value=""> Room Description:</option>
                  <option></option>
                  </select>
              </br>
              <?php 
                $room_retrieve ="SELECT * FROM rooms";
                $room_query = mysqli_query($conn, $room_retrieve);
                
                if ($room_query) {
                  while ($room_result = mysqli_fetch_assoc($room_query)){              

               echo '<input type="radio" name="room" value=" '.$room_result['room_name'].' "/>'; 
               echo $room_result['room_name']; 
               echo '<br>';
               }
               }
               ?>

            </div>
            </div>
            </div>
            
                    <br><br><br>
                    
                    <button type="submit" class="btn btn-primary" name="submit" value='submit'><i class="fa fa-plus-circle"></i> Add New Schedule
                    </button>

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
        <div class ="col-lg-12">
        <div class ="panel panel-default" id="tab_content">
  
        <div class ="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">View Schedule</h4>
                <div class="input-group col-md-4 pull-right">
                    <input type="text" class="form-control" placeholder="Search">
                </div>

        </div>
                       
        <div class="panel-body">           
          <table class="table table-bordered table-hover table-striped table-sm table-responsive">
            <div class="table-responsive">
              <thead class="thead-inverse">
                <tr>
                    <th style="text-align: center;">Strand / Course: </th>
                    <th style="text-align: center;">School Year</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Teacher</th>    
                    <th style="text-align: center;">Room</th>
                    <th style="text-align: center;">Update</th>
                    <th style="text-align: center;">Action</th>
                </tr>
              </thead>

                <!-- View Users -->
                <?php 
                  $sched_retrieve = 'SELECT * FROM schedule';
                  $sched_query = mysqli_query($conn, $sched_retrieve);

                  if($sched_query){
                    while ($sched_result = mysqli_fetch_assoc($sched_query)){
                ?>

              <tbody>
                <tr>
                  
                  <td><?php echo $sched_result['strand_course_id']; ?></td>
                  <td><?php echo $sched_result['school_year_id']; ?></td>
                  <td><?php echo $sched_result['section_id']; ?></td>
                  <td><?php echo $sched_result['subject_id']; ?></td>
                  <td><?php echo $sched_result['teacher_id']; ?></td> 
                  <td><?php echo $sched_result['room_id']; ?></td>
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
                      <form method="POST" action="#".php">

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
                          
                          <option><?php echo $section_result['sec_sc']; ?></option>
                          
                          <?php
                              $services = array('Strand', 'Course');
                              for($i=0; $i < 2; $i++){

                                  if ($section_result['sec_sc'] != $services[$i]) {
                            ?>
                              <option><?php echo $services[$i] ?></option>

                            <?php
                                }
                                } 
                            ?> 

                          </select>
                          </div>
                      </div>
                   
                    
                      <div class="btn-group" role="group">
                        <button type="submit" id="update" name="update" class="btn btn-default btn-hover-green" data-action="save" role="button">Save
                        </button>
                      </div>

                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    
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
          </table>
        </div>        
</body> 
</html>
