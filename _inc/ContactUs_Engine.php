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

$reCAPTCHA_Secret = "6LeqLRkUAAAAAPWWBtUnxxJO2j841Sw6FRvbP2-E";

/* * * * * * * * * * * * * * * * * * *
 *         REQUIRED INCLUDES         *
 * * * * * * * * * * * * * * * * * * */

require_once 'reCAPTCHA_Validator.php';

/* * * * * * * * * * * * * * * * * * *
 *    COLLECT HTML FORM POST DATA    *
 * * * * * * * * * * * * * * * * * * */

$Name = sanitize_input($_POST['name']);
$Email = sanitize_input($_POST['email']);
$Message = sanitize_input($_POST['message']);
$reCAPTCHA_FormResponse   = sanitize_input($_POST['g-recaptcha-response']);

$RemoteIP = $_SERVER['REMOTE_ADDR'];
	
date_default_timezone_set("America/New_York");
$TimeStamp = date('l jS \of F Y h:i:s A');

/* * * * * * * * * * * * * * * * * * *
 *           VALIDATE DATA           *
 * * * * * * * * * * * * * * * * * * */

$data = array();

if (empty($reCAPTCHA_FormResponse))
	$error_text = "reCAPTCHA was not received.";

if(!isset($error_text))
{
	$reCAPTCHAStatus   = isreCAPTCHAValid($reCAPTCHA_Secret, $reCAPTCHA_FormResponse, $RemoteIP);
	if ($reCAPTCHAStatus != true)
		$error_text = "reCAPTCHA was not verified.";
}

if(!isset($error_text))
{
	if (empty($Name))
		$error_text = "Name was not received.";
}

if(!isset($error_text))
{
	if (empty($Email))
		$error_text = "Email was not received.";
}

if(!isset($error_text))
{
	if (empty($Message))
		$error_text = "Message was not received.";
}

/* * * * * * * * * * * * * * * * * * *
 *          DATABASE INSERT          *
 * * * * * * * * * * * * * * * * * * */

/*
require_once 'Medoo/medoo.php';
$database_connection = new medoo();

$Reference_Num = $database_connection->insert("arc_contactfrm", array(
	"recipient" => $Recip,
	"name" => $Name,
	"email" => $Email,
	"subject" => $Subject,
	"message" => $Message,
	"orig_IP" => $IP,
	"timestamp" => $TimeStamp
));
*/

/* * * * * * * * * * * * * * * * * * *
 *          EMAIL FORM DATA          *
 * * * * * * * * * * * * * * * * * * */


/* * * * * * * * * * * * * * * * * * *
 *           RETURN STATUS           *
 * * * * * * * * * * * * * * * * * * */

if (empty($error_text)) {
	$data['success'] = false;
	$data['error']  = $error_text;
}

echo json_encode($data);

?>