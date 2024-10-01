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

                <!--Start book Upload and view-->
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Bank Statement</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li><a href="bank_statement_upload.php">Upload Bank Statement</a></li>
                        <!--<li><a href="vb_statement_upload.php">64VB Upload</a></li>  -->
                        <li><a href="bank_statement_view.php">View Bank Statement</a></li>
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
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Company Books</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li><a href="book_upload.php">Upload Company Books</a></li>
                         <li><a href="book_view.php">View Company Books</a></li>
                        <!-- <li><a href="submission_gstr2_report2.php">View Merged Books</a></li>   -->
                         </ul>
                </li>
				  <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Vendor Statement</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li><a href="vendor_statement_upload.php">Upload Vendor Statement</a></li>
                        <!--<li><a href="vb_statement_upload.php">64VB Upload</a></li>  -->
                        <li><a href="vendor_statement_view.php">View Vendor Statement</a></li>
                    </ul>
                </li>
                <!---finish book upload and view-->
                 <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Approve Statements</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="approve_book_statement_view.php">Approve Book Statemnet</a></li>
                         <li><a href="approve_bank_statement_view.php">Approve Bank Statement</a></li>
                        </ul>
              </li>
                <!--Process tab-->
              <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Process</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="logic_process.php">Logic Process</a></li>
                         <li><a href="bank_recon_process.php">Bank Recon Process</a></li>
                         <li><a href="bank_recon_narration.php">Approx Narration Process</a></li>
                         <li><a href="bank_recon_date_threshold.php">Threshold Process</a></li>
                         <li><a href="bank_status_change.php">Status Change Process</a></li>
                        </ul>
              </li>

                 <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manual Match</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="bank_recon_mm_om.php">Manual Match</a></li>
                        <li><a href="bank_reconmanualexportmatching.php">Manual Match Bulk</a></li> </ul>
                </li>
                    <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li><a href="overview_bank_recon.php">Overview</a></li>
                        <li><a href="bank_recon_view.php">View Process</a></li>
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
