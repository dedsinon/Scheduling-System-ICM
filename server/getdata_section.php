<?php
require('../server/p_db_connection.php');


if (!empty($_POST["sc_id"])){
      $sc_id = $_POST["sc_id"];

      $query = "SELECT * FROM strand_course as sc LEFT JOIN section as sec ON sc.sc_id = sec.sc_id_fk WHERE sc_id = '".$sc_id."'";


      $results = mysqli_query($conn, $query);

      while($sc = mysqli_fetch_assoc($results)) {
?>
          <option value="<?php echo $sc["sec_id"] ;?>"><?php echo $sc["sec_name"]; ?></option>
<?php
      }
}
?>