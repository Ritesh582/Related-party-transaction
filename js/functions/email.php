<?php
function sendEmail($to,$subject,$bodyMsg){	
	$message = $bodyMsg;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".FromEmail."\r\n";
	 @mail($to, $subject, $message, $headers);
}
function sendEmails($to,$subject,$bodyMsg,$from){	
	$message = $bodyMsg;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".$from."\r\n";
	@mail($to, $subject, $message, $headers);
}
?>