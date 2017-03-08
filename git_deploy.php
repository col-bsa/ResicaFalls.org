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

	// Log user info
	$user_log = "Remote IP: " . $remote_addr . "\r\nUA: " . $user_agent "\r\n";
	file_put_contents ($log_file, $data, FILE_APPEND | LOCK_EX);

	// Update local repository
	$command = 'git pull > ' . $log_file . ' &'
	shell_exec($command);

?>