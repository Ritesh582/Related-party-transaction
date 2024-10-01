<?php

include ('includes/config.php');

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;

$columns = array(
// datatable column index  => database column name
     0 =>'id', 
    1 => 'gstin',
    2 => 'invoice_number',
    3 => 'numberofline',
    4 => 'sgst_paid',
    5 => 'cgst_paid',
    6 => 'igst_paid',
    7 => 'status',
);

// getting total number records without any search
$sql = "SELECT * ";
if(isset($_GET["status"]) && $_GET["status"]==5 && $_GET["mode"]=="actionable"){
     $sql .= " FROM tbl_gstr_2_status2 where (status=5 or status=6 or status=7 or status=8)";
 }elseif(isset($_GET["status"]) && $_GET["status"]==3 && $_GET["mode"]=="actionable"){
     $sql .= " FROM tbl_gstr_2_status2 where (status=3 or status=4)";
 }elseif($_GET["status"]==9.1 || $_GET["status"]==8.1 || $_GET["status"]==7.1 || $_GET["status"]==6.1 || $_GET["status"]==5.1){
     $statusno=floor($_GET["status"]);
     $sql .= " FROM ".$_SESSION["tbl_gstr_2_status2"]." where status='".$statusno."' and state_status=2";
 }else{
$sql .= " FROM ".$_SESSION["tbl_gstr_2_status2"]." where status=".$_GET["status"];
 }
if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";

 }
 if($_SESSION['comp_code_tmp']=="")
 {
 
  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
  
 }
  if(isset($_SESSION['dept_code_tmp']) && !empty($_SESSION['dept_code_tmp']))
 {
   $cnd1 .= " and dept_code = '".$_SESSION['dept_code_tmp']."'"; 
}
 
   /*if($st_code<>"")
  {
   $cnd1 .= " and dept_code = '".$st_code."'";
  }*/
 if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
   $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
 }
 if(isset($_GET["state_code"]) && $_GET["state_code"]!=""){
     $cnd1 .= " and state_code= '".$_GET["state_code"]."'";
 }
 
  if((isset($_SESSION["finyear"]) && $_SESSION["finyear"]!="all")){ 
    $nextyear = $_SESSION["finyear"] + 1;
    $finyearvalue = $_SESSION["finyear"];
    $cnd1.= " and ((finmon >=4 and finyear = '" . $finyearvalue . "')  or (finmon<4 and finyear = '" . $nextyear . "'))"; 
}
$sql=$sql.$cnd1;
$query = $Db->query($sql);
$totalData = mysql_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT *";
if(isset($_GET["status"]) && $_GET["status"]==5 && $_GET["mode"]=="actionable"){
     $sql .= " FROM ".$_SESSION["tbl_gstr_2_status2"]." where (status=5 or status=6 or status=7 or status=8)";
 }elseif(isset($_GET["status"]) && $_GET["status"]==3 && $_GET["mode"]=="actionable"){
     $sql .= " FROM ".$_SESSION["tbl_gstr_2_status2"]." where (status=3 or status=4)";
 }elseif($_GET["status"]==9.1){
     $sql .= " FROM ".$_SESSION["tbl_gstr_2_status2"]." where status=9 and state_status=2";
 }else{
$sql .= " FROM ".$_SESSION["tbl_gstr_2_status2"]." where status=".$_GET["status"];
 }

$sql=$sql.$cnd1;

if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql .= " AND ( gstin LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR status LIKE '" . $requestData['search']['value'] . "%'";
    $sql .= " OR invoice_number LIKE '" . $requestData['search']['value'] . "%' )";

    //$sql.=" OR party_name LIKE '".$requestData['search']['value']."%' )";
}
$query = $Db->query($sql);
$totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = $Db->query($sql);

$data = array();
$i = 0;
while ($row = mysql_fetch_array($query)) {  // preparing an array
    // preparing an array
    $nestedData = array();

   
    if($row["status"]!=10){
    $nestedData[] = $row["id"];
    $nestedData[] = $row["gstin"];
    $nestedData[] = $row["invoice_number"];


    $igst2 = round($row["igst_paid"],2);
    $sgst2 = round($row["sgst_paid"],2);
    $cgst2 = round($row["cgst_paid"],2);
    $taxValue = $igst2 + $sgst2 + $cgst2;
    $nestedData[] = $igst2 . "|" . $sgst2 . "|" . $cgst2;
    $nestedData[] = round($row["taxvalue"],2);
    $nestedData[] = $row["state_code"];
    
    }elseif ($row["status"]==10) {
    $nestedData[] = "";
    $nestedData[] ="";
    $nestedData[] ="";
    $nestedData[] = "";
    $nestedData[] = "";
    $nestedData[] = "";
    }
    $nestedData[] = $row["recon_id"]."|".$row["gstintwoa"]."|".$row["invoice_numbertwoa"]."|".$row["igst_twoa"]."|".$row["sgst_twoa"]."|".$row["cgst_twoa"]."|".$row["total_tax_twoa"]."|".$row["state_code_twoa"];
    $taxValue=$row["taxvalue"];
    $taxValue2a=$row["total_tax_twoa"];
    
    $nestedData[] = round($taxValue - $taxValue2a,2);
    $gstrstatus = getrecord("tbl_gstrstatus", "name", "where id='" . $row["status"] . "'");
    $nestedData[] = "<span class='sa'>".$gstrstatus."</span>";
    $data[] = $nestedData;
}



$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal" => intval($totalData), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
