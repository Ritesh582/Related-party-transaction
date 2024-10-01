<?php
	$pagename = 'purchase_requisition.php';
	include ('includes/config.php');
	//pageAccess((int)$_SESSION['tmp_mst']);
	include "includes/session_check.php";
	$showmsg = message($_GET['msg']);
	
	//$cnt = $cnt+1;
	include "includes/header.php";
	include "includes/pr_leftmenu.php";
	
?>

        <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
                    
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Purchase Requisition Detail</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard.php">Home</a>
                            </li>
                            <li class="active">
                                <strong>Purchase Requisition</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
				 <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><a href="purchase_requisition.php?mode=add"><font color="#FFFFFF">Create Requisition</font></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>List of Requisition</h5>
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
                                    <li class="active"><a href="#pr_maker" aria-controls="pr_maker" role="tab"
                                                          data-toggle="tab">PR Maker</a></li>
                                    <li><a href="#pr_checker" aria-controls="pr_checker" role="tab" data-toggle="tab">PR Checker</a>
                                    </li>
                                    <li><a href="#pr_approval" aria-controls="pr_approval" role="tab" data-toggle="tab">PR Approval</a>
                                    </li>
                                  
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="pr_maker">
									<? $str = ""; 
	$sql = "select * from tbl_requisition where status=1 ";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
	$cnt = mysql_num_rows($result_set);?>
                                   <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>
  <th scope="col"><B>Requisition No</B></th>
  <th scope="col"><B>Purchase Date</B></th>
  <th scope="col"><B>Party name</B></th>
  <th scope="col"><B>Pan No</B></th>
  <th scope="col"><B>Total Purchase Cost</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
  <td width="15" align="center"><?=$i;?></td>
  <td><? echo $row['requisition_no']; ?></td>
  <td><? echo yymmdd_ddmmyy($row['purchase_date']); ?></td>
  <td><? echo $row['party_name']; ?></td>
  <td><? echo $row['panno']; ?></td>
  <td><? echo $row['total_requisition_cost']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>

  <td width="45" align="center">
      <a  href='purchase_requisition.php?mode=edit&id=<?=$row['id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="#" onclick="deleterecord(<?=$row['id']?>,'purchase_requisition')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
 </td>
</tr>
<? }?>
                  </tbody>
            </table></div>
									<div role="tabpanel" class="tab-pane" id="pr_checker">
									<? $str = ""; 
	$sql = "select * from tbl_requisition where status=2 ";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
	$cnt = mysql_num_rows($result_set);?>
                                   <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>
  <th scope="col"><B>Requisition No</B></th>
  <th scope="col"><B>Purchase Date</B></th>
  <th scope="col"><B>Party name</B></th>
  <th scope="col"><B>Pan No</B></th>
  <th scope="col"><B>Total Purchase Cost</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
  <td width="15" align="center"><?=$i;?></td>
  <td><? echo $row['requisition_no']; ?></td>
  <td><? echo yymmdd_ddmmyy($row['purchase_date']); ?></td>
  <td><? echo $row['party_name']; ?></td>
  <td><? echo $row['panno']; ?></td>
  <td><? echo $row['total_requisition_cost']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>

  <td width="45" align="center">
      <a  href='purchase_requisition.php?mode=edit&id=<?=$row['id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="#" onclick="deleterecord(<?=$row['id']?>,'purchase_requisition')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
 </td>
</tr>
<? }?>
                  </tbody>
            </table></div>
									<div role="tabpanel" class="tab-pane" id="pr_approval">
								<? $str = ""; 
	$sql = "select * from tbl_requisition where status=3 ";
	if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	$str .= " order by id desc";
	$sql .=$str;
	$result_set = $Db->query($sql);
	$cnt = mysql_num_rows($result_set);?>	
                                   <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>
  <th scope="col"><B>Requisition No</B></th>
  <th scope="col"><B>Purchase Date</B></th>
  <th scope="col"><B>Party name</B></th>
  <th scope="col"><B>Pan No</B></th>
  <th scope="col"><B>Total Purchase Cost</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <? $i=0; while($row= mysql_fetch_array($result_set)){ $i++;?>
<tr>
  <td width="15" align="center"><?=$i;?></td>
  <td><? echo $row['requisition_no']; ?></td>
  <td><? echo yymmdd_ddmmyy($row['purchase_date']); ?></td>
  <td><? echo $row['party_name']; ?></td>
  <td><? echo $row['panno']; ?></td>
  <td><? echo $row['total_requisition_cost']; ?></td>
 
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>

  <td width="45" align="center">
      <a  href='purchase_requisition.php?mode=edit&id=<?=$row['id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="#" onclick="deleterecord(<?=$row['id']?>,'purchase_requisition')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
 </td>
</tr>
<? }?>
                  </tbody>
            </table></div>
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
            }
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
