	<?php
require('p_db_connection.php');
session_start();

$username = $_SESSION['user_name'];

 $sql = "SELECT * FROM useraccount LEFT JOIN log ON useraccount.user_name = log.log_user";
    $result = mysqli_query($conn, $sql) or die('sql: '.mysql_error()); 


       $sql_2 = "INSERT INTO log (log_id, log_user, log_entry, log_time) VALUES ('','".$username."', 'Logged Out', NOW() ) ";


        mysqli_query($conn, $sql_2) or die('SQL_2: '.mysql_error()); 
        
session_destroy();	
header("location: ../login.php?logged_out");

?>

