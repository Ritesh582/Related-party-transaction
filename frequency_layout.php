  <? include "includes/header.php";?>
  <? include "includes/leftmenu.php";?>
    

        <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
        
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
				 
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><? if ($_GET['id']>0){ ?> Edit frequency <? }else{ ?>  <? }?></h5>
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
						<?if($errmsg != ""){echo "<p class='error'>".$errmsg."<span>X</span></p>";}?>  
						     <form method="post" action="frequency.php" class="form-horizontal" id="formGroup">
                                <!-- <div class="form-group"><label class="col-sm-2 control-label">frequency</label>
                                    <div class="col-sm-10"><input type="text" placeholder="Enter frequency"  name='frequency' value="<? echo $frequency;?>"  class="form-control"></div>
									
                                </div>
                                -->


                                <div class="form-group"><label class="col-sm-2 control-label">frequency</label>
                                    <div class="col-sm-10"><select name='frequency' class="form-control"><option value=''>select</option><?= dropdown('tbl_frequency', $frequency); ?></select> </div>
									
                                </div>
                               
                               
                               
                                <div class="hr-line-dashed"></div>
								 	     <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
									   <input type='hidden' value='<?=$id;?>' name='id'>
		                               <input type='hidden' value='<?=$mode;?>' name='mode'>	
                                        <button class="btn btn-white" type="button" onclick="back_fn('frequency_search.php');">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
							
								
                            </form>
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
        <? include "includes/footer.php";?>

        </div>
        </div>


	<script type="text/javascript">
	$(document).ready(function(){
		
		$('#formGroup').validate({
			rules: {
                
                 "txt_groupcode": {
                	 required: true,
                    
                        },
						
                    "txt_groupname":{
					 required:true,
					 },
					 
					 "txt_emailid":{
					 required:true,
					 }
                 
            },
            messages: {
                
                "txt_groupcode" :{
                	required: "Please Enter Group Code.",
					
                    },
				"txt_groupname" :{
				 required:"Please Enter Group Name.",
				},
				"txt_emailId" :{
				 required:"Please Enter EmailId.",
				}	

                
            }
			
		});
	});
	
	
	</script>
		
    
    
    <script type="text/javascript">
	$(document).ready(function(){
		
    $("#startDate").datepicker();

	});
    </script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 08:05:02 GMT -->
</html>
