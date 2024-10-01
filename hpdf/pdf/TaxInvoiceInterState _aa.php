<style type="text/css">
.inv-dtl, .inv-item-dtl{font-size:11px;}
.padding_class_right{padding-right:5px;}
.border{border-style:solid;border-color:#000;}
table{font-size: 14px; COLOR: #000000;FONT-FAMILY:Arial;}
</style>
<?
$q = $Db->query("select * from tbl_invoice where id=$billno");
	if($ft = mysql_fetch_object($q));
	{

?>
<page backtop="20mm" backbottom="25mm" backleft="5mm" backright="10mm">

<div>
<table width="750" border="0.1" bordercolor="#000000">
<tr><td colspan="3"><img src="<? $logo_image=getrecord('tbl_company','logo_image','where company_code='.$ft->comp_code.''); echo DOMAIN."/".$imagePath.$logo_image;?>" /></td><td colspan="8" align="center" width="300"><?=getrecord('tbl_company','name','where company_code='.$ft->comp_code.'');?><br /><?=getrecord('tbl_branch','branch_location','where branch_code='.$ft->upload_to_branch.'');?>,<br />GSTIN: <?=getrecord('tbl_branch','gstin','where branch_code='.$ft->upload_to_branch.'');?></td> <td colspan="3"></td></tr>
<tr><th  width="730" align="center" colspan="14" bgcolor="#99CCFF"><h1>Tax Invoice</h1></th></tr>
 <tr><td  colspan="7" width="300">Invoice No:<? echo $ft->id;?></td><td colspan="7">Transport Mode:</td></tr>
 <tr><td  colspan="7" width="300">Invoice Date:<? echo yymmdd_ddmmyy($ft->invoice_date);?></td><td colspan="7">Vehicle number:</td></tr>
 <tr><td  colspan="7" width="300">Reverse Charge (Y/N): <? $rc=getrecord('tbl_invoice_entry','reverse_charges','where invoice_id="'.$ft->Prefix."".$ft->id.'"'); if($rc==1){echo "YES";}else{echo "No";}?></td><td colspan="7">Date of Supply:</td></tr>
 <tr><td  colspan="5" width="200">State:<? $state=getrecord('tbl_invoice_entry','from_state','where invoice_id="'.$ft->Prefix."".$ft->id.'"');?>
                                          <?=getrecord('tbl_state','name','where id="'.$state.'"');?></td><td  width="30">Code:</td><td  width="30"><? echo $state;?></td><td colspan="7">Place of Supply:<? $state=getrecord('tbl_invoice_entry','place_of_supply','where invoice_id="'.$ft->Prefix."".$ft->id.'"');?></td></tr>
 <tr><td  colspan="7" width="300" height="10"></td><td colspan="7"></td></tr>
 <tr><td  colspan="14" width="600"  bgcolor="#99CCFF"><div align="center">Bill to Party</div></td>

 </tr>
 <tr><td  colspan="14" width="700">Name:<?=getrecord('tbl_vendor_registration','business_name','where id="'.$ft->vendor_id.'"');?></td>

 </tr>
 <tr><td  colspan="14" width="600">Address: <?=getrecord('tbl_vendor_registration','CONCAT(flat,",",road,",",area,",",city,",",pincode)','where id="'.$ft->vendor_id.'"');?></td>
 
 </tr>
 <tr><td  colspan="14" width="600">GSTIN: <?=getrecord('tbl_vendor_registration','gstin','where id="'.$ft->vendor_id.'"');?> </td>
 
 </tr> <? $state_jurisdiction=getrecord('tbl_vendor_registration','state_jurisdiction','where id="'.$ft->vendor_id.'"');?>
                                   
 <tr><td  colspan="10" width="500">State: <?=getrecord('tbl_state','name','where id="'.$state_jurisdiction.'"');?></td><td  width="60" colspan="2">Code:</td><td colspan="2" width="60"><? echo $state_jurisdiction;?>  </td>
</tr>
 
 <tr><td  colspan="14" width="600" height="10"></td></tr>
 <tr><td  width="15" height="10">S No</td><td  width="65">Product Description</td><td  width="40">HSN code</td><td  width="40">UOM</td><td  width="40">Qty</td><td  width="45">Rate</td><td  width="45">Amount</td><td  width="45">Discount</td><td  width="45">Taxable Value</td><td  width="45">CGST<br />Rate</td><td  width="45">CGST<br />Amount</td><td  width="45">SGST<br />Rate</td><td  width="45">SGST<br />Amount</td><td width="45">Total</td></tr>
 
 <?
		 
		$q2 = $Db->query("SELECT  * from tbl_invoice_item where invoice_id='".$ft->Prefix."".$ft->id."'");
		$i=0;
		$totalAmt=0;
		$totalQty=0;
		$totalcgstAmt=0;
		$totalsgstAmt=0;
		//$tax_deducted=0;
		$totalTaxableval=0;
		while($ro= mysql_fetch_array($q2)){
		        $i++;
				$totalQty=$totalQty+$ro['qty'];
				$totalcgstAmt=$totalcgstAmt+$ro['cgst_amt'];
				$totalsgstAmt=$totalsgstAmt+$ro['sgst_amt'];
				$totalTaxableval=$totalTaxableval+$ro['taxable_value'];
				$totalAmt=$totalAmt+$ro['total'];
        ?>      
 <tr style="font-size:10px"><td  width="15" height="10"><?=$i;?></td><td  width="65"><?=$ro['item_description'];?></td><td  width="40"><?=$ro['hsn_sac'];?></td><td  width="40"><?=$ro['unitof_measurement'];?></td><td  width="40"><?=$ro['qty'];?></td><td  width="45"><?=$ro['rate'];?></td><td  width="45"><?=$ro['qty'] * $ro['rate'];?></td><td  width="45"><?=$ro['discount'];?></td><td  width="45"><?=$ro['taxable_value'];?></td><td  width="45"><?=$ro['cgst_percentage'];?></td><td  width="45"><?=$ro['cgst_amt'];?></td><td  width="45"><?=$ro['sgst_percentage'];?></td><td  width="45"><?=$ro['sgst_amt'];?></td><td width="45"><?=$ro['total'];?></td></tr>
 
 <? }?>
 
 
 <tr style="font-size:10px"><td  width="150"  colspan="4" align="center" ><h4>Total</h4></td><td  width="40"><?=$totalQty;?></td><td  width="45"></td><td  width="45"></td><td  width="45"></td><td  width="45"><?=$totalTaxableval;?></td><td  width="45"></td><td  width="45"><?=$totalcgstAmt;?></td><td  width="45"></td><td  width="45"><?=$totalsgstAmt;?></td><td width="45"><?=$totalAmt;?></td></tr>
  <tr><td  width="305"  colspan="7" align="center" >Total Invoice Amount In Word</td><td  width="180" colspan="5">Total Amount before Tax</td><td width="45" colspan="2"><?=$totalTaxableval;?></td></tr>
 <tr><td  width="305" colspan="7"  rowspan="8" align="center" ></td><td  width="180" colspan="5">Add:CGST</td><td width="45" colspan="2"><?=$totalcgstAmt;?></td></tr>
 <tr><td  width="180" colspan="5">Add:SGST</td><td width="45" colspan="2"><?=$totalsgstAmt;?></td></tr>
  <tr><td  width="180" colspan="5">Total Tax Amount</td><td width="45" colspan="2"></td></tr>
  <tr><td  width="180" colspan="5">Total Amount after Tax</td><td width="45" colspan="2"><?=$totalAmt;?></td></tr>
	  <tr><td  width="180" colspan="5">GST On Reverse Charge</td><td width="45" colspan="2"></td></tr>
	 <tr><td  width="220" colspan="7"><small>certified that the perticulars given above are true and correct</small> </td></tr>
	 <tr><td  width="180" colspan="7" >For <?=getrecord('tbl_company','name','where company_code='.$ft->comp_code.'');?></td></tr>
	 <tr><td  width="180" height="100" colspan="7" align="center"><img src="<? $signatureImage=getrecord('tbl_branch','signatureImage','where branch_code='.$ft->upload_to_branch.''); echo DOMAIN."/".$imagePath.$signatureImage;?>" /><br /><?=getrecord('tbl_branch','authorityName','where branch_code='.$ft->upload_to_branch.'');?><br />Authorised Signatory</td></tr>
	
</table>



</div>

 </page>
  
 
  <? }?>