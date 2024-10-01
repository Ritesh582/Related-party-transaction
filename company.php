<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";
if($_GET['id'] == 4){
	header('Location:company_search.php');
	exit;
}
if(strtoupper($_GET['mode'])=="STATUS")
{
	    $id				= $_GET['id'];
        $compstatus     = $_GET['compstatus'];
        $res=$Db->query("update admin set compstatus='".$compstatus."'  where comp_code='".$id."'");

		header("Location:company_search.php");
        exit;
}

if(strtoupper($_GET['mode'])=="ADD")
{
	$mode="save";
	include "company_layout.php";
	exit;
}

if(strtoupper($_GET['mode'])=="DELETE")
{
	$id=$_GET['id'];

	$qPrev = $Db->query("select name as strPrev from tbl_company where id='".$id."'");
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

	$q1 = "delete from tbl_company where id='".$id."'";
	$q = $Db->query($q1);
	if($Db->affected_rows() > 0){
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_company','$strPrev','d','".$_SESSION['user_id_tmp']."','$today')");
		header("Location:company_search.php?msg=del");
		exit;
	}
	header("Location:company_search.php?msg=ndel");
	exit;
}

if(strtoupper($_GET['mode'])=="EDIT"){
	$id				= $_GET['id'];
	$res			=$Db->query("select * from tbl_company  where id='".$id."'");
	$fetch 			=mysql_fetch_object($res);
     $id            =  $fetch->id;
$company_code		=	$fetch->company_code;
$name				=	$fetch->name;
$panno		    	=	$fetch->panno;
$gstno              =   $fetch->gstno;
$logo_image         =   $fetch->logo_image;
$Company_status     =   $fetch->Company_status;
$principalPlace    =    $fetch->principalPlace;
$tanno			    =	$fetch->tanno;
$flatno			    =	$fetch->flatno;
$premises		    =	$fetch->premises;
$roadstreet			=	$fetch->roadstreet;
$area				=	$fetch->area;
$town				=	$fetch->town;
$state				=	$fetch->state;
$country            =   $fetch->country;
$status				=	$fetch->status;
$pincode			=	$fetch->pincode;
$mobileno			=	$fetch->mobileno;
$stdcode			=	$fetch->stdcode;
$teliphoneno		=	$fetch->teliphoneno;
$stdcode1			=	$fetch->stdcode1;
$teliphoneno1		=	$fetch->teliphoneno1;
$comp_email 		=	$fetch->comp_email;
$comp_email1 		=	$fetch->comp_email1;
$deductortype		=	$fetch->deductortype;
$Branch				=	$fetch->Branch;
$status				=	$fetch->status;
$authorized         =$fetch->authorized;
$governmentdetails	=	$fetch->governmentdetails;
$otherdetails		=	$fetch->otherdetails;
$randomNo           =   $fetch->randomNo;
$Bank_Recon_Module = $fetch->Bank_Recon_Module;
$mode			="update";
include "company_layout.php";
exit;
}

if(strtoupper($_POST['mode'])=="UPDATE"){
$company_id			=	$_POST['id'];
$company_code		=	$_POST['txt_code'];
$name				=	$_POST['txt_compname'];
$panno		    	=	$_POST['txt_panno'];
$gstno              =   $_POST['txt_gstno'];
$Company_status     =   $_POST['Company_status'];
$principalPlace    =   $_POST['txt_principalPlace'];
$tanno			    =	$_POST['txt_tanno'];
$flatno			    =	$_POST['txt_flat'];
$premises		    =	$_POST['txt_premises'];
$roadstreet			=	$_POST['txt_roadstreet'];
$area				=	$_POST['txt_area'];
$town				=	$_POST['txt_town'];
$state				=	$_POST['txt_state'];
$country            =   $_POST['txt_country'];
$status				=	$_POST['txt_status'];
$pincode			=	$_POST['txt_pincode'];
$mobileno			=	$_POST['txt_mobile'];
$stdcode			=	$_POST['txt_stdcode'];
$teliphoneno		=	$_POST['txt_teliphoneno'];
$stdcode1			=	$_POST['txt_stdcode1'];
$teliphoneno1		=	$_POST['txt_teliphoneno1'];
$comp_email 		=	$_POST['txt_email'];
$comp_email1 		=	$_POST['txt_email1'];
$authorized         =   $_POST['txt_authorized'];
$deductortype		=	$_POST['Deductor_arr'];
$Branch				=	$_POST['txt_Branch'];
$status				=	$_POST['txt_status'];
$governmentdetails	=	$_POST['txt_governmentdetails'];
$otherdetails		=	$_POST['txt_otherdetails'];
$randomNo           =   $_POST['randomNo'];

    $Bank_Recon_Module = (int)$_POST['Bank_Recon_Module'];
  
	$qPrev = $Db->query("select name as strPrev,logo_image from tbl_company where id='".$company_id."'");
	$ft = mysql_fetch_object($qPrev);
	$strPrev = $ft->strPrev;

     $logo_image =$ft->logo_image;
   if($_FILES["logo_file"]["name"] <> ""){
        $oldFile=$_FILES["logo_file"]["name"];
        $newFile=time().$_FILES["logo_file"]["name"];
        rename($oldFile,$newFile);

        $pathtoupload = $imagePath. $newFile;
        @move_uploaded_file($_FILES["logo_file"]["tmp_name"],$pathtoupload);
		$logo_image=$newFile;
    }


	$res=$Db->query("Update tbl_company SET company_code='$company_code',name='$name',panno='$panno',gstno='$gstno',logo_image='$logo_image',Company_status = '$Company_status',principalPlace='$principalPlace',tanno='$tanno',flatno='$flatno',premises='$premises',roadstreet='$roadstreet',area='$area',
town='$town',state='$state',
country='$country',status='$status',pincode='$pincode',mobileno='$mobileno',stdcode='$stdcode',teliphoneno='$teliphoneno',stdcode1='$stdcode1',teliphoneno1='$teliphoneno1',comp_email='$comp_email',comp_email1='$comp_email1',deductortype='$deductortype',Branch='$Branch',status='$status',governmentdetails='$governmentdetails',otherdetails='$otherdetails',authorized='$authorized',randomNo='$randomNo',Bank_Recon_Module='$Bank_Recon_Module' where id='".$company_id."'");
	echo $res."<br/>";
        if($Db->affected_rows()>0){
		$Db->query("update tbl_company set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where id='".$company_id."'");
		$Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_company','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
	}
	header("Location:company_search.php?msg=upd");
	exit;
}

 if(strtoupper($_POST['mode'])=="SAVE")
 {

$company_id			=	$_POST['id'];
$company_code		=	$_POST['txt_code'];
$name				=	$_POST['txt_compname'];
$panno		    	=	$_POST['txt_panno'];
$gstno              =   $_POST['txt_gstno'];
$Company_status     =   $_POST['Company_status'];
$principalPlace    =   $_POST['txt_principalPlace'];
$tanno			    =	$_POST['txt_tanno'];
$flatno			    =	$_POST['txt_flat'];
$premises		    =	$_POST['txt_premises'];
$roadstreet			=	$_POST['txt_roadstreet'];
$area				=	$_POST['txt_area'];
$town				=	$_POST['txt_town'];
$state				=	$_POST['txt_state'];
$country            =   $_POST['txt_country'];
$status				=	1;
$pincode			=	$_POST['txt_pincode'];
$mobileno			=	$_POST['txt_mobile'];
$stdcode			=	$_POST['txt_stdcode'];
$teliphoneno		=	$_POST['txt_teliphoneno'];
$stdcode1			=	$_POST['txt_stdcode1'];
$teliphoneno1		=	$_POST['txt_teliphoneno1'];
$comp_email 		=	$_POST['txt_email'];
$comp_email1 		=	$_POST['txt_email1'];
$deductortype		=	$_POST['Deductor_arr'];
$Branch				=	$_POST['txt_Branch'];
$governmentdetails	=	$_POST['txt_governmentdetails'];
$otherdetails		=	$_POST['txt_otherdetails'];

$authorized             =       $_POST['txt_authorized'];
$randomNo           =   $_POST['randomNo'];
    
    $Bank_Recon_Module = (int)$_POST['Bank_Recon_Module'];
   
 if($_FILES["txt_logo"]["name"] <> ""){
        $oldFile=$_FILES["txt_logo"]["name"];
        $newFile=time().$_FILES["txt_logo"]["name"];
        rename($oldFile,$newFile);

        $pathtoupload = $imagePath. $newFile;
        @move_uploaded_file($_FILES["txt_logo"]["tmp_name"],$pathtoupload);
    }

	$query="Insert into tbl_company(id,company_code,name,panno,gstno,logo_image,Company_status,principalPlace,tanno,flatno,premises,roadstreet,area,town,state,country ,status,pincode,mobileno,stdcode,teliphoneno,stdcode1,teliphoneno1,comp_email,comp_email1,deductortype,Branch,governmentdetails,otherdetails,authorized,randomNo,Bank_Recon_Module,group_code,added_by,added_date)values ('$company_code','$company_code','$name','$panno','$gstno','$newFile','$Company_status','$principalPlace','$tanno','$flatno','$premises','$roadstreet','$area','$town','$state','$country ','$status','$pincode','$mobileno','$stdcode','$teliphoneno','$stdcode1','$teliphoneno1','$comp_email','$comp_email1','$deductortype','$Branch','$governmentdetails','$otherdetails','$authorized','$randomNo','$Bank_Recon_Module','".$_SESSION['group_code_tmp']."','".$_SESSION['user_id_tmp']."','$today')";

	$insert=$Db->query($query);
        

	header("Location:company_search.php?msg=add");
	exit;
 }
