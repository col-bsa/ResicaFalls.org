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
	$output = nl2br(htmlentities(trim($output)));
	$command = 'git log -1 --pretty=%H';
	$hash_out = shell_exec($command);
	$link = "<a href='https://github.com/col-bsa/ResicaFalls.org/commit/" . $hash_out . "''>Click here for more information.</a>"
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Git Status</title>
</head>
<body>
<h1>Git Deployment Status</h1>
	<p>
<?php
	echo $output;
?>
	</p>
	<p>
<?php
	echo $link;
?>
	</p>
</body>
</html>