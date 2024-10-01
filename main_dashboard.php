<? include "includes/config.php";
 include "includes/session_check.php";
 include "includes/header.php";
 include "includes/leftmenu.php";

 $condition = " where company_code='".$_SESSION['comp_code_tmp']."'";
 $condGrade = " where Grade_Id='".$_SESSION['Grade_Id_tmp']."'";
 //echo $_SESSION['Grade_Id_tmp'];
 ?>

        <div id="page-wrapper" class="gray-bg">
        <? include "includes/sub-header.php";?>

            <div class="wrapper wrapper-content">
        <div class="row">
                       

                        <?
                        
                        $bankreconFlag= getrecord('tbl_company','Bank_Recon_Module',$condition);
                        $bankreconMod= getrecord('tbl_grade_details','Bank_RECON_Module',$condGrade);

                       // if($bankreconFlag>=1 && $bankreconMod>=1){
	             ?>
					<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><a href="access.php?BankRecon=12"><font color="#FFFFFF">Go</font></a></span>
                                <h5>Related Party Transaction</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"></h1>
                                <small>Related Party Transaction</small>
                            </div>
                        </div>
                    </div>
                        <? // }
                       

                       
	             ?>
					
                       
           
         
                       


                </div>
           </div>
      <? include "includes/footer.php";?>

        </div>


        </div>
    </div>

</body>


</html>
