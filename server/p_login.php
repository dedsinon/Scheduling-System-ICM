<?php
  session_start();
  require("p_db_connection.php");

  $username = $_POST['username'];
  $password = $_POST['password'];
  $_SESSION['user_name'] = $username;


  if($username<>'' and $password<>'') {
    
    $encrypt_password = sha1($password);
    
    $sql = "SELECT * FROM useraccount WHERE user_name = '".$username."' AND user_pass = '".$encrypt_password."' AND user_status = 'Activated' ";

   $result = mysqli_query($conn, $sql);

    if(mysqli_errno($conn)>0) {

      echo "Failed to connect: " . mysqli_connect_error();
    } 

    else {
      
      $count = mysqli_num_rows($result);
    
                
      if($count > 0) {

       while($sql_info = mysqli_fetch_assoc($result)){

      $log = "INSERT INTO log (log_id, log_user, log_entry, log_time) VALUES ('', '".$username."', 'Logged In', NOW()) "; 
      mysqli_query($conn, $log) or die('log: '.mysql_error()); 

     

        if($sql_info['user_privileges'] == "Admin") {

        $_SESSION['user_name'] = $username;

        
        header("Location: ../user_profile.php?admin%login=success");
        exit;
        }

        else if($sql_info['user_privileges'] == "Monitoring") {

        $_SESSION['user_name'] = $username;
       
        header("Location: ../m_user_profile.php?monitoring_user%login=success");
        exit;
        }

         else if($sql_info['user_privileges'] == "Reporting") {

        $_SESSION['user_name'] = $username;
       
        header("Location: ../s_user_profile.php?reporting_user%login=success");
        exit;
        }

        else if($sql_info['user_privileges'] == "External") {

        $_SESSION['user_name'] = $username;
       
        header("Location: ../e_user_profile.php?external_user%login=success");
        exit;

      }
    } 
  }
}


  $_SESSION['error_login'] = "Your username and password did not match in our system. Please contact the administrator.";
  header("Location: ../login.php?error=didnotmatch");
 }
?>