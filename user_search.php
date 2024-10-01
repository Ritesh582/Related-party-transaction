<?php
 
	$pagename = 'user_search.php';
	include ('includes/config.php');
	pageAccess((int)$_SESSION['tmp_usr']);
	include "includes/session_check.php";
	if($_POST['mode'] == 'pwdgen'){
		$spwd = generatePassword();
		$sid = $_POST['sid'];
		$email_id = $_POST['email_id_g'];
		$url= DOMAIN;
		$url.= '/company';
		$cndStr = getrecord('admin','username'," where admin_id ='$sid'");
	    if($_SESSION['comp_code_tmp']==""){$url.="/admin";}
		$subject = "Related Party Transaction - Password Reset Details";
		$bodyMsg = "<html><body style='background-color:#FFFFFF;color:#000;font-family:Helvetica,Arial,sans-serif;font-size:12px;'>
		Dear User,<BR><BR>
		<div><strong><font color='#A7262B'>Plese used below detail to manage Related Party Transaction Web Application</font></strong><br />
		<br />Login detail:<br/><br/>
		URL : <a href='http://".$url."'>".$url."</a><br/>
		Username : ".$cndStr."<br/>
		Password : ".$spwd. "<br/><br/>
        Company Code: ".$_SESSION['comp_code_tmp']. " <br/><br/>
		Any query please contact Support Team.<BR><BR>
		</div>
		<div>Thanks and Regards,<BR>
		<strong><font color='#A7262B'>System Admin</div></body></html>";
		
        //include "email.php";
        
		sendEmail($email_id,$subject,$bodyMsg);
		$upd = $Db->query("update admin set password=AES_ENCRYPT('".$spwd."','".SECURE_KEY."'),activation=1 where admin_id='".$sid."'");
		$update = $Db->query("update login_attempts set attempts=0  where ip='".$cndStr."'");
		 
                $url = $pagename.'?msg=pwdg';
		        header("Location:".$url);
		        exit;		
	}

	    $str = "";
        
        $showmsg = message($_GET['msg']);
	
	$sql = "select * from admin where 1";
	
	if($_SESSION['comp_code_tmp']!="") {$str .= " and comp_code='".$_SESSION['comp_code_tmp']."'";}
	if($_SESSION['comp_code_tmp']=="") {$str .= " and comp_code='' and group_code='".$_SESSION['group_code_tmp']."'";}
   
    $sql .=$str;
       
  $result_set = $Db->query($sql);	
  include "includes/header.php";
  include "includes/leftmenu.php";
  ?>
    

        <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
                    
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>User</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="main_dashboard.php">Home</a>
                            </li>
                            <li class="active">
                                <strong>user</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
				    <div class="wrapper wrapper-content animated fadeInRight">
					<div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><a href="user.php?mode=add"><font color="#FFFFFF">Add User</font></a></span>
                            </div>
                        </div>
                    </div>
				      <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>List of User</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#">Config option 1</a>
                                            </li>
                                            <li><a href="#">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
								
                                <div class="ibox-content">

<? if($showmsg != ""){$class = 'success';if($_GET['msg'] == 'ndel'){$class = 'info';}echo "<p class='".$class."'>".$showmsg."<span>X</span></p>";} ?>
<table class="table table-striped table-bordered table-hover dataTables-example " cellspacing="0" width="100%" >
 <thead>
 <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>
  <th scope="col"><B>Name</B></th>
  <th scope="col"><B>Email ID</B></th>
  <th scope="col"><B>Contact No</B></th>
  <th scope="col"><B>User Name</B></th>
  <th scope="col"><B>User Type</B></th>
  <th scope="col"><B>Status</B></th>
  <th scope="col"><B>Action</B></th>
</tr>
</thead>
<tbody>
<? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr class="gradeX">
  <td width="15" align="center"><?=$i;?></td>
  <td><? echo $row['name']; ?></td>
  <td><? echo $row['email_id']; ?></td>
  <td><? echo $row['mobile_no']; ?></td>
  <td><? echo $row['username']; ?></td>
  <td><?php $array=explode(',',$row['utype']);
 foreach($array as $uType) {
     if($uType){
         $condition = " where id =".$uType;	
	echo getrecord('tbl_role','name',$condition)."|";
     }
}
  ?>
</td>
  <td width='20'><? echo status($row['status']); ?></td>
  <td width="65" align="center">
   <a  href='user.php?mode=edit&id=<?=$row['admin_id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
   <a href='#' onclick="gpwd('<?=$row['admin_id'];?>','<?=$row['email_id']?>')" title="Reset Password"><i class="fa fa-cog" aria-hidden="true"></i></a>
  <a href="#" onclick="deleterecord(<?=$row['admin_id']?>,'user')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
  
  
 
  </td>
</tr>
<? }?>
</tbody>

</table>
</div>

<form name='formp' action='<?=$pagename;?>' method='post'>
	<input type='hidden' name='mode' value=''>
	<input type='hidden' name='email_id_g' value=''>
	<input type='hidden' name='sid' value=''>
</form>
<script>
function gpwd(sid,email_id){
	if(email_id == ""){alert("Email ID Not Defined");return;}
	if(confirm("Are you sure you want to Reset Password")){	
		document.formp.mode.value='pwdgen';
		document.formp.sid.value=sid;
		document.formp.email_id_g.value=email_id;
		document.formp.submit();
	}
}
</script>
        
</div>
</div>
</div>
</div>

 <? include "includes/footer.php";?>
</div>
</div>




<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });

        

    });

    
</script>
<style>
    body.DTTT_Print {
        background: #67bdf9;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#67bdf9;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #67bdf9;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #337ab7;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>



</html>
