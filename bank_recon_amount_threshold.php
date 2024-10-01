<style>
    body{
         background-position: center center;
    font-family: open_sansregular , "Helvetica Neue" , Helvetica, Arial, sans-serif;
    background-color: #2f4050;
  /*  background-image: url("img/15055804461504840137BG.png");*/
    font-size: 13px;
    color: #337ab7;
    overflow-x: hidden;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    -webkit-background-attachment: fixed;
    -moz-background-attachment: fixed;
    -ms-background-attachment: fixed;
    }
    .progressbar{
        margin: 10% auto 0%;

        background-color: #FFFFFF;
        border-radius: 50%;
        width:19%;
        height: 40%;
        font-size: 7em;



    }
    .contain{
        position:relative;
        top:50%;
        left: 50%;
        float: left;
        transform: translate(-50%,-50%);
    }
    .caption{
       text-align: center;
       font-size: 3em;
    }
        .button{
        text-align: center;
       font-size: 3em;
    }
    .button a{
        text-align: center;
        float: center;
        background-color:#FFFFFF;
        color:#337ab7;
        border:1px solid #337ab7;
        font-size: 1em;
        padding: 10px 60px;
        text-decoration: none;
        border-radius: 20px;
        display: inline-block;
        cursor: pointer;
    }

</style>
<?php
$pagename = 'book_recon_process.php';
include ('includes/config.php');
include "includes/session_check.php";
$showmsg = message($_GET['msg']);


echo "<div class='container'><div class='progressbar'><div id='bars' class='contain'>0%</div></div></div><br>
<div id='caption' class='caption'>Related Party Transaction</div><br><br/><div class='button'><a href='overview_bank_recon.php'>Next</a></div>";
//include "includes/bank_recon_leftmenu.php";
$count = $_POST['count'];
if($_SESSION['comp_code_tmp'] <>""){
	$cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";
}
$amount = getrecord("bank_recon_threshold","amount","where comp_code='".$_SESSION['comp_code_tmp']."'");
$sql = "select * from tbl_bank_book_statement where status='0' and flag_status='0' and flag_lock='0' and comp_code='".$_SESSION['comp_code_tmp']."' and type!='Test'";
// echo $sql."<br />";
$res = $Db->query($sql);
$total=$Db->num_rows();
while($row=mysql_fetch_array($res)){
	$amt = $row['bankamount'];
	$bookid = $row['id'];
	//echo $bookid;
	$date = $row['paymentreceiveddate'];
	$totalamt = $amt + $amount;
	$banksql = "select * from tbl_bank_bank_statement where status='0' and flag_status='0' and flag_lock='0' and comp_code='".$_SESSION['comp_code_tmp']."' and transaction_date='".$date."' and (transaction_amount < '".$totalamt."' and transaction_amount > '".$amt."')";
	//echo $banksql."<br />";
	$bankres = $Db->query($banksql);
	while($bankrow = mysql_fetch_array($bankres)){
		$id = $bankrow['id'];
		$bankamt = $bankrow['transaction_amount'];
	}
	if($id!=''){
		$upd_bookconcat = "Update tbl_bank_bank_statement set status='12',flag_status ='1',recon_id='".$bookid."' where id='".$id."'";
		//echo $upd_bookconcat."<br />";
		mysql_query($upd_bookconcat." and flag_lock=0");
		$upd_concat = "update tbl_bank_book_statement set status='12',flag_status ='1',recon_id='".$id."' where id='".$bookid."'";
		//	 echo $upd_concat."<br />";
		mysql_query($upd_concat." and flag_lock=0");
	}
	$id = '';

	//echo $amt.'='.$bankamt."<br />";

  $current = $current + 1;
       $progress = round(($current / $total) * 100);
      echo "<script type='text/javascript'>
    document.getElementById('bars').innerHTML='" . $progress . "%';
     document.getElementById('caption').innerHTML='Related Party Transaction Process';
</script>";



}
//echo $id."<br  />";
//echo $bookid;






?>
