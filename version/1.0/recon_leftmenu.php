<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <span>
							<?php
                                                        $logo_image=getrecord("tbl_company","logo_image","where company_code='".$_SESSION['comp_code_tmp']."'");
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
				$modulename = "Recon";
				?>
				<li class="active">
                    <a href="main_dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                </li>
                <li class="active">
                    <a href="recon_dashboard.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Dashboard</span></a>
                </li>
<?php if((int)$_SESSION['RECON_BOOK'] == 1){?>
<?php if((int)$_SESSION['RECON_ITC'] == 1){?>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">2 Process</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Sap Data Upload</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
						<a href="raw_dump_input.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Raw Sap Data upload</span></a></li>
						<li>
						<a href="raw_rev_charge_dump.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Rev. Charge Upload</span></a>
						</li>
						<li>
                    <a href="tax_transaction.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Tax Transaction Upload</span></a>
						</li>
						   <li>
                    <a href="gst_sap_master.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Sap Gst Master Upload</span></a>
                </li>
						</ul>
                </li>

                    </ul>
					 <ul class="nav nav-second-level">
                        <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Sap Data View</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                         <li>
                              <a href="raw_dump_input_view.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Raw SAP Data view</span></a>
                          </li>

          <li>
              <a href="raw_rev_charge_dump_view.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Rev. Charge view</span></a>
          </li>

          <li>
              <a href="tax_transaction_view.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Tax Transaction View</span></a>
          </li>

                          <li>
                              <a href="gst_sap_master_view.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Sap Gst Master View</span></a>
                          </li>
						</ul>
                </li>

                    </ul>
					 <ul class="nav nav-second-level">
                        <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Sap Data Process</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                          <li>
                        <a href="sap_process.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Process</span></a>
                    </li>
                    <li>
                       <a href="dump_input_process.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Re Run</span></a>
                   </li>
						</ul>
                </li>

                    </ul>
					<ul class="nav nav-second-level">
                        <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                          <li>
                        <a href="raw_overview.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Overview</span></a>
                    </li>
						</ul>
                </li>

                    </ul>

					</li>

                   <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Books</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php //if((int)$_SESSION['RECON_UPLOAD'] == 1){?>

                         <li><a href="gstr_2_upload.php">Single Book Upload</a></li>
                         <li><a href="creditnoteupload.php">Upload Credit Note</a></li>
                         <li><a href="indusind_upload.php">Indusind Single Book Upload</a></li>
                         <li><a href="creditnote_indusind_upload.php">Indusind Credit Note Upload</a></li>
                         <li><a href="manual_match_overwrite.php">Manual Match Overwrite</a></li>
                         <li><a href="merged_book_upload.php">Upload Merged Book</a></li>
                         <li><a href="export_to_excel_by_singleId.php">Export Single Book by Single ID</a></li>
                         <li><a href="export_to_excel_by_mergedid.php">Export Single Book by Merged ID</a></li>

                         <?php //}?>

                         <li><a href="gstr_search.php">View Single Books</a></li>
                         <li><a href="submission_gstr2_report2.php">View Merged Books</a></li>
                         <li><a href="combine_zero_internalc_status_upload.php">Update Combine Zero Internal</a></li>

                         </ul>
                </li>
                        <? } ?>
				<?php }?>

                <?php if((int)$_SESSION['RECON_ITC'] == 1){?>
                <!-- display tab-->
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">ITC 2A</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                       <?php //if((int)$_SESSION['RECON_UPLOAD'] == 1){?>

                        <!--<li><a href="gstr_2A_upload.php">Upload ITC</a></li>-->
			<li><a href="gstr_2a_zip_upload.php">Bulk Upload ITC JSON</a></li>
                        <li><a href="gstr_2a_bulk_upload.php">Bulk Upload ITC JSON API</a></li>
<li><a href="isd_upload.php">Upload ITC JSON</a></li>

                        <li><a href="itc_export.php">Last ITC Upload</a></li>
                        <?php //}?>
                        <!--<li><a href="gstr2a_search.php">GSTR 2A</a></li>-->

                        <li><a href="gstr2a_s.php">View Single ITC</a></li>
			<li><a href="submission_gstr2a_report2.php">View Merged ITC</a></li>
                        <li><a href="itc_status_upload.php">Update ITC Status</a></li>

                    </ul>
                </li>
                <?php }?>
                <!-- Process tab-->
				<?php if((int)$_SESSION['RECON_PROCESS'] == 1){?>
           <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Search</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php //if((int)$_SESSION['RECON_UPLOAD'] == 1){?>
<li><a href="gstin_public.php">Search Gstin</a></li>
                         <li><a href="gstin_upload.php">Upload Gstin</a></li>
                         <?php //}?>

                         <li><a href="gstin_process.php">Process Gstin</a></li>
                         <li><a href="gstin_view.php">View GSTIN</a></li>
                         </ul>
                </li>
          <li>
           <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">GSTIN</span><span class="fa arrow"></span></a>
           <ul class="nav nav-second-level">
               <?php //if((int)$_SESSION['RECON_UPLOAD'] == 1){?>

                <li><a href="gstuser_search.php">User Details</a></li>
                <li><a href="gstotp.php">GSTIN Login</a></li>
                <li><a href="gstr_twoa_api.php">Gstr2a Download</a></li>
                <li><a href="gst6aapi.php">Gstr6a Download</a></li>
                <li><a href="gstrtwoa.php">Gstr2a View</a></li>
                <li><a href="gstrtwoa_view.php">Gstr2a Json View</a></li>
                <li><a href="import_from_6a_to_2a_upload.php">Import from GSTR 6A To GSTR 2A</a></li>
      </ul>
       </li>

           <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Locking and Unlocking</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="export_to_excel_by_mergedid.php">Export Single Book by Merged ID</a></li>
                        <li><a href="single_id_wise_locking.php">Locking Single Id Wise</a></li>
                        <li><a href="id_wise_upload.php">Locking Merged Id Wise</a></li>
                    </ul>
                </li>


              <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Cron Export</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                    <li><a href="cron_report_excel_view.php">Cron Export To Excel</a></li>
                    <li><a href="cron_report_txt_view.php">Cron Export To Text </a></li>



                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Process</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <!--<li><a href="gst_match_process.php">2a Reconcile With Gst Book</a></li>-->
                        <li><a href="process_option.php">2a Reconcile With Merged Book</a></li>
			                  <li><a href="flag_reset_page.php">Report Rerun</a></li>

                       <!-- <li><a href="2a_recon_without_invoice.php">2a Reconcile Without Invoice No</a></li>
                        <li><a href="pan_matching.php">2a Reconcile With Pan Matching</a></li>
                        <li><a href="submission_process.php">Not Found In Books</a></li>-->

                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">GSTR 1</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="b2b_upload.php">GSTR 1 Excel Upload</a></li>
                        <li><a href="gstr1_option.php">Generate Gstr 1 Json</a></li>
                   </ul>
                </li>
                <?php }?>
				<?php if((int)$_SESSION['RECON_MANUAL'] == 1){?>
				<li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manual Match</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li><a href="manualmatch.php">Manual Match</a></li>
                        <li><a href="manualexportmatching.php">Manual export Match</a></li>
                        <li><a href="unsetmanualmatch.php">Unset Manual Match</a></li>



                    </ul>
                </li>



				<li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">D LINK</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li><a href="dlink.php">D link</a></li>
                        <li><a href="itc_sub_status.php">Sub Status</a></li>

                    </ul>
                </li>
				<?php }?>


                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Cron Export</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                    <li><a href="cron_report_excel_view.php">Cron Export To Excel</a></li>
                    <!--<li><a href="cron_report_txt_view.php">Cron Export To Text </a></li>-->



                    </ul>
                </li>
                <!-- edit table-->
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
						<li><a href="2a_recon_with_marged_book.php">Overview First Export</a></li>
                        <li><a href="wronggstnorep.php">Wrong GST No Export</a></li>                                            <li><a href="statemismatchview.php">State MisMatch Export</a></li>
                        <li><a href="pannoview.php">Pan Number Wise Export</a></li>
                        <li><a href="mailidview.php">Empty and Invalid Mail Id Export</a></li>

                        <?php if((int)$_SESSION['RECON_OVERVIEW'] == 1){?>
                        <li><a href="overview_report.php?type=1">Overview</a></li>
                        <!--<li><a href="rcm_excel_view.php">RCM View</a></li>-->
                        <li><a href="overview_different_year.php?type=1&finstatus=1">Different Year</a></li>
						<li><a href="vendor_wise_report.php">Vendor Wise</a></li>
                        <!--<li><a href="overview_report_np.php?type=1">Three Year Report</a></li>-->
                         <?php }?>
                       <!-- <li><a href="view_report.php?status=2">View</a></li>-->
                        <?php if((int)$_SESSION['RECON_VENDOR'] == 1){?>
                       <li><a href="inputtaken.php" style="font-size: 10px">INPUT TAKEN IN DIFFERENT MONTH</a></li>
                       <li><a href="overview_itc.php">ITC Previous and Next Summary</a></li>

                                <?php }?>
                        <?php if((int)$_SESSION['RECON_EMAIL'] == 1){?>
                        <!-- <li><a href="email_to_vendor.php">Vendor Email</a></li> -->
                        <li><a href="email_to_vendor_manual.php">Vendor Email Manual</a></li>

                        <?PHP }?>

                        <?php if((int)$_SESSION['RECON_STATEWISE'] == 1){?>
			<li><a href="state_processing_report.php">State Wise</a></li>
      <li>
        <a href="email_send_status.php">Email Status Report</a>
      </li>
		        <?php }?>


                    </ul>
                </li>
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
