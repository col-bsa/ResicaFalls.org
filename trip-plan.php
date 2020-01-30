<?php

$day_array = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
$time_array = array("9-12", "1-5", "5-7", "7-9");
$needs_array = array("Lifeguard", "PFDs", "Canoes", "Food", "Transport");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '_inc/html_head.php'; ?>
		<meta name="description" content="Schedule a trip-plan with the team at Resica Falls Scout Reservation!" />
		<title>Trip-Plan Schedule <?php include '_inc/var/site_name.php'; ?></title>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5R8JMMS');</script>
		<!-- End Google Tag Manager -->
	</head>
	<body>
		<?php include '_inc/header.php'; ?>
		<?php include '_inc/nav.php'; ?>

		<div class="container content">
			<div class="row">
				<div class="col">
					<h1>Trip-Plan Schedule</h1>
				</div>
			</div>
			<form id="tripplan-form">
				<div class="row">
					<div class="col">
						<table class="table table-responsive">
							<thead class="thead-inverse">
								<tr>
									<th class="text-center">Time</th>
<?php
	foreach($day_array as $day)
	{
		echo "<th class=\"text-center\">$day</th>\n";
	}
?>
								</tr>
							</thead>
							<tbody>
<?php
	foreach($time_array as $time)
	{
		echo "<tr>\n";
		echo "<td class=\"align-middle\">$time</td>\n";
		foreach($day_array as $day)
		{
			echo "<td>";
			foreach($needs_array as $need)
			{
				echo "<input class=\"\" type=\"checkbox\" name=\"$day-$time-$need\" id=\"\"> $need<br>";
			}
			echo "<input class=\"form-control\" type=\"text\" name=\"$day-$time-troop\" id=\"\" placeholder=\"Unit #\" value=\"\">";
			echo "</td>\n";
		}
		echo "</tr>\n";
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