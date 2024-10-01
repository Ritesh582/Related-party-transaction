<style type="text/css">
.inv-dtl, .inv-item-dtl{font-size:11px;}
.padding_class_right{padding-right:5px;}
.border{border-style:solid;border-color:#000;}
table{font-size: 14px; COLOR: #000000;FONT-FAMILY:Arial;}
</style>
<?php /*?><?php include "pdf/pdf_header.php";?><?php */?>
<page backtop="20mm" backbottom="25mm" backleft="5mm" backright="10mm">
<?
$query ="SELECT tc.company_name as a1,tc.comp_logo as logo,tv.deductee_nm a2,tb.id as a3,tb.dates as a4,tc.Permanent_Account_No as a5,tc.Service_Tax_Registration_No as a6,tc.Company_Identification_No as a7,tc.Tax_deduction as a8,tc.Payment_details_Account_Name as a9,tc.Payment_details_Account_Type as a10,tc.Payment_details_Account_Number as a11,tc.Payment_details_IFS_Code as a12,tc.Payment_details_Bank_Name as a13,tc.	Payment_details_Bank_Branch as a14,tt.tax_percent as a17 ,tc.address as a18,tc.city as a19,tc.state as a20,tc.country as a21,tc.phone1 as a22,tc.phone2 as a23,tc.faxNo as a24,tc.url as a25,tb.extra_amt as a26 FROM tbl_billgeneration tb INNER JOIN company_table tc on tb.comp_id=tc.company_code INNER JOIN vendor_deductee tv on tb.vendor_id=tv.vendor_id INNER JOIN tbl_Taxes tt on tb.tax_id=tt.id where tb.id=$billno";
$mysqli=mysqli_connect('localhost','root','','invoicesystem') or die("Database Error");	
	$q1= mysqli_query($mysqli,$query);
	if($row = mysqli_fetch_object($q1));
	{
	
?>
<div>
<table width="730" border="0" bordercolor="#000000">
 <tr><th  align="center" colspan="2"><h1>Invoice</h1></th></tr>
  <tr>
    <td height="78"  class="style3" colspan="2"><div align="left">
      <div align="Left">
         
          <h2> <? echo $row->a1;?></h2>

        </div>
		<div align="right">
        <img src="../admin/logo/<?php echo $row->logo;?>" width="100" height="61" />
        </div>
    </div> </td>
  </tr>
  <tr>
    <td width="557"><b>TO,</b>    </td>
	<td width="163"><b>BILL NO.</b><? echo $row->a3;?>    </td>
  </tr>
  <tr>
    <td width="557"><b><? echo $row->a2;?></b>    </td>
	<td width="163"><b>Date: </b><? echo $row->a4;?></td>
	
  </tr>
</table>

<table width="730" border="0.2" >
  <tr>
    
    <td width="50" height="31" bordercolor="#FFFFFF"><div align="top" style="color:#990000"><strong>Sr No </strong></div></td>
    <td width="315" height="31" bordercolor="#FFFFFF"><div align="center" style="color:#990000"><strong>Professional services for</strong></div></td>
	<td width="180" height="31" bordercolor="#FFFFFF"><div align="center" style="color:#990000"><strong>Amount </strong></div></td>
    
    <td width="160" height="31" bordercolor="#FFFFFF"><div align="center" style="color:#990000"><strong>Total Amount</strong></div></td>
  </tr>


		<?
		 $query2="SELECT  tp.amount as amount,tp.total_amount as total_amount,cs.name as name from tbl_billproduct tp INNER JOIN categories cs ON tp.itemId=cs.id where tp.billNo=$billno";
		$q2 = mysqli_query($mysqli,$query2);
		$i=0;
		$totalAmt=0;
		$tax_deducted=0;
		while($ro= mysqli_fetch_object($q2)){
		        $i++;
				$totalAmt=$totalAmt+$ro->total_amount;
        ?>      
			<tr><td width="50" height="31" bordercolor="#FFFFFF"><? echo $i ;?></td>
            <td width="315" height="31" bordercolor="#FFFFFF"><? echo $ro->name;?></td>
	        <td width="180" height="31" bordercolor="#FFFFFF"><? echo $ro->amount;?></td>
            <td width="160" height="31" bordercolor="#FFFFFF"><? echo $ro->total_amount;?></td></tr>
		<?
		  
		  }
		  $tax_deducted=$totalAmt*$row->a17/100;
		  $education_cess=$tax_deducted*3/100;
		  $grossTotal=$totalAmt+$tax_deducted+$row->a26+$education_cess;
		?>		
		
	<tr><td width="50" height="31" bordercolor="#FFFFFF"></td>
            <td colspan="2" height="31" bordercolor="#FFFFFF">Total excluding outlays:</td>
            <td  height="31" bordercolor="#FFFFFF"><?  echo  $totalAmt; ?></td></tr>
<tr><td width="50" height="31" bordercolor="#FFFFFF"></td>
            <td colspan="2" height="31" bordercolor="#FFFFFF">Add:Out Of Pocket</td>
            <td  height="31" bordercolor="#FFFFFF"><?  echo  $row->a26; ?></td></tr>
			<tr><td width="50" height="31" bordercolor="#FFFFFF"></td>
            <td colspan="2" height="31" bordercolor="#FFFFFF">Service tax<? echo $row->a17."%"; ?></td>
            <td  height="31" bordercolor="#FFFFFF"><?  echo  $tax_deducted; ?></td></tr>
			
			<tr><td width="50" height="31" bordercolor="#FFFFFF"></td>
            <td colspan="2" height="31" bordercolor="#FFFFFF">Education Cess @ 3% on above</td>
            <td  height="31" bordercolor="#FFFFFF"><?  echo  $education_cess; ?></td></tr>
 <tr><td width="50" height="31" bordercolor="#FFFFFF"></td>
            <td colspan="2" height="31" bordercolor="#FFFFFF" align="right">Total</td>
            <td  height="31" bordercolor="#FFFFFF"><?  echo  $grossTotal; ?></td></tr>
</table>
<br /><br /><br />
<table width="730" border="0.2" bordercolor="#000000" bgcolor="#FFFFFF">
		
		
			<tr><td width="420" >Permanent Account Number:</td><td width="300"><? echo $row->a5;?></td></tr>
			<tr><td width="420" >Service Tax Registration Number:</td><td width="300"><? echo $row->a6;?></td></tr>
			<tr><td width="420" >Company Identification Number:</td><td width="300"><? echo $row->a7;?></td></tr>
			<tr><td width="420" >Tax Deduction U/s. 194J</td><td width="300"><? echo $row->a8;?></td></tr>
			<tr><td width="420" >Payment Details NEFT/RTGS:</td><td width="300"></td></tr>
			<tr><td width="420" >1)Account Name</td><td width="300"><? echo $row->a9;?></td></tr>
			<tr><td width="420" >2)Account Type:</td><td width="300"><? echo $row->a10;?></td></tr>
			<tr><td width="420" >3)Account Number:</td><td width="300"><? echo $row->a11;?></td></tr>
			<tr><td width="420" >4)IFS Code:</td><td width="300"><? echo $row->a12;?></td></tr>
			<tr><td width="420" >5)Bank Name:</td><td width="300"><? echo $row->a13;?></td></tr>
			<tr><td width="420" >6)Bank Branch:</td><td width="300"><? echo $row->a14;?></td></tr>
			<tr><td width="420" >Payment Term:</td><td width="300"><? echo $row->a15;?></td></tr>
				
</table>
</div>
<div style='position:fixed;top:900;'>
<hr />
<p align="center"><? echo $row->a18.",".$row->a19.",".$row->a20.",".$row->a21.",Phone_no:-".$row->a22.",".$row->a23.",Fax_NO:-".$row->a24.",Website:-".$row->a25; ?></p>
<?
		  
 }
		 
?>
</div>
 </page>
 
 
