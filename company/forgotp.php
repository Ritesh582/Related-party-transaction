<?php
include ('../includes/config.php');

if($_POST['txt_username']!="" && $_POST['comp_code']!="")
{
	$comp_type	=	$_POST['login_type'];
	$username	=	$_POST['txt_username'];
	$comp_code	=	$_POST['comp_code'];
	$emailId	=	$_POST['emailId'];
	if($comp_type == 'vendor')
	{
		$sql	= "select AES_DECRYPT(password,'".SECURE_KEY."'),email_id from tbl_vendor where emailId='$username' and comp_code='$comp_code'";
		$res	= mysql_query($sql) or die(mysql_error());
		$cnt	= mysql_num_rows($res);
		if($cnt == 1)
		{
			// Mail the password
			$row=mysql_fetch_assoc($res);
			$pass	=	$row['password'];
			$email	=	$row['emailId'];
		}
	}
	elseif($comp_type == 'company')
	{
		$sql1="select AES_DECRYPT(password,'".SECURE_KEY."') from admin where username='$username' and comp_code='$comp_code'";
		$res1	= mysql_query($sql1) or die(mysql_error());
		if(mysql_num_rows($res1) == 1)
		{
			$data	= mysql_fetch_assoc($res1);
			$pass	= $data['password'];
			$sql2	= "select comp_email from tbl_company where company_code='$comp_code' and comp_email='$emailId'";
			$res2	= mysql_query($sql2) or die(mysql_error());
			$cnt	= mysql_num_rows($res2);
			
			if($cnt == 1)
				$email = $emailId;
		}
	}
	else{
		$cnt = 0;
	}
	if($cnt==1)
	{
		$to		=	$email;
		$subject = "Support-Gst Login & Password Credentials";
		$message = "As per your request , Please find the following Login & Password Details.
User Name :: ". $username . "
Password  :: ". $pass . " 
Note : Please Change Password after 1st Login.";
		$from = "support@support-tds.com";
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);		
		header("location:forgotpassword.php?error=0");
	}
	else
	{
		header("location:forgotpassword.php?error=1");
	}
}

?>