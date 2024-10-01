<?php

ini_set("memory_limit", "5000M");	
ob_start(); 
include '../includes/config.php';
//pageAccess((int)$_SESSION['tmp_rpt']);
  
$typ =$_GET['type'];

$billno =$_GET['id'];
$website = "universalsompo.com";
//if($billno == 0)exit;
switch($typ){
    case 'InvoicePrint':
         $headingTitle = "Invoice-Print";
         $filename = "InvoicePrint.php";
		 $sql= "update tbl_invoice set printStatusFlag=1 where concat(prefix,id)='".$billno."'";
         $result=$Db->query($sql);
        break;
	 case 'PQPrint':
        $headingTitle = "Quotation-Print";
        $filename = "QuotationPrint.php";
        break;
	 case 'POPrint':
        $headingTitle = "PurchaseOrder-Print";
        $filename = "PurchaseOrderPrint.php";
        break;	
    default:
        echo '<b>Parameter Missing</b>';
        break;
}
include(dirname(__FILE__).'/pdf/'.$filename);
$content = ob_get_clean();
require_once(dirname(__FILE__).'/html2pdf.class.php');

try
{
    $html2pdf = new HTML2PDF('P','A4', 'en', false, 'ISO-8859-1', 3);	
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
   
    $html2pdf->Output($typ."_".$billno.'.pdf');
}

catch(HTML2PDF_exception $e) { echo $e; }	
exit;
?>