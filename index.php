<?php
include ('includes/config.php');
header("location: company/index.php");exit;
//if($_SESSION['user_id_tmp'] <> ""){header("location:gst_dashboard.php");exit;}
if((int)$_SESSION['user_id_tmp'] > 0 && FL_PATH == $_SESSION['folder_tmp']){header("Location:gst_dashboard.php");exit;}
$showmsg = "";
if($_GET['err']=='gen')
$showmsg="<b>Password change successfully </b>";
if ($_GET['err'] == 1)
$showmsg = "<b>Invalid Email or Password!</b>";
if ($_GET['err'] == 'out')
$showmsg = "<b>You have successfully logged out!</b>";	
if($_GET['err']=='access')
$showmsg = "<b>Access denied for ".TIME_PERIOD." day</b>";
if ($_POST['action'] == 'login_process' && $_POST['Username']!='' && $_POST['Password']!=''){
	$user= $_POST['Username'];
	$pwd= $_POST['Password'];
	$result = confirmIPAddress($user);

      if($result == 1){
                       
		             header("location: index.php?err=access");
                     exit;

       } 
	  else
	  {	
  	                
                     $query = "SELECT * FROM tbl_vendor WHERE emailId = '".$user."' AND password=AES_ENCRYPT('".$pwd."','".SECURE_KEY."')  and comp_code!=''";
     
	     $results = $Db->query($query);
		$exist = mysql_fetch_array($results);
		$affected = $Db->num_rows();
          

if($affected > 0){
  session_start();
 
  $_SESSION['user_id_tmp1'] = $exist['id'];	
  $_SESSION['username_tmp'] = $user;
  $_SESSION['pwd_tmp'] = $pwd;
  $_SESSION['panNo_tmp']  =$exist['panNo'];
     $now  = date('Y-m-d');   // or your date as well
     $registrationDate = $exist['registrationDate'];
    $daydiff=floor((abs(strtotime($now) - strtotime($registrationDate ))/(60*60*24)));
   if($daydiff>40 && $daydiff<45)
   {
    $_SESSION['days_tmp']="<b>Your Password is ".$daydiff." days old Please Change Password</b>";
   }
  
   if($daydiff>=45 || $exist['status']==0)
   {
   //  header("location:change_passwords.php");
   //  exit;   
   }
   $_SESSION['user_id_tmp'] = $exist['id'];
  $ipaddress = getRealIpAddr(); 
  $_SESSION[session_ip] = $ipaddress;
  $_SESSION['comp_code_tmp']=$exist['comp_code'];
  $query_insert = $Db->query("insert into login_history (`user_id`,`loginType`,`ipaddress`,`macaddress`,`comp_code`) values ('".$_SESSION['user_id_tmp']."' ,2,'$ipaddress','$macaddress','".$_SESSION['comp_code_tmp']."')");
  $_SESSION['admin_user_tmp'] = -1;
  $temp = explode("/",$_SERVER['PHP_SELF']);
  $_SESSION['folder_tmp'] = $temp[1];
   
  header("location: vendor.php?mode=add");
  exit;

 }
 addLoginAttempt($user);
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

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     <link href="css/login.css" rel="stylesheet">
	 <!-- Mainly scripts -->
   <script src="js/jquery-2.1.1.js"></script>

    <!-- iCheck -->
   <script src="js/jquery.validate.min.js"></script>
   
 </head>

<body class="gray-bg" >

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Goods and Services Tax </h2>

                <p>
                   support management
                </p>
               
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
				 <? if($showmsg != ""){echo "<p class='error'>".$showmsg."</p>"; }?>
                    <form class="m-t" id="loginForm" role="form" method="post" action="index.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="Username" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="Password" placeholder="Password">
                        </div>
						<div class="form-group">
						 <img id="imgCaptcha" src="create_image.php" height="30" width="100"  /><a href="javascript:void(0)" target="_self" onClick="getImage();"><img alt="image" src="img/refresh.jpg" height="30" width="20"  border="0" /></a>	
						</div>
						<div class="form-group">
						 <input id="txtCaptcha" type="text" class="form-control"  name="txtCaptcha"  class="inputText" >
						</div>
						
						<input type='hidden' value='login_process' name='action'>
                        <button type="submit"  class="btn btn-primary block full-width m-b">Login</button>
                          <p >User will be block after three unsuccessfully attempt</p>
                        <a href="forgotpassword.php" style="float:left">
                           <u> <small>Forgot Password</small></u>
                        </a>
						  <a href="reach_us.php" style="float:right">
                            <u><small>REACH Us</small></u>
                        </a>
                        &nbsp;
                    </form>
                </div>
            </div>
        </div>
       <div id="footer" align="right">
<div id="credits"><?=CP_FOOTER;?></div><br>
</div>


    </div>
	<script type="text/javascript">
	function getImage(){
	
	    img = document.getElementById('imgCaptcha'); 
        img.src = 'create_image.php?' + Math.random();
	   	
      
	}
	</script>
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
					"txtCaptcha":{
					required:true,
					/*remote: function(){
					 var param = "txtCaptcha" + "=" + encodeURIComponent( $('#txtCaptcha').val());
					
			             var result= $.ajax({
        type:"POST",
        cache:true,
        url:"captcha.php",
        data:param, 
		async: false,    // multiple data sent using ajax
        success: function (result) {
		 
		 img = document.getElementById('imgCaptcha'); 
        img.src = 'create_image.php?' + Math.random();
	   	
       }
	  
      });
	 	 if(result.responseText==2){ return false;
         }
		 return true;			
	}
					
	} */
                 
            },
			
		},
            messages: {
                
                "Username" :{
                	required: "Please Enter Email.",
					
                    },
				"Password" :{
				 required:"Please Enter Password",
				}
				
                
            }
			
			
		});
	});
	
	
	</script>
    <?php
include "includes/chatbotpage.php";
?>
</body>



</html>
