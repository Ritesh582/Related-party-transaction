<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "upload_oracle_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	
	// $qPrev = $Db->query("select name as strPrev from tbl_account_oracle_master where id=".$id);
	// $ft = mysql_fetch_object($qPrev);
	// $strPrev = $ft->strPrev;

	$q1 = "delete from tbl_account_oracle_master where id='".$id."'";
	$q = $Db->query($q1);
	// if($Db->affected_rows() > 0){
	// 	$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_account_oracle_master','$strPrev','d','".$_SESSION['user_id_tmp']."','$today')");
	// 	header("Location:group
    //     upload_oracle_seach.php?msg=del");
	// 	exit;
	// }
	header("Location:upload_oracle_seach.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_account_oracle_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $account_oracle				=	$fetch->account_oracle;
     $omnibus_categories=$omnibus_categories;
	$mode			="update";
	include "upload_oracle_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

$account_oracle				=	$_POST['account_oracle'];
$account_oracle				=	$_POST['omnibus_categories'];
// $group_code		    =	$_POST['txt_groupcode'];
// $email_id  	        =   $_POST['txt_emailid'];
	$qPrev = $Db->query("select account_oracle as account_oracle from tbl_account_oracle_master where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update tbl_account_oracle_master SET account_oracle='".$account_oracle."',omnibus_categories='".$omnibus_categories."' where id=".$id);
	if($Db->affected_rows()>0){		
		$Db->query("update tbl_account_oracle_master set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id=".$id);
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_account_oracle_master','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:upload_oracle_seach.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from tbl_account_oracle_master");
	 $fetch 		=mysql_fetch_object($res);
   
	
	
    $account_oracle			=$_POST['account_oracle'];
	$omnibus_categories		    =$_POST['omnibus_categories'];
    // $email_id           =   $_POST['txt_emailid'];
	 $query="Insert into tbl_account_oracle_master(id,account_oracle,omnibus_categories,comp_code,added_by,added_date)values ('$id','$account_oracle','$omnibus_categories','".$_SESSION['comp_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:upload_oracle_seach.php?msg=add");
	exit;
 }

?>