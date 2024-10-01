<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "status_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	

	$q1 = "delete from tbl_status_master where id='".$id."'";
	$q = $Db->query($q1);

	header("Location:status_search.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_status_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
    $id                =  $fetch->id;
    $status                =  $fetch->status;
    //  $group_code		=	$fetch->group_code;
    //  $email_id          =   $fetch->email_id;
	$mode			="update";
	include "status_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

$status				=	$_POST['status'];
// $group_code		    =	$_POST['txt_groupcode'];
// $email_id  	        =   $_POST['txt_emailid'];
	$qPrev = $Db->query("select status as strPrev from tbl_status_master where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update tbl_status_master SET status='".$status."' where id=".$id);
	if($Db->affected_rows()>0){		
		$Db->query("update tbl_status_master set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id=".$id);
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_status_master','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:status_search.php?msg=upd");	
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from tbl_status_master");
	 $fetch 		=mysql_fetch_object($res);

	
	
    $status				=	$_POST['status'];
	// $group_code		    =	$_POST['txt_groupcode']; $_SESSION['comp_code_tmp']
    // $email_id           =   $_POST['txt_emailid'];
	$query="Insert into tbl_status_master(id,status,comp_code,added_by,added_date)values ('$id','$status','".$_SESSION['comp_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:status_search.php?msg=add");
	exit;
 }

?>