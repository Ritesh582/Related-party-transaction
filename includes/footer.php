

<script type="text/javascript">
		function logout(value,userFlag) {

			if (value == 'yes') {
				if(userFlag>=1){
				window.location = "admin/logout.php";
				}else{
				     window.location = "company/logout.php";
				 }
				return true;
			} else {
				document.getElementById('myModalforPop').style.display = "none";
				$('.modal-backdrop').remove();

			}
		}
	</script>


<div id="myModalforPop" class="modal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to logout?</p>

			</div>
			<div class="modal-footer">
				<button type="button" id="yes" value="yes" onclick="logout('yes',<?=$_SESSION['admin_user_tmp'];?>);" class="btn btn-primary waves-effect" data-dismiss="modal">Yes</button>
				<button type="button" id="No" value="No" onclick="logout('No',<?=$_SESSION['admin_user_tmp'];?>);" class="btn btn-primary  waves-effect" style="background: #E3023B;">No</button>
			</div>
		</div>
	</div>
</div>




<?php
include "chatbotpage.php";
?>


 <div class="footer">
            <div class="pull-right">
			
                &nbsp;
            </div>
            <div>
                <strong>Copyright</strong> Savvy Business solution Pvt Ltd &copy; 2015-<?=date("Y")?> Version <strong>1.0<strong>
            </div>
        </div>
