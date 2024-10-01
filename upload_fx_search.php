<?php
	$pagename = 'upload_fx_search.php';
	include ('includes/config.php');
	pageAccess((int)$_SESSION['admin_user_tmp']);
	include "includes/session_check.php";
	$showmsg = message($_GET['msg']);
	$str = ""; 
	$sql = "select * from tbl_account_fx_master  where 1 ";
	

    if($_SESSION['comp_code_tmp'] <>""){
        $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";
        
        }
        if($_SESSION['comp_code_tmp']=="")
        {
         $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
        
         
        }
        $result_set=$Db->query($sql.$cnd1);	
	//  $result_set = $Db->query($sql);
	include "includes/header.php";
	include "includes/leftmenu.php";
?>

        <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
                    
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Chart of Account-Fx</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="main_dashboard.php">Home</a>
                            </li>
                            <li class="active">
                                <strong>Chart of Account-Fx</strong>
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
                                <span class="label label-success pull-right"><a href="upload_fx.php?mode=add"><font color="#FFFFFF">Add Account-Fx</font></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><a href="upload_bulk_account_fx.php"><font color="#FFFFFF">Upload  Account-Fx</font></a></span>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><a href="account_fx_export_xl.php"><font color="#FFFFFF">Export  Account-Fx</font></a></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><a href="upload_update_account_fx.php"><font color="#FFFFFF"> Updated  Account-Fx</font></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>List of Group</h5>
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
                                    <table class="table table-striped table-bordered table-hover dataTables-example " cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>
  <th scope="col"><B>Account-Fx</B></th>
  <th scope="col"><B>Omnibus Categories</B></th>
   <!-- <th scope="col"><B>comp code</B></th>
  <th scope="col"><B>EmailId</B></th> --> -->
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  <th scope="col"><B>Updated By</B></th>
  <th scope="col"><B>Updated Date</B></th>
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <?  while($row= mysql_fetch_array($result_set)){ ?>
<tr>
  <td width="15" align="center"><?=$row['id'];?></td>
  <td><? echo $row['account_fx']; ?></td>
  <!-- <td><? echo $row['name']; ?></td>
  <td><? echo $row['email_id']; ?></td> -->

  <td><? echo getrecord("tbl_omnibus_categories_master","omnibus","where id='".$row['omnibus_categories']."'"); ?></td>
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
  <td>
  <?php 
	$condition = " where admin_id ='".$row['updated_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['updated_date']); ?></td>
  <td width="45" align="center">
 
   <a  href='upload_fx.php?mode=edit&id=<?=$row['id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="#" onclick="deleterecord(<?=$row['id']?>,'upload_fx')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
  
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
			// scrollX:        true,
            // scrollCollapse: true,
			"aaSorting": []
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


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 08:06:09 GMT -->
</html>
