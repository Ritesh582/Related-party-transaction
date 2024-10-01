<style>
.inv-dtl, .inv-item-dtl{font-size:11px;}
.padding_class_right{padding-right:5px;}
.border{border-style:solid;border-color:#000;}
table{font-size: 14px; COLOR: #000000;FONT-FAMILY:Arial;}
</style>

<page backtop="20mm" backbottom="25mm" backleft="0mm" backright="10mm">
<div>
<table width="750" border="0.1" bordercolor="#000000">
<?
$q = $Db->query("select * from tbl_purchase_order where po_no='".$billno."'");

	if($ft = mysql_fetch_object($q));
	{

?>
<tr><th colspan="4" align="center" bgcolor="#99CCFF"><h3>Purchase Order Details</h3></th></tr>
<tr><td width="180">PR REF</td><td width="180"><?=$ft->requester;?></td><td width="180">PR Date</td><td width="180"><?=yymmdd_ddmmyy($ft->po_date);?></td></tr>

<tr><td>Branch Code</td><td><?=$ft->from_branch;?></td><td>Enter Branch to Upload</td><td><?=$ft->to_branch;?></td></tr>
<tr><td>Department</td><td><?=$ft->from_department;?></td><td>Enter Department to Upload</td><td><?=$ft->to_department;?></td></tr>
<tr><td width="180">Party Name </td><td width="180"><?   $condition = " where id =".$ft->vendor_id;	
                echo getrecord('tbl_vendor_registration','business_name',$condition);?></td><td>GSTIN</td><td><?   $condition = " where id =".$ft->vendor_id;	
                echo getrecord('tbl_vendor_registration','gstin',$condition);?></td></tr>
<tr><td width="180">Party Address </td><td width="180"><?php   $condition = " where id =".$ft->vendor_id;
                      $state_jurisdiction=getrecord("tbl_vendor_registration","state_jurisdiction",$condition);
                echo getrecord("tbl_vendor_registration","CONCAT(`flat`,' ',`road`,' ',`area`,' ',`address4`,' ',address5,' ',`city`)",$condition)." ".getrecord("tbl_state","name","where id='".$state_jurisdiction."'")." ".getrecord("tbl_vendor_registration","CONCAT(`pincode`,' ',telefax)",$condition);?></td><td>Mobile No</td><td><?   $condition = " where id =".$ft->vendor_id;	
                echo getrecord('tbl_vendor_registration','mobile_no',$condition);?></td></tr>				
<tr><td>Pan No</td><td><?   $condition = " where id =".$ft->vendor_id;	
                echo getrecord('tbl_vendor_registration','panno',$condition);?></td><td>Ledger Code</td><td><?   $condition = " where id =".$ft->vendor_id;	
                echo getrecord('tbl_vendor_registration','ledger_code',$condition);?></td></tr>
<tr><td >Purchase Order Number</td><td ><?=$ft->po_no;?></td><td></td><td></td></tr>
<tr><td>Purchase Order Date</td><td><?=yymmdd_ddmmyy($ft->po_date);?></td><td width="180">Purchase Order Commitment Date</td><td><?=yymmdd_ddmmyy($ft->po_close_date);?></td></tr>
<tr><td >Acceptance</td><td colspan="3"><?=$ft->acceptance;?></td></tr>
<tr><td >Purchase Order Description</td><td colspan="3"><?=$ft->po_description;?></td></tr>
<tr><td>Expense Category</td><td width="100"><?   $condition = " where id =".$ft->expense_category;	
                echo getrecord('tbl_expense_type','name',$condition);?></td><td>Budget</td><td width="100"><?   $condition = " where id ='".$ft->budget."'";	
                echo getrecord('tbl_budget','name',$condition);?></td></tr>
<tr><td>GSTIN NO</td><td><?   $condition = " where branch_code =".$ft->to_branch;	
                echo getrecord('tbl_branch','gstin',$condition);?></td></tr>

<?}?>

<tr><td colspan="4"><table  border="1" width="100%">   
       <thead>
 <tr width="100%">
                                                                <th value="No id" class="text-left" width="30">Sr no</th>                                                                                <th scope="col" width="190">Item Description</th>
                                                                <th scope="col" width="100">Quantity</th>
                                                                <th scope="col" width="100">Rate</th>
                                                                
                                                                <th scope="col" width="100">Unit</th>
                                                                
                                                                <th scope="col" width="100">Total Cost</th>
                                                                 <th scope="col" width="100">PR Ref No</th>
                                                            </tr>

</thead>
<tbody>
<? $sqlItem="select * from tbl_purchase_order_item where po_no='".$billno."'";	 
    $invoiceItem=$Db->query($sqlItem);
    $row_counts=mysql_num_rows($invoiceItem); 
    
        $i=0; 
        while($row= mysql_fetch_array($invoiceItem)){ 
            $i++;
                       
?>
<tr>
<td><?=$i;?></td>

<td class="item_description">
<?=$row['item_description'];?>
</td>


<td >
    <?=$row['qty'];?>
  </td>

  <td ><?=$row['rate'];?></td>
  
<td ><?=$row['unit'];?></td>

<td><?=$row['total_cost'];?></td>
<td></td>
</tr>

<? }?>

</tbody>
    </table></td></tr>
	<tr><td></td><td></td><td>Grand Total</td><td><?=$ft->cost;?></td></tr>
	<tr><td>Term & conditions</td><td colspan="3" width="500"><?=$ft->agreeText;?></td></tr>
        <tr><td>Delivery Address</td><td colspan="3" width="500"><?=$ft->deliveryaddress;?></td></tr>
	<tr><td>Comment</td><td></td><td>Purchase Committee note</td><td></td></tr>	
			
	<!--<tr><td colspan="4"><table   width="750"  border="1">
        <tr>
              <th   colspan="6" align="center" bgcolor="#99CCFF"><h4>PO STATUS LOGS</h4></th>
        </tr>
        <tr>
            <th width="15" align="center" scope="col" width="30"><B>ID</B></th>
            <th scope="col" width="150"><B>Po No</B></th>
            <th scope="col" width="150"><B>Status</B></th>
            <th scope="col" width="150"><B>Comments</B></th>
            <th scope="col" width="125"><B>Operator Name</B></th>
            <th scope="col" width="120"><B>Date</B></th>
        </tr>
		<?
$q4 = $Db->query("select * from tbl_po_status_log where po_no='".$billno."'");

  $k=0;	while($ft4 = mysql_fetch_object($q4))
	{ $k++;

?>    
<tr>
<td><?=$k;?></td>
<td><?=$ft4->po_no;?></td>
<td width="100"><?php
                $condition = " where id =".$ft4->status;	
                $inv_status_nm = getrecord('tbl_postatus','name',$condition);
                if($ft4->status == 2){
                    $condition = " where admin_id =".$ft->assign_checker_Id;	
                    $assignto_checker_name =  getrecord('admin','name',$condition);
                    $inv_status_nm .= ' - '. $assignto_checker_name;
                }
                echo $inv_status_nm;
                ?></td>
<td width="100"><?=$ft4->comments;?></td>
<td width="100"> <?php 
                    $condition = " where admin_id =".$ft4->added_by;	
                    echo getrecord('admin','name',$condition);
                ?></td>
<td width="100"><?php $added_date = new DateTime($ft4->added_date); echo $added_date->format('d/m/Y H:i:s');  ?></td>
</tr>		
<? } ?>
        </table></td></tr>-->
</table>
</div>
</page>
