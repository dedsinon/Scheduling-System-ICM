<?php

include('p_db_connection.php');

mysqli_select_db($conn, "informatics");

$sql = "UPDATE subject SET subj_status = '".$_GET['status']."' where subj_id = '".$_GET['subjid']."' ";

$query = mysqli_query($conn, $sql) or die("Activate / Deactivate Failed");

header("Location: ../subject_course.php");

?>