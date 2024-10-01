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
$q = $Db->query("select * from tbl_invoice where concat(Prefix,id)='".$billno."'");

	if($ft = mysql_fetch_object($q));
	{

?>
<tr><th colspan="4" align="center" bgcolor="#99CCFF"><h3>Uploaded Invoice Details</h3></th></tr>
<tr><td width="180">Party Name </td><td width="180"><?=$ft->party_name;?></td><td width="180">Uploaded Invoice</td><td width="180"><?= $ft->filename; ?></td></tr>
<tr><td>Pan No</td><td><?=$ft->panno;?></td><td>GSTIN</td><td><?=$ft->gstin;?></td></tr>
<tr><td>Ledger Code</td><td><?=$ft->ledger_code;?></td><td>Vendor Invoice Number</td><td><?=$ft->invoice_no;?></td></tr>
<tr><td>Branch Code</td><td><?=$ft->branch_code;?></td><td>Enter Branch to Upload</td><td><?=$ft->upload_to_branch;?></td></tr>
<tr><td>Department</td><td><?=$ft->dept_code;?></td><td>Enter Department to Upload</td><td><?=$ft->upload_to_department;?></td></tr>
<tr><td>Select Checker</td><td><?   $condition = " where admin_id =".$ft->assign_checker_Id;	
                echo getrecord('admin','name',$condition);?></td><td>Expense Category</td><td width="100"><?   $condition = " where id =".$ft->sub_dept_id;	
                echo getrecord('tbl_sub_department','sub_dept_name',$condition);?></td></tr>
<tr><td>Invoice Amount(Including Tax)</td><td><?=$ft->invoice_amount;?></td><td>Invoice Date</td><td><?=yymmdd_ddmmyy($ft->invoice_date);?></td></tr>
<tr><td>Advance Amount</td><td><?=$ft->advance_amount;?></td><td>Adv. Transaction ID</td><td><?=$ft->adv_transaction_id;?></td></tr>
<tr><td>Comment</td><td colspan="3"><?=$ft->comment;?></td></tr>
<?}?>
<?
$q1 = $Db->query("select * from tbl_invoice_entry where invoice_id='".$billno."'");

	if($ft1 = mysql_fetch_object($q1));
	{

?>
<tr><th colspan="4" align="center" bgcolor="#99CCFF"><h3>Add Invoice Entries</h3></th></tr>
<tr><td>Invoice No</td><td><?=$ft1->invoice_serial_no;?></td><td>Invoice Date</td><td><?=yymmdd_ddmmyy($ft1->invoice_date);?></td></tr>
<tr><td>PO Number </td><td><?=$ft1->po_no;?></td><td>Due Date on Invoice (if any)</td><td><?=yymmdd_ddmmyy($ft1->due_date);?></td></tr>
<tr><td>From State</td><td><?   $condition = " where id ='".$ft1->from_state."'";	
                echo getrecord('tbl_state','name',$condition);?></td><td>To State</td><td><?   $condition = " where id ='".$ft1->to_state."'";	
                echo getrecord('tbl_state','name',$condition);?></td></tr>
<tr><td>Place of Supply</td><td><?   $condition = " where id ='".$ft1->place_of_supply."'";	
                echo getrecord('tbl_state','name',$condition);?></td><td>Nature Of Supply</td><td><?   $condition = " where id ='".$ft1->nature_of_supply."'";	
                echo getrecord('tbl_nature_of_supply','name',$condition);?></td></tr>
<tr><td>Reverse Charge</td><td ><? if($ft1->reverse_charges==1){?> Yes<?}else{?> No <?}?> </td><td>Input Tax Credit</td><td ><? if($ft1->input_tax_credit==1){?> Yes<?}else{?> No <?}?></td></tr>
<tr><td>Input Service Distributor</td><td><? if($ft1->input_service_distribution==1){?> Yes<?}else{?> No <?}?></td><td></td><td></td></tr>
<tr><td>Expense Category</td><td><?   $condition = " where id ='".$ft1->expense_category."'";	
                echo getrecord('tbl_expense_category','name',$condition);?></td><td>Budget</td><td><?   $condition = " where id ='".$ft1->budget."'";	
                echo getrecord('tbl_budget','name',$condition);?></td></tr>
<tr><td>Pay Method</td><td><?   $condition = " where id ='".$ft1->pay_method."'";	
                echo getrecord('tbl_pay_method','name',$condition);?></td><td></td><td></td></tr>
<?}?>
<tr><td colspan="4"><table border="1" width="750">

   <tr>
                        <th value="No id"  align="center"  width="20">Sr no</th>
                        <th value="Item Description" align="center"  width="140">Item Description</th>
				<th value="Nature Of Supply"   align="center" width="140">Nature Of Supply</th>
                                <th value="gl_description" align="center" name="gl_description" id="gl_description"  width="140"   >GL Description</th>
                        <th value="Item Type"    align="center" width="130">Item Type</th>
                        <th value="HSN / SAC"   align="center" width="130" >HSN / SAC</th>
                        </tr>   
                <?
$q2 = $Db->query("select * from tbl_invoice_item where invoice_id='".$billno."'");

  $i=0;	while($ft2 = mysql_fetch_object($q2))
	{ $i++;

?>    
                        <tr>
                        <td><?=$i;?></td>
                        <td><?=$ft2->item_description;?></td>
						<td><?=$ft2->nature_of_supply;?></td>
						<td><?=$ft2->gl_description;?></td>
						<td><?=$ft2->item_type;?></td>
						<td><?=$ft2->hsn_sac;?></td>
                        </tr>
	<?}?>
    </table> </td></tr><tr><td colspan="4">                    
	<table  border="1" width="750"><tr>
						  <th value="No id"  align="center" rowspan="2" width="20">Sr no</th>
						 <th value="Qty"   align="center" rowspan="2" width="40">Qty</th>
                        <th value="Unit of Measurement" rowspan="2" align="center" width="50">Unit of<br /> Measure</th>
                        <th value="Rate/Item (Rs.)" rowspan="2" align="center" width="50">Rate</th>
                        <th value="Discount (Rs.)" rowspan="2"  align="center" width="50">Discount</th>
                        <th value="Taxable Value"  rowspan="2" align="center" width="60">Taxable Value</th>
                        <th value="CGST"  align="center" colspan="2" width="70" >CGST</th>
                        <th value="SGST"  align="center" colspan="2" width="80">SGST/UGST</th>
                        <th value="IGST"  align="center" colspan="2" width="70">IGST</th>
                        <th value="CESS"   align="center"  colspan="2" width="70">CESS</th>
                        <th value="TOTAL"  align="center" rowspan="2" width="50">TOTAL</th>
                        <th value="narration" align="center" rowspan="2" width="60" >NARR<br />ATION</th>
                        </tr>
                        <tr>
                        <th value="%"  >%</th>
                        <th value="Amt (Rs.)" >Amt</th>
                        <th value="%"   >%</th>
                        <th value="Amt (Rs.)"   >Amt</th>
                        <th value="%"  >%</th>
                        <th value="Amt (Rs.)" >Amt</th>
                        <th value="%"  >%</th>
                        <th value="Amt (Rs.)" >Amt</th>
                        </tr>
		<?
$q3 = $Db->query("select * from tbl_invoice_item where invoice_id='".$billno."'");

  $j=0;	while($ft3 = mysql_fetch_object($q3))
	{ $j++;

?>    				
	<tr>
						  <td><?=$j;?></td>
						  <td><?=$ft3->qty;?></td>
						  <td><?=$ft3->unitof_measurement;?></td>
						  <td><?=$ft3->rate;?></td>
						  <td><?=$ft3->discount;?></td>
						  <td><?=$ft3->taxable_value;?></td>
						  <td><?=$ft3->cgst_percentage;?></td>
						  <td><?=$ft3->cgst_amt;?></td>
						  <td><?=$ft3->sgst_percentage;?></td>
						  <td><?=$ft3->sgst_amt;?></td>
						  <td><?=$ft3->igst_percentage;?></td>
						  <td><?=$ft3->igst_amt;?></td>
						  <td><?=$ft3->cess_percentage;?></td>
						  <td><?=$ft3->cess_amt;?></td>
						  <td><?=$ft3->total;?></td>
						  <td><?=$ft3->narration;?></td>
                        </tr>					
						
	<? }?>				
                   </table></td></tr>
	<tr><td></td><td></td><td>Grand Total</td><td><?=$ft1->grandTotal;?></td></tr>				
	<tr><td colspan="4"><table   width="750"  border="1">
        <tr>
              <th   colspan="6" align="center" bgcolor="#99CCFF"><h4>INVOICE STATUS LOGS</h4></th>
        </tr>
        <tr>
            <th width="15" align="center" scope="col" width="20"><B>ID</B></th>
            <th scope="col" width="150"><B>Invoice No</B></th>
            <th scope="col" width="150"><B>Status</B></th>
            <th scope="col" width="150"><B>Comments</B></th>
            <th scope="col" width="120"><B>Operator Name</B></th>
            <th scope="col" width="120"><B>Date</B></th>
        </tr>
		<?
$q4 = $Db->query("select * from tbl_invoice_status_log where invoice_id='".$billno."'");

  $k=0;	while($ft4 = mysql_fetch_object($q4))
	{ $k++;

?>    
<tr>
<td><?=$k;?></td>
<td><?=$ft4->invoice_id;?></td>
<td width="100"><?php
                $condition = " where id =".$ft4->status;	
                $inv_status_nm = getrecord('tbl_rstatus','name',$condition);
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
