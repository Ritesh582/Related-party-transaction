<?php
include ('includes/config.php');
//include "includes/session_check.php";

$redirectURL = DOMAIN.str_replace('/bank-recon', '', $_SESSION["previousURL"]); //Added on 15-SEP-2017, Pratik. For re-direction

if ($_POST['action'] == 'change_pwd'){
    $pwd_new= $_POST['txtPassword'];
    $pwd_old= $_POST['oldpwd'];
    if($pwd_old == $_SESSION['pwd_tmp']){
        $query = "update admin set password=AES_ENCRYPT('".$pwd_new."','".SECURE_KEY."'),activation=1,activationdate='$today' where admin_id ='".$_SESSION['user_id_tmp1']."'";		
        $results = $Db->query($query);
        $_SESSION['pwd_tmp'] = $pwd_new;		
        //$showmsg = 'Password changed successfully!';
        //header("Location:index.php?err=gen"); //Commented on 15-SEP-2017, Pratik.
        header("Location:".$redirectURL."?err=gen"); //Added on 15-SEP-2017, Pratik.
        exit;
    }else{
        $showmsg = 'Old Password is Incorrect!';
    }
}
include "includes/header.php";
//include "includes/leftmenu.php";	
?>
 <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
				 
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change  Password</h5>
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
						<? if($showmsg != ""){echo "<p class='success'>".$showmsg."<span>X</span></p>";}?>  
	  <form  method="post" action="<?php $_SERVER["PHP_SELF"]?>"  class="form-horizontal" id="changePassword" >
                                <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10"><input type="text" placeholder="Enter User Name" name='txtUsername' value="<?=$_SESSION['username_tmp'];?>" class="form-control" readonly></div>
									
                                </div>
                                <div class="hr-line-dashed"></div>
                             	 <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10"> <input name="oldpwd"  placeholder="Enter  Password" type="password" value="" class="form-control" required></div>
									
                                </div>
                                <div class="hr-line-dashed"></div>
								 <div class="form-group"><label class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10"> <input name="txtPassword" id="txtPassword" placeholder="Enter New Password" type='password' value="" class="form-control" required></div>
									
                                </div>
                                <div class="hr-line-dashed"></div>
								
								 <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10"> <input name="txtconfirmPassword" placeholder="Enter Confirm Password" type='password' class="form-control" required></div>
									
                                </div>
                                
								<div class="hr-line-dashed"></div>
								 <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
									      <input type='hidden' value='change_pwd' name='action'>
		                                <button class="btn btn-white" type="button" onclick="back_fn('index.php');">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                       
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
		 </form>
		 </div>
		 </div>
		 </div>
		 
		 <? include "includes/footer.php";?>

        </div>
        </div>
   <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#changePassword').validate({
			rules:{
				
				oldpwd:{
					required:true,
			    	 minlength:3,
			    	 maxlength:10
					
				      },
		         txtPassword:{
		        	 required:true,
			    	 minlength:3,
			    	 maxlength:10
		    		 },
		    	txtconfirmPassword:{
			    	 
			    	 required:true,
			    	 minlength:3,
			    	 maxlength:10,
			    	 equalTo: "#txtPassword"
			    	 
			     	},
					
			    
			},
			 messages: {
	                
	                "oldpwd" :{
	                	required: "Old Password is required.",
						
	                    },

	                    
		                "txtPassword" :{
		                	required: "New Password is required.",
							
		                    },

		                
			                "txtconfirmPassword" :{
			                	required: "Confirm Password is required.",
			                //	equalTo: "Please enter the same Password.",
			                    },
			 },
			
		});
	});
	
	
	</script>


   
