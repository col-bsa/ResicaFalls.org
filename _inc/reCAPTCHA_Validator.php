<?php

function isreCAPTCHAValid($reCAPTCHA_Secret, $reCAPTCHA_FormResponse, $RemoteIP) 
{
	try {

		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array('secret'   => $reCAPTCHA_Secret,
				 'response' => $reCAPTCHA_FormResponse,
				 'remoteip' => $RemoteIP
				 );

		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data) 
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		return json_decode($result)->success;
	}
	catch (Exception $e) {
		return null;
	}
}

?>