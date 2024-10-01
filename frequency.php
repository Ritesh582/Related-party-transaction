<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "frequency_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	

	$q1 = "delete from tbl_frequency_master where id='".$id."'";
	$q = $Db->query($q1);
	
	header("Location:frequency_search.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_frequency_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $frequency				=	$fetch->frequency;
    
	$mode			="update";
	include "frequency_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];
	$frequency	=	$_POST['frequency'];

// $group_code		    =	$_POST['txt_groupcode'];

	$qPrev = $Db->query("select frequency as strPrev from tbl_frequency_master where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update tbl_frequency_master SET frequency='".$frequency."' where id=".$id);
	if($Db->affected_rows()>0){		
		$Db->query("update tbl_frequency_master set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id=".$id);
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_frequency_master','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:frequency_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from tbl_frequency_master");
	 $fetch 		=mysql_fetch_object($res);
    //  $id            =  $fetch->id + 1;
	

    $frequency           =   $_POST['frequency'];
	$query="Insert into tbl_frequency_master(id,frequency,comp_code,added_by,added_date)values ('$id','$frequency','".$_SESSION['comp_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:frequency_search.php?msg=add");
	exit;
 }

?>