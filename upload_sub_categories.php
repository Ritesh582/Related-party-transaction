<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";


if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "upload_subcategories_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];	
	
	// $qPrev = $Db->query("select name as strPrev from  tbl_omnibus_subcategories_master where id=".$id);
	// $ft = mysql_fetch_object($qPrev);
	// $strPrev = $ft->strPrev;

	$q1 = "delete from  tbl_omnibus_subcategories_master where id='".$id."'";
	$q = $Db->query($q1);
	// if($Db->affected_rows() > 0){
	// 	$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value(' tbl_omnibus_subcategories_master','$strPrev','d','".$_SESSION['user_id_tmp']."','$today')");
	// 	header("Location:group
    //     upload_subcategories_search.php?msg=del");
	// 	exit;
	// }
	header("Location:upload_subcategories_search.php?msg=del");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from  tbl_omnibus_subcategories_master  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id                =  $fetch->id;
     $sub_category				=	$fetch->sub_category;
    //  $group_code		=	$fetch->group_code;
    //  $email_id          =   $fetch->email_id;
	$mode			="update";
	include "upload_subcategories_layout.php";
	exit;
}
if(strtoupper($_POST['mode'])=="UPDATE"){
	$id			=	$_POST['id'];

 $sub_category				=	$_POST['sub_category'];

// $email_id  	        =   $_POST['txt_emailid'];
	$qPrev = $Db->query("select sub_category as sub_category from tbl_omnibus_subcategories_master where id=".$id);
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$res=$Db->query("Update  tbl_omnibus_subcategories_master SET sub_category='".$sub_category."'where id=".$id);
	if($Db->affected_rows()>0){		
		$Db->query("update  tbl_omnibus_subcategories_master set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id=".$id);
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value(' tbl_omnibus_subcategories_master','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:upload_subcategories_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {
	 $res			=$Db->query("select max(id) as id from  tbl_omnibus_subcategories_master");
	 $fetch 		=mysql_fetch_object($res);
    $id            =  $fetch->id+1;
	

    $sub_category				=	$_POST['sub_category'];
	
	echo $query="Insert into  tbl_omnibus_subcategories_master(id,sub_category, comp_code,added_by,added_date)values ('$id','$sub_category','".$_SESSION['comp_code_tmp']."',".$_SESSION['user_id_tmp'].",'$today')";
	$insert=$Db->query($query);
	
	
	header("Location:upload_subcategories_search.php?msg=add");
	exit;
 }

?>