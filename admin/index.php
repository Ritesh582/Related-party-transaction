<?php
include ('../includes/config.php');
session_regenerate_id();
$_SESSION["previousURL"] = $_SERVER["REQUEST_URI"];//Added on 15-SEP-2017, Pratik. To re-direct to this page after change password.
if((int)$_SESSION['user_id_tmp'] > 0 && FL_PATH == $_SESSION['folder_tmp']){header("Location:../main_dashboard.php");exit;}
$showmsg = "";
if ($_GET['err'] == 1)
$showmsg = "<b>Invalid User Name or Password!</b>";
if ($_GET['err'] == 'out')
$showmsg = "<b>You have successfully logged out!</b>";	
if($_GET['err']=='access')
$showmsg = "<b>Access denied for ".TIME_PERIOD." day</b>";
if ($_POST['action'] == 'login_process' && $_POST['Username']!='' && $_POST['Password']!=''){
    $user= $_POST['Username'];
    $pwd= $_POST['Password'];
    $group_code=$_POST['groupCode'];
    $result = confirmIPAddress($user);
    
    if($result == 1){
        header("location: index.php?err=access");
        exit;
    }
    else
    {
        if($user=='admin'){
            $query = "SELECT * FROM admin WHERE username = '".$user."' AND password=AES_ENCRYPT('".$pwd."','".SECURE_KEY."')  AND admin_user>=1 AND status=1";
        }else{
            $query = "SELECT * FROM admin WHERE username = '".$user."' AND password=AES_ENCRYPT('".$pwd."','".SECURE_KEY."') AND group_code='".$group_code."' AND admin_user>=1 AND status=1";
        }
		//echo "SQL : " . $query . "<br/>";
        $results = $Db->query($query);
        $exist = mysql_fetch_array($results);
        $affected = $Db->num_rows();
		//echo "Rows : " . $affected . "<br/>";
        $query1 = "SELECT * FROM tbl_groupmaster WHERE group_code='".$group_code."'";
		//echo "SQL 1 : " . $query1 . "<br/>";
        $resu= $Db->query($query1);
        $exists = mysql_fetch_array($resu);
        $affecteds = $Db->num_rows();
		//echo "Rows 1 : " . $affecteds . "<br/>";die;
    if($affected > 0 && $affecteds > 0 ){
        session_start();
        $_SESSION['user_id_tmp1'] = $exist['admin_id'];	
        $_SESSION['username_tmp'] = $user;
        $_SESSION['pwd_tmp'] = $pwd;
  
        $now  = date('Y-m-d');   // or your date as well
        $activationdate = $exist['activationdate'];
        $daydiff=floor((abs(strtotime($now) - strtotime($activationdate ))/(60*60*24)));
        if($daydiff>40 && $daydiff<45)
        {
            $_SESSION['days_tmp']="<b>Your Password is ".$daydiff." days old Please Change Password</b>";
        }
        if($daydiff>=45 || $exist['activation']==0)
        {
            header("location:../change_passwords.php");
            exit;
        }
        $_SESSION['user_id_tmp'] = $exist['admin_id'];
        $ipaddress = getRealIpAddr(); 
        $_SESSION[session_ip] = $ipaddress;
        $query_insert = $Db->query("insert into login_history (`user_id`,`ipaddress`,`macaddress`) values ('".$_SESSION['user_id_tmp']."','$ipaddress', '$macaddress')");
  
        $_SESSION['admin_user_tmp'] = $exist['admin_user'];
        $_SESSION['dept_id_tmp'] = $exist['dept_id'];
        $_SESSION['dept_code_tmp'] = $exist['dept_code'];
        $_SESSION['comp_code_tmp']=$exist['comp_code'];
        $_SESSION['branch_code_tmp'] = $exist['branch_code'];
        $_SESSION['heairachy_id']=$exist['heairachy_id'];
        $_SESSION['heairachy_details_id']=$exist['heairachy_details_id'];
        $_SESSION['group_code_tmp']=$exists['group_code'];
        $_SESSION['utype_tmp'] = $exist['utype'];

        $_SESSION['tmp_appr'] = $exist['appr'];
        $_SESSION['tmp_rappr'] = $exist['rappr'];
        $_SESSION['tmp_crisk'] = $exist['crisk'];
        $_SESSION['tmp_usr'] = $exist['usr'];
        $_SESSION['tmp_mst'] = $exist['mst'];
        $_SESSION['tmp_rpt'] = $exist['rpt'];

        $_SESSION['tmp_arisk'] = $exist['arisk'];
        $_SESSION['tmp_erisk'] = $exist['erisk'];
        $_SESSION['tmp_drisk'] = $exist['drisk'];
        $_SESSION['tmp_actrl'] = $exist['actrl'];
        $_SESSION['tmp_ectrl'] = $exist['ectrl']; 
        $_SESSION['tmp_tlink'] = $exist['tlink'];
        $_SESSION['Grade_Id_tmp']=$exist['gradeId'];
        $condition = " WHERE dept_code='".$_SESSION['dept_code_tmp']."' AND comp_code='".$_SESSION['comp_code_tmp']."'";
        $deptid = getrecord('department','id',$condition);
        $_SESSION['user_deptid'] = $deptid;
        
        $temp = explode("/",$_SERVER['PHP_SELF']);
        $_SESSION['folder_tmp'] = $temp[1];
		
		//echo "TEMP 0 : " . $temp[0] . "<br/>";
		//echo "TEMP 1 : " . $temp[1] . "<br/>";
		//echo "FL_PATH : " . FL_PATH . "<br/>";
		//echo "FOLDER : " . $_SESSION['folder_tmp'] . "<br/>";die;
		
		header("location:../main_dashboard.php");
        exit;
    }
    addLoginAttempt($user,'1');//Modified on 19-SEP-2017, Pratik. Passing default '1'  as 'comp_code' field is required field. '1' stands for "ADMIN LOGIN"
    header("location: index.php?err=1");
    exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=CP_TITLE;?></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <script src="../js/jquery-2.1.1.js"></script>
    <!-- iCheck -->
   <script src="../js/jquery.validate.min.js"></script>
 </head>

<body class="gray-bg" >
    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Related Party Transaction</h2>

                <p>
                support management
                <p>
                    <br><br>
                <p> This website is best viewed with Internet Explorer Version 11.7 and Above, and latest versions of Google chrome and Mozilla Firefox   <p>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
				 <? if($showmsg != ""){echo "<p class='error'>".$showmsg."</p>"; }?>
                    <form class="m-t" id="loginForm"  role="form" method="post" action="index.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="Username" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="Password" placeholder="Password" required="">
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control" name="groupCode" placeholder="groupCode">
                        </div>
						<input type='hidden' value='login_process' name='action'>
                        <button type="submit"  class="btn btn-primary block full-width m-b">Login</button>
                          <p >User will be block after three unsuccessfully attempt</p>
                        <a href="#">
                            <small>Forgot your username or password, please contact administrator</small>
                        </a>
                          
                          
                          <br/>
                          <br/>
                          
                          <a href='../version.php'>
                              <small>Version Entry</small>
                          </a>
                    </form>
                </div>
            </div>
        </div>
       <div id="footer" align="right">
<div id="credits"><?=CP_FOOTER;?></div><br>
</div>
    </div>
    <?php
include "../includes/chatbotpage.php";
?>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#loginForm').validate({
			rules: {
                
                 "Username": {
                	 required: true,
                    
                        },
                    "Password":{
					 required:true,
					 },
					 "groupCode":{
					   required:true,
					 }
                 
            },
            messages: {
                
                "Username" :{
                	required: "Please Enter User Name.",
					
                    },
				"Password" :{
				 required:"Please Enter Password",
				},
				"groupCode" :{
				 required:"Please Enter Group Code",
				}	

                
            }
			
		});
	});
	
	
	</script>


</html>
