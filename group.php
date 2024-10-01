<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "group_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	
	$qPrev = $Db->query("select name as strPrev from tbl_groupmaster where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$q1 = "delete from tbl_groupmaster where id='".$id."'";
	$q = $Db->query($q1);
	if($Db->affected_rows() > 0){
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_groupmaster','$strPrev','d','".$_SESSION['user_id_tmp']."','$today')");
		header("Location:group_search.php?msg=del");
		exit;
	}
	header("Location:group_search.php?msg=ndel");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_groupmaster  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $name				=	$fetch->name;
     $group_code		=	$fetch->group_code;
     $email_id          =   $fetch->email_id;
	$mode			="update";
	include "group_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

$name				=	$_POST['txt_groupname'];
$group_code		    =	$_POST['txt_groupcode'];
$email_id  	        =   $_POST['txt_emailid'];
	$qPrev = $Db->query("select name as strPrev from tbl_groupmaster where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update tbl_groupmaster SET name='".$name."',email_id='".$email_id."' where id=".$id);
	if($Db->affected_rows()>0){		
		$Db->query("update tbl_groupmaster set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id=".$id);
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_groupmaster','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:group_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from tbl_groupmaster");
	 $fetch 		=mysql_fetch_object($res);
     $id            =  $fetch->id + 1;
	
	
    $name				=	$_POST['txt_groupname'];
	$group_code		    =	$_POST['txt_groupcode'];
    $email_id           =   $_POST['txt_emailid'];
	$query="Insert into tbl_groupmaster(id,name,group_code,email_id,added_by,added_date)values ('$id','$name','$group_code','$email_id','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:group_search.php?msg=add");
	exit;
 }

?>