
<div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           <?php


     if($_POST['company'])
     {
       $_SESSION['comp_code_tmp']=$_POST['company'];
       $_SESSION['dept_code_tmp'] = $_POST['dept'];
       $_SESSION["finyear"]=$_POST["finyear"];
       if($_SESSION["finyear"]!="all"){

       $nextyear=$_POST["finyear"]+1;

       $_SESSION["finyearcond"] = "  and ((finyear >= '" . $_POST["finyear"] . "' and finyear < '" . $nextyear . "' and finmon >=4)  or (finyear > '" . $_POST["finyear"] . "' and finyear <= '" . $nextyear . "' and finmon<4))";
       }
       header("Refresh:0");



       }
       if($_POST['Logout']=="logout")
       {
          unset($_SESSION["finyearcond"]);
          unset($_SESSION["finyear"]);
          unset($_SESSION['dept_code_tmp']);
          unset($_SESSION['comp_code_tmp']);
          unset($_SESSION['dept_code_tmp']);
	  unset($_SESSION['Year_Date_Tmp']);
          header("Refresh:0");
       }
       
       if($_POST['cron']=="Cron Off")
       {
         $updatequery="update tbl_company_recon_table_master set complete_flag='0' where comp_code='".$_SESSION['comp_code_tmp']."'";
           $Db->query($updatequery);

       }
       
       if($_POST['cron']=="Cron On")
       {
           $updatequery="update tbl_company_recon_table_master set complete_flag='1' where comp_code='".$_SESSION['comp_code_tmp']."'";
           $Db->query($updatequery);

       }
?>

        </div>
		<ul class="nav navbar-top-links navbar-left">
		<div style="margin-left:50px;"><h1><? echo $modulename; ?></h1> </div>

		</ul>
            <ul class="nav navbar-top-links navbar-right">

			<li>
                    <span class="m-r-sm text-muted welcome-message">
					 <form method="post" action="main_dashboard.php" >
 <? if($_SESSION['comp_code_tmp'] == ''){?>
	    <select name='company' id='company'  class="form-control" style="float:left;width:200px;" onchange="getdept(this.value)"><option value=''> Select company code </option><?=dropdown('tbl_company',$_POST['comp_code']," where group_code='".$_SESSION['group_code_tmp']."'");?></select>

      <span id="dept"></span>

     <select name='finyear'  class="form-control" style="float:left;width:200px;" required="true">
                                <option value="all">All Financial Year</option>
                                <?php
                                for($year=2017;$year<date("Y");$year++){
                                    $nextyear=$year+1;
                                echo "<option value='".$year."'>".$year."-".$nextyear."</option>";
                                }
                                ?>
                            </select>

            <input type="submit" name="Publish" value="Publish" class="btn btn-primary" class="form-control"  />
  	<? }
	else if($_SESSION['admin_user_tmp']>=1){
        $condition = " where company_code ='".$_SESSION['comp_code_tmp']."'";
        $finyears="";
        if(isset($_SESSION['finyear']) && $_SESSION['finyear']!='all'){
         $nextyear=$_SESSION['finyear']+1;
         $finyears=$_SESSION['finyear']."-".$nextyear;
         }
	echo "<strong>".getrecord('tbl_company','name',$condition)." ".$finyears."</strong>";
  $complete_flag=getrecord('tbl_company_recon_table_master','complete_flag', " where comp_code ='".$_SESSION['comp_code_tmp']."'");
  if($complete_flag==1){
    $crontext="Cron Off";
    $cronclass="btn btn-danger";
  }else{
    $crontext="Cron On";
    $cronclass="btn btn-warning";
  }

  $dept_count = getrecord("department", "count(id)", "where comp_code='" . $_SESSION['comp_code_tmp'] . "'");
              if ($_SESSION['admin_user_tmp'] >= 1 &&  $dept_count > 0) {

                echo '<select name="dept" id="dept" class="form-control" style="display:inline;width:200px;" onchange="setDeptCode(this.value)">';
                echo "<option value=''> Select department </option>";
                echo dropdown_q("select dept_code as id ,name as name  from department where comp_code='" . $_SESSION['comp_code_tmp'] . "'", $_SESSION["dept_code_tmp"]);
                echo "</select>";
              } else {
                $condition1 = " where dept_code ='" . $_SESSION['dept_code_tmp'] . "'";
                echo "<strong>  " . getrecord('department', 'name', $condition1) . "</strong>";
              }
            ?>
	
         <input type="submit" name="Logout" value="logout" class="btn btn-primary" />
         <input type="submit" name="cron" value="<?=$crontext?>" class="<?=$cronclass?>" />


	<? }else{
        $condition = " where company_code ='".$_SESSION['comp_code_tmp']."'";
	      echo "<strong>".getrecord('tbl_company','name',$condition)."</strong>";

        $condition1 = " where dept_code ='" . $_SESSION['dept_code_tmp'] . "'";
        echo "<strong> - " . getrecord('department', 'name', $condition1) . "</strong>";


            }?>


       </form></span>
                </li>
            </ul>

        </nav>
        </div>
        <script>
  function getdept(deptdata) {
    const data = {
      company_code: deptdata,
      mode: 'dept'
    }
    console.log(deptdata);
    $.ajax({


      url: 'includes/getdept_details.php',

      type: 'POST',

      //async : false,
      data,

      success: function(data) {
        //  if (data != "") {
        //  document.getElementById("deptcode").display = "block";
        $('#dept').html(data);
        // }

        // console.log(data);
        // $('#hsn_code').val(data);

      }

    });
  }

  function setDeptCode(dept_code) {

    const data = {
      dept_code: dept_code,
      mode: 'setdept'
    }
    $.ajax({


      url: 'includes/getdept_details.php',

      type: 'POST',

      //async : false,
      data,

      success: function(data) {
        //  if (data != "") {
        //  document.getElementById("deptcode").display = "block";
        //$('#dept').html(data);
        // }
        window.location = "main_dashboard.php";
        // console.log(data);
        // $('#hsn_code').val(data);

      }

    });

  }
</script>