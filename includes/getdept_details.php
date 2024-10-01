<?php
include('config.php');

//print_r($_POST);

if ($_POST["mode"] == "dept") {

      $deptname = getrecord("department", "id", "where comp_code='" . $_POST['company_code'] . "'");


    if (!empty($deptname)) {
        echo '<select name="dept" id="dept" class="form-control" style="float:left;width:200px;">';
        echo "<option value=''> Select department </option>";
        echo dropdown_q("select dept_code as id ,name as name  from department where comp_code='" . $_POST['company_code'] . "'");
        echo "</select>";
    }
}


if ($_POST["mode"] == "setdept") {
    $_SESSION["dept_code_tmp"] = $_POST["dept_code"];
}