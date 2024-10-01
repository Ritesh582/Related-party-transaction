<?php
ob_start();
include ('../includes/config.php');

if(isset($_GET['msg']) && $_GET['msg']==1)
{
    $showmsg="Password is sent on your registered email id. ";
}
if(isset($_GET['msg']) && $_GET['msg']==0)
{
    $showmsg="Please enter correct email id. Try Again.";
}

//if($_POST['txt_username']!="" && $_POST['emailId']!="" && $_POST['comp_code']!="")
if($_POST['emailId']!="" && $_POST['comp_code']!="")
{
    //$username	=	$_POST['txt_username'];
    $emailId	=	$_POST['emailId'];
    $comp_code	=	$_POST['comp_code'];
    
    $sql	= "select AES_DECRYPT(password,'".SECURE_KEY."') password from admin where email_id='$emailId' and comp_code='$comp_code'";
    $res	= $Db->query($sql);
    $cnt	= mysql_num_rows($res);
    if($cnt == 1)
    {
        // Mail the password
        $row=mysql_fetch_assoc($res);
        $pass       =	$row['password'];
        $comp_code  =	$row['comp_code'];
        $condition  =   " where company_code ='".$comp_code."'";	
        $form       =   getrecord('tbl_company','comp_email',$condition);
        $name       =   getrecord('tbl_company','name',$condition);
        $to         =	$emailId;
        
        $subject = $name ." GST- Login Details";

        $bodyMsg = "<html><body style='background-color:#FFFFFF;color:#000;font-family:Helvetica,Arial,sans-serif;font-size:12px;'>
        Dear User,<BR><BR>
        <div><strong><font color='#A7262B'>Your login credentials</font></strong><br />
        <br />Your Login detail:<br/><br/>
        Username : ".$username."<br/>
        Password : ".$pass. " <br/>
        Company code : ".$comp_code." <br/><br/><strong>Note : Please Change Password after 1st Login.</strong><br/><br/>
        Any query please contact Support Team.<BR><BR>
        </div>
        <div>Regards,<BR>
        <strong><font color='#A7262B'>Support Team</font></strong></div></body></html>";
        
        sendEmail($to,$subject,$bodyMsg);
        //$headers = "From: $from";
        //smail($to,$subject,$bodyMsg,$headers);
        header("Location: ".DOMAIN."/company/forgotpassword.php?msg=1");
        exit;
    }else{
        header("Location: ".DOMAIN."/company/forgotpassword.php?msg=0");
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
	 <!-- Mainly scripts -->
   <script src="../js/jquery-2.1.1.js"></script>

    <!-- iCheck -->
   <script src="../js/jquery.validate.min.js"></script>
   
 </head>

<body class="gray-bg" >

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-12"><div class="ibox-content">
                <h2 class="font-bold" align="center">Forgot Password  Details</h2>
             </div></div>
            <div class="col-md-12">
                <div class="ibox-content">
                <?  
                if($showmsg != "" && $_GET['msg']==1){
                    echo "<p class='success'>".$showmsg."</p>";
                }elseif($showmsg != "" && $_GET['msg']==0){
                    echo "<p class='error'>".$showmsg."</p>";
                }
                ?>
                    <form class="form-horizontal" id="forgotPasswordForm" role="form" method="post" action="">
                        <!--<div class="form-group"><label class="col-sm-4 control-label">User Name <span class="information">*</span></label>
                            <div class="col-sm-8"> <input type="text" class="form-control" name="txt_username" placeholder="Enter User Name"></div>
			</div>-->
			<div class="hr-line-dashed"></div>
			<div class="form-group"><label class="col-sm-4 control-label">Company Code  <span class="information">*</span></label>
                            <div class="col-sm-8"> <input type="text" class="form-control" name="comp_code" placeholder="Enter Company Code"></div>
			</div>
			<div class="hr-line-dashed"></div>
			<div class="form-group"><label class="col-sm-4 control-label">Email ID   <span class="information">*</span></label>
                            <div class="col-sm-8"> <input type="email" class="form-control" name="emailId" placeholder="Enter Email Id"></div>
			</div>
			<div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button type="button" id="btn_forgotpass_submit"  class="btn btn-primary ">Submit</button>
                                <button type="button" id="btn_forgotpass_login" class="btn btn-primary ">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       <div id="footer" align="right">
<div id="credits"><?=CP_FOOTER;?></div><br>
</div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
    $('#btn_forgotpass_submit').click(function(e) {
        ValidateIt();
        var formaction = '<?php echo DOMAIN; ?>/company/forgotpassword.php';
        $('#forgotPasswordForm').attr('action', formaction);
        $("#forgotPasswordForm").submit();
    });
    $('#btn_forgotpass_login').click(function(e) {
        var formaction = '<?php echo DOMAIN; ?>/company/';
        $('#forgotPasswordForm').attr('action', formaction);
        $("#forgotPasswordForm").submit();
    });
});
function ValidateIt()
{
    $('#forgotPasswordForm').validate({
        rules:{
            emailId:{
                    required:true,
                    email: true
                },
                /*txt_username:{
                    required:true,
                },*/
                comp_code:{
                    required:true,
                }	
            },
            messages: {          
                emailId:{
                    required:'Please enter Email',
                    email:'Please enter valid Email'
                },
            },
            highlight: function(element) {
                $(element).closest('.fg-line').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.fg-line').removeClass('has-error');
            },
    });
}
</script>
</body>



</html>
