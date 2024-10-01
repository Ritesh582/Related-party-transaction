<style type="text/css">
.inv-dtl, .inv-item-dtl{font-size:11px;}
.padding_class_right{padding-right:5px;}
.border{border-style:solid;border-color:#000;}
table{font-size: 14px; COLOR: #000000;FONT-FAMILY:Arial;}
</style>
<?php /*?><?php include "pdf/pdf_header.php";?><?php */?>
<page backtop="20mm" backbottom="25mm" backleft="5mm" backright="10mm">
<?
$q1 = $Db->query("select * from tbl_form15cb where b_id=$id");
	if($ft1 = mysql_fetch_object($q1));
	{
		
	
 
?>

<table width="730" border="0" bordercolor="#000000">
 
  <tr>
    <td width="730" height="78" bgcolor="#990000" class="style3"><div align="left">
      <div align="center">
          <strong>FORM NO. 15CB </strong>
          <br >
          <em>(See rule 37BB)</em>
          <br >
          <strong><u>Certificate Of an Accountant *</u></strong>

        </div>
    </div> </td>
  </tr>
</table>
<form>
<table width="7300" border="0">
  <tr>
    <td width="730"><p align="left" >I/We have examined the agreement (wherever applicable) between Mr./Ms./M/s
     
		<?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName.'>'
		 ?>
		  <br>
		  
 Mr./Ms./M/s
 <?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName1.'>'
 ?>
  requiring the (remitters) (beneficiary) above remittance as well as the relevant <br>documents and books of acc
ount required for ascertaining the nature of remittance and for determining the rate of <br> deduction of tax at source as per provisions of sub section (6) of section 195. We hereby certify the following:
     </p></td>
  </tr>
</table>

<p align="center"><strong>&nbsp;&nbsp;<span class="style7">NOTE:-</span>  Fields marked * are mandatory. All values for amount should be entered upto two decimal places.&nbsp;  </strong>
</p>

<table width="730" border="0" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
    <td width="59" bordercolor="#FFFFFF" bgcolor="#990000"><div align="center"><span class="style2">A </span></div></td>
    
    <td width="730" bordercolor="#FFFFFF" bgcolor="#cccc99"><div align="center" style="color:#990000"><strong>NAME AND ADDRESS OF THE BENEFICIARY OF THE REMITTANCE</strong></div></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="59" bordercolor="#FFFFFF" bgcolor="#990000"><div align="center"><span class="style2">B </span></div></td>
    <td width="730" bordercolor="#FFFFFF" bgcolor="#cccc99"><div align="center" style="color:#990000"><strong>PARTICULARS OF REMITTANCE AND TDS (as per certificate of the Accountant) </strong></div></td>
  </tr>
</table>

<table width="730" border="0" bordercolor="#FFFFFF">
 <tr>

</tr>
  <tr>
    <td width="26">&nbsp;</td>
        <td width="20"><div align="left">1.</div></td>
    <td colspan="5"><div align="left"><strong> Country to which remittance is made </strong></div></td>
  </tr>
 
  <tr>
    
    <td width="50"><div align="left"></div></td>
    <td width="1"><div align="left"></div></td>
    <td width="100">Country *</td>
	
    
	<?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->partBcountry."</B></Td>";
	?>
    
	 
    <td width="100"> Currency *</td>
    <?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->partBCurrency."</B></Td>";
	?>
	</tr>
 
  <tr>
    <td>&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="150">In case of others, please mention  country name </td>
    <?
      echo "<Td style='width:184;text-align:left;padding:5px;'><B>".$ft1->partBOtherCountry."</B></Td>";
	?>
    <td width="150">In case of others, please  mention currency</td>
   <?
      echo "<Td style='width:184;text-align:left;padding:5px;'><B>".$ft1->partBOtherCurrency."</B></Td>";
	?>
  </tr>
  <tr><td  height="30" colspan="7"><div align="left"></div></td></tr>
    <tr >
    	 <td width="26">&nbsp;</td>
  	 	 <td width="20">2.</td>
    	 <td colspan="5"><div align="left"><strong> Amount of remittance </strong></div></td>
    </tr>
	
  <tr>
    <td>&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td colspan="2" align="left" width="155"> In foreign currency * </td>
    <?
      echo "<Td style='width:184;text-align:left;padding:5px;'><B>".$ft1->rforeignRemittance."</B></Td>";
	?>
    <td width="150">In Indian Rs. * </td>
   <?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->rindianRemittance."</B></Td>";
	?>
  </tr>
  
	<tr>
    <td width="26">&nbsp;</td>
    <td width="20">3.</td>
    <td align="left" colspan="3">
    	<table cellpadding="0" cellspacing="0" border="0" width="410px">
    		<tr>
    			<td>Type Of Bank<strong>*</strong></td>
    			<td align="left" colspan="3" style="padding-left: 50px">
    				<table cellpadding="0" cellspacing="2" border="0">

    				<tr>
    					 <?
                          echo "<Td colspan='2'style='text-align:left;padding:5px;'><B>".$ft1->bankType."</B></Td>";
	                      ?>
    					
    				</tr>
    				</table>			    
   				</td>
   			</tr>
			 </table>
 
   		
   	</td>   
  </tr> 
  
  <tr>
  	<td colspan="6" height="10"></td>
  </tr>
  <tr>
  <td width="36"></td>
    <td colspan="6" >
    	<table cellpadding="0" cellspacing="0" border="0" style="margin-left: 20px;">
    		<tr>
    			<td width="120"> Name of the bank <strong>*</strong></td>
    			  <?
                   echo "<Td style='width:215;text-align:left;padding:5px;'><B>".$ft1->bankname."</B></Td>";
	              ?>
                   <td width="140"  align="center">Branch of the bank *</td>
				      <?
                        echo "<Td style='width:170;text-align:left;padding:5px;'><B>".$ft1->partBbranch."</B></Td>";
	                   ?>
    		</tr>
    	</table>
	</td>
    
  </tr>
  
  <tr>
         <td colspan="6"><STRONG></STRONG></td>
  </tr>

  <tr>
  	<td colspan="6" height="10"></td>
  </tr>
   <tr>
         <td colspan="6"><STRONG></STRONG></td>

  </tr>
  
  <tr>
		<td width="26">&nbsp;</td>
		<td width="26">&nbsp;</td>
    	<td colspan="2"> Location of the bank </td>
  		  <?
            echo "<Td colspan='2' style='width:400;text-align:left;padding:5px;'><B>".$ft1->locationofbank."</B></Td>";
	      ?>
   </tr>
   
  <tr>
  <td>&nbsp;</td>
         <td colspan="6"><STRONG></STRONG></td>

  </tr>
  
	<tr>
  	<td colspan="7" height="10"></td>
  </tr>
  
  <tr>
    <td width="26">&nbsp;</td>
    <td width="20"><div align="left">4.</div></td>
    <td colspan="2" width="190"><div align="left">BSR Code of the bank branch(7 digit)</div></td>
    <?
      echo "<Td style='width:100;text-align:left;padding:5px;'><B>".$ft1->partBBSRCode."</B></Td>";
	?>
	
    <td width="150">Code of the Branch(in case of foreign bank) </td>
   <?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->bankBranchCode."</B></Td>";
	?>
  </tr>
<tr>

<td colspan="7" height="30"></td>
  </tr>
  <tr >
    <td width="26">&nbsp;</td>
    <td valign="top" width="20"><div align="left">5.</div></td>
    <td colspan="2" valign="top" width="150"><div align="left">Proposed date of remittance* (DD/MM/YYYY)  </div></td>
    <?
      echo "<Td style='width:180;text-align:left;padding:5px;'><B>".$ft1->remittanceProposedDate."</B></Td>";
	?>
    <td width="155"><div align="left"></div></td>
    <td width="224"><div align="left"></div></td>
  </tr>
<tr>

<td colspan="7" height="40"></td>
  </tr>
  <tr>
    <td width="26" >&nbsp;</td>
    <td width="20"><div align="left">6.</div></td>
    <td colspan="2" width="100"><div align="left"><strong>Amount of TDS </strong></div></td>
    <td><div align="left">
    </div></td>
    <td width="155">&nbsp;</td>
    <td width="224">&nbsp;</td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td width="20"><div align="left"></div></td>
    <td >&nbsp;</td>
    <td width="180">In foreign currency * </td>
    <?
      echo "<Td style='text-align:left;padding:5px;'><B>".$ft1->rforeignTDS."</B></Td>";
	?>
    <td width="155"><div align="left">In Indian Rs. * </div></td>
    <?
      echo "<Td style='text-align:left;padding:5px;'><B>".$ft1->rindianTDS."</B></Td>";
	?>
  </tr>

  <tr>
    <td width="26">&nbsp;</td>
    <td width="20"><div align="left">7.</div></td>
    <td colspan="2" width="190"><div align="left"><strong>Rate of TDS </strong></div></td>
    <td><div align="left">
    </div></td>
    <td width="155">&nbsp;</td>
    <td width="224">&nbsp;</td>
  </tr>
 
  <tr>
    <td width="26">&nbsp;</td>
    <td width="20"><div align="left"></div></td>
    <td>&nbsp;</td>
    <td width="140">As per Income-tax Act *(%) </td>
    <?
      echo "<Td style='text-align:left;padding:5px;'><B>".$ft1->tdsRateIT."</B></Td>";
	?>
    <td width="155"><div align="left"> As per DTAA* (% ) </div></td>
    <?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->tdsRateDTAA."</B></Td>";
	?>
  </tr>
  <tr>

<td colspan="7" height="20"></td>
  </tr>
  <tr>
    <td width="26" height="30">&nbsp;</td>
    <td valign="top" width="20"><div align="left">8.</div></td>
    <td colspan="5" valign="top" width="300"><div align="left"><strong>Actual amount of remittance after TDS </strong></div>      <div align="left">
      </div> </td>
  </tr>
   
  <tr>
    <td width="26">&nbsp;</td>
    <td width="20"><div align="left"></div></td>
    <td>&nbsp;</td>
    <td width="180">In foreign currency * </td>
    <?
      echo "<Td style='width:180;text-align:left;padding:5px;'><B>".$ft1->ractualforeignremittance."</B></Td>";
	?>
    <td width="155">In Indian Rs. * </td>
   <?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->ractualIndianremittance."</B></Td>";
	?>
  </tr>

  <tr>
    <td width="26">&nbsp;</td>
    <td valign="top" width="20"><div align="left">9.</div></td>
    <td colspan="2" valign="top" width="180"><div align="left">
      Date of deduction of tax at source (DD/MM/YYYY) 


      </div></td>
    <?
      echo "<Td style='text-align:left;padding:5px;'><B>".$ft1->dateTDSDed."</B></Td>";
	?>
    <td width="155"><div align="left"></div></td>
    <td width="224"><div align="left"></div></td>
  </tr>
  <tr>

<td colspan="7" height="20"></td>
  </tr>
  <tr>
    <td width="26">&nbsp;</td>
    <td valign="top" width="20"><div align="left">10.</div></td>
    <td colspan="2" valign="top" width="180"><div align="left">Nature of remittance as per agreement/ document * </div></td>
    <?
      echo "<Td colspan='3' style='text-align:left;padding:5px;'><B>".$ft1->remittanceNature."</B></Td>";
	?>
  </tr>



<tr>
    <td width="26">&nbsp;</td>
    <td valign="top" width="20"><div align="left"></div></td>
    <td colspan="2" valign="top" width="180"><div align="left"> In case of  Other Income please mention nature of remittance
</div></td>
     <?
      echo "<Td colspan='3' style='text-align:left;padding:5px;'><B>".$ft1->otherIncomeRemitNature."</B></Td>";
	?>
  </tr>
</table>
<table width="650" border="0" bordercolor="#FFFFFF">
  <tr bordercolor="#FFFFFF">
    <td width="26" bordercolor="#FFFFFF">&nbsp;</td>
    <td  bordercolor="#FFFFFF" colspan="2" width="550">
     11. In case the remittance is net of taxes, whether tax payable has been grossed up?* 
    </td>
     <td width="80">
   <?
	 echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->rgrossTaxFlag.'>'
   ?>
     </td>
    
  </tr>
 
  <tr bordercolor="#FFFFFF">
    <td colspan="4" bordercolor="#FFFFFF" > <strong>Please provide details of remittance (select any one out of fields 12, 13, 14, 16 )</strong></td>
    <td>&nbsp;</td>
  </tr>
 
 


  <tr>
    <td colspan="4" align="left" valign="top" bordercolor="#FFFFFF" width="200" ><strong>
        <input type="checkbox" name="rroyaltiesRemittance" tabindex="60" value="true" >
</strong>12<strong>. </strong>  <strong> If the remittance is for royalties, fee for technical services, interest, dividend, etc</strong> <strong>.,</strong>   </td>
   
  </tr>
 
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF">&nbsp;</td>
   
    <td width="150" bordercolor="#FFFFFF" colspan="2">(a)
    
        The clause of the relevant DTAA under which the remittance is covered
    </td>
     <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->rdTAAClause."</B></Td>";
	?>
  </tr>
  
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="26">&nbsp;</td>
    <td valign="middle" bordercolor="#FFFFFF">&nbsp;</td>
    <td valign="middle" bordercolor="#FFFFFF"> Reasons for the above </td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->rdTAAReason."</B></Td>";
	?>
  </tr>
  
  
  <tr bordercolor="#FFFFFF">
    
    <td bordercolor="#FFFFFF">&nbsp;</td>
    <td width="150" bordercolor="#FFFFFF" colspan="2">(b)Rate of TDS required to be deducted in terms of such clause of the applicable DTAA 
    </td>
     <?
      echo "<Td style='width:224;text-align:left;padding:5px;'><B>".$ft1->rdTAARate."</B></Td>";
	?>
  </tr>
  
  <tr bordercolor="#FFFFFF">
   
    <td bordercolor="#FFFFFF" >&nbsp;</td>
    <td width="150" bordercolor="#FFFFFF" colspan="2">(c)
    
         In case TDS is made at a lower rate than the rate prescribed under DTAA, reasons thereof </td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->rlowerTDSReasons."</B></Td>";
	?>
  </tr>
  
   
  <tr bordercolor="#FFFFFF">
    <td colspan="5" bordercolor="#FFFFFF" >
     <strong>
        <input type="checkbox" name="rsupplyRemittance" tabindex="65" value="true" >
      </strong>      13<strong>. In case remittance is for supply of articles or things (e.g. plant, machinery, equipment etc.), </strong>
     </td>
  </tr>
 
  <tr bordercolor="#FFFFFF" >
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
   
    <td valign="top" bordercolor="#FFFFFF" colspan="2" width="150">(a) Whether the recipient of remittance has any permanent establishment (PE) in India through which the beneficiary of the 
        remittance is directly or indirectly carrying on such activity of supply of articles or things? </td>
    <td width="80">
   <?
	 echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->rpermanentEstablishment.'>'
   ?>
     </td>
     
  </tr>
   
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" colspan="2" width="200">(b) 
       Whether such remittance is attributable to or connected with such permanent establishment </td>
    <td width="80">
   <?
	 echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->rremittancePEFlag.'>'
   ?>
     </td>
     
  </tr>
  
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td valign="top" bordercolor="#FFFFFF" width="200" colspan="2">(c)
     If the reply to Item no. (b) above is yes, the amount of income ( Indian Rs.) comprised in such remittance which is liable to tax. </td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->peAmount."</B></Td>";
	?>
  </tr>
  
  
  <tr bordercolor="#FFFFFF">
    
    <td bordercolor="#FFFFFF" width="20" >&nbsp;</td>
    <td bordercolor="#FFFFFF" width="200" colspan="2">(d)
    If not, the reasons in brief thereof. </td>
   <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->pesupplyReasons."</B></Td>";
	?>
  </tr>


  <tr>
    <td colspan="4" bordercolor="#FFFFFF" ><strong>
          <input type="checkbox" name="rbuisnessRemittance" tabindex="69" value="true">
        </strong>        14.<strong>In case the remittance is on account of business income, </strong> </td>
  </tr>
  
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
   
    <td bordercolor="#FFFFFF" width="200" colspan="2">(a)Whether such income is liable to tax in India </td>
    
	
	<td width="80">
   <?
	 echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->businessIncomeTaxFlag.'>'
   ?>
     </td>
  </tr>
  
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" width="200" colspan="2">(b) If so, the basis of arriving at the rate of deduction of tax. </td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->businessIncomeRateBasis."</B></Td>";
	?>
  </tr>
  
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" width="200" colspan="2"> (c) If not, the reasons thereof.</td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->otherBusinessIncomeReasons."</B></Td>";
	?>
  </tr>

 
  <tr>
    <td colspan="4" bordercolor="#FFFFFF" ><strong>
</strong><strong>
<input type="checkbox" name="rincomeTaxRemittance" tabindex="73" value="true" >
</strong>15.<strong> In case any order u/s 195(2)/ 195(3)/ 197 of Income-tax Act has been obtained from the Assessing Officer, details thereof:</strong> </td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" width="200" colspan="2">(a)Name  of the Assessing officer who issued the order/ certificate</td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->aoName."</B></Td>";
	?>

  </tr>
   

  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" width="200" colspan="2">Designation of the Assessing officer who issued the order/ certificate </td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->aoDesignation."</B></Td>";
	?>
  </tr>
  
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" width="200" colspan="2">(b) Date of the order/ certificate </td>
   <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->aoCertDate."</B></Td>";
	?>
  </tr>
  
   
  <tr bordercolor="#FFFFFF">
    <td bordercolor="#FFFFFF" width="20">&nbsp;</td>
    <td bordercolor="#FFFFFF" colspan="2" width="200">(c)  Specify whether u/s 195(2)/ 195(3)/ 197 of I T Act </td>
    <?
      echo "<Td style='text-align:left;padding:5px;'><B>".$ft1->aoSection."</B></Td>";
	?>
  </tr>
 

  <tr>
    <td colspan="3" bordercolor="#FFFFFF" width="250"><strong>
          <input type="checkbox" name ="otherremittancecheckbox" id="otherremittancecheckbox"  tabindex="78"  value="true" >
        </strong>16.<strong> In case of any other remittance, if tax is not deducted at source for any reason, details thereof</strong> </td>
    <?
      echo "<Td style='width:80;text-align:left;padding:5px;'><B>".$ft1->rotherReason."</B></Td>";
	?>
  </tr>
	
</table>
   


<table width="730" height="49" border="0">
  <tr>
  	<td width="500" colspan="4"><strong>(Attach separate sheet duly authenticated wherever necessary)</strong>
	
	</td>
	</tr>
	
  <tr>
  	<td width="500"  colspan="4"><strong>** Certificate No :-
	    <?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->certNo.'>'
		 ?>
		 </strong></td>

		

</tr>
 	
<tr>
	<td colspan="4"><strong>Signature &nbsp; :-
	    <?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName.'>'
		 ?>
		 </strong></td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>	
<tr>
	<td colspan="4"><div align="left"><strong>Name &nbsp; :-
	<?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName.'>'
	 ?>
		 </strong></div></td>
</tr>	
<tr>
	<td colspan="4">&nbsp;</td>
</tr>	
<tr>
	<td colspan="4"><strong>Name Of the properietorship/Firm &nbsp; :-
	<?
		 echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName.'>'
    ?>
		 </strong></td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>	
<tr>
	<td colspan="4"><div align="left"><strong>Address &nbsp; :-
	<?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName.'>'
		 ?>
		 </strong></div></td>
</tr>	
<tr>
	<td colspan="4">&nbsp;</td>
</tr>	
<tr>
	<td colspan="4"><div align="left"><strong>Registration Number &nbsp; :-
	    <?
		  echo '<input type="text" name="verAgreeName" maxlength="75" size="40" tabindex="80" value='.$ft1->verAgreeName.'>'
		 ?>
		 </strong></div></td>
</tr>	
	
	

<tr>
    <td width="48" height="45"><strong>Place</strong></td>
   <?
      echo "<Td style='width:232;text-align:left;padding:5px;'><B>".$ft1->verAgreePlace."</B></Td>";
	?>
    <td width="186"><div align="right"><strong>Date</strong></div></td>
   <?
      echo "<Td style='width:205;text-align:left;padding:5px;'><B>".$ft1->verDate."</B></Td>";
	?>


  </tr>
 
</table>
</form>
		  <input type="hidden" name="rgrossTaxFlagVar" value="">
		  <input type="hidden" name="selectCheckFlagVar" value="">
	  	  <input type="hidden" name="selectincomeTaxRemittance" value="false">
 		  <input type='hidden' value='' name='b_id''>
		  <input type='hidden' value='' name='mode'>	
<p align="center">&nbsp;&nbsp;
  <input type="submit" name="cmdSubmit" class="submitbutton" tabindex="85" value="PROCEED" >
  <input name="cmdSubmit" value="Back" class="submitbutton" type="button">
  &nbsp;</p>
<?php }?>
 </page>
 
 
