<?php
/*************************************
 * ResicaFalls.org				   *
 * Contact Us						*
 * Submission Processing Engine	  *
 *								   *
 * David Gibbons					 *
 * 3/15/17						   *
 * me@davidgibbons.me				*
 *************************************/

/* * * * * * * * * * * * * * * * * * *
 *          ADMIN VARIABLES          *
 * * * * * * * * * * * * * * * * * * */

$recaptcha_secret = "6LeqLRkUAAAAAPWWBtUnxxJO2j841Sw6FRvbP2-E";
// SMTP information: [web root]/_inc/php-smtp/src/config/config.php

/* * * * * * * * * * * * * * * * * * *
 *         REQUIRED INCLUDES         *
 * * * * * * * * * * * * * * * * * * */

require_once 'reCAPTCHA_Validator.php';
require_once 'php-smtp/vendor/travis/ex/src/ex.php';
require_once 'php-smtp/src/models/Travis/SMTP.php';

/* * * * * * * * * * * * * * * * * * *
 *    COLLECT HTML FORM POST DATA    *
 * * * * * * * * * * * * * * * * * * */

$user_data = array();
$return_data = array();

$user_data['name'] = $_POST['name'];
$user_data['email'] = $_POST['email'];
$user_data['message'] = $_POST['message'];
$user_data['recaptcha'] = $_POST['g-recaptcha-response'];

$user_data['address'] = $_SERVER['REMOTE_ADDR'];
	
date_default_timezone_set("America/New_York");
$TimeStamp = date('l jS \of F Y h:i:s A');

/* * * * * * * * * * * * * * * * * * *
 *           VALIDATE DATA           *
 * * * * * * * * * * * * * * * * * * */

if (empty($user_data['recaptcha']))
	$error_text = "reCAPTCHA was not received.";

if(!isset($error_text))
{
	$recaptcha_status   = isreCAPTCHAValid($recaptcha_secret, $user_data['recaptcha'], $user_data['address']);
	if ($recaptcha_status != true)
		$error_text = "reCAPTCHA was not verified.";
}

if(!isset($error_text))
{
	if (empty($user_data['name']))
		$error_text = "Name was not received.";
}

if(!isset($error_text))
{
	if (empty($user_data['email']))
		$error_text = "Email was not received.";
}

if(!isset($error_text))
{
	if (empty($user_data['message']))
		$error_text = "Message was not received.";
}

if(!isset($error_text))
{

	/* * * * * * * * * * * * * * * * * * *
	 *          DATABASE INSERT          *
	 * * * * * * * * * * * * * * * * * * */

	/*
	require_once 'Medoo/medoo.php';
	$return_database_connection = new medoo();

	$Reference_Num = $return_database_connection->insert("arc_contactfrm", array(
		"recipient" => $Recip,
		"name" => $user_data['name'],
		"email" => $user_data['email'],
		"subject" => $Subject,
		"message" => $user_data['message'],
		"orig_IP" => $IP,
		"timestamp" => $TimeStamp
	));
	*/

	/* * * * * * * * * * * * * * * * * * *
 	*          EMAIL FORM DATA          *
 	* * * * * * * * * * * * * * * * * * */

	$send_text = "The following was submitted to ResicaFalls.org/contact-us." . 
		PHP_EOL . PHP_EOL . $user_data['message'] . PHP_EOL . PHP_EOL . $user_data['name'] . PHP_EOL . $user_data['email'];

	$mail = new Travis\SMTP(require __DIR__ . '/php-smtp/src/config/config.php');

	$mail->to('dgibbons@unamilodge.org');
	$mail->from('website@resicafalls.org', 'ResicaFalls.org'); // email is required, name is optional
	$mail->reply($user_data['email'], $user_data['name']);
	$mail->subject('ResicaFalls.org Contact Us Submission');
	$mail->text($send_text);
	$result = $mail->send_text();
	$result = $mail->send();

}

/* * * * * * * * * * * * * * * * * * *
 *           RETURN STATUS           *
 * * * * * * * * * * * * * * * * * * */

if (empty($error_text))
	$return_data['success'] = true;
else
{
	$return_data['success'] = false;
	$return_data['error']  = $error_text;
}

echo json_encode($return_data);

?>