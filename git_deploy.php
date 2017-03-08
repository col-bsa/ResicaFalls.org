<?php
/*
 * Resica Falls Scout Reservation
 * Git Deployment Script
 * ----------------------------------------------------
 * Triggers webserver deployment based on request from GitHub
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

	// Bash script location and name
	$bash_script = "../github_request.sh";
	$log_file = "../git_deploy.log";

	// Get user info
	$remote_addr = $_SERVER['REMOTE_ADDR'];
	$user_agent =  $_SERVER['HTTP_USER_AGENT'];
	$event = $_POST['X-GitHub-Event'];

	// Commands to run
	$commands = array(
		'echo ' . $remote_addr . ' > ' . $log_file,
		'echo ' . $user_agent . ' > ' . $log_file,
		'git pull > ' . $log_file . ' &'
	);

	// Run the commands for output
	$output = '';
	foreach($commands AS $command){
		// Run it
		$tmp = shell_exec($command);
	}
?>