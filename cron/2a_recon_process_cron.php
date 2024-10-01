    <?php
 
    include ('includes/config.php');
   

        //gst matched

        $gst_sql = "UPDATE  tbl_gstr_2_status2 a , tbl_merged_gstr_2a b set a.status=2,a.recon_id=b.id,a.gstintwoa=b.gstin,b.recon_id=a.id,b.status=2 WHERE a.comp_code=b.comp_code and a.gstin=b.gstin and a.status=0 and b.status=0 and a.gstin<>'' and b.gstin<>'' ";
	$result_set = $Db->query($gst_sql);
        
        $invoice_sql = "UPDATE `tbl_gstr_2_status2` a , tbl_merged_gstr_2a b set a.status=3,a.recon_id=b.id,a.gstintwoa=b.gstin,a.invoice_numbertwoa=b.invoice_number,b.recon_id=a.id,b.status=3 WHERE a.comp_code=b.comp_code and a.gstin=b.gstin and a.invoice_number=b.invoice_number and a.status=2 and b.status=2 ";
	$result_set = $Db->query($invoice_sql);

        
        //intelligent invoice matched
        
        $sql_prefix_query="SELECT * FROM `tbl_prefix_invoice_number`";                      
        $resultPrefix = $Db->query($sql_prefix_query);
                            
        while ($rowPrefix = mysql_fetch_array($resultPrefix)){
            
        $intel_invoice_sql = "UPDATE `tbl_gstr_2_status2` a , tbl_merged_gstr_2a b set a.status=3,a.gstintwoa=b.gstin,a.invoice_numbertwoa=b.invoice_number,a.intel_invoice_status=1,a.recon_id=b.id,b.recon_id=a.id,b.status=3,b.intel_invoice_status=1 WHERE a.comp_code=b.comp_code and a.comp_code='".$rowPrefix["comp_code"]."' and b.comp_code='".$rowPrefix["comp_code"]."'  and a.gstin=b.gstin and replace(a.invoice_number,'".$rowPrefix["prefix_invoice_number"]."','')=b.invoice_number and a.status=2 and b.status=2";
	//if($_SESSION['comp_code_tmp'] <>""){$str .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";}  
	//$sql .=$str;
	$result_set = $Db->query($intel_invoice_sql);
        }
        
        // tax value matched
         
        $taxValue_sql="UPDATE `tbl_gstr_2_status2`  a , tbl_merged_gstr_2a b set a.status=4,a.gstintwoa=b.gstin,a.invoice_numbertwoa=b.invoice_number,a.igst_twoa=b.igst,a.sgst_twoa=b.sgst,a.cgst_twoa=b.cgst,a.total_tax_twoa=b.taxvalue,a.tax_difference=a.taxvalue-b.taxvalue,a.tax_value_status=case when a.taxvalue=b.taxvalue THEN 1 when ((a.taxvalue-b.taxvalue<=1 and a.taxvalue-b.taxvalue>= 0) OR (a.taxvalue-b.taxvalue <= 0 AND a.taxvalue-b.taxvalue >= -1)) then 2 WHEN (a.taxvalue-b.taxvalue < -1) then  3 WHEN (a.taxvalue-b.taxvalue)>1 THEN 4 END ,a.recon_id=b.id,b.recon_id=a.id,b.status=4,b.tax_value_status=a.tax_value_status WHERE  a.comp_code=b.comp_code and a.status=3 and b.status=3";
        
        $result_set = $Db->query($taxValue_sql);
        

        //tax code matced
       
        $taxcode_sql="UPDATE `tbl_gstr_2_status2` a , tbl_merged_gstr_2a b set a.gstintwoa=b.gstin,a.invoice_numbertwoa=b.invoice_number,a.igst_twoa=b.igst,a.sgst_twoa=b.sgst,a.cgst_twoa=b.cgst,a.total_tax_twoa=b.taxvalue,a.tax_difference=a.taxvalue-b.taxvalue,a.status=CASE WHEN a.igst_paid=b.igst then 5 when a.cgst_paid=b.cgst and a.sgst_paid=b.sgst then 5 ELSE 4 end,a.recon_id=b.id,b.recon_id=a.id,b.status=a.status WHERE  a.comp_code=b.comp_code and a.status=4 and b.status=4";
        
        $result_set = $Db->query($taxcode_sql);

        
        //GST NOT MATCHED and NOT FOUND 
        
        $sqlQuery="UPDATE `tbl_gstr_2_status2` a , tbl_merged_gstr_2a b set a.status=1,b.status=6 WHERE  a.comp_code=b.comp_code and a.status=0 and b.status=0";
        
        $result_set = $Db->query($sqlQuery);
       
        
       
       ?>              
      