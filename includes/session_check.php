<?php
function usercheck($user_id,$pwd,$admin_user){
	$myDb = new DB();
	if($user_id>0 && $pwd<>"" ){
	     if($admin_user>-1){
		$sql = $myDb->query("select * from admin where admin_id='$user_id' and password=AES_ENCRYPT('".$pwd."','".SECURE_KEY."') and status='1'");
		}else{
		$sql = $myDb->query("select * from tbl_vendor where id='$user_id' and password=AES_ENCRYPT('".$pwd."','".SECURE_KEY."') and status='1'");

		}
		if(mysql_num_rows($sql) == 0){
			header('Location:logout.php');
			exit;
		}
	 }else{
		header('Location:logout.php');
		exit;
	}
}

//check token
$databasetoken=getrecord("admin","token","where admin_id='".$_SESSION['user_id_tmp']."'");
if(isset($_SESSION['token']) && $_SESSION['token']!=$databasetoken){
	session_start();
	session_unset();
	session_destroy();
	header("location: company/index.php?err=2");
	exit;
}else{

if($_SESSION['user_id_tmp'] == "" || FL_PATH != $_SESSION['folder_tmp']){
	header('Location:index.php');exit;
}


usercheck($_SESSION['user_id_tmp'],$_SESSION['pwd_tmp'],$_SESSION['admin_user_tmp']);
//$pageArr = array("tmp_usr"=>'user_search.php');
}
?>
