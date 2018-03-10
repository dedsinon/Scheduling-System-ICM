<?php
require('p_db_connection.php');

$section_id = $_POST['update_section_id'];
$section_name = $_POST['update_section_name'];
$section_code = $_POST['update_section_code'];
$section_sc = $_POST['update_section_sc'];

$update_section = "UPDATE section SET sec_name = '".$section_name."', sec_code ='".$section_code."', sc_id_fk ='".$section_sc."' WHERE sec_id = '".$section_id."'";

$update_section_query = mysqli_query($conn, $update_section);

if ($update_section_query) {
	?>
	
	<script>
	window.location.href='../section.php?success=edit';
	alert('Successfully Edited');
	
	</script> 
	<?php

}
else
{
	echo "Failed: ".mysqli_error($conn);
}


?>