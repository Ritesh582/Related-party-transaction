<?php
	$pagename = 'company_search.php';
	include ('includes/config.php');
	pageAccess((int)$_SESSION['tmp_mst']);
	include "includes/session_check.php";
	$showmsg = message($_GET['msg']);
	$str = ""; 
	$sql = "select * from tbl_company where status=1 ";
	if($_SESSION['group_code_tmp']<>""){$str .= " and group_code = '".$_SESSION['group_code_tmp']."'";}
	$str .= " order by id desc";
	
	$sql .=$str;
	$result_set = $Db->query($sql);
	include "includes/header.php";
	include "includes/leftmenu.php";
	
?>

        <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
                    
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Company Details</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="main_dashboard.php">Home</a>
                            </li>
                            <li class="active">
                                <strong>Company</strong>
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
                                <span class="label label-success pull-right"><a href="company.php?mode=add"><font color="#FFFFFF">Add Company</font></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>List of Company</h5>
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
                                 
                                   <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>
  <th scope="col"><B>Company Name</B></th>
  <th scope="col"><B>Company Code</B></th>
  <th scope="col"><B>Company Email</B></th>
  <th scope="col"><B>Added By</B></th>
  <th scope="col"><B>Added Date</B></th>
  <th scope="col"><B>Action</B></th>
</tr>
                                        </thead>
                                        <tbody>
                                            <?  while($row= mysql_fetch_assoc($result_set)){ ?>
<tr>
  <td width="15" align="center"><? echo $row['id']; ?></td>
  <td><? echo $row['name']; ?></td>
  <td><? echo $row['company_code']; ?></td>
  <td><? echo $row['comp_email']; ?></td>
 
 <td>
  <?php 
	$condition = " where admin_id ='".$row['added_by']."'";	
	echo getrecord('admin','name',$condition)
  ?>
  </td>
  <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
  <td width="45" align="center">
  <a  href='company.php?mode=edit&id=<?=$row['id'];?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
  <a href="#" onclick="deleterecord(<?=$row['id']?>,'company')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
 
   <?php $condition = " where comp_code ='".$row['id']."'";	
	   $compstatus=getrecord('admin','compstatus',$condition);
          if($compstatus>0)
           {?>
        <a href='company.php?mode=status&id=<?=$row['id'];?>&compstatus=0'></a>
           <?}else{?>
        <a href='company.php?mode=status&id=<?=$row['id'];?>&compstatus=1'></a>
        <?}?>
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

        /* Init DataTables */
      //  var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
      /*  oTable.$('td').editable( 'http://webapplayers.com/example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );
*/

    });

   /* function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }*/
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
