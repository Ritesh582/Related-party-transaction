<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "substatus_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	

	$q1 = "delete from tbl_substatus_master where id='".$id."'";
	$q = $Db->query($q1);

	header("Location:substatus_search.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_substatus_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $substatus				=	$fetch->substatus;

	$mode			="update";
	include "substatus_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

$substatus				=	$_POST['substatus'];
// $group_code		    =	$_POST['txt_groupcode'];
// $email_id  	        =   $_POST['txt_emailid'];
	$qPrev = $Db->query("select substatus as strPrev from tbl_substatus_master where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update tbl_substatus_master SET substatus='".$substatus."' where id=".$id);
	if($Db->affected_rows()>0){		
		$Db->query("update tbl_substatus_master set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id=".$id);
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_substatus_master','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:substatus_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from tbl_substatus_master");
	 $fetch 		=mysql_fetch_object($res);
    //  $id            =  $fetch->id + 1;
	
	
    $substatus				=	$_POST['substatus'];

	$query="Insert into tbl_substatus_master(id,substatus,comp_code,added_by,added_date)values ('$id','$substatus','".$_SESSION['comp_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:substatus_search.php?msg=add");
	exit;
 }

?>