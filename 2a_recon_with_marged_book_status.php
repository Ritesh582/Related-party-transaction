<?php
$pagename = '2a_recon_with_marged_book_status.php';
include ('includes/config.php');
//pageAccess((int)$_SESSION['tmp_mst']);
include "includes/session_check.php";
$showmsg = message($_GET['msg']);

//$cnt = $cnt+1;
include "includes/header.php";
include "includes/recon_leftmenu.php";

$invoice_number = "";
$invoice_value = "";
$gstM = 0;
$invoice_numberM = 0;
$invoice_valueM = 0;
$status = 1;
$gstn = "";

function yesNo($v) {

    if ($v == 1) {
        $d = "Yes";
    } else {
        $d = "No";
    }

    return $d;
}
$cnd2="where id=1";
if(isset($_GET["status"])){
    $cnd2="where id=".$_GET["status"]."";
}

if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";

 }
 if($_SESSION['comp_code_tmp']=="")
 {
 
  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";
  
 }
  if(isset($_SESSION['dept_code_tmp']) && !empty($_SESSION['dept_code_tmp']))
 {
   $condition .= " and dept_code = '".$_SESSION['dept_code_tmp']."'"; 
}
 if(isset($_GET["state"]) && !empty($_GET["state"]))
 {
   $cnd1 .= " and state_code = '".$_GET["state"]."'";
  }
 
 if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
   $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
 }
 $statusname=getrecord("tbl_gstrstatus", "name", $cnd2);
 $statusname=explode(".",$statusname);
 if(isset($_GET["status"]) && $_GET["status"]==5 && $_GET["mode"]=="actionable"){
     $statusname[1]="Tax Value Matched with 2A";
 }elseif(isset($_GET["status"]) && $_GET["status"]==3 && $_GET["mode"]=="actionable"){
     $statusname[1]="Invoice Number Matched With 2A";
 }
 
?>

<div id="page-wrapper" class="gray-bg">
    <? include "includes/sub-header.php";?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>DATA REPORT >><?=$statusname[1]?></h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
					          <div class="form-group">
							  <div class="col-sm-10"> </div>
                                    <div class="col-sm-2"> 
			<form  method='post' action='2a_report_export_status.php' target=_blank>
			<!--<input type='hidden' name='dept_code' value="<?=$_GET['dept_code'];?>">
			<input type='hidden' name='period' value="<?=$_GET['period'];?>">
                        <input type='hidden' name='action' value="EXPORT">-->
                        <input type='hidden' name='state_code' value="<?=$_GET['state_code'];?>">    
			<input type='hidden' name='status' value="<?=$_GET['status'];?>">			
			<input type='submit' class="btn btn-primary " value='Export To XL'>
		</form>
									 </div>	
									
						</div>	
             <br><br>
							
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>LIST OF  2A RECONCILE WITH MERGED BOOKS OF <?= strtoupper($statusname[1])?></h5>
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


                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tds_recivable">
                                    <table id="margedTable" class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="15" align="center" scope="col"><B>Id</B></th>
                                                <th width="15" align="center" scope="col"><B>GST</B></th>
                                                <th scope="col"><B>Invoice No</B></th>
                                                <th scope="col" title="(IGST|SGST|CGST)"><B>Tax Code&nbsp;&nbsp;&nbsp;(IGST|SGST|CGST)</B></th>
                                                <th scope="col"><B>Tax Value</B></th> 
                                                <th scope="col"><B>State Code</B></th> 
                                                <!--<th scope="col"><B>Invoice Value</B></th>-->
                                                
                                                
                                                <th scope="col"><B>2A&nbsp;&nbsp;&nbsp;(Id | Gstin | Invoice No | IGST | SGST | CGST |TAX VALUE | State Code)</B></th>
                                                <th scope="col"><B>Tax Value diff</B></th> 
                                                <!--
                                                <th scope="col"><B>GST Match</B></th>
                                                <th scope="col"><B>Invoice Match</B></th>
                                                <th scope="col"><B>Remove Special Character Invoice Match</B></th>
                                                <th scope="col"><B>Exact Tax Value Match</B></th>
                                                <th scope="col"><B>Decimal Tax Value Match</B></th>
                                                <th scope="col"><B>Lower Book Tax Value Match</B></th>
                                                <th scope="col"><B>Higher Book Tax Value Match</B></th>
                                                <th scope="col"><B>Tax Code Match</B></th>
                                                
                                                <th scope="col"><B>Found In 2A</B></th>-->
                                                <!--<th scope="col"><B>Invoice Number Match With 2A</B></th>
                                                <th scope="col"><B>Tax Code Matched With 2A</B></th>
                                                <th scope="col"><B>Tax Value Matched With 2A</B></th>
                                                <th scope="col"><B>Found In 2A But Not in Books</B></th>-->
                                                <th scope="col"><B>Status</B></th>
                                                <!--<th scope="col"><B>Action</B></th>-->

                                            </tr>

                                        </thead>
                                      
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
</div


<!-- Page-Level Scripts -->
<!--<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });

    });


</script>
-->
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

<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
                             var mode="<?=$_GET["mode"]?>";
                             var state_code="<?=$_GET["state_code"]?>";
                             console.log(state_code);
				var dataTable = $('#margedTable').DataTable( {
					"processing": true,
					"serverSide": true,
					"responsive": true,
                                        /* "dom": 'T<"clear">lfrtip',
                                            "tableTools": {
                                            "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                                        },*/
                                   	"ajax":{
                                           
						url :"magedBookTable_data_status.php?status="+<?=$_GET["status"]?>+"&mode="+mode+"&state_code="+state_code, // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".margedTable-grid-error").html("");
							$("#margedTable").append('<tbody class="margedTable-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#gstr-grid_processing").css("display","none");
							
						}
					}
                                        
				} );
			} );
		</script>
</body>


</html>
