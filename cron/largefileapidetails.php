<?php
include('databaseconfig.php');
$plus20=date('Y-m-d H:i:s');
echo $sqlquery="SELECT * FROM `tbl_file_details_api` where status='0' and (create_at + INTERVAL 21 MINUTE)<= '".$plus20."'";
$result=mysqli_query($connection,$sqlquery);
$i=0;
$total=mysqli_num_rows($result);
if($total>0){
while($row=mysqli_fetch_assoc($result)){

  $userquery="SELECT * FROM `tbl_gst_userdetail` where gst_username='".$row["gst_username"]."'";
  $userDetails=mysqli_fetch_assoc(mysqli_query($connection,$userquery));

  $ip=$row["ip"];
  $txn=$userDetails["txn"];
  $stcd=$userDetails["state_cd"];
  $username=$row["gst_username"];
  $clientid=$userDetails["client_id"];
  $clientsecret=$userDetails["client_secret"];

  $link = "https://api.mastergst.com/all/filedet?email=harmeet%40mathia.in";
  $link .= "&gstin=".$userDetails["gstin"]."&returnperiod=".$row["ret_period"]."&token=".$row["token"];

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


   curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
   curl_setopt($ch, CURLOPT_URL, $link);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  $response = curl_exec($ch);
  $result = json_decode($response,True);
  print_r($result);
  if($result["status_cd"]==1){

    mysqli_query($connection,"Start Transaction");

  for($i=0;$i<count($result["data"]["urls"]);$i++){
  $ul=$result["data"]["urls"][$i]["ul"];
  $ic=$result["data"]["urls"][$i]["ic"];
  $hash=$result["data"]["urls"][$i]["hash"];

  $insertquery="insert into tbl_largefileurldetails (filedetailsid,ul,invoice_count,hash,comp_code,create_at) values ('".$row["id"]."','".addslashes($ul)."','".$ic."','".addslashes($hash)."','".addslashes($row["comp_code"])."','".date("Y-m-d H:i:s")."')";
  mysqli_query($connection,$insertquery);
  }
  $ek=$result["data"]["ek"];
  $fc=$result["data"]["fc"];
  $updatequery="update tbl_file_details_api set status='1',ek='".addslashes($ek)."',fc='".$fc."',error_message='".$result["error"]["message"]."' where id='".$row["id"]."'";
  mysqli_query($connection,$updatequery);
  mysqli_query($connection,"Commit");


    }else{
      $updatequery="update tbl_file_details_api set status='2',error_message='".$result["error"]["message"]."' where id='".$row["id"]."'";
      mysqli_query($connection,$updatequery);

    }
  }
}

mysqli_close($connection);

?>
