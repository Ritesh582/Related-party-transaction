<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "upload_category_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	
	

	$q1 = "delete  from tbl_omnibus_categories_master where id='".$id."'";
	$q = $Db->query($q1);
	// if($Db->affected_rows() > 0){
	// 	$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value(' tbl_omnibus_categories_master','$strPrev','d','".$_SESSION['user_id_tmp']."','$today')");
	// 	header("Location:upload_category_search.php?msg=del");
	// 	exit;
	// }
	header("Location:upload_category_search.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_omnibus_categories_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $omnibus 				=	$fetch->omnibus ;
    //  $group_code		=	$fetch->group_code;
    //   $email_id          =   $fetch->email_id;
	$mode			="update";
	include "upload_category_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

$omnibus				=	$_POST['omnibus'];
// $group_code		    =	$_POST['txt_groupcode'];
// $email_id  	        =   $_POST['txt_emailid'];
	$qPrev = $Db->query("select omnibus as omnibus from tbl_omnibus_categories_master where id=".$id);
	
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update tbl_omnibus_categories_master SET omnibus='".$status."' where id=".$id);
	 $res=$Db->query("Update  tbl_omnibus_categories_master SET omnibus='".$omnibus."' where id=.$id");

	header("Location:upload_category_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from  tbl_omnibus_categories_master");
	 $fetch 		=mysql_fetch_object($res);
     $id            =  $fetch->id+1;

	 $omnibus				=	$_POST['omnibus'];


    // $name				=	$_POST['txt_groupname'];
	// $group_code		    =	$_POST['txt_groupcode'];
    // $email_id           =   $_POST['txt_emailid'];
	echo $query="Insert into  tbl_omnibus_categories_master(id, omnibus, comp_code,added_by,added_date)values ('$id','$omnibus' , '".$_SESSION['comp_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";
	$insert=$Db->query($query);
	
	
	header("Location:upload_category_search.php?msg=add");
	exit;
 }

?>