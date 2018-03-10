<?php

   require ('../p_db_connection.php');

                  $info_retrieve = "SELECT * FROM useraccount";
                  $info_query = mysqli_query($conn, $info_retrieve);



                  if($info_query){
                    while ($info_result = mysqli_fetch_assoc($info_query)){
               


   // Array with names
   $a[] = $info_result['user_fname'];
   $a[] = $info_result['user_lname'];
   $a[] = $info_result['user_department'];
   $a[] = $info_result['user_position'];
   $a[] = $info_result['user_gender'];
   $a[] = $info_result['user_email'];
   $a[] = "GWT";
   $a[] = "HTML5";
   $a[] = "ibatis";
   $a[] = "Java";
   $a[] = "K programming language";
   $a[] = "Lisp";
   $a[] = "Microsoft technologies";
   $a[] = "Networking";
   $a[] = "Open Source";
   $a[] = "Prototype";
   $a[] = "QC";
   $a[] = "Restful web services";
   $a[] = "Scrum";
   $a[] = "Testing";
   $a[] = "UML";
   $a[] = "VB Script";
   $a[] = "Web Technologies";
   $a[] = "Xerox Technology";
   $a[] = "YQL";
   $a[] = "ZOPL";
   
   $q = $_REQUEST["q"];
   $hint = "";
   
   if ($q !== "") {
      $q = strtolower($q);
      $len = strlen($q);
      
      foreach($a as $name) {
		
         if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
               $hint = $name;
            }else {
               $hint .= ", $name";
            }
         }
      }
   }
   echo $hint === "" ? "Please enter a valid course name" : $hint;
}
?>