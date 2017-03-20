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

/* * * * * * * * * * * * * * * * * * *
 *         REQUIRED INCLUDES         *
 * * * * * * * * * * * * * * * * * * */

require_once 'reCAPTCHA_Validator.php';
require_once 'php-smtp/vendor/travis/ex/src/ex.php';
require_once 'php-smtp/src/models/Travis/SMTP.php';

/* * * * * * * * * * * * * * * * * * *
 *    COLLECT HTML FORM POST DATA    *
 * * * * * * * * * * * * * * * * * * */

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$recaptcha_response = $_POST['g-recaptcha-response'];

$remote_ip = $_SERVER['REMOTE_ADDR'];
	
date_default_timezone_set("America/New_York");
$TimeStamp = date('l jS \of F Y h:i:s A');

/* * * * * * * * * * * * * * * * * * *
 *           VALIDATE DATA           *
 * * * * * * * * * * * * * * * * * * */

$data = array();
/*
if (empty($recaptcha_response))
	$error_text = "reCAPTCHA was not received.";

if(!isset($error_text))
{
	$reCAPTCHAStatus   = isreCAPTCHAValid($recaptcha_secret, $recaptcha_response, $remote_ip);
	if ($reCAPTCHAStatus != true)
		$error_text = "reCAPTCHA was not verified.";
}

if(!isset($error_text))
{
	if (empty($name))
		$error_text = "Name was not received.";
}

if(!isset($error_text))
{
	if (empty($email))
		$error_text = "Email was not received.";
}

if(!isset($error_text))
{
	if (empty($message))
		$error_text = "Message was not received.";
}
*/
/* * * * * * * * * * * * * * * * * * *
 *          DATABASE INSERT          *
 * * * * * * * * * * * * * * * * * * */

/*
require_once 'Medoo/medoo.php';
$database_connection = new medoo();

$Reference_Num = $database_connection->insert("arc_contactfrm", array(
	"recipient" => $Recip,
	"name" => $name,
	"email" => $email,
	"subject" => $Subject,
	"message" => $message,
	"orig_IP" => $IP,
	"timestamp" => $TimeStamp
));
*/

/* * * * * * * * * * * * * * * * * * *
 *          EMAIL FORM DATA          *
 * * * * * * * * * * * * * * * * * * */

$send_text = "The following was submitted to ResicaFalls.org/contact-us." . 
	PHP_EOL . PHP_EOL . $message . PHP_EOL . PHP_EOL . $name . PHP_EOL . $email;

$mail = new Travis\SMTP(require __DIR__ . '/php-smtp/src/config/config.php');
use Travis\SMTP;

$mail = new SMTP($config);
$mail->to('dgibbons@unamilodge.org');
$mail->from('website@resicafalls.org', 'ResicaFalls.org'); // email is required, name is optional
//$mail->reply($email, $name);
$mail->subject('ResicaFalls.org Contact Us Submission');
$mail->text($send_text);
$result = $mail->send_text();
$result = $mail->send();

/* * * * * * * * * * * * * * * * * * *
 *           RETURN STATUS           *
 * * * * * * * * * * * * * * * * * * */

if (empty($error_text))
	$data['success'] = true;
else
{
	$data['success'] = false;
	$data['error']  = $error_text;
}


echo json_encode($data);

?>