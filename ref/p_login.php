<?php

  session_start();
  require("p_db_connection.php");

  $username = $_POST['username'];
  $password = $_POST['password'];
  
  if($username<>'' and $password<>'')
  {
    $secure_username = mysqli_real_escape_string($conn, $username);
    $secure_password = mysqli_real_escape_string($conn, $password);
    $encrypt_password = sha1($secure_password);
  
    #Code is vulnerable, read about sql injection. 
    $sql = "SELECT * FROM useraccount WHERE user_name = '".$username."' AND user_pass = '".$encrypt_password."' AND user_status = 'Activated' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_errno($con)>0)
    {
      #handle error
    } else {
      $count = mysqli_num_rows($result);
      if($count > 0) 
      {
        $_SESSION['user_name'] = $username;
        #no need to save password in session vars.
        #$_SESSION['user_pass'] = $password;
        header("Location: ../user_profile.php?login%success");
        exit;
        
      }
    } 
  }
  $_SESSION['error_login'] = "Your username and password did not match in our system.";
  header("Location: ../login.php?error=didnotmatch");
 
?>