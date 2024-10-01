<?php

$to = "tham@to";

$sub = "Enquiry";



$cname=$_POST["txtname"];

$cemail=$_POST["txtemailaddress"];

$comments=$_POST["txtComments"];



require("class.phpmailer.php");



$mail = new PHPMailer();



$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host = "mail.domain.com"; // SMTP server

$mail->SMTPAuth = true;

$mail->Username = "admin@domain.com";

$mail->Password = "xxxxxxxxx";



$body="Testing mail";



$mail->From = "admin@domain.com";

$mail->FromName = "Admin Domain.COM";



$mail->AddAddress($to);

$mail->Subject = $sub;

$mail->Body = $body;

$mail->WordWrap = 50;



if(!$mail->Send())

{

   echo 'Message was not sent.';

   echo 'Mailer error: ' . $mail->ErrorInfo;

}

else

{

   header('Location: ../index.html');

}

?> 