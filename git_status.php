<?php
/*
 * Resica Falls Scout Reservation
 * Git Deployment Status Script
 * ----------------------------------------------------
 * Shows last deployed commit from GitHub
 * ----------------------------------------------------
 * |Version History|
 *
 * 1.0
 * 3/8/17
 *
 * ----------------------------------------------------
 * Questions?
 * David Gibbons - me@davidgibbons.me
 * ----------------------------------------------------
 */

	// Find status
	$command = 'git log -1';
	$output = shell_exec($command);
	$output = htmlentities(trim($output));

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>GIT STATUS</title>
</head>
<body>
<h1>Git Deployment Status</h1>
	<p>
<?php
	echo $output;
?>
	</p>
</body>
</html>