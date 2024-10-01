<?php	
include ('includes/config.php');
$pagename = 'user_search.php';
pageAccess((int)$_SESSION['tmp_usr']);
include "includes/session_check.php";
if(strtoupper($_GET['mode'])=="ADD")
{
    $mode="save";
    $status=1;
    $condition = "";
    $tpwd = "AUTO GENERATED";
    include "user_layout.php";
    exit;
}
	
if(strtoupper($_GET['mode'])=="DELETE")
{
    $id=$_GET['id'];

    $qPrev = $Db->query("select CONCAT_WS('#~#',name,email_id,dept_code,branch_code,comp_code,mobile_no,username,utype,admin_user,usr,mst,rpt,arisk,crisk,drisk,erisk,actrl,ectrl,tlink) as strPrev from admin where admin_id=".$id);
    $ft = mysql_fetch_object($qPrev);
    $strPrev = $ft->strPrev;

    $q = $Db->query("delete from admin where admin_id='".$id."' and admin_user!=1");
    if($Db->affected_rows() > 0){
        $Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('admin','$strPrev','d','".$_SESSION['user_id_tmp']."','$today')");
        header("Location:user_search.php?msg=del");
        exit;
    }
    header("Location:user_search?msg=ndel");
    exit;
}

if(strtoupper($_GET['mode'])=="EDIT")
{
    $id=$_GET['id'];
    $errmsg =message($_GET['msg']);
    $res= $Db->query("select * from admin where admin_id='".$id."'");
    $fetch=mysql_fetch_object($res);
    $fname=stripslashes($fetch->name); 
    $email_id =stripslashes($fetch->email_id);
    $mobile_no = stripslashes($fetch->mobile_no) ; 
    $comp_code=$fetch->comp_code;
    $branch_code=$fetch->branch_code; //Un-Commented on 16-SEP-2017, Pratik.
    //$branch_code=$fetch->heairachy_details_id; //Commented on 16-SEP-2017, Pratik.
    $hierarchy_id=$fetch->heairachy_id;
    $heairachy_details_id=$fetch->heairachy_details_id;
    $dept_code=$fetch->dept_code;
    $variable =$fetch->utype;
	$uTypeArray = explode(',', $variable);
	$utype=$uTypeArray[0];
	unset($uTypeArray[0]);
	$usertype=implode(',',$uTypeArray);
    $username =stripslashes($fetch->username);
    $password = stripslashes($fetch->password);
    $status =  $fetch->status;
    $tpwd = "***********";
    
    $ad =   $fetch->admin_user ;
    $crisk = $fetch->crisk ;
    $usr = $fetch->usr ;
    $mst = $fetch->mst ;
    $rpt = $fetch->rpt ;

    $arisk = $fetch->arisk ;
    $erisk = $fetch->erisk ;
    $drisk = $fetch->drisk ;
    $actrl = $fetch->actrl ;
    $ectrl = $fetch->ectrl ;
    $tlink = $fetch->tlink ;
    $gradeId = $fetch->gradeId;
    $mode="update";
    
    ### Added on 16-SEP-2017, Pratik. For "LOCATION" Dropdown Select Options Starts Here ###
    if($hierarchy_id == 1){
        $field_names = 'hod_code as id,name';
        $location_tbl_name = 'tbl_hod';
    }elseif($hierarchy_id == 2){
        $field_names = 'zone_code as id,name';
        $location_tbl_name = 'tbl_zone';
    }elseif($hierarchy_id == 3){
        $field_names = 'branch_code as id,name';
        $location_tbl_name = 'tbl_branch';
    }
    ### For "LOCATION" Dropdown Select Options Ends Here ###
    
    include "user_layout.php";
    exit;
}

if(strtoupper($_POST['mode'])=="UPDATE")
{				
    $admin_id=addslashes($_POST['admin_id']);
    $id=addslashes($_POST['admin_id']);
    $fname=addslashes($_POST['fname']);
    $email_id =addslashes($_POST['email_id']);	
    $mobile_no = addslashes($_POST['mobile_no']);
    $comp_code=$_POST['comp_code'];
    //$branch_code=$_POST['branch_code'];
    $branch_code=$_POST['cmb_location'];
    $hierarchy_id=$_POST['cmb_hierarchy_id'];
    $heairachy_details_id=$_POST['cmb_location'];
    $heairachy_details_id = 0; //Added on 16-SEP-2017, Pratik. Currently hard-coded as it is not used currently.All branch code values are displayed from tbl_branch
    $dept_code=$_POST['dept_code'];	
    if($comp_code==""){
        $utype =0;
    }else{
        $utype = $_POST['utype'];
        if($_POST['usertype']){
            $utype .= ",".$_POST['usertype'];
        }
    }
    $username =addslashes($_POST['username']);	
    $status =  addslashes($_POST['status']);	
    $ad = (int)$_POST['ad'];  
    $crisk = (int)$_POST['crisk'] ;
    $usr = (int)$_POST['usr'] ;
    $mst = (int)$_POST['mst'] ;
    $rpt = (int)$_POST['rpt'] ;

    $arisk = (int)$_POST['arisk'] ;
    $erisk = (int)$_POST['erisk'] ;
    $drisk = (int)$_POST['drisk'] ;
    $actrl = (int)$_POST['actrl'] ;
    $ectrl = (int)$_POST['ectrl'] ;
    $tlink = (int)$_POST['tlink'];
    $gradeId =  (int)$_POST['gradeId'];
   

    $sql_chk = $Db->query("select * from admin where username='$username' and admin_id!='$admin_id'");
    if($Db->num_rows($sql_chk)==0){
        $qPrev = $Db->query("select CONCAT_WS('#~#',name,email_id,comp_code,branch_code,dept_code,mobile_no,username,utype,admin_user,usr,mst,rpt,actrl,ectrl,arisk,crisk,drisk,erisk,tlink) as strPrev from admin where admin_id=".$admin_id);
        $ft = mysql_fetch_object($qPrev);
        $strPrev = $ft->strPrev;

        $quser = "update admin set name='$fname',email_id='$email_id',comp_code ='$comp_code',branch_code='$branch_code',heairachy_id='$hierarchy_id',heairachy_details_id='$heairachy_details_id',dept_code='$dept_code',mobile_no='$mobile_no',username='$username',status='$status',utype='$utype',admin_user='$ad',usr='$usr',mst='$mst',rpt='$rpt',actrl='$actrl',ectrl='$ectrl',tlink='$tlink',arisk='$arisk',crisk='$crisk',drisk='$drisk',erisk='$erisk',gradeId='$gradeId',activation=0 where admin_id='$admin_id'";
        $update_query = $Db->query($quser);
        if($Db->affected_rows()>0){		
            $Db->query("update admin set updated_by='".$_SESSION['user_id_tmp']."',updated_date='$today' where admin_id=".$admin_id);
            $Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('admin','$strPrev','u','".$_SESSION['user_id_tmp']."','$today')");
        }
        
       
        header("Location:user_search.php?msg=upd");
        exit;
    }else{
        $errmsg = "Username already in used";
        $mode="update";
        include "user_layout.php";
        exit;	
    }
}

if(strtoupper($_POST['mode'])=="SAVE")
{
    $fname=addslashes($_POST['fname']);	
    $email_id =addslashes($_POST['email_id']);	
    $mobile_no = addslashes($_POST['mobile_no']);
    $comp_code=$_POST['comp_code'];
    $url="https://savvysystems.in/bank-recon";
    if($comp_code==""){
        $utype =0;
        $url.="/admin";
        //$sql_user = "select name,group_code as randomNo from admin where group_code='".$_SESSION['group_code_tmp']."' and username ='".addslashes($_POST['username'])."'";
    }else{
        $url.="/company";
        $utype = $_POST['utype'];
        if($_POST['usertype']){
            $utype .= ",".$_POST['usertype'];
        }
        //$sql_user = "select name,randomNo from tbl_company where company_code =".$comp_code;
	      
    }
    $group_code=$_POST['group_code'];
    if($group_code==""){
        $group_code=$_SESSION['group_code_tmp'];
    }
    //$branch_code=$_POST['branch_code'];
    $branch_code=$_POST['cmb_location'];
    $hierarchy_id=$_POST['cmb_hierarchy_id'];
    $heairachy_details_id=$_POST['cmb_location'];
    $heairachy_details_id = 0; //Added on 16-SEP-2017, Pratik. Currently hard-coded as it is not used currently.All branch code values are displayed from tbl_branch
    $dept_code=$_POST['dept_code'];
    $username =addslashes($_POST['username']);	
//    $password = generatePassword();
    $password = "mumbai1";
    $status =  addslashes($_POST['status']);	
    
    $ad = (int)$_POST['ad'];  
   
    $rappr = (int)$_POST['rappr'] ;
    $crisk = (int)$_POST['crisk'] ;
    $usr = (int)$_POST['usr'] ;
    $mst = (int)$_POST['mst'] ;
    $rpt = (int)$_POST['rpt'] ;

    $arisk = (int)$_POST['arisk'] ;
    $erisk = (int)$_POST['erisk'] ;
    $drisk = (int)$_POST['drisk'] ;
    $actrl = (int)$_POST['actrl'] ;
    $ectrl = (int)$_POST['ectrl'] ;
    $tlink = (int)$_POST['tlink'] ;
    $gradeId =  (int)$_POST['gradeId'];
    $compstatus=1;

    $sql_chk = $Db->query("select * from admin where username='$username'");
    if($Db->num_rows($sql_chk)==0){						
      
        $quser = "INSERT INTO admin (name,email_id,mobile_no,branch_code,heairachy_id,heairachy_details_id,comp_code,group_code,dept_code,username,password,status,compstatus,utype,admin_user,usr,mst,rpt,actrl,ectrl,arisk,crisk,drisk,erisk,tlink,gradeId,added_by,added_date)values('$fname','$email_id','$mobile_no','$branch_code','$hierarchy_id','$heairachy_details_id','$comp_code','$group_code','$dept_code','$username',AES_ENCRYPT('".$password."','".SECURE_KEY."'),'$status','$compstatus','$utype','$ad','$usr','$mst','$rpt','$actrl','$ectrl','$arisk','$crisk','$drisk','$erisk','$tlink','$gradeId','".$_SESSION['user_id_tmp']."','$today')";
        $insert_query = $Db->query($quser);
       
	    if($comp_code==""){
            $qPrev1 = $Db->query("select name,group_code from tbl_groupmaster where group_code='".$_SESSION['group_code_tmp']."'");
            $ft1 = mysql_fetch_object($qPrev1);
            $group_comp_name = $ft1->name;
            $group_code = $ft1->group_code;
            
            $subject = $group_comp_name." GST Group Login Details";

            $bodyMsg = "<html><body style='background-color:#FFFFFF;color:#000;font-family:Helvetica,Arial,sans-serif;font-size:12px;'>
            Dear ".$fname.",<BR><BR>
            <div><strong><font color='#A7262B'>Please use below details to manage Login's</font></strong><br />
            <br />Your Login detail:<br/><br/>
            URL : <a href='".$url."'>".$url."</a><br/>
            Username : ".$username."<br/>
            Password : ".$password. "<br/>
            Group Code: ".$group_code."<br/><br/>
            Any query please contact Support Team.<BR><BR>
            </div>
            <div>Thanks and Regards,<BR>
            <strong><font color='#A7262B'>System Admin</div></body></html>";
        } else {
            $sql_user = "select name,randomNo from tbl_company where company_code ='".$comp_code."'";
            $qPrev = $Db->query($sql_user);
            $ft = mysql_fetch_object($qPrev);
            $comp_name = $ft->name;
            $comp_regNo_code = $ft->randomNo;
            
            $subject = $comp_name." BANK RECON- Company Login Details";

            $bodyMsg = "<html><body style='background-color:#FFFFFF;color:#000;font-family:Helvetica,Arial,sans-serif;font-size:12px;'>
            Dear ".$fname.",<BR><BR>
            <div><strong><font color='#A7262B'>Please use below details to manage BANK RECON [Company Logins]</font></strong><br />
            <br />Your Login detail:<br/><br/>
            URL : <a href='".$url."'>".$url."</a><br/>
            Username : ".$username."<br/>
            Password : ".$password. "<br/>
            Company Code: ".$comp_code. " <br/><br/>
            Any query please contact Support Team.<BR><BR>
            </div>
            <div>Thanks and Regards,<BR>
            <strong><font color='#A7262B'>System Admin</div></body></html>";
        }
        
        
        //include "email.php";				
        sendEmail($email_id,$subject,$bodyMsg);
        header("Location:user_search.php?msg=add");
        exit;
    }else{
        $errmsg = "Username already in used";
        $mode="save";
        include "user_layout.php";
        exit;			
    }				
}
?>