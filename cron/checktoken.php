<?php
include('databaseconfig.php');

$sqlquery="SELECT * FROM `tbl_gst_userdetail` where autorefershtoken='1' and flag_token='0' and tokentime!='0000-00-00 00:00:00' and (tokentime + INTERVAL 330 MINUTE) <= '".date("Y-m-d H:i:s")."' and (tokentime + INTERVAL 360 MINUTE) > '".date("Y-m-d H:i:s")."'";
$tokenresult=mysqli_query($connection,$sqlquery);
$i=0;
$total=mysqli_num_rows($tokenresult);
if($total>0){

  $subject= "Auto Refersh Token Details";
  $bodyMsg="<html><head></head><body style='background-color:#DCDCDC;font-weight:400;'>";
  $bodyMsg.="<div style='text-align:center'>Token Refersh</div><br/>";
  $bodyMsg.="<table style='width:90%;margin:auto;border:1px solid #000000'><tr><td>Sr No</td><td>Company Name</td><td>Username</td><td>Token</td><td>Token Time</td><td>Status</td><td>Error Message</td></tr>";
  $status_error='- All Token has been Successfully Reset';
while($row=mysqli_fetch_assoc($tokenresult)){

  /*
  $tokentime=$row["tokentime"];
  $tokentime = strtotime($tokentime);
  $beforehalfhourexpirytokentime = strtotime("+5 hours", $tokentime);
  $beforehalfhourexpirytokentime=date('Y-m-d H:i:s', $beforehalfhourexpirytokentime);


  $expirytokentime = strtotime("+6 hours", $tokentime);
  $expirytokentime=date('Y-m-d H:i:s', $expirytokentime);
 //echo $beforehalfhourexpirytokentime."<".date('Y-m-d H:i:s')." && ".$expirytokentime.">".date("Y-m-d H:i:s");
  //
   if($beforehalfhourexpirytokentime<date('Y-m-d H:i:s') && $expirytokentime>date("Y-m-d H:i:s")){
        print_r($row);*/
      $status=0;
			 $username = $row['gst_username'];
			$stcd = $row['state_cd'];
			$email = $row['email'];
			$ip = $row["ip_address"];
			$clientid = $row['client_id'];
			$clientsecret = $row['client_secret'];
      $txn = $row['txn'];

if($txn!=''){
$link = "https://api.mastergst.com/authentication/refreshtoken?email=harmeet%40mathia.in";
$link .= "&otp=".$otp;
$ch = curl_init();
$header = array(
 'Accept: application/json',
'ip_address: '.$ip,
'txn: '.$txn,
'state_cd:'.$stcd,
'gst_username: '.$username,
	 'client_id: '.$clientid,
	 'client_secret: '.$clientsecret,
	 'Content-Type: application/json'
 );
//print_r($header);

 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 curl_setopt($ch, CURLOPT_URL, $link);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 $response = curl_exec($ch);
// $json = json_encode( array( 'test' => 'test' ));

 $result = json_decode($response,True);

 $arr = (array)$result;
$status_cd=$arr['status_cd'];
if($status_cd!=1){
  $status_error='-Some token as been failed';
}
//echo "status=".$arr['status_cd'];
//echo "status description=".$arr['status_desc'];
//$ar = (array)$arr['header'];

//echo $ar['s1tjCd'];
$txn = $result['header']['txn'];
$status=$arr['error']["message"];

if($status_cd==1){
$gstuname = $ar['gst_username'];
$tokentime = date("Y-m-d H:i:s");
$update = "update tbl_gst_userdetail set txn='".$txn."',tokentime='".$tokentime."',flag_token='0' where gst_username='".$username."'";
mysqli_query($connection,$update);

}else{
// failed

$update = "update tbl_gst_userdetail set flag_token='1',error_message='".$status."' where gst_username='".$username."'";
mysqli_query($connection,$update);


}
}else{
  $update = "update tbl_gst_userdetail set flag_token='1',error_message='".$status."' where gst_username='".$username."'";
  mysqli_query($connection,$update);
}
//}
++$i;
$companyname=getrecord("tbl_company","name","where company_code='".$row['comp_code']."'");
$bodyMsg.="<tr><td style='border:1px solid #000000'>".$i."</td><td style='border:1px solid #000000'>".$companyname."</td><td style='border:1px solid #000000'>".$row['gst_username']."</td><td style='border:1px solid #000000'>".$txn."</td><td style='border:1px solid #000000'>".$tokentime."</td><td style='border:1px solid #000000'>".$arr['status_desc']."</td><td style='border:1px solid #000000'>".$status."</td></tr>";
}
$bodyMsg.="</body></html>";
$subject.=$status_error;
$to="bhavin.sheth@mathia.in,aarti@mathia.in,pramod@mathia.in,ashraf@mathia.in";
if($status_cd!=1){
sendEmail($to,$subject,$bodyMsg);
}
}

mysqli_close($connection);

?>
