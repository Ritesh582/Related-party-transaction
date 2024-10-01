<?php
function sendEmail($to,$subject,$bodyMsg){
	$message = $bodyMsg;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".FromEmail."\r\n";
	 mail($to, $subject, $message, $headers);
}
// function sendEmails($to,$subject,$bodyMsg,$from){
// 	$message = $bodyMsg;
//         $headers  = 'MIME-Version: 1.0' . "\r\n";
// 	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// 	$headers .= "From: ".$from."\r\n";
//         if($_SESSION["comp_code_tmp"]=="A"){
//         $headers .= 'Reply-To: Vinay.Garg@libertyinsurance.in' . "\r\n";
//         // $headers .= 'Bcc: Vinay.Garg@libertyinsurance.in' . "\r\n";
//         }else if($_SESSION["comp_code_tmp"]=="B" || $_SESSION["comp_code_tmp"]=="AP" ){
//         // $headers .= 'Reply-To: hardik.mistry@bhartiaxa.com' . "\r\n";
//         $headers .= 'Reply-To: ashraf@mathia.in' . "\r\n";
//        // $headers .= 'cc: hardik.mistry@bhartiaxa.com,kiran.shingote@bhartiaxa.com,Aditya.Desai@bhartiaxa.com,deependra.rajawat@bhartiaxa.com,Massrat.khan@bhartiaxa.com '."\r\n";
//         $headers .= 'cc: ankit@mathia.in,kinjal@mathia.in'."\r\n";
//         // $headers .= 'Bcc: ankit@mathia.in,kinjal@mathia.in'."\r\n";
          
//         }else{
//         }
//         if(@mail($to, $subject, $message, $headers)){
//             $GLOBALS['status']='success';
//         }else{
//             $GLOBALS['status']='failed';
//         }
// }
?>
