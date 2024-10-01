<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <span>
							<? $logo_image=getrecord('tbl_company','logo_image',"where company_code='".$_SESSION['comp_code_tmp']."'");
							if($logo_image!="")
							{?>
                            <img alt="image" class="img-rounded" src="img/<?=$logo_image;?>" width="100px" />
                            <? }else{ ?>
							<<img alt="image" class="img-rounded" src="img/savvybiz_logo.png" width="100px" />
							<? }?>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$_SESSION['name_tmp'];?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_SESSION['username_tmp'];?><b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="change_password.php">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<? if( $_SESSION['admin_user_tmp']>=1){?> admin/logout.php <? }else if($_SESSION['admin_user_tmp']>=0){?>company/logout.php <? }else{?> logout.php<? }?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        Reports
                    </div>
                </li>
           				<?php
				$modulename = "Related Party Transaction";
				?>
				<li class="active">
                    <a href="main_dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                </li>
                <li class="active">
                    <a href="bank_recon_dashboard.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Dashboard</span></a>
                </li>


                <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Process 1</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">

                    <!--<li><a href="upload_payu_data.php">Upload Payu Data</a></li>-->
                    <!--<li><a href="payu_view.php">View Payu Data</a></li>-->
                   <!-- <li><a href="bbps_data_upload.php">Upload BBPS Data</a></li>-->
                    <!--<li><a href="bbps_view.php">View BBPS Data</a></li>-->
                   <!-- <li><a href="upload_pms_data.php">Upload PMS Data</a></li>-->
                    <!--<li><a href="pms_view.php">View PMS Data</a></li>-->
                   <!-- <li><a href="juspay_upload.php">Upload JUSPAY Data</a></li>-->
                    <!--<li><a href="juspay_view.php">View JUSPAY Data</a></li>-->
                    <li><a href="process1_upload_file.php">Upload Process File </a></li>

                    <li><a href="process1_search.php">View Upload Data</a></li>

                    <li><a href="bank_recon_process1.php">Recon Process</a></li>

                    <li><a href="bank_recon_bbps_view.php">Recon Report</a></li>
                    
                    </ul>
                </li>


                <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Process 2</span><span class="fa arrow"></span></a> -->
                   

                    <ul class="nav nav-second-level">

                    <li><a href="process2_upload_file.php">Upload Process file</a></li>
                    <li><a href="process2_search.php">View Upload Data</a></li>

                    <li><a href="bank_recon_process2.php">Recon Process 2</a></li>
                    <li><a href="logic_process2.php">Logic Process 2</a></li>
                    <li><a href="bank_recon_report2.php">Recon Report 2</a></li>
                    </ul>
                </li>


                <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Process 3</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">

                    <li><a href="process3_upload_file.php">Upload Data</a></li>
                    <li><a href="export_xl_process3_file.php">View Upload Data</a></li>
                    <li><a href="bank_recon_process3.php">System Input with payment <br /> gateway recon process</a></li>
                    <li><a href="bank_recon_payment_recon_bank3.php">Payment gateway with recon bank <br/> process</a></li>
                    <li><a href="bank_recon_report3.php">Recon Report 3</a></li>
                    <li><a href="process3_summary.php">Summary</a></li>
                    
                    </ul>
                </li>

                <!--Start book Upload and view-->
                <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Bank Statement</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">

                        <li><a href="bank_statement_upload.php">Upload Bank Statement</a></li>
                        <!--<li><a href="vb_statement_upload.php">64VB Upload</a></li>  
                        <li><a href="bank_statement_view.php">View Bank Statement</a></li>-->
						 <li><a href="bank_statement_view.php">View Bank Statement</a></li>
                    </ul>
                </li>
                   <!--<li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Expanding</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="mibl_upload.php">MIBL Upload</a></li>
                        <li><a href="amex_upload.php">Amex Upload</a></li>
                        </ul>
              </li>-->
		<li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Company Books</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">
                         <li><a href="book_upload.php">Upload Company Books</a></li>
                         <li><a href="book_view.php">View Company Books</a></li>
                        <!-- <li><a href="submission_gstr2_report2.php">View Merged Books</a></li>   -->
                         </ul>
                </li>
				  <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Vendor Statement</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">

                        <li><a href="vendor_statement_upload.php">Upload Vendor Statement</a></li>
                        <!--<li><a href="vb_statement_upload.php">64VB Upload</a></li>  -->
                        <li><a href="vendor_statement_view.php">View Vendor Statement</a></li>
                    </ul>
                </li>
                <!--<li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Payu Details</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li><a href="upload_payu_data.php">Upload Payu Data</a></li>
                         <li><a href="payu_view.php">View Payu Data</a></li>

                         </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">BBPS Details</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li><a href="bbps_data_upload.php">Upload BBPS Data</a></li>
                         <li><a href="bbps_view.php">View BBPS Data</a></li>

                         </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">JUSPAY Details</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li><a href="bbps_data_upload.php">Upload JUSPAY Data</a></li>
                         </ul>
                </li>-->
                <!---finish book upload and view-->
                 <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Approve Statements</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">
                        <li><a href="approve_book_statement_view.php">Approve Book Statement</a></li>
                         <li><a href="approve_bank_statement_view.php">Approve Bank Statement</a></li>
                        </ul>
              </li>
                <!--Process tab-->
              <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Process</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">
                     <li><a href="logic_process.php">Logic Process</a></li>
                         <li><a href="bank_recon_process.php">Bank Recon Process</a></li>
                         <li><a href="bank_recon_narration.php">Approx Narration Process</a></li>
                         <li><a href="bank_recon_date_threshold.php">Threshold Process</a></li>
                         <li><a href="bank_status_change.php">Status Change Process</a></li>
                        </ul>
              </li>

                 <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manual Match</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">
                        <li><a href="bank_recon_mm_om.php">Manual Match</a></li>
                        <li><a href="bank_reconmanualexportmatching.php">Manual Match Bulk</a></li> </ul>
                </li>
                    <li>
                    <!-- <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">
                         <li><a href="overview_bank_recon.php">Overview</a></li>
                        <li><a href="bank_recon_view.php">View Process</a></li>
                         </ul>
                </li>
                <li>
                    <!-- <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Create Table</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level">
                       
                         <li><a href="create_new_table.php">Bulk Upload Table</a></li>
                         <li><a href="created_tbl_view.php">View created table</a></li>
                         <li><a href="upload_file.php">Upload Data File</a></li>
                         <li><a href="view_upload_file.php">View Upload Data</a></li>
                    
                         <li><a href="new_dynamic.php">Change Datatype </a></li>
                         <li><a href="logic_layout_view.php"> Set Logic</a></li>
                         <li><a href="logic_process_file.php">Logic process</a></li>
                         <li><a href="logic_process_reset.php">Reset process</a></li>
                                               </ul>
                </li>
                       <!-- <li><a href="2a_recon_process.php">2a Reconcile With Merged Book</a></li>
                        <li><a href="2a_recon_without_invoice.php">2a Reconcile Without Invoice No</a></li>
                        <li><a href="pan_matching.php">2a Reconcile With Pan Matching</a></li>
                        <li><a href="submission_process.php">Not Found In Books</a></li>

                    </ul>
                </li>-->

                <!-- edit table-->
               <!-- <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="overview_report.php">Overview</a></li>
                        <li><a href="view_report.php?status=2">View</a></li>
                        <li><a href="vendor_wise_report.php">Vendor Wise</a></li>
                        <li><a href="email_to_vendor.php">Email to Vendor</a></li>
                    </ul>
                </li>-->
<!--				<li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
						 <li><a href="purchase_order_search.php">Create Purchase Order</a></li>
                        <li><a href="purchase_order_view.php">View Purchase Order</a></li>
                        <li><a href="invoice_maker_search.php">Invoice Maker</a></li>
                        <li><a href="invoice_checker_search.php">Invoice Checker</a></li>
                        <li><a href="invoice_posting_approver_search.php">Invoice Posting Approver</a></li>
			<li><a href="download_invoice.php">Invoice Download</a></li>

						<li><a href="#">Search by PR/PO/GRN/Invoice No</a></li>
						<li><a href="#">PR -> Quotation -> PO</a></li>
						<li><a href="#">PO -> GRN -> VP</a></li>
						<li><a href="#">Pending Approvals</a></li>
						<li><a href="#">TDS</a></li>
						<li><a href="#">GST</a></li>
						<li><a href="#">Open Purchase Order</a></li>
						<li><a href="#">Analysis</a></li>
						<li><a href="#">Budgeted & Non - Budgeted</a></li>
				</ul>
                </li>-->

			<li><a href="#myModalforPop" id="sidebar-logOut" data-toggle="modal"><i class="fa fa-sitemap"></i> <span class="nav-label">Logout</span></a></li>

            </ul>

        </div>
    </nav>
