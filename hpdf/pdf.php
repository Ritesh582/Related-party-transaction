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
	case 'TaxInvoiceInterState':
		$headingTitle = "Tax Invoice-Inter State";
		$filename = "TaxInvoiceInterState.php";
		break;
	case 'ExportInvoice':
		$headingTitle = "Export Invoice";
		$filename = "ExportInvoice.php";
		break;
		case 'RevicedInvoice':
		$headingTitle = "Reviced Invoice";
		$filename = "RevicedInvoice.php";
		break;
		case 'BillOfSupply':
		$headingTitle = "Bill Of Supply";
		$filename = "BillOfSupply.php";
		break;
		case 'ReceiptVoucher':
		$headingTitle = "Receipt Voucher";
		$filename = "ReceiptVoucher.php";
		break;
		case 'RefundVoucher':
		$headingTitle = "Refund Voucher";
		$filename = "RefundVoucher.php";
		break;
		case 'PaymentVoucher':
		$headingTitle = "Payment Voucher";
		$filename = "PaymentVoucher.php";
		break;
		case 'CreditNote':
		$headingTitle = "Credit Note";
		$filename = "CreditNote.php";
		break;
		case 'DebitNote':
		$headingTitle = "Debit Note";
		$filename = "DebitNote.php";
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
    
	$html2pdf = new HTML2PDF('P','A4', 'en', false, 'ISO-8859-15', 3);	
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output($billno.'.pdf');
}
catch(HTML2PDF_exception $e) { echo $e; }
 // ob_get_clean();	
exit;
?>