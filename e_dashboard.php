<?php
session_start();

    if (!isset($_SESSION['user_name'])) {

        header('Location: login.php');
}
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    
		<meta charset="UTF-8">
        <meta http-equiv="X-AU-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
			
    <!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <!-- JQuery -->
		<script type="text/javascript" src="bootstrap/jquery-3.1.1.min.js"></script>

    <!--  JavaScript -->
		 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/sb-admin.css">

    <!-- Custom Fonts -->
    <link href="fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<style>

body{

    background-color: white;
}

a.navbar-brand{
    font-family: Georgia Extrabold;
}



@media(min-width:768px) {
    .side-nav {
        position: fixed;
        top: 50px;
        left: 225px;
        width: 220px;
        border: none;
        border-radius: 0;
        border-top: 2px rgba(0,0,0,.5) solid;
        overflow-y: auto;
         
        bottom: 0;
        overflow-x: hidden;
        padding-bottom: 40px;
        color: white;
    }

.nav-side-menu{

  overflow: auto;
  font-family: arial;
  font-size: 13px;
  font-weight: 200;
  background-color: white;
  position: fixed;
  top: 0px;
  width: 300px;
  height: 100%;
  
}



    .side-nav li a:hover,
    .side-nav li a:focus {
        outline: none;
        background-color: black !important;
    }
}



.side-nav>li>ul>li>a {
    display: block;
    padding: 10px 15px 10px 38px;
    text-decoration: none;
    /*color: #999;*/
    color: #fff;    
}

.profile-userpic{

    margin-top: 10px;
    margin-bottom: 10px;
    margin-left: 5px;
    margin-right: 5px;
}

img.img-circle{
    size: 10px;
}

.page-header{

  font-family: Georgia ExtraBold;
  margin-top: 25px;
}

</style>


<body>

<div id="wrapper">

        <!-- Navigation Bar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   
        <!-- Navbar Header -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </button>

            <a class="navbar-brand"><!--<img src="images/info2.jpg" alt="Informatics">-->Informatics College Manila</a>
        </div>
        <!-- End Navbar Header -->
 
        </a>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

               
        
                      
        <!-- Notification  -->            
        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-envelope"></i> Pending for Approval  <b class="caret"></b></a>
 
               
                    <?php

                     $sy_retrieve ="SELECT * FROM school_year WHERE status ='Activated'";
                        $sy_query = mysqli_query($conn, $sy_retrieve);
                        while ($sy_result = mysqli_fetch_assoc($sy_query)){
                          $activatedyear =  $sy_result['school_year'];
                        }

                        $get_schedule_sql ="SELECT * FROM schedule  WHERE is_approved = 'no' AND school_year = '$activatedyear'";
                        //print_r($get_schedule_sql);
                        $get_schedule_query = mysqli_query($conn, $get_schedule_sql);
                        //$schedule_result = mysqli_fetch_assoc($get_schedule_query);
                        $notification_count = ($get_schedule_query->num_rows);
                    
                    ?>

                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview"><a href="#">
                            <div class="media"><span class="pull-left"><img class="media-object"></span>
                            <div class="media-body">
                                <p style="margin-bottom: 0;">You have <?php echo $notification_count; ?> notification<?php echo $notification_count > 1 ? 's':''; ?>.</p>
                            </div>
                            </div>
                            </a>
                        </li>
                        <?php
                        $show_only = 20;
                        $settings_school_year = '$activatedyear';
                        $settings_day_start = 1;
                        $settings_hour_start = '07';
                        $settings_schedule_of = 'class';
                        while ($schedule_result = mysqli_fetch_assoc($get_schedule_query)){
                            $show_only -= 1;
                            //print_r($schedule_result['schedule_id']);
                            if($show_only >= 0){
                                $notification_param = array(
                                    
                                    'school_year' => $schedule_result['school_year'],
                                    'course_strand' => $schedule_result['course_strand'],
                                    'term_grading' => $schedule_result['term_grading'],
                                    'section_id' => $schedule_result['section_id_fk'],
                                    'schedule_id' => $schedule_result['schedule_id'],
                                    'settings_school_year' => $settings_school_year,
                                    'settings_day_start' => $settings_day_start,
                                    'settings_hour_start' => $settings_hour_start,
                                    'settings_schedule_of' => $settings_schedule_of,
                                );
                                $url_notification = '&'.http_build_query($notification_param);
                                //echo $url_notification;
                        ?>
                        <li class="message-preview"><a href="e_view_class.php?filterBy=Section<?php echo $url_notification; ?>">
                            <div class="media"><span class="pull-left"><img class="media-object"></span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>New Schedules #<?php echo $schedule_result['schedule_id']; ?></strong></h5>
                                <p class="small text-muted"> Date Created: <?php echo date('F d, Y', strtotime($schedule_result['schedule_created'])); ?></p>
                                <p>Need your approval. Click here.</p>
                            </div>
                            </div>
                            </a>
                        </li>
                        <?php 
                            }
                        }
                        ?>

                        <!-- End Notification <li class="message-footer">
                            <a href="#">View All Notifications</a>
                        </li>-->
                    </ul>
        </li>
        <!-- End Notification -->

        <!-- User -->          
        <li class="dropdown">
            <a href="#Username" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['user_name'];?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="e_user_profile.php"><i class="fa fa-fw fa-user"></i> User Profile</a>
                    </li>
                    <li class="divider">  
                    </li>
                    <li>
                        <a href="server/p_logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
    
                </ul>   
        </li>
        <!-- End User -->  
        </ul>
        <!-- End Top Menu Items -->



        <!-- Sidebar Menu -->     
        <div class="nav-side-menu collapse navbar-collapse navbar-ex1-collapse" id="accordion">


            <ul class="nav navbar-nav side-nav">

                <!-- Profile User Picture-->
                <div class="profile-userpic"><img src="images/bg3.jpg" class="img-responsive"> 
                </div>

                <!-- Manage Schedule -->
                         <li>
                            <a href="e_view_class.php"><i class="fa fa-fw fa-calendar"></i> Confirm Class Schedule</a>
                        </li>
                         <li>
                    <a href="e_view_reports_class.php" data-toggle="collapse" data-parent="accordion" data-target="#3"><i class="fa fa-fw fa-bar-chart"></i> View and Print Reports </a>
                    </li>

            </ul>
        </div>
        <!-- End Sidebar Menu -->
        </nav>
        <!-- End Navigation Bar -->

</body>
</html>