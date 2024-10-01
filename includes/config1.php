<?php
//ini_set('display_errors', 1);
//ini_set('display_errors', 1);
//error_reporting(-1);
error_reporting(0);
set_time_limit(0);
session_start();

define('DB_SERVER', 'localhost'); //Localhost:3309

switch($_SERVER['SERVER_NAME'])
{
    case 'phpwork.info':
        break;
    case 'mathia.in':
        define('DB_SERVER_USERNAME','mathimjs_prj9'); //mathimjs_gst
        define('DB_SERVER_PASSWORD','prj9@29jUn2017!'); //gsT1@16aPr2017!
        define('DB_DATABASE','mathimjs_project9');
        define('FL_PATH','project9'); 
        $docRoot = $_SERVER['DOCUMENT_ROOT'].'/project9/';
        define('DOMAIN','http://mathia.in/project9');
        break;
    case 'www.supportgst.com':
        define('DB_SERVER_USERNAME','');
        define('DB_SERVER_PASSWORD','');
        define('DB_DATABASE','mathimjs_project9');
        define('FL_PATH','project9'); 
        $docRoot = $_SERVER['DOCUMENT_ROOT'].'/project9/';
        define('DOMAIN','https://www.supportgst.com/project9');
        break;
    case 'localhost':
        define('DB_SERVER_USERNAME','root');
        define('DB_SERVER_PASSWORD','');
        define('DB_DATABASE','mathimjs_project9');
        define('FL_PATH','project9');
        $docRoot = $_SERVER['DOCUMENT_ROOT'].'/project9/';
        define('DOMAIN','http://localhost/project9');
        break;
    default:
        break;
}

include ($docRoot."includes/classes/class-db.php");
include ($docRoot."includes/functions/general_function.php");
//include ($docRoot."includes/functions/email.php");
$Db = new DB();
/*
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$today_datetime = date('Y-m-d H:i:s');
$year = date('Y-m-d HH:mm:ss'); 
$filePath = $_SERVER['DOCUMENT_ROOT'].'/p2p-upload/upload/';
$imagePath ="img/";
$filePath2= $_SERVER['DOCUMENT_ROOT'].'/p2p-upload/uploads/';
define("ATTEMPTS_NUMBER", "5");
define("TIME_PERIOD", "1");
define('CP_TITLE','GST | support management');
define('CP_FOOTER',"Developed By <a href='#' target=_blank style='color:#0066CC'>Savvy Business Solution Pvt Ltd.</a>");
//define('DOMAIN','http://mathia.in/project9');
//define('FromEmail','Kotak.GST@kotak.com');// Commented By AJAY 10/09/2017
  define('FromEmail','Tech@savvybiz.in');
//date_default_timezone_set('Asia/Calcutta');
*/
?>