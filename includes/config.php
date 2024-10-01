<?php
//ini_set('display_errors', 1);
//ini_set('display_errors', 1);
//error_reporting(0);
ob_start();
ini_set('display_errors', 1);
ini_set('display_errors', 1);
error_reporting(0);

ini_set('log_errors', 0); 
set_time_limit(0);
// session_set_cookie_params(0, "/bank-recon/", "savvysystems.in", true, true);
session_start();

// Date in the past
header("Expires: Mon, 26 Jul 2013 05:00:00 GMT");
// always modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("X-Frame-Options: SAMEORIGIN");

// HTTP/1.0
header("Pragma: no-cache");
header("Cache-control:public");
define('DB_SERVER', 'localhost'); //Localhost:3309


/*
    case 'www.supportgst.com':
        define('DB_SERVER_USERNAME','');
        define('DB_SERVER_PASSWORD','');
        define('DB_DATABASE','savvyeh9_gst2a');
        define('FL_PATH','project10');
        $docRoot = $_SERVER['DOCUMENT_ROOT'].'/project10/';
        define('DOMAIN','https://www.supportgst.com/project10');
        break;
*/

switch($_SERVER['SERVER_NAME'])
{
        case 'savvysystems.in':
            define('DB_SERVER_USERNAME','root');
            define('DB_SERVER_PASSWORD','Urj@H!t#123');
            define('DB_DATABASE', 'savvysystems_rpt');
            define('FL_PATH', 'rpt');
            $docRoot = $_SERVER['DOCUMENT_ROOT'] . '/rpt/';
            define('DOMAIN', 'https://savvysystems.in/rpt');
            break;
            case 'localhost':
                define('DB_SERVER_USERNAME','root');
                define('DB_SERVER_PASSWORD','');
                define('DB_DATABASE', 'savvysystems_rpt');
                define('FL_PATH', 'rpt');
                $docRoot = $_SERVER['DOCUMENT_ROOT'] . '/rpt/';
                define('DOMAIN', 'http://localhost/rpt');
                break;
        
        case 'www.savvysystems.in':
            define('DB_SERVER_USERNAME','root');
            define('DB_SERVER_PASSWORD','Urj@H!t#123');
            define('DB_DATABASE', 'savvysystems_rpt');
            define('FL_PATH', 'rpt');
            $docRoot = $_SERVER['DOCUMENT_ROOT'] . '/rpt/';
            define('DOMAIN', 'https://www.savvysystems.in/rpt');
            break;
    default:
        break;
}

define('FILEPATH_DOMAIN','http://support-tds.com.in'.'/p2p-upload/upload/');
define('FILEPATH2_DOMAIN',$_SERVER['SERVER_NAME'].'/p2p-upload/upload2/');
include ($docRoot."includes/classes/class-db.php");
include ($docRoot."includes/functions/general_function.php");
include ($docRoot."includes/functions/email.php");

define("GSP_URL","https://supportgst.com/invoice_reader_systems/api/v1.0/");
define("CLIENT_ID", "savvy");
define("CLIENT_SECRET", "savvy@2365855");

$Db = new DB();

date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$today_datetime = date('Y-m-d H:i:s');
$year = date('Y-m-d HH:mm:ss');
$filePath = $_SERVER['DOCUMENT_ROOT'].'/p2p-upload/upload/';
$imagePath ="img/";
$filePath2= $_SERVER['DOCUMENT_ROOT'].'/p2p-upload/uploads/';
define("ATTEMPTS_NUMBER", "5");
define("API_URL", "https://api.mastergst.com/");
define("API_COST", "0.10");

define("TIME_PERIOD", "1");
define('CP_TITLE','Related Party Transaction| support management');
define('CP_FOOTER',"Developed By <a href='#' target=_blank style='color:#0066CC'>Savvy Business Solution Pvt Ltd.</a>");
//define('DOMAIN','http://mathia.in/project9');
//define('FromEmail','Kotak.GST@kotak.com');// Commented By AJAY 10/09/2017
  define('FromEmail','Tech@savvybiz.in');

//date_default_timezone_set('Asia/Calcutta');

//******* Added on 19-AUG-2017, Pratik. For Cross Site Scripting [XSS] hacking prevention Starts Here ********//

//require_once $_SERVER['DOCUMENT_ROOT'].'/gst2a/HTMLPurifier/library/HTMLPurifier.auto.php';
//$config = HTMLPurifier_Config::createDefault();
//$purifier = new HTMLPurifier($config);

// Checking for Special Caracters in POST Variables
//foreach ($_POST as $PostKey => $PostValue)
//	$_POST[$PostKey] = $purifier->purify($_POST[$PostKey]);

// Checking for Special Caracters in GET Variables
//foreach ($_GET as $GetKey => $GetValue)
//	$_GET[$GetKey] = $purifier->purify($_GET[$GetKey]);
//******* For Cross Site Scripting [XSS] hacking prevention Ends Here ********//
?>
