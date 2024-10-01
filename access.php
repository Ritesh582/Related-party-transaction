<?php
include ('includes/config.php');
include "includes/session_check.php";
$id=$_SESSION['Grade_Id_tmp'];

  $result= $Db->query("select * from tbl_grade_details where Grade_Id='".$id."'");
        $fetchGrade=mysql_fetch_object($result);
		$affected = $Db->num_rows();
        if($affected > 0){
         $_SESSION['PR_Module_TMP'] = (int) $fetchGrade->PR_Module ;
         $_SESSION['PQ_Module_TMP'] = (int) $fetchGrade->PQ_Module ;
         $_SESSION['PO_Module_TMP'] = (int) $fetchGrade->PO_Module ;
         $_SESSION['RM_Module_TMP'] = (int) $fetchGrade->RM_Module ;
         $_SESSION['VP_Module_TMP'] = (int) $fetchGrade->VP_Module ;
         $_SESSION['VM_Module_TMP'] = (int) $fetchGrade->VM_Module ;
		 $_SESSION['PSR_Module_TMP'] = (int) $fetchGrade->PSR_Module ;
		 $_SESSION['IC_Module_TMP'] = (int) $fetchGrade->IC_Module ;
		 $_SESSION['ISD_Module_TMP'] = (int) $fetchGrade->ISD_Module ;
         $_SESSION['IBI_Module_TMP'] = (int) $fetchGrade->IBI_Module ;
		 $_SESSION['AA_Module_TMP'] = (int) $fetchGrade->AA_Module ;
		 $_SESSION['RCM_Module_TMP'] = (int) $fetchGrade->RCM_Module ;
          }

    if((int)$_GET['PR']>=1){
        $prresult= $Db->query("select * from tbl_pr_module where Grade_Id='".$id."'");
        $fetchpr=mysql_fetch_object($prresult);
         $_SESSION['PR_ACTR_TMP'] = (int) $fetchpr->PR_ACTR ;
         $_SESSION['PR_BCTR_TMP'] = (int) $fetchpr->PR_BCTR ;
         $_SESSION['PR_CCTR_TMP'] = (int) $fetchpr->PR_CCTR ;
         $_SESSION['PR_DCTR_TMP'] = (int) $fetchpr->PR_DCTR ;
         $_SESSION['PR_ECTR_TMP'] = (int) $fetchpr->PR_ECTR ;
		 $_SESSION['PR_FCTR_TMP'] = (int) $fetchpr->PR_FCTR ;
		 $_SESSION['PR_GCTR_TMP'] = (int) $fetchpr->PR_GCTR ;
		 $_SESSION['PR_HCTR_TMP'] = (int) $fetchpr->PR_HCTR ;

		header("Location:pr_dashboard.php");
        exit;
    }
	if((int)$_GET['PQ']>=1){
        $prresult= $Db->query("select * from tbl_pq_module where Grade_Id='".$id."'");
        $fetchpr=mysql_fetch_object($prresult);
         $_SESSION['PQ_ACTR_TMP'] = (int) $fetchpr->PQ_ACTR ;
         $_SESSION['PQ_BCTR_TMP'] = (int) $fetchpr->PQ_BCTR ;
         $_SESSION['PQ_CCTR_TMP'] = (int) $fetchpr->PQ_CCTR ;
         $_SESSION['PQ_DCTR_TMP'] = (int) $fetchpr->PQ_DCTR ;
         $_SESSION['PQ_ECTR_TMP'] = (int) $fetchpr->PQ_ECTR ;
		 $_SESSION['PQ_FCTR_TMP'] = (int) $fetchpr->PQ_FCTR ;
		 $_SESSION['PQ_GCTR_TMP'] = (int) $fetchpr->PQ_GCTR ;
		 $_SESSION['PQ_HCTR_TMP'] = (int) $fetchpr->PQ_HCTR ;

		header("Location:pq_dashboard.php");
        exit;
    }
    if((int)$_GET['PO']>=1){
        $poresult= $Db->query("select * from tbl_po_module where Grade_Id='".$id."'");
        $fetchpo=mysql_fetch_object($poresult);
         $_SESSION['PO_ACTR_TMP'] = (int) $fetchpo->PO_ACTR ;
         $_SESSION['PO_BCTR_TMP'] = (int) $fetchpo->PO_BCTR ;
         $_SESSION['PO_CCTR_TMP'] = (int) $fetchpo->PO_CCTR ;
         $_SESSION['PO_DCTR_TMP'] = (int) $fetchpo->PO_DCTR ;
         $_SESSION['PO_ECTR_TMP'] = (int) $fetchpo->PO_ECTR ;
		 $_SESSION['PO_FCTR_TMP'] = (int) $fetchpo->PO_FCTR ;
		 $_SESSION['PO_GCTR_TMP'] = (int) $fetchpo->PO_GCTR ;
		 $_SESSION['PO_HCTR_TMP'] = (int) $fetchpo->PO_HCTR ;
		header("Location:po_dashboard.php");
        exit;
   }
     if((int)$_GET['RM']>=1){
        $rmresult= $Db->query("select * from tbl_rm_module where Grade_Id='".$id."'");
        $fetchrm=mysql_fetch_object($rmresult);
        $_SESSION['RM_ACTR_TMP'] = (int) $fetchrm->RM_ACTR ;
        $_SESSION['RM_BCTR_TMP'] = (int) $fetchrm->RM_BCTR ;
        $_SESSION['RM_CCTR_TMP'] = (int) $fetchrm->RM_CCTR ;
        $_SESSION['RM_DCTR_TMP'] = (int) $fetchrm->RM_DCTR ;
        $_SESSION['RM_ECTR_TMP'] = (int) $fetchrm->RM_ECTR ;
		$_SESSION['RM_FCTR_TMP'] = (int) $fetchrm->RM_FCTR ;
		$_SESSION['RM_GCTR_TMP'] = (int) $fetchrm->RM_GCTR ;
		$_SESSION['RM_HCTR_TMP'] = (int) $fetchrm->RM_HCTR ;
		header("Location:rm_dashboard.php");
        exit;
    }
    if((int)$_GET['VP']>=1){
       $vpresult= $Db->query("select * from tbl_vp_module where Grade_Id='".$id."'");
        $fetchvp=mysql_fetch_object($vpresult);
        $_SESSION['VP_ACTR_TMP']  = (int) $fetchvp->VP_ACTR ;
        $_SESSION['VP_BCTR_TMP']  = (int) $fetchvp->VP_BCTR ;
        $_SESSION['VP_CCTR_TMP']  = (int) $fetchvp->VP_CCTR ;
        $_SESSION['VP_DCTR_TMP']  = (int) $fetchvp->VP_DCTR ;
        $_SESSION['VP_ECTR_TMP']  = (int) $fetchvp->VP_ECTR ;
        $_SESSION['VP_FCTR_TMP']  = (int) $fetchvp->VP_FCTR ;
        $_SESSION['VP_GCTR_TMP']  = (int) $fetchvp->VP_GCTR ;
        $_SESSION['VP_HCTR_TMP']  = (int) $fetchvp->VP_HCTR ;
        header("Location:vp_dashboard.php");
        exit;
   }
     if((int)$_GET['VM']>=1){
        $vmresult= $Db->query("select * from tbl_vm_module where Grade_Id='".$id."'");
        $fetchvm=mysql_fetch_object($vmresult);
        $_SESSION['VM_ACTR_TMP']  = (int) $fetchvm->VM_ACTR ;
        $_SESSION['VM_BCTR_TMP']  = (int) $fetchvm->VM_BCTR ;
        $_SESSION['VM_CCTR_TMP']  = (int) $fetchvm->VM_CCTR ;
        $_SESSION['VM_DCTR_TMP']  = (int) $fetchvm->VM_DCTR ;
        $_SESSION['VM_ECTR_TMP']  = (int) $fetchvm->VM_ECTR ;
        $_SESSION['VM_FCTR_TMP']  = (int) $fetchvm->VM_FCTR ;
        $_SESSION['VM_GCTR_TMP']  = (int) $fetchvm->VM_GCTR ;
        $_SESSION['VM_HCTR_TMP']  = (int) $fetchvm->VM_HCTR ;
        header("Location:gst_dashboard.php");
        exit;
    }
    if((int)$_GET['PSR']>=1){
        $psrresult= $Db->query("select * from tbl_psr_module where Grade_Id='".$id."'");
        $fetchpsr=mysql_fetch_object($psrresult);
        $_SESSION['PSR_ACTR_TMP']  = (int) $fetchpsr->PSR_ACTR ;
        $_SESSION['PSR_BCTR_TMP']  = (int) $fetchpsr->PSR_BCTR ;
        $_SESSION['PSR_CCTR_TMP']  = (int) $fetchpsr->PSR_CCTR ;
        $_SESSION['PSR_DCTR_TMP']  = (int) $fetchpsr->PSR_DCTR ;
        $_SESSION['PSR_ECTR_TMP']  = (int) $fetchpsr->PSR_ECTR ;
		$_SESSION['PSR_FCTR_TMP']  = (int) $fetchpsr->PSR_FCTR ;
		$_SESSION['PSR_GCTR_TMP']  = (int) $fetchpsr->PSR_GCTR ;
		$_SESSION['PSR_HCTR_TMP']  = (int) $fetchpsr->PSR_HCTR ;
		header("Location:psr_dashboard.php");
        exit;
   }
     if((int)$_GET['IC']>=1){
       $icresult= $Db->query("select * from tbl_ic_module where Grade_Id='".$id."'");
        $fetchic=mysql_fetch_object($icresult);
        $_SESSION['IC_ACTR_TMP']  = (int) $fetchic->IC_ACTR ;
        $_SESSION['IC_BCTR_TMP']  = (int) $fetchic->IC_BCTR ;
        $_SESSION['IC_CCTR_TMP']  = (int) $fetchic->IC_CCTR ;
        $_SESSION['IC_DCTR_TMP']  = (int) $fetchic->IC_DCTR ;
        $_SESSION['IC_ECTR_TMP']  = (int) $fetchic->IC_ECTR ;
		$_SESSION['IC_FCTR_TMP']  = (int) $fetchic->IC_FCTR ;
		$_SESSION['IC_GCTR_TMP']  = (int) $fetchic->IC_GCTR ;
		$_SESSION['IC_HCTR_TMP']  = (int) $fetchic->IC_HCTR ;
		header("Location:imprest_cash_dashboard.php");
        exit;
    }
    if((int)$_GET['ISD']>=1){
        $isdresult= $Db->query("select * from tbl_isd_module where Grade_Id='".$id."'");
        $fetchisd=mysql_fetch_object($isdresult);
        $_SESSION['ISD_ACTR_TMP']  = (int) $fetchisd->ISD_ACTR ;
        $_SESSION['ISD_BCTR_TMP']  = (int) $fetchisd->ISD_BCTR ;
        $_SESSION['ISD_CCTR_TMP']  = (int) $fetchisd->ISD_CCTR ;
        $_SESSION['ISD_DCTR_TMP']  = (int) $fetchisd->ISD_DCTR ;
        $_SESSION['ISD_ECTR_TMP']  = (int) $fetchisd->ISD_ECTR ;
		$_SESSION['ISD_FCTR_TMP']  = (int) $fetchisd->ISD_FCTR ;
		$_SESSION['ISD_GCTR_TMP']  = (int) $fetchisd->ISD_GCTR ;
		$_SESSION['ISD_HCTR_TMP']  = (int) $fetchisd->ISD_HCTR ;
		header("Location:isd_dashboard.php");
        exit;
   }

     if((int)$_GET['IBI']>=1){
        $ibiresult= $Db->query("select * from tbl_ibi_module where Grade_Id='".$id."'");
        $fetchibi=mysql_fetch_object($ibiresult);
        $_SESSION['IBI_ACTR_TMP']  = (int) $fetchibi->IBI_ACTR ;
        $_SESSION['IBI_BCTR_TMP']  = (int) $fetchibi->IBI_BCTR ;
        $_SESSION['IBI_CCTR_TMP']  = (int) $fetchibi->IBI_CCTR ;
        $_SESSION['IBI_DCTR_TMP']  = (int) $fetchibi->IBI_DCTR ;
        $_SESSION['IBI_ECTR_TMP']  = (int) $fetchibi->IBI_ECTR ;
		$_SESSION['IBI_FCTR_TMP']  = (int) $fetchibi->IBI_FCTR ;
		$_SESSION['IBI_GCTR_TMP']  = (int) $fetchibi->IBI_GCTR ;
		$_SESSION['IBI_HCTR_TMP']  = (int) $fetchibi->IBI_HCTR ;
		header("Location:ibi_dashboard.php");
        exit;
    }
    if((int)$_GET['AA']>=1){
        $aaresult= $Db->query("select * from tbl_aa_module where Grade_Id='".$id."'");
        $fetchaa=mysql_fetch_object($aaresult);

        $_SESSION['AA_ACTR_TMP']  = (int) $fetchaa->AA_ACTR ;
        $_SESSION['AA_BCTR_TMP']  = (int) $fetchaa->AA_BCTR ;
        $_SESSION['AA_CCTR_TMP']  = (int) $fetchaa->AA_CCTR ;
        $_SESSION['AA_DCTR_TMP']  = (int) $fetchaa->AA_DCTR ;
        $_SESSION['AA_ECTR_TMP']  = (int) $fetchaa->AA_ECTR ;
		$_SESSION['AA_FCTR_TMP']  = (int) $fetchaa->AA_FCTR ;
		$_SESSION['AA_GCTR_TMP']  = (int) $fetchaa->AA_GCTR ;
		$_SESSION['AA_HCTR_TMP']  = (int) $fetchaa->AA_HCTR ;
		header("Location:aa_dashboard.php");
        exit;
   }
     if((int)$_GET['RCM']>=1){
        $rcmresult= $Db->query("select * from tbl_rcm_module where Grade_Id='".$id."'");
        $fetchrcm=mysql_fetch_object($rcmresult);

        $_SESSION['RCM_ACTR_TMP']  = (int) $fetchrcm->RCM_ACTR ;
        $_SESSION['RCM_BCTR_TMP']  = (int) $fetchrcm->RCM_BCTR ;
        $_SESSION['RCM_CCTR_TMP']  = (int) $fetchrcm->RCM_CCTR ;
        $_SESSION['RCM_DCTR_TMP']  = (int) $fetchrcm->RCM_DCTR ;
        $_SESSION['RCM_ECTR_TMP']  = (int) $fetchrcm->RCM_ECTR ;
		$_SESSION['RCM_FCTR_TMP']  = (int) $fetchrcm->RCM_FCTR ;
		$_SESSION['RCM_GCTR_TMP']  = (int) $fetchrcm->RCM_GCTR ;
		$_SESSION['RCM_HCTR_TMP']  = (int) $fetchrcm->RCM_HCTR ;
		header("Location:rcm_dashboard.php");
        exit;
    }

    if((int)$_GET['Recon']>=1){
        $reconresult= $Db->query("select * from tbl_recon_module where Grade_Id='".$id."'");
        $fetchrecon=mysql_fetch_object($reconresult);

        $_SESSION['Recon_ACTR_TMP']  = (int) $fetchrecon->Recon_ACTR ;
        $_SESSION['Recon_BCTR_TMP']  = (int) $fetchrecon->Recon_BCTR ;
        $_SESSION['Recon_CCTR_TMP']  = (int) $fetchrecon->Recon_CCTR ;
        $_SESSION['Recon_DCTR_TMP']  = (int) $fetchrecon->Recon_DCTR ;
        $_SESSION['Recon_ECTR_TMP']  = (int) $fetchrecon->Recon_ECTR ;
		$_SESSION['Recon_FCTR_TMP']  = (int) $fetchrecon->Recon_FCTR ;
		$_SESSION['Recon_GCTR_TMP']  = (int) $fetchrecon->Recon_GCTR ;
        $_SESSION['Recon_HCTR_TMP']  = (int) $fetchrecon->Recon_HCTR ;
        $_SESSION['RECON_BOOK']  = (int) $fetchrecon->RECON_BOOK ;
        $_SESSION['RECON_ITC']  = (int) $fetchrecon->RECON_ITC ;
        $_SESSION['RECON_UPLOAD']  = (int) $fetchrecon->RECON_UPLOAD ;
        $_SESSION['RECON_PROCESS']  = (int) $fetchrecon->RECON_PROCESS ;
        $_SESSION['RECON_MANUAL']  = (int) $fetchrecon->RECON_MANUAL ;
        $_SESSION['RECON_OVERVIEW']  = (int) $fetchrecon->RECON_OVERVIEW ;
        $_SESSION['RECON_VENDOR']  = (int) $fetchrecon->RECON_VENDOR ;
        $_SESSION['RECON_EMAIL']  = (int) $fetchrecon->RECON_EMAIL ;
        $_SESSION['RECON_STATEWISE']  = (int) $fetchrecon->RECON_STATEWISE ;
        
        include("recon_table_master.php");
      //  header("location:finyearlogin.php");
        header("Location:recon_dashboard.php");
        exit;
    }

    if((int)$_GET['tds']>=1){
        $sql3a = "SELECT * FROM tbl_tds_threshold WHERE comp_code='".$_SESSION["comp_code_tmp"]."'";
 $sql3a = $sql3a.$cnd1;
$result3a = $Db->query($sql3a);
$row = mysql_fetch_array($result3a);
if(count($row)>0 && $row[0]!=""){

                      header("Location:tds_dashboard.php");
}else{
        header("Location:threshold.php");
}
        exit;
    }

    if((int)$_GET['BankRecon']>=1){
        $reconresult= $Db->query("select * from tbl_bank_recon_module where Grade_Id='".$id."'");
        $fetchrecon=mysql_fetch_object($reconresult);

        $_SESSION['BANK_STATEMENT']  = (int) $fetchrecon->BANK_STATEMENT ;
        $_SESSION['EXPANDING']  = (int) $fetchrecon->EXPANDING ;
        $_SESSION['COMPANY_BOOKS']  = (int) $fetchrecon->COMPANY_BOOKS ;
        $_SESSION['APPROVE_STATEMENTS']  = (int) $fetchrecon->APPROVE_STATEMENTS;
        $_SESSION['PROCESS']  = (int) $fetchrecon->PROCESS;
	$_SESSION['MANUAL_MATCH']  = (int) $fetchrecon->MANUAL_MATCH ;
	$_SESSION['OVERVIEW']  = (int) $fetchrecon->OVERVIEW ;
	$_SESSION['VIEW_PROCESS']  = (int) $fetchrecon->VIEW_PROCESS ;
        header("Location:bank_recon_dashboard.php");
        exit;
    }
    if((int)$_GET['GstrI']>=1){
        /*$reconresult= $Db->query("select * from tbl_bank_recon_module where Grade_Id='".$id."'");
        $fetchrecon=mysql_fetch_object($reconresult);

        $_SESSION['BANK_STATEMENT']  = (int) $fetchrecon->BANK_STATEMENT ;
        $_SESSION['EXPANDING']  = (int) $fetchrecon->EXPANDING ;
        $_SESSION['COMPANY_BOOKS']  = (int) $fetchrecon->COMPANY_BOOKS ;
        $_SESSION['APPROVE_STATEMENTS']  = (int) $fetchrecon->APPROVE_STATEMENTS;
        $_SESSION['PROCESS']  = (int) $fetchrecon->PROCESS;
	$_SESSION['MANUAL_MATCH']  = (int) $fetchrecon->MANUAL_MATCH ;
	$_SESSION['OVERVIEW']  = (int) $fetchrecon->OVERVIEW ;
	$_SESSION['VIEW_PROCESS']  = (int) $fetchrecon->VIEW_PROCESS ;*/
        header("Location:gstr_i_dashboard.php");
        exit;
    }
    if((int)$_GET['bni']>=1){
      echo "bni";
        /*$reconresult= $Db->query("select * from tbl_bank_recon_module where Grade_Id='".$id."'");
        $fetchrecon=mysql_fetch_object($reconresult);

        $_SESSION['BANK_STATEMENT']  = (int) $fetchrecon->BANK_STATEMENT ;
        $_SESSION['EXPANDING']  = (int) $fetchrecon->EXPANDING ;
        $_SESSION['COMPANY_BOOKS']  = (int) $fetchrecon->COMPANY_BOOKS ;
        $_SESSION['APPROVE_STATEMENTS']  = (int) $fetchrecon->APPROVE_STATEMENTS;
        $_SESSION['PROCESS']  = (int) $fetchrecon->PROCESS;
	$_SESSION['MANUAL_MATCH']  = (int) $fetchrecon->MANUAL_MATCH ;
	$_SESSION['OVERVIEW']  = (int) $fetchrecon->OVERVIEW ;
	$_SESSION['VIEW_PROCESS']  = (int) $fetchrecon->VIEW_PROCESS ;*/
        header("Location:magic_dashboard.php");
        exit;
    }
?>
