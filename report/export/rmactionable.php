 <div id="page-wrapper" class="gray-bg">
     <? include "includes/sub-header.php";?>
                    
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-12">
                       <h2> DATA REPORT >> <?=$title_pie;?></h2>
                    </div>
                    
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
				  <div class="ibox-content" >
					          <div class="form-group">
							  <div class="col-sm-10"> </div>
                                    <div class="col-sm-2"> 
									 <form  method='post' action='rm_report_export.php' target=_blank>
			<input type='hidden' name='dept_code' value="<?=$_GET['dept_code'];?>">
                        	<input type='hidden' name='period' value="<?=$_GET['period'];?>">
			<input type='hidden' name='action' value="EXPORT">
			<input type='hidden' name='status' value="<?=$_GET['status'];?>">			
			<input type='submit' class="btn btn-primary " value='Export To XL'>
		</form>
									 </div>	
									
						</div>	
						
							</div>
                    
				
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>List of Requisitions</h5>
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
								
                                <div class="ibox-content table-responsive" >
<? if($showmsg != ""){$class = 'success';if($_GET['msg'] == 'ndel'){$class = 'info';}echo "<p class='".$class."'>".$showmsg."<span>X</span></p>";}?>
                                   <table class="table table-striped table-bordered dataTables-example" width="100%" >

                                        <thead>
                                            <tr>
  <th width="15" align="center" scope="col"><B>ID</B></th>										
  <th scope="col"><B>PO NO</B></th>
   <th scope="col"><B>GRM No</B></th>
  <th scope="col"><B>GRM DATE</B></th>
  <th scope="col"><B>PO AMOUNT</B></th>
  <th scope="col"><B>VENDOR NAME</B></th>
  <th scope="col"><B>Exp Category</B></th>
  <th scope="col"><B>Status*</B></th>
</tr>
                                        </thead>
                                        <tbody>
                   <? $i=0; while($row= mysql_fetch_array($export_q)){$i++; ?>
<tr>
  <td width="15" align="center"><?=$i;?></td>
  <td><? echo $row['Prefix'].$row['po_no']; ?></td>
  <td><?php 
	$condition = " where po_no ='".$row['po_no']."'";	
	echo getrecord('tbl_grm_item','grm_no',$condition);
  ?> </td>
  <td><?php 
	$condition = " where po_no='".$row['po_no']."'";	
	echo getrecord('tbl_grm_item','added_date',$condition);
  ?> </td>
  
<td>
      <?php 
	$condition = " where po_no ='".$row['po_no']."'";	
	echo getrecord('tbl_purchase_order','cost',$condition)
	?>
</td>
  
  <td>
      <?php 
	$condition = " where id ='".$row['vendor_id']."'";	
	echo getrecord('tbl_vendor_registration','business_name',$condition);
	?>
</td>
<td>
      <?php 
        $condition = " where po_no ='".$row['po_no']."'";	      
	$expense_category_value=getrecord('tbl_purchase_order','expense_category',$condition);
	echo getrecord('tbl_expense_category','name'," where id ='".$expense_category_value."'");
      ?>
</td>
<td><?php echo getrecord("tbl_gstatus","name","where id='".$row["status"]."'"); ?></td>
  
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


@media only screen and (min-width: 768px) {
.table-responsive {
overflow-x: hidden;
}
}

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
