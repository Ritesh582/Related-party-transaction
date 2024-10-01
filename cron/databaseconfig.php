<?php
ob_start();
ini_set("max_execution_time",0);
ini_set('memory_limit', '-1');
date_default_timezone_set("Asia/Calcutta");
define('host','localhost');
define('username','root');
define('password','Urj@H!t#123');
define('database','savvyeh9_gst2a');
define("FromEmail","admin@supportgst.com");
$connection=mysqli_connect(host,username,password,database);

function getrecord($table,$column,$conditon){
    $sql="select ".$column." from ".$table." ".$conditon;
    $result1=mysqli_query($GLOBALS["connection"], $sql);
    $data=mysqli_fetch_array($result1);
    return $data[0];
}

function sendEmail($to,$subject,$bodyMsg){
	$message = $bodyMsg;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".FromEmail."\r\n";
	 mail($to, $subject, $message, $headers);
}
?>
