<?php
include('databaseconfig.php');
$sqlquery="SELECT * FROM `tbl_file_details_api` where status='1'";
$result=mysqli_query($connection,$sqlquery);
$i=0;
$today=date("Y-m-d H:i:s");
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

  $fileurldetailsquery="select * from tbl_largefileurldetails where status=0 and filedetailsid='".$row["id"]."'";
  $fileurldetailsresult=mysqli_query($connection,$fileurldetailsquery);
  while($fileurldetails=mysqli_fetch_assoc($fileurldetailsresult)){
//    print_r($fileurldetails);
  $link = "https://api.mastergst.com/all/largefile?email=harmeet%40mathia.in";
  $link .= "&url=".urlencode($fileurldetails["ul"])."&ek=".urlencode($row["ek"])."&gstin=".$userDetails["gstin"]."&returnperiod=".$row["ret_period"];
//echo $link=urlencode($link);
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

  //$error=print_r($response);
  $result = json_decode($response,True);
  //print_r($result);
$comp_code=$row["comp_code"];
  $dir="../twoa/".$comp_code."/".date("Y-m-d");
  if(!is_dir($dir)){
      mkdir($dir);
  }


  if($result["status_cd"]==1){

    $data  = $result['data'];
    $b2btype = $data[$row["type"]];
    $header = $result['header'];
    $fp=$header['ret_period'];
    $ctin = $header['gstin'];
    $state_cd = $header['state_cd'];
    $error=$result['error'];
    $arr = array("fileIndex"=>"0","totalFiles"=>"0","gstin"=>$ctin,"fp"=>$fp,$row["type"]=>$b2btype);
    $jsonfile=json_encode($arr);
    $filename=$dir."/Large_file_".$fileurldetails["id"].$row["type"].$userDetails["gstin"].$row["ret_period"].$comp_code.date("Y_m_d_H_i_s_u").".json";
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    // echo $myfile;
    fwrite($myfile, $jsonfile);
    fclose($myfile);
    $insert_gstr_twoa = "INSERT  INTO tbl_gstr_twoa_api_detail (fp,typeofjson,fetchingdate,jsonurl,gstin,compcode,addedby,addeddate) VALUES ('".$fp."','".$row["type"]."','".$today."','".$filename."','".$userDetails["gstin"]."','".$comp_code."','".$_SESSION['user_id_tmp']."','".$today."')";
    mysqli_query($connection,$insert_gstr_twoa);
    $updatequery="update tbl_largefileurldetails set status='1',error_message='".$error."' where id='".$fileurldetails["id"]."'";
    mysqli_query($connection,$updatequery);

    }else{
      $updatequery="update tbl_largefileurldetails set status='2',error_message='".$error."' where id='".$fileurldetails["id"]."'";
      mysqli_query($connection,$updatequery);

    }
    }
    $updatequery="update tbl_file_details_api set status='3' where id='".$row["id"]."'";
      mysqli_query($connection,$updatequery);
  }
}

mysqli_close($connection);

?>
