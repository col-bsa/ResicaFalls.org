<?php

$day_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
$time_array = array("9-12", "1-5", "5-7", "7-9");
$needs_array = array("Lifeguard(s)", "PFDs", "Canoes", "Food", "Transportation");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '_inc/html_head.php'; ?>
		<meta name="description" content="Schedule a trip-plan with the team at Resica Falls Scout Reservation!" />
		<title>Trip-Plan Scheduler <?php include '_inc/var/site_name.php'; ?></title>
	</head>
	<body>
		<?php include '_inc/header.php'; ?>
		<?php include '_inc/nav.php'; ?>

		<div class="container content">
			<div class="row">
				<div class="col">
					<h1>Trip-Plan Scheduler</h1>
				</div>
			</div>
			<form id="tripplan-form">
				<div class="row">
					<div class="col">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Time</th>
<?php
	foreach($day_array as $day)
	{
		echo "<th>$day</th>";
	}
?>
								</tr>
							</thead>
							<tbody>
<?php
	foreach($time_array as $time)
	{
		echo "<tr>";
		echo "<td>$time</td>";
		foreach($day_array as $day)
		{
			echo "<td>";
			foreach($needs_array as $need)
			{
				echo "<input class=\"\" type=\"checkbox\" name=\"$day-$time-$need\" id=\"\"> $need<br>";
			}
			echo "<input class=\"form-control\" type=\"text\" name=\"$day-$time-troop\" id=\"\">";
			echo "</td>";
		}
		echo "</tr>";
	}
?>
							</tbody>
						</table>
					</div>	
				</div>
				<div class="form-group row">
					<div class="col-12 col-md-4">
						<button type="submit" class="btn btn-primary btn-block" id="forminput_update">Update</button>
					</div>
					<div class="col-12 col-md-4">
						<button type="reset" class="btn btn-danger btn-block" id="forminput_send">Clear</button>
					</div>
				</div>
				<div class="form-group row">
					
				</div>
			</form>
		</div>
		<?php include '_inc/footer.php'; ?>	
		<?php include '_inc/html_foot.php'; ?>
	</body>
</html>