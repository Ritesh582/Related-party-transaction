<?php
$pagename = 'created_tbl_view.php';
include('includes/config.php');
pageAccess((int)$_SESSION['tmp_drisk']);
include "includes/session_check.php";
$showmsg = message($_GET['msg']);
$str = "";
$sql = "select * from tbl_created where 1 ";
if ($_SESSION['comp_code_tmp'] <> "") {
    $str .= " and comp_code = '" . $_SESSION['comp_code_tmp'] . "'";
}
if ($_SESSION['dept_code_tmp'] <> "") {
    $str .= " and dept_code = '" . $_SESSION['dept_code_tmp'] . "'";
}
$str .= " order by file_name asc";
$sql .= $str;
$result_set = $Db->query($sql);
include "includes/header.php";
include "includes/bank_recon_leftmenu.php";

if (strtoupper($_GET['mode']) == "DELETE") {
    $id = $_GET['id'];

    // Fetch the table name from tbl_created before deleting the entry
    $tableResult = $Db->query("SELECT table_name FROM tbl_created WHERE id = '$id'");
    $count=$Db->num_rows();
    if ($tableResult && $count > 0) {
        $tableRow = mysql_fetch_assoc($tableResult );
        $tableName = $tableRow['table_name'];

        // Drop the actual table from the database
        $dropQuery = "DROP TABLE IF EXISTS `$tableName`";
        $dropResult = $Db->query($dropQuery);
        if (!$dropResult) {
            die("Error dropping table: " . $Db->error);
        }
    }

    // Now delete the entry from tbl_created
    $q = $Db->query("DELETE FROM tbl_created WHERE id='$id'");
    if (!$q) {
        die("Error deleting record: " . $Db->error);
    }

    header("Location:created_tbl_view.php?msg=del");
    exit;
}
?>

<div id="page-wrapper" class="gray-bg">
    <? include "includes/sub-header.php"; ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Table Detail</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="main_dashboard.php">Home</a>
                </li>
                <li class="active">
                    <strong>Created Table Detail</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="form-group" style="float:right">
            <form method='post' action='export_created_table_xl.php' target=_blank>
                <div class="col-sm-2">
                    <input type='submit' class="btn btn-primary" value='Export To XL'>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List of Created Tables</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a></li>
                                <li><a href="#">Config option 2</a></li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <? if ($showmsg != "") {
                            $class = 'success';
                            if ($_GET['msg'] == 'ndel') {
                                $class = 'info';
                            }
                            echo "<p class='" . $class . "'>" . $showmsg . "<span>X</span></p>";
                        } ?>
                        <table class="table table-striped table-bordered table-hover dataTables-example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="15" align="center" scope="col"><b>ID</b></th>
                                    <th scope="col"><b>System Number</b></th>
                                    <th scope="col"><b>File Name</b></th>
                                   
                                    <th scope="col"><b>Table Name</b></th>
                                    <th scope="col"><b>Added By</b></th>
                                    <th scope="col"><b>Added Date</b></th>
                                    <th scope="col"><b>Updated By</b></th>
                                    <th scope="col"><b>Updated Date</b></th>
                                    <th scope="col"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? $i = 0;
                                while ($row = mysql_fetch_array($result_set)) {
                                    $i++; ?>
                                <tr>
                                    <td width="15" align="center"><?= $i; ?></td>
                                    <td><? echo $row['system_number']; ?></td>
                                    <td><? echo $row['file_name']; ?></td>
                                 
                                    <td><? echo $row['table_name']; ?></td>
                                    <td><?php $condition = " where admin_id ='" . $row['added_by'] . "'";
                                        echo getrecord('admin', 'name', $condition); ?></td>
                                    <td><? echo yymmdd_ddmmyy($row['added_date']); ?></td>
                                    <td><?php $condition = " where admin_id ='" . $row['updated_by'] . "'";
                                        echo getrecord('admin', 'name', $condition); ?></td>
                                    <td><? echo yymmdd_ddmmyy($row['updated_date']); ?></td>
                                    <td width="45" align="center">
                                        <!-- <a href='created_tbl_view.php?mode=edit&id=<?= $row['id']; ?>'><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                        <a href="#" onclick="deleterecord(<?= $row['id'] ?>,'created_tbl_view')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? include "includes/footer.php"; ?>
</div>
</div>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {
    $('.dataTables-example').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        }
    });
});
</script>
<style>
body.DTTT_Print {
    background: #67bdf9;
}

.DTTT_Print #page-wrapper {
    margin: 0;
    background: #67bdf9;
}

button.DTTT_button,
div.DTTT_button,
a.DTTT_button {
    border: 1px solid #e7eaec;
    background: #67bdf9;
    color: #676a6c;
    box-shadow: none;
    padding: 6px 8px;
}

button.DTTT_button:hover,
div.DTTT_button:hover,
a.DTTT_button:hover {
    border: 1px solid #d2d2d2;
    background: #337ab7;
    color: #676a6c;
    box-shadow: none;
    padding: 6px 8px;
}

.dataTables_filter label {
    margin-right: 5px;
}
</style>
</body>
</html>
