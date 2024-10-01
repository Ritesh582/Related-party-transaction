<?php

include ('../includes/config.php');
if($_POST['txt_email']!="")
{
	$mail_subject=$_POST['txt_subject'];
	$mail_message=$_POST['txt_message'];
	$mail_contactno=$_POST['txt_contactno'];
	$email=$_POST['txt_email'];
	$to = "gst@savvybiz.in";//"inquiry@support-tds.com"; //"amj.webit@gmail.com";
	$subject = $mail_subject;
	$message = $mail_message . "  Contact No : " . $mail_contactno;
	$from = $email;
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
	
	header("location:reach_us.php?error=0");
	
}
?>