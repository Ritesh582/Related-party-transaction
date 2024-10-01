<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
							<? $logo_image=getrecord('tbl_company','logo_image','where company_code="'.$_SESSION['comp_code_tmp'].'"');
							if($logo_image!="")
							{?>
                            <img alt="image" class="img-rounded" src="img/<?=$logo_image;?>" width="100px" />
                            <? }else{ ?>
							<<img alt="image" class="img-rounded" src="img/savvybiz_logo.png" width="100px" />
							<? }?>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"><strong class="font-bold"><?=$_SESSION['name_tmp'];?></strong></span>
                                <span class="text-muted text-xs block"><?php echo $_SESSION['username_tmp'];?><b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="change_password.php">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<? if( $_SESSION['admin_user_tmp']>=1){?> admin/logout.php <? }else if($_SESSION['admin_user_tmp']>=0){?>company/logout.php <? }else{?> logout.php<?}?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        GST
                    </div>
                </li>
                <li class="active">
                    <a href="main_dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
		<li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                            
                            <!--<li><a href="state_gst_master.php">State Gst</a></li>
                           
                            <li><a href="state_search.php">State</a></li>-->
                            <? if( $_SESSION['admin_user_tmp']>=4){?>
                                <li><a href="group_search.php">Group Master</a></li>
                            
                            <?php
                            }?>

                            <? if((int)$_SESSION['tmp_mst']==2){?><li><a href="company_search.php">Company Master</a></li><? } ?>
                            <li><a href="department_search.php">Department</a></li>

                            <? if((int)$_SESSION['tmp_usr']==1){?>  <li><a href="user_search.php">System User</a></li><? }?>

                           
                            <? if( $_SESSION['admin_user_tmp']>=4){?>

                                <!-- <li>
                               <a href="#"><span class="nav-label">processing frequency</span><span class="fa arrow"></span></a> -->
                               <ul class="nav">
                                    <li><a href="frequency_search.php">Processing Frequency</a></li>
                                    <li><a href="reporting_search.php">Reporting Period</a></li>
                                    <li><a href="status_search.php">Status</a></li>
                                    <li><a href="substatus_search.php"> Sub Status</a></li>
                                    <li><a href="upload_category_search.php">Omnibus Categories</a></li>
                                    <li><a href="upload_subcategories_search.php">Omnibus Sub-Categories</a></li>
                                    <li><a href="upload_oracle_seach.php">Account-Oracle</a></li>
                                    <li><a href="upload_fx_search.php">Account-Fx</a></li>
                                    <li><a href="rpt_master_view.php">RPT Master</a></li>

                              </ul>
                           <!-- </li> -->
                           <!-- <li>
                               <a href="#"><span class="nav-label">reporting period</span><span class="fa arrow"></span></a>
                               <ul class="nav">
                                    <li><a href="reporting_search.php">frequency_search</a></li>
                                    <li><a href="process_setting.php">recon process setting</a></li>
                                    <li><a href="recon_process_status.php">recon process status</a></li>
                              </ul>
                           </li>
                             -->
                             <!-- <li>
                               <a href="#"><span class="nav-label">Cron process</span><span class="fa arrow"></span></a>
                               <ul class="nav">
                                    <li><a href="start_end_time.php">Cron Timing setting</a></li>
                                    <li><a href="process_setting.php">recon process setting</a></li>
                                    <li><a href="recon_process_status.php">recon process status</a></li>
                              </ul>
                           </li>

                           <li>
                            <a href="#"><span class="nav-label">Vendor Pan Master</span><span class="fa arrow"></span></a>
                            <ul class="nav">
                                <li><a href="vendor_panmaster_upload.php">Vendor Pan Upload</a></li>
                                <li><a href="vendor_panmaster_report.php">Vendor Pan Report</a></li>
                            </ul>
                        </li>


                            <li><a href="gst_master_upload.php">Upload Taxpayer</a></li>
                            
                            <li><a href="gst_master_view.php">Taxpayer</a></li>-->
                            <!-- <li><a href="bank_lockdata.php">Bank Recon Locking</a></li> 
                            <li><a href="email_search.php">Emails</a></li>
                            <li><a href="email_logs.php">Emails Logs</a></li> -->
                            <!--<li><a href="statusselection.php">Status Action</a></li>
                             <li><a href="mergin_master.php">Merge Master</a></li>
                            <li><a href="prefix_invoice_number.php">Prefix Invoice Number</a></li>
                             <li><a href="substatus_match.php">Sub Status company wise</a></li>
                            <li><a href="taxvalue.php">Tax Value</a></li>
                            <li><a href="lockdata.php">Locking</a></li>-->
                            
                      
                         <? }?>
                
					

						  <? if((int)$_SESSION['admin_user_tmp']>=1){?>
						 
						<? if((int)$_SESSION['tmp_drisk']==1 && (int)$_SESSION['comp_code_tmp']<>""){?>
						 <!--<li><a href="branch_search.php">Branch</a></li>
                         <li><a href="voucher_type_search.php">Voucher Type</a></li>
                        <li><a href="department_search.php">Department</a></li>
                        <li><a href="sub_department_search.php">Sub Department</a></li>
						<li><a href="glcode_search.php">GLCode</a></li>
                        <li><a href="department_year_search.php">Department Year Managment</a></li>-->
						<? }?>
						
						<? if((int)$_SESSION['tmp_arisk']==1){?>
<!-- 				
                                                <li><a href="bank_detail.php">Bank Master</a></li>
                                                <li><a href="status_detail.php">Status Master</a></li> -->
						<? }?>





						<? }?>

						<? if((int)$_SESSION['admin_user_tmp']>=1 && (int)$_SESSION['tmp_rpt']==1){?>
						<li>
							<a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Logs</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="login_search.php">Login History</a></li>
								<li><a href="mlog_search.php">Master Logs</a></li>
								<!--<li><a href="reflink_search.php">Reference Link</a></li>-->
							</ul>
						</li>
						<? }?>





                       <!-- <li><a href="ca_search.php">Chareted Accountant</a></li>
                        <li><a href="bank_search.php">Bank</a></li>-->

						<!--<li><a href="vendor_search.php">Vendor</a></li>-->


                    </ul>
                </li>

                 <li><a href="#myModalforPop" id="sidebar-logOut" data-toggle="modal"><i class="fa fa-sitemap"></i> <span class="nav-label">Logout</span></a></li>
            </ul>
        </div>
    </nav>
