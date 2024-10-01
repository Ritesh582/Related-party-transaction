<?php
session_start();
include "includes/config.php";
ini_set('memory_limit', '1024M');

$filename = "substatus_report.csv";

$csv_terminated = "\n";
$csv_separator = ",";
$csv_enclosed = '"';
$csv_escaped = "\\";

$sql = "SELECT * FROM  tbl_substatus_master where 1 ";
if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";
 
 }
 if($_SESSION['comp_code_tmp']=="")
 {
  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
  $param .= "&comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
  
 }
 if(isset($_SESSION['dept_code_tmp']) && !empty($_SESSION['dept_code_tmp']))
 {
   $condition .= " and dept_code = '".$_SESSION['dept_code_tmp']."'"; 
}
if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
   $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
}
    //$result = $Db->query($sql.$cnd1);
    $fields_cnt = mysql_num_fields($result);
    
  

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=substatus_report'.date("Y-m-d").'.csv;');
  
    $f = fopen('php://output', 'w');
    $fields = array('ID','substatus','Comp Code','Added Date');
    fputcsv($f, $fields);
    
    $query=$Db->query($sql.$cnd1);
    
   
    while($row = mysql_fetch_assoc($query)){


        $name12=getrecord("tbl_substatus1","name","where id='".$row['substatus']."'");

        $lineData = array($row['id'],$name12,$row['comp_code'],$row['added_date']);
        fputcsv($f, $lineData);
    }
    fseek($f, 0);
    fpassthru($f);
exit;
?>

