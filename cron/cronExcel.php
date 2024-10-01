<?php
include('databaseconfig.php');
$sqlquery="SELECT start_time,end_time FROM tbl_cron_time where id='1'";
$cronrow=mysqli_fetch_array(mysqli_query($connection,$sqlquery));
$currenttime=date('H:i:s');
if($currenttime>=$cronrow['start_time'] && $currenttime<=$cronrow['end_time']){
$query='select exportExcel,comp_code from tbl_company_recon_table_master where exportExcel="0"';
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result)){
  foreach($row as $key =>$value){
    if($value==0){
      $query1='select process_files from tbl_recon_process_name where status="'.$key.'" limit 1';
      $result1=mysqli_query($connection,$query1);
      $process_filesarray=mysqli_fetch_assoc($result1);
      $filename=$process_filesarray["process_files"];
      $output = shell_exec('ps axu | grep php');
      if(!strpos($output,$filename)){

      $path='/home/supportgst/public_html/gst2a/';
      $processfile=$path.$filename;
      echo $processfiles=exec('php -q '.$processfile.' &');

      /*header("location: ../".$filename."?processoption=cron&comp_code=".$row["comp_code"]);
      exit;*/
      }
      exit;

      //  echo $process_files=getrecord("tbl_recon_process_name","process_files","where status='".$value."'");
    }

  }
}
}

?>
