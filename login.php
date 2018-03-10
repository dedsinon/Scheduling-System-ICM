<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-AU-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

  <title>Login Page</title>

   
    <!-- Bootstrap JQuery -->
    <script type="text/javascript" src="bootstrap/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
     <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- Sb-Admin Custom CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/sb-admin.css">
    <!-- Font Awesome Custom fonts -->
    <link  rel="stylesheet" type="text/css" href="bootstrap/font-awesome/css/font-awesome.min.css">

</head>

<style>

  body {
    background-image: url("images/bg4.jpg");
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-clip: border-box;
    background-size: cover;
  } 

  #box{
  
    margin-top: 70px;
  }

</style>

<body>

  <div class="container-fluid">
    <div class="col-lg-4 col-lg-offset-4">
      <div class="panel panel-default mx-auto mt-5" id="box">
        <div class="panel-heading" name="panel" id="panelhead">
          <h4 id="login"><center><b> LOGIN </b></center></h4>
        </div>

        <div class="panel-body">

        <!-- If Login Failed -->
        <?php if(isset($_SESSION['error_login'])){ ?>

          <div class="alert alert-danger">
          <strong>Failed!</strong>

        <?php echo $_SESSION['error_login'];?></div>
        <?php $_SESSION['error_login'] = null; }?> 
            
      
          <!-- Login Form -->
          <form class="form" role="form" method="POST" action="server/p_login.php" accept-charset="UTF-8">

          <!-- Username -->
          <div class="row">
          <div class=" form group col-lg-12 col-lg-12 col-lg-12">
            <label for="username"><span class="text-danger">*</span> Username:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-user"></span>
                </div>
                  <input class="form-control" type="text" placeholder="Username" id="username" name="username" required autofocus />
                <div class="input-group-btn">
                  <button type="button" id="remove" data-val="1" class="btn btn-default btn-md"><span class="glyphicon glyphicon-remove"></span>
                  </button>
                </div>
              </div>
          </div>
          </div>
          </br>
               
          <!-- Password -->
          <div class="row">
          <div class=" form group col-lg-12 col-lg-12 col-lg-12">
            <label for="password"><span class="text-danger" style="margin-right:5px;">*</span>Password:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-lock"></span>
                </div>
                  <input class="form-control" id="password" type="password" name="password" placeholder="Password" required />
                <div class="input-group-btn">
                  <button type="button" id="showhide" data-val="1" class="btn btn-default btn-md"><span id='eye' class="glyphicon glyphicon-eye-open"></span>
                  </button>
                </div>
              </div>
          </div>
          </div> 
          </br>

          <div class="row">
          <div class="form-group col-lg-12 col-lg-12 col-lg-12  ">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" /> Remember Password
              </label>
            </div>
          </div>
          </div>

          <!-- Login Button -->
          <div class="row">
          <div class="form-group col-lg-12 col-lg-12 col-lg-12">
            <center><input class="btn btn-primary btn-block" id='Submit' name='Submit' type='Submit' value="Submit" /></center>
          </div>
          </div>
              
          </form>
          <!-- End of Login Form -->

        </div>
      </div>
      </div>
    </div>

    
    <div id="footer"  class="col-md-4 col-md-offset-4">
        <div style="padding-top: 10px;">
            <ul style="list-style-type: none;">
              <li><strong class="text-muted"> Copyright 2018 <span class="glyphicon glyphicon-globe"></span> Informatics College Manila  </strong></li>
              <li><span class="text-muted">Quiapo Manila, Philippines. All Rights Reserved.</span></li>
              <li><span class="text-muted">Designed and Developed by: Daryl and 4 others</span></li>
            </ul>
        </div>
    </div>
         


<!-- Delete Username, Show & Hide Password -->
<script type="text/javascript" src="js/show_hide_password.js"></script>
<!-- Core plugin JavaScript-->
<script src="bootstrap/jquery-easing/jquery.easing.min.js"></script>

</body>
</html>