 <?php
require("dashboard.php");

if (!isset($_SESSION['user_name'])) 
{
    header('Location: login.php');
}
?>

<!DOCTYPE html>
 <html>
 <head>

     <title> User Profile </title>
 </head>
 <style>

#panel-head{
  
    border: 1px #e5e5e5 solid;
    height: 60px;
}


 .panel-title{

font-size: 30px;
 }

.panel{
   border: 2px  solid; 
}

.panel-body{

   
}

.panel-footer{

    
}

.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
</style>
 <body>
    
            <!-- Head Container Fluid -->
            <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                    <div class="col-lg-12">
                    <h2 class="page-header"><center>User Profile <br></center>
                    </h2>
                
                    <ol class="breadcrumb">
                            <li>
                                    <i class="fa fa-arrow-right"></i> You are here:</a>
                            </li>
                            <li class="active">
                                    <i class="fa fa-file"></i> <a href="admin.php"> User Profile:</a>
                            </li>
                    </ol>
                    </div>
                    </div>
                    <!-- Page Heading -->        
            </div>
            <!-- Head Container-fluid  -->

            <!--  Body Container-fluid  -->
            <div class="container-fluid">

                    <div class="row">
                    <div class="col-md-5 pull-right col-md-offset-12">        
                    
                            <!-- Date/Time -->
                            <?php
                                include('server/p_db_connection.php');
                                echo date ('M. d, Y');
                                echo ", ";
                                echo date ('h:i:s A');

                            ?>  <i class="fa fa-fw fa-clock-o"></i><p></p>
                    </div>
                    </div>

                    <div class="col-md-8 col-md-offset-2">
   
                    <div class="panel">
                    <div class="panel-heading" id="panel-head">
                    <h1 class="panel-title"> Welcome, 
                         
                <?php

                $user_name = $_SESSION['user_name']; 

                $show_usernames = "SELECT *FROM useraccount WHERE user_name = '{$user_name}'";
                $show_usernames_query = mysqli_query($conn, $show_usernames);

                if ($show_usernames_query) {
                while ($username_result = mysqli_fetch_assoc($show_usernames_query)) {
                echo $username_result['user_fname'];
                  
                ?> !!!

                    </h1>
                    </div>


                    <div class="panel-body">
                    <div class="row">

                    <div class="col-md-3 col-lg-3 " align="center">
                   
                    <img alt="User Pic" src="#" class="img-circle img-responsive">
                    </div>
                    

                    <div class=" col-md-8 col-lg-8 "> 
                        <table class="table table-striped">
                       
                                <tbody>     
                                        <tr>
                                                <td>Firstname:</td>
                                                <td><?php echo $username_result['user_fname'];?></td>
                                        </tr>
                                        <tr>
                                                <td>Lastname:</td>
                                                <td> <?php echo $username_result['user_lname'];?></td>
                                        </tr>
                                        <tr>
                                                <td>Department:</td>
                                                <td><?php echo $username_result['user_department'];?></td>
                                        </tr>
                                        <tr>
                                                <td>Position:</td>
                                                <td><?php echo $username_result['user_position'];?></td>
                                        </tr>
                                        <tr>
                                                <td>Gender:</td>
                                                <td><?php echo $username_result['user_gender'];?></td>
                                        </tr>
                                        <tr>
                                                <td>Email:</td>
                                                <td><a href="mailto:ded.sinon@gmail.com"><?php echo $username_result['user_email'];?></a></td>
                                        </tr>
                                        <tr>
                                                <td>Username:</td>
                                                <td><?php echo $username_result['user_name'];?></td>
                                        </tr>
                                        <tr>
                                                <td>Password:</td>
                                                <td>
                                                    <input type="Password" value="<?php echo $info_result['user_pass'];?>" style="border:none; width: 200px" readonly=''>
                                    
                                                </td>
                                        </tr>
                                             
                                </tbody>
                        
                        </table>

                    </div>
                    </div>
                    </div>
                    <!-- Panel Body -->
 <?php }
                }
                  
                ?>
                    <!-- Panel Footer -->
                    <div class="panel-footer">
                    <div class="input-group-btn">

                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-camera"> Upload Photo</i></button>


                   <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
    
                   <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                    </div>

                    <div class="modal-body">

                    <div class="container">
<div class="col-md-6">
    <div class="form-group">
        <label>Upload Image</label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="imgInp">
                </span>
            </span>
                <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload'/>
    </div>
</div>
</div>

<script>
  $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });   
  });
</script>

                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-default">Upload</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
      
              </div>
              </div>
                    


                  <!-- View Users for Update -->
                <?php 

                  $user_name = $_SESSION['user_name'];

                  $info_retrieve = "SELECT * FROM useraccount where user_name = '{$user_name}'";
                  $info_query = mysqli_query($conn, $info_retrieve);



                  if($info_query){
                    while ($info_result = mysqli_fetch_assoc($info_query)){
                ?>

                    <span class="pull-right">
                                                  
                    <!-- Update Button -->
                    <button type="button" class="btn btn-success btn-md" data-toggle="modal"data-target="#update<?php echo $info_result['user_id']; ?>" id="#edit">
                    <span class="glyphicon glyphicon-pencil"></span> Update Profile</button>
                    </span>
                    </div>
                    <!-- End Group Button -->


  

                    <!-- Update Modal -->
                    <div id="update<?php echo $info_result['user_id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                           
                    <!-- Update Modal Content-->
                    <div class=" col-lg-12">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Profile</h4>
                    </div>

                   <div class="modal-body">
                      <form method="POST" action="server/p_update_userprofile.php">

                        <div hidden> <input type="number" name="update_user_id" class="form-control" value="<?php echo $info_result['user_id']; ?>" readonly>
                        </div>

                        </div>
                        <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                          </span>
                          <input type="text" name="update_firstname" class="form-control" placeholder="First Name" value="<?php echo $info_result['user_fname']; ?>" required>
                        </div>
                        </div>

                        <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                          </span>
                          <input type="text" name="update_lastname" class="form-control" placeholder="Last Name" value="<?php echo $info_result['user_lname']; ?>" required>
                        </div>
                        </div>

                        <div class="form-group col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span>
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
                        
                        <div class="form-group col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span>
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

                        <div class="form-group col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
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

                        <div class="form-group col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                          </span>
                          <select class="form-control" name="update_usertype" placeholder="Usertype" type="text" required>

                            <option><?php echo $info_result['user_privileges']; ?></option>

                            <?php
                              $services = array('Reporting User', 'Monitoring User', 'External User', 'Admin');
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
                          <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                          </span>
                          <input type="text" name="update_email" class="form-control" placeholder="Email Address" value="<?php echo $info_result['user_email']; ?>" required>
                        </div>
                        </div>

                        <div class="form-group col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                          </span>
                          <input type="text" name="update_username" class="form-control" placeholder="Username Name" value="<?php echo $info_result['user_name']; ?>" required>
                        </div>
                        </div>

                         <div class="form-group col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user-circle-o" aria-hidden="true"></span>
                        </span>
                        <input type="password" id="password" name="update_password" class="form-control" placeholder="Password" value="<?php echo $info_result['user_pass'];?>" required>
                      </div>
                    </div>

                    <div class="modal-footer">

                        <button type="submit" id="update" name="update" class="btn btn-default btn-hover-green" data-action="save" role="button">Save
                            </button>
                     
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                    </div>
                       
  <?php
              }
              }
              ?>
                        
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
                         
                    
                    </div>
                    <!-- End Panel Footer -->
                    </div>
                    </div>
            </div>
            <!-- Bondy Container Fluid -->
    </div>
    <!-- page-wrapper -->

</div>
<!-- Wrapper -->
 
</body>
</html>
 