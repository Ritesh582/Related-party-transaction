<?php
	$pagename = 'gstr_refund_view.php';
	include ('includes/config.php');
	include "includes/session_check.php";
	$showmsg = message($_GET['msg']);
	include "includes/header.php";
  $content = $_GET['taxperiod'];
  require_once('pdf/html2pdf.class.php');

    $html2pdf = new HTML2PDF('P','A4', 'en', false, 'ISO-8859-1', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);

    $html2pdf->Output();
?>
