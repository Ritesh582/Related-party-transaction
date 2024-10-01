<?php
ini_set('max_execution_time', '800'); //300 seconds = 5 minutes
include('databaseconfig.php');
$dirdate = date('Y-m-d');
$path="/home/supportgst/public_html/gst2a/";
$today=date("Y-m-d");
$return_year=date("Y");
$return_mon=date("m");
$upd_invalid_twoa_query="update tbl_json_download_request set status_desc='invalid year',status=2 WHERE ((return_year=".$return_year." and return_month>".$return_mon.") or return_year>".$return_year.")";
mysqli_query($connection,$upd_invalid_twoa_query);
$multipleRequest=5;
$sql1="SELECT * FROM `tbl_json_download_request` where status=0  limit 100";
$query1=mysqli_query($connection,$sql1);

$total=mysqli_num_rows($query1);

if($total>0){
while($row1=mysqli_fetch_assoc($query1)){
$status=2;
$file="";
$dir = getrecord("tbl_company","name","where company_code='".$row1["comp_code"]."'");
$companycode=$row1["comp_code"];
if($row1["request_type"]=="gstr2b"){
//gst2B
$maindir="twob/";

if(!(is_dir($path.$maindir.$dir))){
  mkdir($path.$maindir.$dir);
}  
if(!is_dir($path.$maindir.$dir.'/'.$dirdate)){
    mkdir($path.$maindir.$dir.'/'.$dirdate);
}
	
 $username=$row1["username"];
 $sql = "select * from tbl_gst_userdetail where gst_username='" . $username . "' and comp_code='".$row1["comp_code"]."'";
            // echo $sql."=".$ret."<br/>";
            $query = mysqli_query($connection,$sql);
            if($row = mysqli_fetch_assoc($query)) {
                //echo "<br/>";
                //print_r($row);

                $txn = $row["txn"];
                $email = $row['email'];
                $ipaddress = $row["ip_address"];
                $ip = $ipaddress;
                $clientid = $row['client_id'];
                $clientsecret = $row['client_secret'];
                $companycode = $row['comp_code'];
                $stcd=$row["state_cd"];
                $gstin=$row["gstin"];
            }
            $gstno = $gstin;


			$rmonth = $row1["return_month"];
            $ryear = $row1['return_year'];
            if ($rmonth < 10) {
                $rmonth = '0' . $rmonth;
            }
            $ret = $rmonth . $ryear;
			
$link = "https://api.mastergst.com/".$row1["request_type"]."/".$row1["invoice_type"];
$link .= "?email=harmeet@mathia.in";
$link .= "&gstin=".$gstin;
$link .= "&rtnprd=".$ret;
if(isset($row1["file_num"]) && !empty($row1["file_num"])){
  $link .= "&filenum=".$row1["file_num"];

}

$ch = curl_init();
$header = array(
  'Accept: application/json',
  'ip_address: '.$ip,
  'state_cd: '.$stcd,
  'txn: '.$txn,
  'gst_username: '.$username,
  'client_id: '.$clientid,
  'client_secret: '.$clientsecret,
  'Content-Type: application/json'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
//print_r($response);
$json=json_decode($response,true);
$status_desc=$json['status_desc'];
$message=$json["error"]["message"];
$validstatus = $json['status_cd'];
if($validstatus!='0'){
	$status=1;
    $data  = $json['data'];
    $fc=$data["data"]["fc"];
   
    $header = $json['header'];
    $fp=$header['ret_period'];
    $ctin = $header['gstin'];
    $state_cd = $header['state_cd'];
    $jsonfile = json_encode($data);
    $file = $path.$maindir.$dir.'/'.$dirdate."/gst2b_".$companycode.$ctin.$state_cd.$rmonth.$ryear.$row1["id"]."_".date("Y-m-d H:i:s").".json";

    $insert_gstr_twob = "INSERT  INTO tbl_gstr_twob_api_detail (fp,typeofjson,fetchingdate,jsonurl,gstin,compcode,addedby,addeddate) VALUES ('".$fp."','twob','".$today."','".$file."','".$ctin."','".$companycode."','".$row1["added_by"]."','".$today."')";
    mysqli_query($connection, $insert_gstr_twob);
    $myfile = fopen($file, "w") or die("Unable to open file!");
    // echo $myfile;
    fwrite($myfile, $jsonfile);
    fclose($myfile);


    //fc logic for twob

    if(isset($fc) && !empty($fc)){
      
      for($i =1; $i <=$fc; $i++ ){
         
        $insertquery="INSERT INTO `tbl_json_download_request`(`return_month`,`return_year`,invoice_type, `username`, `status`,request_type,file_num,`comp_code`,`added_by`,`added_date`) VALUES ('".$row1["return_month"]."', '".$row1["return_year"]."','all','".$row1["username"]."', '0','gstr2b','".$i."','".$row1["comp_code"]."','".$row1["added_by"]."','".date("Y-m-d H:i:s")."');";
        mysqli_query($connection, $insertquery);
      }
    }
    

}
}else if($row1["request_type"]=="gstr2a"){
    
 //gstr2a
$maindir="twoa/";
$dir = $companycode;
if(!(is_dir($path.$maindir.$dir))){
  mkdir($path.$maindir.$dir);
}
 
if(!is_dir($path.$maindir.$dir.'/'.$dirdate)){
    mkdir($path.$maindir.$dir.'/'.$dirdate);
}

$username=$row1["username"];

$sql = "select * from tbl_gst_userdetail where gst_username='" . $username . "' and comp_code='".$row1["comp_code"]."'";
            // echo $sql."=".$ret."<br/>";
            $query = mysqli_query($connection,$sql);
            if ($row = mysqli_fetch_assoc($query)) {
                //echo "<br/>";
                //print_r($row);

                $txn = $row["txn"];
                $email = $row['email'];
                $ipaddress = $row["ip_address"];
                $ip = $ipaddress;
                $clientid = $row['client_id'];
                $clientsecret = $row['client_secret'];
                $companycode = $row['comp_code'];
                $stcd=$row["state_cd"];
                $gstin=$row["gstin"];
            }
            $gstno = $gstin;


            $rmonth = $row1["return_month"];
            $ryear = $row1['return_year'];
            if ($rmonth < 10) {
                $rmonth = '0' . $rmonth;
            }
            $ret = $rmonth . $ryear;
			
$link = "https://api.mastergst.com/".$row1["request_type"]."/".$row1["invoice_type"];
$link .= "?email=harmeet@mathia.in";
$link .= "&gstin=".$gstin;
$link .= "&retperiod=".$ret;

$ch = curl_init();
$header = array(
  'Accept: application/json',
  'ip_address: '.$ip,
  'state_cd: '.$stcd,
  'txn: '.$txn,
  'gst_username: '.$username,
  'client_id: '.$clientid,
  'client_secret: '.$clientsecret,
  'Content-Type: application/json'
);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$json=json_decode($response,true);
$status_desc=$json['status_desc'];
$message=$json["error"]["message"];
$validstatus = $json['status_cd'];
if($validstatus!='0'){
   
    
     if(!empty($json["data"]["est"]) && !empty($json["data"]["token"]) && $json["status_cd"]==2 ){
  $est=$json["data"]["est"];
  $token=$json["data"]["token"];
  $ip=$json["header"]["ip_address"];
  $ret_period=$ret;
  $gst_username=$json["header"]["gst_username"];
  $types=$row1["invoice_type"];

  $fileurldetailslink = "https://api.mastergst.com/all/filedet?email=harmeet%40mathia.in";
  $fileurldetailslink .= "&gstin=".$gstin."&returnperiod=".$ret."&token=".$token;

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_URL, $fileurldetailslink);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 $curlresponse = curl_exec($curl);
 $curlresult = json_decode($curlresponse,True);
 $error_message=$curlresult["error"]["message"];
 $message=$error_message;
 if($curlresult["status_cd"]==0 && $curlresult["error"]["error_cd"]=="RTN_24"){

   
   $insert_query="insert into tbl_file_details_api (est,token,ip,ret_period,gst_username,type,error_message,comp_code,create_at) values ('".$est."','".$token."','".$ip."','".$ret_period."','".$gst_username."','b2b','".$error_message."','".$companycode."','".date("Y-m-d H:i:s")."')";
  mysqli_query($connection,$insert_query);
  }
 



  }else{
      $status=1;
    $data  = $json['data'];
    $dataType = $data[$row1["invoice_type"]];
  
    $header = $json['header'];
    $fp=$header['ret_period'];
    $ctin = $header['gstin'];
    $state_cd = $header['state_cd'];
    $arr = array("fileIndex"=>"0","totalFiles"=>"0","gstin"=>$ctin,"fp"=>$fp,$row1["invoice_type"]=>$dataType);
    $jsonfile = json_encode($arr);
    $file = $path.$maindir.$dir.'/'.$dirdate."/".$row1["invoice_type"].$companycode.$ctin.$state_cd.$rmonth.$ryear.date("Y_m_d_H_i_s").".json";
    $insert_gstr_twoa = "INSERT  INTO tbl_gstr_twoa_api_detail (fp,typeofjson,fetchingdate,jsonurl,gstin,compcode,addedby,addeddate) VALUES ('".$fp."','".$row1["invoice_type"]."','".$today."','".$file."','".$ctin."','".$companycode."','".$row1["added_by"]."','".$today."')";
    mysqli_query($connection,$insert_gstr_twoa);

    $myfile = fopen($file, "w");
    // echo $myfile;
    fwrite($myfile, $jsonfile);
    fclose($myfile);
    
}
}
   
}

$update_query="update tbl_json_download_request set file_url='".$file."',message='".$message."',status='".$status."',status_desc='".$status_desc."' where id='".$row1["id"]."'";
mysqli_query($connection,$update_query);
//exit;

}
}
mysqli_close($connection);
