<?php
	$pagename = 'purchase_order_checker.php';
	include ('includes/config.php');
	//pageAccess((int)$_SESSION['tmp_mst']);
	include "includes/session_check.php";
	$showmsg = message($_GET['msg']);
	

	include "includes/header.php";
	include "includes/po_leftmenu.php";
	
?>

        <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
                    
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Purchase Order Detail</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php">Home</a>
                            </li>
                            <li class="active">
                                <strong>Purchase Order</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
				 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>List of Purchase Orders</h5>
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
<? if($showmsg != ""){$class = 'success';if($_GET['msg'] == 'ndel'){$class = 'info';}echo "<p class='".$class."'>".$showmsg."<span>X</span></p>";}?>

                                <div role="tabpanel">
                                    
                                    <ul class="tab-nav" role="tablist">
									<li><a href="#po_checker" aria-controls="po_checker" role="tab" data-toggle="tab">PO Checker</a>
                                    </li>
                                    <li><a href="#po_approval" aria-controls="po_approval" role="tab" data-toggle="tab">PO Approval</a>
                                    </li>
									 <li><a href="#po_approved" aria-controls="po_approved" role="tab" data-toggle="tab">PO Approved</a>
                                    </li>
									 <li><a href="#po_reject" aria-controls="po_reject" role="tab" data-toggle="tab">PO Rejected</a>
                                    </li>
                                  
                                </ul>
                                   
                                    <div class="tab-content">
                                        
                                        
                                       <div role="tabpanel" class="tab-pane active" id="po_checker">
                                           <? $str = ""; 
	$sql = "select * from tbl_purchase_order where po_status=2";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by po_id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
                                            ?>
                                            <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>PO ID</B></th>
  <th scope="col"><B>PO No</B></th>
  <th scope="col"><B>PO Description</B></th>
  <th scope="col"><B>Vendor</B></th>
  <th scope="col"><B>Cost</B></th>
  <th scope="col"><B>PO Date</B></th>
  <th scope="col"><B>Requester</B></th>
  <th scope="col"><B>PO Close Date</B></th>
  <th scope="col"><B>PO Expiry Date</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
   <td width="15" align="center"><? echo $i; ?></td>
  <td><? echo $row['po_no']; ?></td>
  <td><? echo $row['po_description']; ?></td>
  <td>
  <?php 
	$condition = " where id ='".$row['vendor_id']."'";	
	echo getrecord('tbl_vendor_registration','business_name',$condition)
  ?>
  </td>
 <td><? echo $row['cost']; ?></td>
 <td><? echo $row['po_date']; ?></td>
 <td><? echo $row['requester']; ?></td>
 <td><? echo $row['po_close_date']; ?></td>
 <td><? echo $row['po_expiry_date']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
  
  <td width="45" align="center">
  <a  href='purchase_order_checker.php?mode=edit&id=<?=$row['po_id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
 
 </td>
</tr>
<? }?>
                  </tbody>
            </table>
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane " id="po_approval">
                                            <? $str = ""; 
	$sql = "select * from tbl_purchase_order where po_status=3";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by po_id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
                                            ?>
                                            <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>PO ID</B></th>
  <th scope="col"><B>PO No</B></th>
  <th scope="col"><B>PO Description</B></th>
  <th scope="col"><B>Vendor</B></th>
  <th scope="col"><B>Cost</B></th>
  <th scope="col"><B>PO Date</B></th>
  <th scope="col"><B>Requester</B></th>
  <th scope="col"><B>PO Close Date</B></th>
  <th scope="col"><B>PO Expiry Date</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
   <td width="15" align="center"><? echo $i; ?></td>
  <td><? echo $row['po_no']; ?></td>
  <td><? echo $row['po_description']; ?></td>
  <td>
  <?php 
	$condition = " where id ='".$row['vendor_id']."'";	
	echo getrecord('tbl_vendor_registration','business_name',$condition)
  ?>
  </td>
 <td><? echo $row['cost']; ?></td>
 <td><? echo $row['po_date']; ?></td>
 <td><? echo $row['requester']; ?></td>
 <td><? echo $row['po_close_date']; ?></td>
 <td><? echo $row['po_expiry_date']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
  
  <td width="45" align="center">
  <a  href='purchase_order_checker.php?mode=edit&id=<?=$row['po_id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
 
 </td>
</tr>
<? }?>
                  </tbody>
            </table>
                                        </div>
                                        
                                       <div role="tabpanel" class="tab-pane " id="po_approved">
                                            <? $str = ""; 
	$sql = "select * from tbl_purchase_order where po_status=4";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by po_id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
                                            ?>
                                            <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>PO ID</B></th>
  <th scope="col"><B>PO No</B></th>
  <th scope="col"><B>PO Description</B></th>
  <th scope="col"><B>Vendor</B></th>
  <th scope="col"><B>Cost</B></th>
  <th scope="col"><B>PO Date</B></th>
  <th scope="col"><B>Requester</B></th>
  <th scope="col"><B>PO Close Date</B></th>
  <th scope="col"><B>PO Expiry Date</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
   <td width="15" align="center"><? echo $i; ?></td>
  <td><? echo $row['po_no']; ?></td>
  <td><? echo $row['po_description']; ?></td>
  <td>
  <?php 
	$condition = " where id ='".$row['vendor_id']."'";	
	echo getrecord('tbl_vendor_registration','business_name',$condition)
  ?>
  </td>
 <td><? echo $row['cost']; ?></td>
 <td><? echo $row['po_date']; ?></td>
 <td><? echo $row['requester']; ?></td>
 <td><? echo $row['po_close_date']; ?></td>
 <td><? echo $row['po_expiry_date']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
  
  <td width="45" align="center">
  <a  href='purchase_order_checker.php?mode=edit&id=<?=$row['po_id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
 
 </td>
</tr>
<? }?>
                  </tbody>
            </table>
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane " id="po_reject">
                                            <? $str = ""; 
	$sql = "select * from tbl_purchase_order where po_status=5";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by po_id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
                                            ?>
                                            <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>PO ID</B></th>
  <th scope="col"><B>PO No</B></th>
  <th scope="col"><B>PO Description</B></th>
  <th scope="col"><B>Vendor</B></th>
  <th scope="col"><B>Cost</B></th>
  <th scope="col"><B>PO Date</B></th>
  <th scope="col"><B>Requester</B></th>
  <th scope="col"><B>PO Close Date</B></th>
  <th scope="col"><B>PO Expiry Date</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
   <td width="15" align="center"><? echo $i; ?></td>
  <td><? echo $row['po_no']; ?></td>
  <td><? echo $row['po_description']; ?></td>
  <td>
  <?php 
	$condition = " where id ='".$row['vendor_id']."'";	
	echo getrecord('tbl_vendor_registration','business_name',$condition)
  ?>
  </td>
 <td><? echo $row['cost']; ?></td>
 <td><? echo $row['po_date']; ?></td>
 <td><? echo $row['requester']; ?></td>
 <td><? echo $row['po_close_date']; ?></td>
 <td><? echo $row['po_expiry_date']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
 
  <td width="45" align="center">
  <a  href='purchase_order_checker.php?mode=edit&id=<?=$row['po_id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
 
 </td>
</tr>
<? }?>
                  </tbody>
            </table>
                                        </div>
                                        
                                    </div>
                                    
                                </div>

        </div>
    </div>
</div>
</div>
</div>

 <? include "includes/footer.php";?>
</div>
</div>


<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            },
            scrollX:        true,
         scrollCollapse: true,
        });

       
    });

    
</script>
<style>
    body.DTTT_Print {
        background: #67bdf9;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#67bdf9;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #67bdf9;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #337ab7;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>


</html>
