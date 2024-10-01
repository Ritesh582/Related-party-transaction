<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "reporting_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	
	// $qPrev = $Db->query("select name as strPrev from tbl_reporting_period_master where id=".$id);
	// $ft = mysql_fetch_object($qPrev);
	// $strPrev = $ft->strPrev;

	$q1 = "delete from tbl_reporting_period_master where id='".$id."'";
	$q = $Db->query($q1);

	header("Location:reporting_search.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_reporting_period_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $reporting_period				=	$fetch->reporting_period;

	$mode			="update";
	include "reporting_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

$reporting_period				=	$_POST['reporting_period'];
// $group_code		    =	$_POST['txt_groupcode'];
// $email_id  	        =   $_POST['txt_emailid'];

	$res=$Db->query("Update tbl_reporting_period_master SET reporting_period='".$reporting_period."' where id=".$id);

	header("Location:reporting_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from tbl_reporting_period_master");
	 $fetch 		=mysql_fetch_object($res);
    //  $id            =  $fetch->id + 1;
	
	
    $reporting_period				=	$_POST['reporting_period'];

	$query="Insert into tbl_reporting_period_master(id,reporting_period,comp_code,added_by,added_date)values('$id','$reporting_period','".$_SESSION['comp_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:reporting_search.php?msg=add");
	exit;
 }

?>