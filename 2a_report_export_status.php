<?php
session_start();
include ('includes/config.php');
ini_set('memory_limit', '1024M');
include ('statusArray.php');
$filename ="gstr2_report_status";
$sql = "SELECT * FROM ".$_SESSION["tbl_gstr_2_status2"]." where 1";
if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";
}
if($_SESSION['comp_code_tmp']==""){
  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
  $param .= "&comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
}if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";
}
if($_SESSION['comp_code_tmp']==""){
  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
  $param .= "&comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
}
if(isset($_SESSION['dept_code_tmp']) && !empty($_SESSION['dept_code_tmp'])){
  $cnd1 .= " and dept_code = '".$_SESSION['dept_code_tmp']."'"; 
}
if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
  $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
}
if(isset($_POST["status"]) && $_POST["status"]!=""){
     if($_POST['status']==5){
     $cnd1 =  $cnd1." and (status=5 or status=6 or status=7 or status=8)";
}elseif($_POST["status"]==3){
     $cnd1 =  $cnd1." and (status=3 or status=4)";
}else{
     $cnd1 .= " and status = '".$_POST["status"]."'";
}}
if(isset($_POST["status"]) && $_POST["status"]!=""){
     if($_POST['status']==5){
     $cnd1 =  $cnd1." and (status=5 or status=6 or status=7 or status=8)";
}elseif($_POST["status"]==3){
     $cnd1 =  $cnd1." and (status=3 or status=4)";
}else{
     $cnd1 .= " and status = '".$_POST["status"]."'";
}}
header('Content-TYpe:text/csv');
header('Content-Disposition:attachment;filename='.$filename.'.csv');
$f = fopen('php://output','w');

$data=array("Company Name",':',getrecord("tbl_company","Name", "where id='" . $_SESSION["comp_code_tmp"] . "'"),"","Export Date",":",date("Y-m-d"));
    fputcsv($f, $data);
$fields =array('id','gstin','panno','party_name','invoice_number','real_invoice_number','invoice_date','invoice_value','place_of_supply','reverse_change','invoice_type','rate','taxable_value','igst_paid','cgst_paid','taxvalue','cess_paid','email','eligibility_for_itc','availed_itc_igst','availed_itc_cgst','availed_itc_sgst','availed_itc_cess','DocumentNo','type','correct_profit_center','year_mon','pstng_date','Offst_acct','account','remark','fp','gstintwoa','pannotwoa','invoice_number_twoa','igst_twoa','sgst_twoa','cgst_twoa','total_tax_twoa','state_code_twoa','fp_twoa','status');
fputcsv($f, $fields);
$sql = $sql.$cnd1;
$result = $Db->query($sql);
while($row= mysql_fetch_assoc($result)){
    $state_code = $state_code_status[$row['state_status']] ;
        if($row['status']==5 || $row['status']==6 || $row['status']==7 || $row['status']==8 || $row['status']==9 || $row['status']==2){
             $gstrstatus=$statusarray[$row['status']][$row['flag_status']];
         }else{
              $gstrstatus=$statusarray[$row['status']];
         }
    $lineData = array($row['id'],$row['gstin'],$row['panno'],$row['party_name'],$row['invoice_number'],$row['real_invoice_number'],$row['invoice_date'],$row['invoice_value'],$row['place_of_supply'],$row['reverse_change'],$row['invoice_type'],$row['rate'],$row['taxable_value'],$row['igst_paid'],$row['cgst_paid'],$row['taxvalue'],$row['cess_paid'],$row['email'],$row['eligibility_for_itc'],$row['availed_itc_igst'],$row['availed_itc_cgst'],$row['availed_itc_sgst'],$row['availed_itc_cess'],$row['DocumentNo'],$row['type'],$row['correct_profit_center'],$row['year_mon'],$row['pstng_date'],$row['Offst_acct'],$row['account'],$row['remark'],$row['fp'],$row['gstintwoa'],$row['pannotwoa'],$row['invoice_number_twoa'],$row['igst_twoa'],$row['sgst_twoa'],$row['cgst_twoa'],$row['total_tax_twoa'],$row['state_code_twoa'],$row['fp_twoa'],$gstrstatus);
        fputcsv($f, $lineData);
}
fseek($f,0);
fpassthru($f);
exit();
?>