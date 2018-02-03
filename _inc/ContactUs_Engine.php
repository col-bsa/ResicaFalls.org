<?php
/*************************************
 * ResicaFalls.org                   *
 * Contact Us                        *
 * Submission Processing Engine      *
 *                                   *
 * David Gibbons                     *
 * 3/15/17                           *
 * me@davidgibbons.me                *
 *************************************/

require 'vendor/autoload.php';
use Mailgun\Mailgun;
use Medoo\Medoo;

require 'reCAPTCHA_Validator.php';

$mailgun = array();

/* * * * * * * * * * * * * * * * * * *
 *          ADMIN VARIABLES          *
 * * * * * * * * * * * * * * * * * * */

$recaptcha_secret = "6LeqLRkUAAAAAPWWBtUnxxJO2j841Sw6FRvbP2-E";

$mailgun['domain'] = "resicafalls.org";
$mailgun['key'] = "key-7282acc75265f51c56d8f821956316e8";
$mailgun['from'] = "ResicaFalls.org Contact Form <contact-form@resicafalls.org>";
$mailgun['to'] = "David Gibbons <david.gibbons@resicafalls.org>";
$mailgun['subject'] = "ResicaFalls.org Received a Message";

/* * * * * * * * * * * * * * * * * * *
 *    COLLECT HTML FORM POST DATA    *
 * * * * * * * * * * * * * * * * * * */

$user_data = array();
$return_data = array();

$user_data['name'] = trim($_POST['name']);
$user_data['email'] = trim($_POST['email']);
$user_data['message'] = trim($_POST['message']);
$user_data['recaptcha'] = $_POST['g-recaptcha-response'];

$user_data['address'] = $_SERVER['REMOTE_ADDR'];

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

$inputs = ['name', 'email', 'message'];

foreach ($inputs as $input)
{
	if(!isset($error_text))
	{
		if (empty($user_data[$input]))
			$error_text = ucfirst($input) . " was not received.";
	}
}

if(!isset($error_text))
{
	/* * * * * * * * * * * * * * * * * * *
	 *          EMAIL FORM DATA          *
	 * * * * * * * * * * * * * * * * * * */

	$send_text = "The following was submitted to ResicaFalls.org/contact-us." . 
		PHP_EOL . PHP_EOL . $user_data['message'] . PHP_EOL . PHP_EOL . $user_data['name'] . PHP_EOL . $user_data['email'];

	$mg = new Mailgun($mailgun['key']);

	$response = $mg->sendMessage($mailgun['domain'], array(
		'from'			=> $mailgun['from'],
		'to'			=> $mailgun['to'],
		'h:Reply-To'	=> $user_data['name'] . " <" . $user_data['email'] . ">",
		'subject'		=> $mailgun['subject'],
		'text'			=> $send_text
	));

	/* * * * * * * * * * * * * * * * * * *
	 *          DATABASE INSERT          *
	 * * * * * * * * * * * * * * * * * * */

	$database = new Medoo([
		'database_type' => 'sqlite',
		'database_file' => '../../database.sqlite'
	]);

	$database->insert('arc_contactform', [
		'name' => $user_data['name'],
		'email' => $user_data['email'],
		'message' => $user_data['message'],
		'orig_ip' => $user_data['address'],
	]);
}

/* * * * * * * * * * * * * * * * * * *
 *           RETURN STATUS           *
 * * * * * * * * * * * * * * * * * * */

if (empty($error_text))
	$return_data['success'] = true;
else
{
	$return_data['success'] = false;
	$return_data['error'] = $error_text;
}

echo json_encode($return_data);

?>
