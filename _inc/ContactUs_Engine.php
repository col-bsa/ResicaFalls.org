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

$mailgun = array();

/* * * * * * * * * * * * * * * * * * *
 *          ADMIN VARIABLES          *
 * * * * * * * * * * * * * * * * * * */

$recaptcha_secret = "6LeqLRkUAAAAAPWWBtUnxxJO2j841Sw6FRvbP2-E";

$mailgun['domain'] = "resicafalls.org";
$mailgun['key'] = "key-7282acc75265f51c56d8f821956316e8";
$mailgun['from'] = "ResicaFalls.org Contact Form <website@resicafalls.org>";
$mailgun['to'] = "dgibbons@unamilodge.org";
$mailgun['subject'] = "ResicaFalls.org Received a Message";

/* * * * * * * * * * * * * * * * * * *
 *         REQUIRED INCLUDES         *
 * * * * * * * * * * * * * * * * * * */

require_once 'reCAPTCHA_Validator.php';
require 'vendor/autoload.php';
use Mailgun\Mailgun;

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

	$mg = Mailgun::create($mailgun_key);

	$mg->message()->send($mailgun['domain'], [
		'from'			=> $mailgun['from'],
		'h:Reply-To'	=> "$user_data['name'] <$user_data['email']>",
		'to'			=> $mailgun['to'],
		'subject'		=> $mailgun['subject'],
		'text'			=> $send_text
	]);

	$dns = $mg->domains()->show($mailgun['domain'])->getInboundDNSRecords();

	foreach ($dns as $record) {
		echo $record->getType();
	}

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