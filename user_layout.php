
<? include "includes/header.php";?>
<? include "includes/leftmenu.php";?>

<div id="page-wrapper" class="gray-bg">
<? include "includes/sub-header.php";?>
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><? if ($_GET['id']>0){ ?> Edit User <? }else{ ?> Add User <? }?></h5>
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
                    <form method="post" action="user.php" class="form-horizontal" id="formUser" enctype="multipart/form-data">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-4"><input type="text" placeholder="Enter  Name" name='fname' value="<?=$fname;?>" class="form-control" ></div>
                                <label class="col-sm-2 control-label">Email *</label>
                                <div class="col-sm-4"><input type="email" placeholder="Enter Email" name='email_id' id="email_id" value="<?=$email_id;?>" class="form-control" ></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Contact No.</label>
                        <div class="col-sm-4"><input type="number" placeholder="Enter Contact No." name='mobile_no' value="<?=$mobile_no;?>"  class="form-control" ></div>
                        <? if($_SESSION['comp_code_tmp']==""){?>
                        <label class="col-sm-2 control-label">Admin User</label>
                        <div class="col-sm-4">
                            <select name='ad' class="form-control">
                            <?php
                            foreach ($admin_user as $key => $value) {
                                if($key == $ad)echo "<option value='".$key."' selected>".$value."</option>";
                                else echo "<option value='".$key."'>".$value."</option>";
                            }
                            ?>
                            </select>
                        </div><?}?>
                    </div>
                    <? if($_SESSION['comp_code_tmp']==""){?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">UserName</label>
                        <div class="col-sm-4"><input type="text" placeholder="Enter Username" name='username'  id="username" value="<?=$username;?>" class="form-control" ></div>
                        <label class="col-sm-2 control-label">Password</label>
                         <div class="col-sm-4"><input type="password" placeholder="Enter password" name='pwd' size='25' value="<?=$tpwd?>" readonly class="form-control"></div>
                    </div>
                <?}?>								
                <?php if($_SESSION['comp_code_tmp']<>""){?>
                    <!--<div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">HIERARCHY</label>
                    <div class="col-sm-4">
                        <select name='cmb_hierarchy_id' id="cmb_hierarchy_id" class="form-control" onChange="getLocation(this.value)" required="true"><option value="">SELECT HIERARCHY</option><?=dropdown_q("SELECT heariachy_order as id,name FROM tbl_heariachy_master WHERE 1",$hierarchy_id);?></select> 
                    </div>
                    <label class="col-sm-2 control-label">LOCATION</label>
                    <div class="col-sm-4">
                        <select name='cmb_location' id="cmb_location" class="form-control">
                            <option value="">SELECT LOCATION</option>
                            <?php 
                            //if(strtoupper($_GET['mode'])=="EDIT")
                              //  echo dropdown_q("SELECT ".$field_names." FROM ".$location_tbl_name." WHERE status=1 AND heairachy_id='".$hierarchy_id ."' AND comp_code='".$_SESSION['comp_code_tmp']."'",$branch_code);
                            ?>
                        </select>
                    </div>
                    </div>//  onchange="getUserType(this.value)" deptMap=1
-->                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">User Type *</label>
                        <div class="col-sm-4">
                            <select name='utypes' class="form-control"><option value="">SELECT USER-TYPE</option><?=dropdown_q("select id,name from tbl_role where 1",$utype);?></select>
                        </div>
                        <label class="col-sm-2 control-label">Department *</label>
                        <div class="col-sm-4"><select name='dept_code' id='dept_code' class="form-control" ><option value="">SELECT DEPARTMENT</option><?=dropdown_q("select dept_code as id,name from department",$dept_code);?></select></div>
                    </div>
					 <div class="hr-line-dashed"></div>
                    <!--<div class="form-group">
					<label class="col-sm-2 control-label">User Type *</label>
                        <div class="col-sm-4">
                            <select name="usertypes" id="usertypes" multiple class="form-control"  <? if(strtoupper($_GET['mode'])=="EDIT" && (int)$_SESSION['tmp_ectrl'] < 1){?> disabled="disabled" <? } ?> onchange="getUserTypes()" ><?=dropdown_q("select id,name from tbl_role where deptMap=0",$usertype);?></select>
                        </div>
					</div>-->	
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Username </label>
                        <div class="col-sm-4"><input type="text" placeholder="Enter Username" name='username'  id="username" value="<?=$username;?>" class="form-control" ></div>
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-4"><input type="password" placeholder="Enter password" name='pwd' size='25' value="<?=$tpwd?>" readonly class="form-control"></div>
                    </div>
                <?php } if((int)$_SESSION['comp_code_tmp']==""){?>				
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">Access Rights</label>
            <div class="col-sm-10">  <label class="checkbox-inline col-sm-2">
            <input type="checkbox" name='usr' value='1' <?=strchecked(1,$usr);?>>User Managment
            </label>
            <label class="checkbox-inline col-sm-2">
            <input type="checkbox" name='mst' value='1' <?=strchecked(1,$mst);?>>Master
            </label>
            <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='actrl' value='1' <?=strchecked(1,$actrl);?>>Manage Department year
            </label>
            <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='rpt' value='1' <?=strchecked(1,$rpt);?>>Reports/Logs
            </label>
			 <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='tlink' value='1' <?=strchecked(1,$tlink);?>>Link 
            </label>
            </div>
            </div>
            
            <div class="hr-line-dashed"></div>  
					 <div class="form-group"><label class="col-sm-2 control-label">Grade</label>
                    <div class="col-sm-4">
                        <select name='gradeId' id="gradeId" class="form-control" ><option value="">Select Grade</option><?=dropdown_q("SELECT g.id AS id, g.name AS name FROM grade_master g INNER JOIN tbl_grade_details tg ON g.id = tg.Grade_Id",$gradeId);?></select> 
                    </div>
					</div>
               <? }else{ ?>
			   
			         <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">Access Rights</label>
            <div class="col-sm-10">
			
			   <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='ectrl' value='1' <?=strchecked(1,$ectrl);?>>Designation Change Permission 
            </label>
			  <label class="checkbox-inline col-sm-2">
            <input type="checkbox" name='usr' value='1' <?=strchecked(1,$usr);?>>User Managment
            </label>
            <label class="checkbox-inline col-sm-2">
            <input type="checkbox" name='arisk' value='1' <?=strchecked(1,$arisk);?>>Grade Manage
            </label>
            <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='crisk' value='1' <?=strchecked(1,$crisk);?>>Authority Matrix
            </label>
            <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='drisk' value='1' <?=strchecked(1,$drisk);?>>Branch/Department
            </label>
			 <label class="checkbox-inline col-sm-2">
            <input type='checkbox' name='erisk' value='1' <?=strchecked(1,$erisk);?>>Role/Zone 
            </label>
            </div>
            </div>
			         <div class="hr-line-dashed"></div>  
					 <div class="form-group"><label class="col-sm-2 control-label">Grade</label>
                    <div class="col-sm-4">
                        <select name='gradeId' id="gradeId" class="form-control" ><option value="">Select Grade</option><?=dropdown_q("SELECT g.id AS id, g.name AS name FROM grade_master g INNER JOIN tbl_grade_details tg ON g.id = tg.Grade_Id",$gradeId);?></select> 
                    </div>
					</div>
			   <?}?>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Active User</label>
                <div class="col-sm-10">
                    <input type="checkbox" name='status' value='1' <?=strchecked(1,$status);?>>
                </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <input type='hidden' value='<?=$id;?>' name='admin_id'>
                        <input type='hidden' value='<?=$_SESSION['comp_code_tmp'];?>' name='comp_code'>
						<input type='hidden' value="<?=$utype;?>" name="utype" id="utype" />
						<input type='hidden' value="<?=$usertype;?>" name="usertype" id="usertype" />
					    <input type='hidden' value='<?=$mode;?>' name='mode' id="mode">	
                        <button class="btn btn-white" type="button" onclick="back_fn('user_search');">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
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
function checkGstFlag(isgst){
    if(isgst.checked==true){
        $(".gstAccess").css("display","block");   
    }else{
        $(".gstAccess").css("display","none");  
    }
}
function checkVpFlag(isvp){
    if(isvp.checked==true){
        $(".vpAccess").css("display","block");   
    }else{
        $(".vpAccess").css("display","none");  
    }
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    if($("#isgst").is(":checked")==false){
        $(".gstAccess").css("display","none"); 
    }
    if($("#isvp").is(":checked")==false){
        $(".vpAccess").css("display","none");   
    }
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#formUser').validate({
        rules: {
            "username": {
                required: true,
                minlength: 3,
                maxlength: 15,
            },
            "email_id": {
                required: true,
                email: true,
            },
            "branch_code": {
                required: true
            },
            "utypes": {
                required: true
            }
        },
        messages: {
            "userName" :{
                required:"Please Enter User Name.",
            },
            "email_id" :{
                required: "Email Id is required.",
                email: "Please Enter Valid Email Id.",
            },
            "branch_code" :{
                required: "Select User Location.",
            },
            "utypes": {
                required: "Select User Type.",
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
<script>
function getBranch(selectedValue)
 {
    //make the ajax call
    $.ajax({
        url: 'roleLogin.php',
        type: 'POST',
        data: { option : selectedValue,
                mode:'branch'},
        success: function(html) {
           $('#branch_code').html(html);
        }
    });
}
</script>
<script>
function getDepartment(selectedValue)
{
    $.ajax({
        url: 'roleLogin.php',
        type: 'POST',
        data: {option : selectedValue,
            mode :'department'
        },
        success: function(html) {
            $('#dept_code').html(html); 
        }
    });
}
function getLocation(selectedValue)
{
    if(selectedValue != ''){
        //make the ajax call
        $.ajax({
            url: 'userLocation.php',
            type: 'POST',
            data: { option : selectedValue,
                    mode:'location'},
            success: function(html) {
                $('#cmb_location').html(html);
            }
        });
    }else{
        $('#cmb_location').html('<option value="">SELECT LOCATION</option>');
    }
}

function getUserType(selectedValue){
      if(selectedValue != ''){
	    $('#utype').val(selectedValue);       
	  }

}
function getUserTypes(){
        var selectedValue=$('#usertypes').val(); 
	    $('#usertype').val(selectedValue);       
	 

}
function checkTransferAccount(data){
 if(data.checked==true){
   alert("Please Change Emp Code");
  $('#mode').val("save"); 
     
 
 }else{
      $('#mode').val("update");  
 }

}
</script>
</body>
</html>