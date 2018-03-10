<?php 
require ("dashboard.php");
require('server/p_db_connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title> Notifications </title>
</head>
<body>
<br />
    <div class="row">
        <div class="col-xs-12">
			<h1>Notifications</h1>
			<?php
				$get_schedule_sql ="SELECT * FROM schedule  WHERE is_approved = 'no' ";
				//print_r($get_schedule_sql);
				$get_schedule_query = mysqli_query($conn, $get_schedule_sql);
				//$schedule_result = mysqli_fetch_assoc($get_schedule_query);
				$notification_count = ($get_schedule_query->num_rows);
			
			?>
			<ul style="list-style: none; padding: 0; margin: 0;">
				<li class="message-preview"><a href="#">
					<div class="media"><span class="pull-left"><img class="media-object"></span>
					<div class="media-body">
						<p style="margin-bottom: 0;">You have <?php echo $notification_count; ?> notification<?php echo $notification_count > 1 ? 's':''; ?>.</p>
					</div>
					</div>
					</a>
				</li>
				<?php
				//$show_only = 3;
				$settings_school_year = '2017-2018';
				$settings_day_start = 1;
				$settings_hour_start = '07';
				$settings_approved_not_approve = 'no';
				$settings_schedule_of = 'class';
				while ($schedule_result = mysqli_fetch_assoc($get_schedule_query)){
					//$show_only -= 1;
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
							'settings_approved_not_approve' => $settings_approved_not_approve,
							'settings_schedule_of' => $settings_schedule_of,
						);
						$url_notification = '&'.http_build_query($notification_param);
						echo $url_notification;
				?>
				<li class="message-preview"><a href="create_schedule.php?filterBy=Section<?php echo $url_notification; ?>">
					<div class="media"><span class="pull-left"><img class="media-object"></span>
					<div class="media-body">
						<h5 class="media-heading"><strong>New Schedules #<?php echo $schedule_result['schedule_id']; ?></strong></h5>
						<p class="small text-muted"> <?php echo date('F d, Y', strtotime($schedule_result['schedule_created'])); ?></p>
						<p>Need your approval. Click here.</p>
					</div>
					</div>
					</a>
				</li>
				<?php 
					}
				}
				?>
			</ul>
		</div>
	</div>
</body>
</html>