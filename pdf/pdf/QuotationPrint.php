<style>
.inv-dtl, .inv-item-dtl{font-size:11px;}
.padding_class_right{padding-right:5px;}
.border{border-style:solid;border-color:#000;}
table{font-size: 14px; COLOR: #000000;FONT-FAMILY:Arial;}
</style>

<page backtop="20mm" backbottom="25mm" backleft="5mm" backright="10mm">
<div>
<table width="750" border="0.1" bordercolor="#000000">
<?
$q = $Db->query("select * from tbl_requisition where requisition_no='".$billno."'");

	if($ft = mysql_fetch_object($q));
	{

?>
<tr><th colspan="4" align="center" bgcolor="#99CCFF"><h3>Add Purchase Quotation</h3></th></tr>
<tr><td width="180">Requisition Number *</td><td width="180"><?=$ft->requisition_no;?></td><td width="180">Date</td><td width="180"><?=yymmdd_ddmmyy($ft->purchase_date);?></td></tr>
<tr><td>Branch Name</td><td><?=$ft->to_branch;?></td><td>Enter Branch to Upload</td><td><?=$ft->from_branch;?></td></tr>
<tr><td>Department</td><td><?=$ft->to_department;?></td><td>Enter Department to Upload</td><td><?=$ft->from_department;?></td></tr>
<tr><td>Select Checker</td><td><?   $condition = " where admin_id =".$ft->assign_checker_Id;	
                echo getrecord('admin','name',$condition);?></td><td>Budget</td><td width="100"><?   $condition = " where id ='".$ft->budgetFlag."'";	
                echo getrecord('tbl_budget','name',$condition);?></td></tr>

<?}?>

<tr><td colspan="4"><table  border="1" width="750">   
       <thead>
 <tr width="100%">
                                                                <th value="No id" class="text-left" width="20">Sr no</th>                                                                                <th scope="col" width="100">Item Description</th>
                                                                <th scope="col" width="60">Quantity</th>
                                                                <th scope="col" width="50">Rate</th>
                                                                
                                                                <th scope="col" width="50">Unit</th>
                                                                
                                                                <th scope="col" width="70">Total Cost</th>
                                                                <th scope="col" width="80">Balance as on Date</th>
                                                                <th scope="col" width="80">Last Order Date& Qty</th>
                                                                <th scope="col" width="80">Monthly Consumption</th>
                                                                <th scope="col" width="90">Remark </th>
                                                            </tr>

</thead>
<tbody>
<? $sqlItem="select * from tbl_requisition_item where requisition_no='".$billno."'";	 
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

<td><?=$row['balance_on_date'];?></td>

<td><?=$row['last_order'];?></td>

<td><?=$row['monthly_consumption'];?></td>

<td><?=$row['remark'];?></td>


</tr>

<? }?>

</tbody>
    </table></td></tr>
	<tr><td></td><td></td><td>Grand Total</td><td><?=$ft->total_requisition_cost;?></td></tr>
	<tr><th colspan="4" align="center" bgcolor="#99CCFF"><h3>Enter Quotation Details</h3></th></tr>
	<tr><td colspan="4"><table  border="1" width="750">   
       <thead>
 <tr width="100%">
                                                                <th value="No id" class="text-left" width="20">Sr no</th>
                                                                <th scope="col" width="80">Supplier Name</th>
							                                    <th scope="col" width="50">Upload File</th>
                                                                <th scope="col" width="80">Select Date</th>
                                                                <th scope="col" width="60">Total Amount</th>
                                                                <th scope="col" width="70">Company Turnover</th>
                                                                <th scope="col" width="70">Company Nett Profit</th>
                                                                <th scope="col" width="50">Company Exp</th>
                                                                <th scope="col" width="60">Vendor Since</th>
																<th scope="col" width="80">Remarks</th>
																<th scope="col" width="20">In Favor Of</th>
                                                            </tr>

</thead>
<tbody>

<? 

$quotationStatus=0;
$sqlItem="select * from tbl_quotation where pr_no='".$ft->id."'";	 
    $pqItem=$Db->query($sqlItem);
   
        $i=0; 
        while($row= mysql_fetch_array($pqItem)){ 
            $i++;
            $countItem=$i;  
			$reason_in_favor_of =$row['reason_in_favor_of'];  
			 $quotationStatus =$row['status'];     
?>
<tr>
<td><?=$i;?></td>
<td><?=$row['company_name'];?></td>
<td>  
<?= $row['upload_file']; ?>
                       </td>
   
<td ><?=$row['upload_date'];?></td>
<td><?=$row['total_amt'];?></td>
<td><?=$row['company_turnover'];?></td>
<td><?=$row['company_net_profit'];?></td>
<td><?=$row['company_experience'];?></td>
<td><?=$row['vendor_since'];?></td>
<td><?=$row['remarks'];?></td>
<td><?=strchecked(1,$row['in_favor_of']);?></td>
</tr>
<? }?>
</tbody></table></td></tr>
	<tr><td></td><td></td><td>Reason For In favor of</td><td><?=$reason_in_favor_of;?></td></tr>				
	<tr><td colspan="4"><table   width="750"  border="1">
        <tr>
              <th   colspan="6" align="center" bgcolor="#99CCFF"><h4>PR QUOATATION STATUS LOGS</h4></th>
        </tr>
        <tr>
            <th width="15" align="center" scope="col" width="20"><B>ID</B></th>
            <th scope="col" width="150"><B>Requisition No</B></th>
            <th scope="col" width="150"><B>Status</B></th>
            <th scope="col" width="150"><B>Comments</B></th>
            <th scope="col" width="120"><B>Operator Name</B></th>
            <th scope="col" width="120"><B>Date</B></th>
        </tr>
		<?
$q4 = $Db->query("select * from tbl_pq_status_log where requsitionNo ='".$billno."'");

  $k=0;	while($ft4 = mysql_fetch_object($q4))
	{ $k++;

?>    
<tr>
<td><?=$k;?></td>
<td><?=$ft4->requsitionNo;?></td>
<td width="100"><?php
                $condition = " where id =".$ft4->status;	
                $inv_status_nm = getrecord('tbl_pqstatus','name',$condition);
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
<td width="100"><?php echo $ft4->added_date; ?></td>
</tr>		
<? } ?>
        </table></td></tr>
</table>
</div>
</page>
