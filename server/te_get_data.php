<?php
require('../server/p_db_connection.php');


if (!empty($_POST["teacher_id"])){
	$teach_id = $_POST["teacher_id"];

	$query = "SELECT * FROM schedule as sc LEFT JOIN teacher as te ON sc.teacher_id_fk = te.teacher_id LEFT JOIN subject as subj ON sc.subject_id_fk = subj.subj_id WHERE te.teacher_id = '".$teach_id."' ";
	
	$results = mysqli_query($conn, $query);

	while($result = mysqli_fetch_assoc($results)) {

		
?>
					<th style="text-align: center;">Code</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Units</th>
                    <th style="text-align: center;">Section</th>
                    <th style="text-align: center;">Days</th>
                    <th style="text-align: center;">Time</th>
                    <th style="text-align: center;">Room</th>

		 <tr>
                    <td><?php echo $result['subj_code'];?></td>
                    <td><?php echo $result['day_name'];?></td>
                    <td><?php echo $result['sec_code'];?></td>
                    <td><?php echo $result['teacher_fullname'];?></td>
                    <td><?php echo $result['subj_code'];?></td>
                    <td><?php echo $result['room_number'];?></td>
                    <td><?php echo $new_start_time;?></td>
                    <td><?php echo $new_end_time;?></td>
                   </tr>
<?php
}

}
?>