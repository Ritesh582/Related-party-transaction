<?php
session_start();
include "includes/config.php";
ini_set('memory_limit', '1024M');

//$export_value = $_GET['exp_value'];
//echo "EXPORT VALUE : " . $export_value . "<br>";

$filename = "bank_book_export.csv";

$csv_terminated = "\n";
$csv_separator = ",";
$csv_enclosed = '"';
$csv_escaped = "\\";

//$month = $_GET['month'];

//$sql_query = "SELECT * FROM tbl_gstr_2_status2";
$sql = "SELECT * FROM tbl_bank_book_statement where status ='".$_POST['status']."' ";
//$sql = "SELECT * FROM tbl_book where status ='".$_POST['status']."' ";
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
 
   /*if($st_code<>"")
  {
   $cnd1 .= " and dept_code = '".$st_code."'";
  }*/
 if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
   $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
 }
//$result = $Db->query($sql.$cnd1);
    $fields_cnt = mysql_num_fields($result);
    
  

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename= book_report'.date("Y-m-d").'.csv;');
  
     $f = fopen('php://output', 'w');
    $fields = array('id','month','year','bankincrementalid','paymentreceiveddate','banknarration','branchcode','closing','banktransactionid','bankamount','acceptedamount','bankname','kcode','uid','agencyname','entity','type','givendate','submitteddatetime','updatedby','remarks','updateddatetime','submittedbykcode','comp_code','reconid','id','month','year','transaction_id','transaction_date','value_date','cheque_no','particulars','dr_cr','transaction_amount','available_balance','brach_name','instrument_id','comp_code','bank_code','recon_id',"Status");
    fputcsv($f, $fields);
    //echo $sql.$cnd1;
    $query=$Db->query($sql.$cnd1);
    
    
$bankdata=array();
$lineData=array();
    while($row = mysql_fetch_assoc($query)){
        
        $recon_id=" ";
         $bankData = array("","","","","","","","","","","","","","","","");
        if($row['recon_id']==''){
            $recon_id=" ";
            
        }else{
            $recon_id=$row["recon_id"];
			$banksql = "SELECT * FROM tbl_bank_bank_statement where 1 and  id='".$row["recon_id"]."' and status='".$_POST['status']."'";

            $bankquery=$Db->query($banksql.$cnd1);
    
   
    while($bankrow = mysql_fetch_assoc($bankquery)){
          $bankData = array($bankrow['id'],$bankrow['month'],$bankrow['year'],$bankrow['transaction_id'],$bankrow['transaction_date'],$bankrow['value_date'],$bankrow['cheque_no'],$bankrow['particulars'],$bankrow['dr_cr'],$bankrow['transaction_amount'],$bankrow['available_balance'],$bankrow['brach_name'],$bankrow['instrument_id'],$bankrow['comp_code'],$bankrow['bank_code'],$bankrow['recon_id']);
      
    }
        }
          $lineData = array($row['id'],$row['month'],$row['year'],$row['bankincrementalid'],$row['paymentreceiveddate'],$row['banknarration'],$row['branchcode'],$row['closing'],$row['banktransactionid'],$row['bankamount'],$row['acceptedamount'],$row['bankname'],$row['kcode'],$row['uid'], htmlspecialchars($row['agencyname']),$row['entity'],$row['type'],$row['givendate'],$row['submitteddatetime'],$row['updatedby'],$row['remarks'],$row['updateddatetime'],$row['submittedbykcode'],$row['comp_code'],$recon_id);
          //$status1 = $_POST['status'];
         $status1 =  getrecord("bank_recon_status","name","where id='".$_POST['status']."'");
          if($row['status']==0)
          {
              $status1 = "Unmatch In Bank Statement";
          }else{
           $status1 =  getrecord("bank_recon_status","name","where id='".$row["status"]."'");
          }
                     $status= array($status1);
          $arraymerged=array_merge($lineData,$bankData,$status);
         fputcsv($f, $arraymerged);
    }
  
    /*$sqlq = "SELECT * FROM tbl_bank_bank_statement where flag_status=0";
  $queryq=$Db->query($sqlq.$cnd1);
    while($rows = mysql_fetch_assoc($queryq)){
       
           $lineData = array("","","","","",
              "","","","","","",
              "","",
              "","","","","","","","","","","","",$rows['id'],$rows['month'],$rows['year'],$rows['transaction_id'],$rows['transaction_date'],$rows['value_date'],$rows['cheque_no'],$rows['particulars'],$rows['dr_cr'],$rows['transaction_amount'],$rows['available_balance'],$rows['brach_name'],$rows['instrument_id'],$rows['comp_code'],$rows['bank_code'],$rows['recon_id']
          );
            $status1 = getrecord("bank_recon_status","name","where id='".$_POST['status']."'");
		    if($rows['status']==0)
          {
              $status1 = "UnMatch In Book Statement";
          }else{
           $status1 =  getrecord("bank_recon_status","name","where id='".$rows["status"]."'");
          }
          $status= array($status1);

        $arraymerged=array_merge($lineData,$status);
          fputcsv($f, $arraymerged);
    }*/
    fseek($f, 0);
   
    fpassthru($f);
exit;
?>