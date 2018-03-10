 <?php
require("s_dashboard.php");
require('server/p_db_connection.php');

if (!isset($_SESSION['user_name'])) 
{
    header('Location: login.php');
}
?>

<!DOCTYPE html>
 <html>

 <head>
    
    <title> User Profile </title>

    <!-- clock -->
    <script type="text/javascript" src="js/js_clock.js"></script>

 </head>

<style>

  #panel-head{
    height: 60px;
  }


  .panel-title{
    font-size: 30px;
  }

  #clock {
    margin-top: 10px;
    font-size: 20px;
    font-family: Georgia;
  }

</style>

<body>
    
  <!-- Head Container Fluid -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">
    <h2 class="page-header">
      <center>User Profile <br></center>
    </h2>
                
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-arrow-right"></i> You are here:
        </li>
        <li class="active"><a href="s_user_profile.php"> User Profile</a>
        </li>
      </ol>
    </div>
    </div>
                          
  </div>
  <!-- Head Container-fluid  -->

  <!--  Body Container-fluid  -->
  <div class="container-fluid">

  <div class="row">
    <!-- For User Profile Info -->
    <div class="col-lg-6 col-lg-offset-3">
      <div class="panel panel-default">
      <div class="panel-heading" id="panel-head">
        <h3 class="panel-title"> <center> Welcome, 
                         
        <?php
          $user_name = $_SESSION['user_name']; 

          $show_usernames = "SELECT *FROM useraccount WHERE user_name = '".$user_name."'";
          $show_usernames_query = mysqli_query($conn, $show_usernames);

            if ($show_usernames_query) {
              while ($username_result = mysqli_fetch_assoc($show_usernames_query)) {
                echo $username_result['user_fname'];
                  
        ?>
          </center>
        </h3>
      </div>

      <!-- Panel Body -->
      <div class="panel-body">
      <div class="row">
      <div class="col-md-12">

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
            <td><a href="mailto:#"><?php echo $username_result['user_email'];?></a></td>
          </tr>
          <tr>
            <td>Username:</td>
            <td><?php echo $username_result['user_name'];?></td>
          </tr>
        </tbody>             
      </table>  

      </div>
      </div>
      </div>
      <!-- Panel Body -->

      <?php }} ?>
      
      <!-- Panel Footer -->
      <div class="panel-footer">
      <div class="input-group-btn">

      <!-- View Users for Update -->

      <?php 

        $user_name = $_SESSION['user_name'];
        $info_retrieve = "SELECT * FROM useraccount where user_name = '".$user_name."'";
        $info_query = mysqli_query($conn, $info_retrieve);
                
          if($info_query){
            while ($info_result = mysqli_fetch_assoc($info_query)){
      ?>

        <span class="pull-right">                                       
          <button type="button" class="btn btn-success btn-md" data-toggle="modal"data-target="#update<?php echo $info_result['user_id']; ?>" id="#edit">
            <span class="fa fa-pencil-square-o"></span> Update Profile</button>
        </span>
      </div>
      </div>

      </div>
      <!-- End Panel-Success-->
      </div>
      <!-- End Col-MD-6 -->

      <!-- Update Modal -->
      <div id="update<?php echo $info_result['user_id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">
                           
        <!-- Update Modal Content-->
        <div class="col-lg-12">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center> Update User Profile </center></h4>
        </div>

        <div class="modal-body">
          <form method="POST" action="server/p_update_userprofile.php">

          <div hidden><input type="number" name="update_user_id" class="form-control" value="<?php echo $info_result['user_id']; ?>" readonly />
          </div>

          <div class="form-group col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" name="update_firstname" class="form-control" placeholder="First Name" value="<?php echo $info_result['user_fname']; ?>" required />
            </div>
          </div>

          <div class="form-group col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" name="update_lastname" class="form-control" placeholder="Last Name" value="<?php echo $info_result['user_lname']; ?>" required />
            </div>
          </div>

          <div class="form-group col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                <select class="form-control" name="update_department" placeholder="Department" type="text" required>
                  <option><?php echo $info_result['user_department']; ?></option>
                    <?php
                      $dept = array('Faculty', 'Services', 'Admin', 'Student Assistant', 'Marketing');
                      for($i=0;$i < 5; $i++){
                        if ($info_result['user_department'] != $dept[$i]) {
                    ?>
                      <option><?php echo $dept[$i] ?></option>
                    <?php
                      }
                        }
                     ?>       
                </select>
            </div>
          </div>
                        
          <div class="form-group col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                <select class="form-control" name="update_position" placeholder="Position" type="text" required>
                  <option><?php echo $info_result['user_position']; ?></option>
                    <?php
                      $pos = array('Center Manager', 'Faculty Head', 'Services Head', 'Student Assistant', 'Marketing');
                      for($i=0;$i < 5; $i++){
                        if ($info_result['user_position'] != $pos[$i]) {
                    ?>
                      <option><?php echo $pos[$i] ?></option>
                    <?php
                      }
                        }
                    ?>
                </select>
            </div>
          </div>

          <div class="form-group col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <select class="form-control" name="update_gender" placeholder="Gender" type="text" required>
                  <option><?php echo $info_result['user_gender']; ?></option>
                    <?php
                      $gen = array('Male', 'Female');
                      for($i=0;$i < 2; $i++){
                        if ($info_result['user_gender'] != $gen[$i]) {
                    ?>
                      <option><?php echo $gen[$i] ?></option>
                    <?php
                      }
                        }
                    ?> 
                </select>
            </div>
          </div>

          <div class="form-group col-md-6">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <select class="form-control" name="update_usertype" placeholder="Usertype" type="text" required>
                  <option><?php echo $info_result['user_privileges']; ?></option>
                    <?php
                      $user = array('Reporting User', 'Monitoring User', 'External User', 'Admin');
                      for($i=0;$i < 4; $i++){
                        if ($info_result['user_privileges'] != $user[$i]) {
                    ?>
                      <option><?php echo $user[$i] ?></option>
                    <?php
                      }
                        } 
                    ?> 
                </select>
            </div>
          </div>

          <div class="form-group col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" name="update_email" class="form-control" placeholder="Email Address" value="<?php echo $info_result['user_email']; ?>" required />
            </div>
          </div>

          <div class="form-group col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" name="update_username" class="form-control" placeholder="Username Name" value="<?php echo $info_result['user_name']; ?>" required />
            </div>
          </div>

          <div class="form-group col-md-12">
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-user-circle-o" aria-hidden="true"></span></span>
                <input type="password" id="password" name="update_password" class="form-control" placeholder="Password" title="Please re-type your password for safety" required />
            </div>
          </div>

          

          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="modal-footer">
            <button type="submit" id="update" name="update" class="btn btn-success btn-hover-green" data-action="save" role="button">Update Profile</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
                       
        <?php
          }
            }
        ?>
</form>
        </div>
        <!-- End Modal Body -->
      
      </div>
      <!-- End Modal Content -->
      </div>
      <!-- End col-lg-12 -->
      </div>
      <!-- End Modal Dialog -->
      </div>
      <!-- End Update -->

      
      
    <!-- For Chat Box 
    <div class="col-md-6">
      <div class="panel panel-default">
      <div class="panel-heading" id="panel-head">
        <h1 class="panel-title"> <center> Conversation Corner </center></h1>
      </div>

      <!-- Panel Body 
      <div class="panel-body">
      <div class="row">
      <div class="col-md-12">
      <div class="chatbody">

        <table class="table">
          <tr>
            <td class="col-md-2"><b> Mr. Sinon</b></td>
            <td>Goodmorning! I have submitted the needed requirements for Scheduling.</td>
            <td class="col-md-3"><small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span> 15:20 mins ago</small></td>
          </tr>
          <tr>
            <td class="col-md-2"><b> Mr. Ang</b></td>
            <td>I already approved your schedules, kindly check.</td>
            <td class="col-md-3"><small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span> 5:00 mins ago</small></td>
          </tr>
          <tr>
            <td class="col-md-2"><b> Ms. Gonzales</b></td>
            <td>Kindly checck the reports of monitored schedules. Thanks!</td>
            <td class="col-md-3"><small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span> 2:00 mins ago</small></td>
          </tr>
        </table>

      </div>
      </div>
      </div>
      </div>
      <!-- Panel Body 

      
      <!-- Panel Footer 
      <div class="panel-footer">
      <div class="input-group-btn">
       
       <div class="col-md-9">
         <input type="text" name="lastname" class="form-control" placeholder="Message . . ." />  
         </div>  
         <div class="col-md-3">                                 
          <button type="button" class="btn btn-primary btn-md" id="#edit">
            <span class="fa fa-paper-plane"></span> Send</button>
        </div>
      </div>
      </div>
      <!-- End Panel Footer 
            
      </div>
      <!-- Panel -->
    </div>
  </div>
  <!-- Row

</div>
<!-- Container-Fluid -->

</body>
</html>
