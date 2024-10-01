<?php
       include ('includes/config.php');
		if(isset($_GET['error']) && $_GET['error']==0){
			$showmsg="Enquiry Send";
		}
		if(isset($_GET['error']) && $_GET['error']==1){
			$showmsg="Enter correct email id";
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
                <h2 class="font-bold" align="center">Company Reach_Us Details</h2>
             </div></div>
            <div class="col-md-12">
                <div class="ibox-content">
				<? if($showmsg != ""){$class = 'success';if($_GET['msg'] == 'ndel'){$class = 'error';}echo "<p class='".$class."'>".$showmsg."<span>X</span></p>";}?>
                    <form class="form-horizontal" id="reachUsForm" role="form" action="reach_us_email.php" method="post">
					 <div class="form-group">
						 </div>
                        <div class="form-group"><label class="col-sm-4 control-label">Subject  <span class="information">*</span></label>
                            <div class="col-sm-8"> <input name="txt_subject" type="text" class="form-control" id="txt_subject" tabindex="1" value="" size="55" /></div>
						 </div>
						 <div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-4 control-label">Message <span class="information">*</span></label>
                            <div class="col-sm-8">   <textarea name="txt_message" cols="30" rows="5" tabindex="2" class="form-control"></textarea></div>
							</div>
							<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-4 control-label">Contact No  <span class="information">*</span></label>
                            <div class="col-sm-8"> <input type="number"  class="form-control" name="txt_contactno" placeholder="Enter Contact No"></div>
							</div>
						 <div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-4 control-label">Email ID   <span class="information">*</span></label>
                            <div class="col-sm-8"> <input type="email" class="form-control" name="txt_email" placeholder="Enter Email Id"></div>
							</div>
							 
							
						  <div class="hr-line-dashed"></div>
								 	     <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">
						 <button type="submit"  class="btn btn-primary ">Submit Inquiry</button>
						</div></div>
						
                        
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
	
$('#reachUsForm').validate({
    rules:{
    		      txt_subject: {
				required:true,
			   
			},
			txt_message: {
				required:true,
				
			},
                 txt_email:{
				required:true,
				email: true
			},	
			txt_contactno:{
				required:true,
				number: true
			},
								
					
			
           
            
    	
        },
        messages: {

       
            txt_email:{
				required:'Please enter Email',
				email:'Please enter valid Email'
			},
            
			txt_contactno : {
				required:'Please enter Mobile Number',
            	number: 'Please enter valid Mobile Number'
			},
			
					
	        
           
            
		},
        highlight: function(element) {
            $(element).closest('.fg-line').addClass('has-error');
        
        },
        unhighlight: function(element) {
            $(element).closest('.fg-line').removeClass('has-error');
        },
   
});
});
        </script>
</body>



</html>
