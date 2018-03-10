<?php
require('p_db_connection.php');

$id = $_POST['update_subj_id'];
$name = $_POST['update_subj_name'];
$code = $_POST['update_subj_code'];
$unit = $_POST['update_subj_unit'];
$term = $_POST['update_subj_term'];
$sc = $_POST['update_sc_id'];
$class = $_POST['update_room_class'];

if (isset($_POST['update'])){

	
	$update_subj = "UPDATE subject SET subj_name ='".$name."', subj_code ='".$code."', subj_unit ='".$unit."', subj_term ='".$term."', room_classification ='".$class."', sc_id = '".$sc."' WHERE subj_id = '".$id."' ";

	$update_subj_query = mysqli_query($conn, $update_subj);
	
	if ($update_subj_query) {
?>
	
	<script>
		window.location.href='../subject_strand.php';
		alert('Successfully Edited');
	</script> 
	
<?php
}
else
{
	echo "Failed: ".mysqli_error($conn);
}
}

?>
