<?php
session_start();
$pagename = 'upload_bulk_oracle.php';
include('includes/config.php');
include "includes/session_check.php";
include "includes/header.php";
include "includes/bank_recon_leftmenu.php";
$Time =  date("Y-m-d H:i:s");
$err_msg = '';
$areNos = "";

//echo $_SESSION['branch_code_tmp'];
//////////********* IF CHECKING FOR FILE IS UPLOADED FOR SUBMIT STARTS HERE *******///////////
if (isset($_FILES['bank_statement_excel_file']['name'])) {

    /////////*********IF CHECKING FOR FILE UPLOAD TEXTBOX  IS NOT EMPTY STARTS HERE *******///////////
    if ((!empty($_FILES["bank_statement_excel_file"]["name"])) && ($_FILES["bank_statement_excel_file"]['error'] == 0)) {
        //$file=$_FILES['txtvendor_excel_file']['name'];
        //echo $file.'<br>';
        $file_tmp_name = $_FILES['bank_statement_excel_file']['tmp_name'];
        //echo $file_tmp_name.'<br>';
        $filename = basename($_FILES["bank_statement_excel_file"]['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);
        //echo "<br>FILE EXTENSION : " . $ext . "<br>";
        //////***** IF Checking for csv Format STARTS HERE *******///////
        if ($ext == 'csv') {
            $handle = @fopen($file_tmp_name, 'r');
            $data = @fgetcsv($handle, 3000, ',', '"');

            // echo "ROWS COUNT : " . count($data) . "<br>";
            //echo "DATA : " . $data[0] . "<br>";
            //echo "DATA : " . implode(",",$data). "<br>";
            //////***** IF Checking for total column count is exactly 9 columns STARTS HERE *******///////
            if ($_POST['type'] == 'append') {

                if (count($data) == "1") {


                    // $genid= getrecord("tbl_bank_bank_statement","max(lastid)","where comp_code='".$_SESSION["comp_code_tmp"]."' and bank_code='".$bankcode."'");

                    while (($data = @fgetcsv($handle, 3000, ',', '"')) != FALSE) {



                        $account_oracle = addslashes($data[0]);
                        // $TimeStamp = date("Y-m-d H:i:s", strtotime(addslashes($data[6])));


                        $added_date = $today;
                        
                        //////***** IF $data check for empty row-column data STARTS HERE *******///////

                        $insert_bank_statement = "INSERT INTO tbl_account_oracle_master(account_oracle,comp_code,added_by,added_date) VALUES ('$account_oracle','" . $_SESSION['comp_code_tmp'] . "','" . $_SESSION['admin_user_tmp'] . "','" . $added_date . "')";
                        // echo $insert_bank_statement;
                        // echo "<br/><br/>".$insert_bank_statement;
                        $res_query = mysql_query($insert_bank_statement);

                        if ($res_query == 1) {
                            $insert_counter++;
                        }
                    } //WHILE LOOP ENDS HERE


                    //echo "Total New Records Inserts : " . $insert_counter . "<br/>";

                    //echo "<br><br><br>";
                    echo "<script language='javascript'>document.getElementById('progBar').style.display='none'</script>";
                    echo "<script language='javascript'>document.getElementById('div_error_msg').style.display='none'</script>";
                }
            } else {

                $err_msg = "Error : Uploaded File is not complete missing required column.";
                //echo "Error : Upload File in 'csv' extension & fromat only with comma delimiter only.<br><br>";
            } //////***** IF ELSE Checking for total column count is exactly 9 columns STARTS HERE *******///////
        } //////***** IF Checking for csv Format ENDS HERE *******///////
        else {
            $err_msg = "Error : Upload File in 'csv' extension & fromat only with comma delimiter only.";
            //echo "Error : Upload File in 'csv' extension & fromat only with comma delimiter only.<br><br>";
        } //********* IF CHECKING FOR FILE IS UPLOADED FOR SUBMIT ENDS HERE *******///////////


        //include "db_upload.php";


    } else {
        $err_msg = "Error: No file Uploaded.";
        //echo "Error: No file Uploaded<br><br>";
    } /////////*********IF ELSE CHECKING FOR FILE UPLOAD TEXTBOX  IS NOT EMPTY ENDS HERE *******///////////
}
//////////********* IF CHECKING FOR FILE IS UPLOADED FOR SUBMIT ENDS HERE *******///////////
?>
<script language="javascript">
    function validate() {
        if (document.form_bank_statement_excel_upload.bank_statement_excel_file.value == "") {
            document.getElementById('progBar').style.display = 'none';
            alert('Please Select File to Upload');
            document.form_bank_statement_excel_upload.bank_statement_excel_file.focus();
            return false;
        }
        document.getElementById('progBar').style.display = 'block';
        return true;
    }
</script>

<div id="page-wrapper" class="gray-bg">
    <? include "includes/sub-header.php"; ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Bulk upload account oracle</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="bank_recon_dashboard.php">Home</a>
                </li>
                <li class="active">
                    <strong>Bulk upload account oracle</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Bulk upload account oracle Entries</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <?
                            if ($insert_counter)
                                echo "Total New Record Inserts : " . $insert_counter . "<br/>"; ?>
                            <table align="center" border="0">

                                <tr>
                                    <td colspan="4"><strong>
                                            <font size="4">Instruction for Bulk upload account oracle File Upload</font>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><strong>1. Excel File should be in .csv format only.</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><strong>2. Column Names Required in the sequence of csv file.</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center">
                                        <font color="#FF0000" size="2">Column name cannot be empty</font>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center">
                                        <font color="#FF0000" size="2"><?php if ($err_msg != '') echo $err_msg; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">Append format</td>

                                </tr>
                                <tr>
                                    <td align="center"><a href="docs_download/Icic_Consolidated_upload_csv.csv" target="_blank"><img src="img/CSV-42x42.jpg" alt="Click to download Bank Statement Upload File Format" title="Click to download Bank Statement Upload File Format" /></a></td>


                                </tr>
                            </table>
                            <form name="form_bank_statement_excel_upload" method="post" action="upload_bulk_oracle.php" enctype="multipart/form-data">
                                <div style="display:none" id="progBar"><img src="img/progressbar.gif" /></div>
                                <table align="center" border="0">

                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="right">Select Type:&nbsp;&nbsp;</td>
                                        <td><input type="radio" name="type" value="append" checked="true" />Append&nbsp;&nbsp;</td>
                                        <td></td>
                                        <td>&nbsp;&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Select Month :</b></td>
                                        <td><input type="text" name="date" id='exp_date' autocomplete="off" class="form-control" style="display:inline-block" value="<?= $exp_date ?>"></td>
                                    </tr>
                                    <!-- <tr style="text-align:center">
                                        <td colspan="3">Append: <input type="radio" name="overwrite" value="append" checked="checked"/>&nbsp;&nbsp;&nbsp;&nbsp;Overwrite: <input type="radio" name="overwrite" value="overwrite"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </tr> -->
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Select File to Upload :</b></td>
                                        <td align="center">
                                            <input type="file" name="bank_statement_excel_file" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center">
                                            <input type="submit" name="btn_fileupload" value="Upload" onclick="document.getElementById('progBar').style.display = 'block'" style="vertical-align:bottom" /> <input name="cmdSubmit" value="Back" class="submitbutton" type="button" onClick="history.go(-1);">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                        </td>
                                    </tr>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#exp_date").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,

            });
        });
    </script>
    <?php include "includes/footer.php"; ?>
</div>

</div>