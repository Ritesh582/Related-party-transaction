<?php
include "includes/config.php";
pageAccess((int)$_SESSION['tmp_drisk']);
include "includes/session_check.php";
$comp_code =  $_SESSION['comp_code_tmp'];

if (strtoupper($_GET['mode']) == "ADD") {
    $mode = "save";
    include "department_layout.php";
    exit;
}

if (strtoupper($_GET['mode']) == "ADDS") {
    $mode = "saveall";
    include "department_Year_layout.php";
    exit;
}

if (strtoupper($_GET['mode']) == "DELETE") {
    $id = $_GET['id'];

    $qPrev = $Db->query("select CONCAT_WS('#~#',name,cperson,cnumber,cemail_id,dept_code,baddress,rboFlag) as strPrev from department where id=" . $id);
    $ft = mysql_fetch_object($qPrev);
    $strPrev = $ft->strPrev;
    $q = $Db->query("delete from department where id='" . $id . "'");
    if ($Db->affected_rows() > 0) {
        $Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('department','$strPrev','d','" . $_SESSION['user_id_tmp'] . "','$today')");
        header("Location:department_search.php?msg=del");
        exit;
    }
    header("Location:department_search.php?msg=ndel");
    exit;
}
if (strtoupper($_GET['mode']) == "DELETES") {
    $id = $_GET['id'];
    $qPrev = $Db->query("select CONCAT_WS('#~#',id,dept_id,code,rboFlag,FormDate,ToDate) as strPrev from tbl_deptcode where id=" . $id);
    $ft = mysql_fetch_object($qPrev);
    $strPrev = $ft->strPrev;
    $q = $Db->query("delete from tbl_deptcode where id='" . $id . "'");
    if ($Db->affected_rows() > 0) {
        $Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_deptcode','$strPrev','d','" . $_SESSION['user_id_tmp'] . "','$today')");
        header("Location:department_year_search.php?msg=del");
        exit;
    }
    header("Location:department_year_search.php?msg=ndel");
    exit;
}

if (strtoupper($_GET['mode']) == "EDIT") {
    $id = $_GET['id'];
    $errmsg = message($_GET['msg']);
    $res = $Db->query("select * from department  where id='" . $id . "'");
    $fetch = mysql_fetch_object($res);
    $id = $fetch->id;
    $name = $fetch->name;
    $baddress = $fetch->baddress;
    $btel = $fetch->btel;
    $email_id = $fetch->email_id;
    $cemail_id = $fetch->cemail_id;
    $cperson = $fetch->cperson;
    $cnumber = $fetch->cnumber;
    $dept_code = $fetch->dept_code;
    $rboFlag = $fetch->rboFlag;
    $termcondition = $fetch->term_condition;
    $mode = "update";
    include "department_layout.php";
    exit;
}
print_r($_POST);
if (strtoupper($_POST['mode']) == "UPDATE") {
    $id = $_POST['id'];
    $cperson = $_POST['cperson'];
    $cnumber = $_POST['cnumber'];
    $cemail_id = $_POST['cemail_id'];
    $name = $_POST['name'];
    $email_id = addslashes($_POST['email_id']);
    $baddress = addslashes($_POST['baddress']);
    $btel = $_POST['btel'];
    $dept_code = $_POST['dept_code'];
    $termcondition = $_POST['term_condition'];

    $rboFlag = (int)$_POST['rboFlag'];
    $qPrev = $Db->query("select CONCAT_WS('#~#',name,cperson,cnumber,cemail_id,dept_code,baddress,rboFlag) as strPrev from department where id=" . $id);
    $ft = mysql_fetch_object($qPrev);
    $strPrev = $ft->strPrev;

    //$deptcode = getrecord("department", "dept_code", "where comp_code = '$comp_code'");

    //if (strtoupper($deptcode) != strtoupper($dept_code)) {

    $res = $Db->query("update department set name='" . $name . "',baddress='$baddress',btel='$btel',cemail_id='$cemail_id',email_id='$email_id',cnumber='$cnumber',cperson='$cperson',rboFlag='$rboFlag',term_condition='$termcondition',comp_code = '$comp_code' where id=" . $id);

    if ($Db->affected_rows() > 0) {
        $Db->query("update department set updated_by='" . $_SESSION['user_id_tmp'] . "',updated_date='$today' where id=" . $id);
        $Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('department','$strPrev','u','" . $_SESSION['user_id_tmp'] . "','$today')");
    }
    header("Location:department_search.php?msg=upd");
    //} else {
    //  header("Location:department_search.php?msg=depterror");
    //}
    exit;
}

if (strtoupper($_GET['mode']) == "EDITS") {
    $id = $_GET['id'];
    $errmsg = message($_GET['msg']);
    $res = $Db->query("select * from tbl_deptcode  where id='" . $id . "'");
    $fetch = mysql_fetch_object($res);
    $id = $fetch->id;
    $dept_id = $fetch->dept_id;
    $code = $fetch->code;
    $formDate = $fetch->FormDate;
    $toDate = $fetch->ToDate;
    $termcondition = $fetch->term_condition;
    $formDate = date("d/m/Y", strtotime($formDate));
    $toDate = date("d/m/Y", strtotime($toDate));
    $mode = "updates";
    include "department_Year_layout.php";
    exit;
}
if (strtoupper($_POST['mode']) == "UPDATES") {
    $id = $_POST['id'];
    $dept_id = $_POST['dept_id'];
    $code = $_POST['code'];
    $formDate = ddmmyy_yymmdd($_POST['formDate']);
    $toDate = ddmmyy_yymmdd($_POST['toDate']);

    $qPrev = $Db->query("select CONCAT_WS('#~#',id,dept_id,code,FormDate,ToDate) as strPrev from tbl_deptcode where id=" . $id);
    $ft = mysql_fetch_object($qPrev);
    $strPrev = $ft->strPrev;
    $res = $Db->query("update tbl_deptcode set dept_id='" . $dept_id . "',code='$code',FormDate='$formDate',ToDate='$toDate', comp_code ='$comp_code' where id=" . $id);

    if ($Db->affected_rows() > 0) {
        $Db->query("update tbl_deptcode set updated_by='" . $_SESSION['user_id_tmp'] . "',updated_date='$today' where id=" . $id);
        $Db->query("insert into tbl_master_history(tname,utext,process,updated_by,updated_date)value('tbl_deptcode','$strPrev','u','" . $_SESSION['user_id_tmp'] . "','$today')");
    }
    header("Location:department_year_search.php?msg=upd");
    exit;
}
if (strtoupper($_POST['mode']) == "SAVE") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cemail_id = $_POST['cemail_id'];
    $cperson = $_POST['cperson'];
    $cnumber = $_POST['cnumber'];
    $email_id = addslashes($_POST['email_id']);
    $baddress = addslashes($_POST['baddress']);
    $btel = $_POST['btel'];
    $dept_code = $_POST['dept_code'];
    $branch_code = $_POST['branch_code'];
    $termcondition = $_POST['term_condition'];
    $rboFlag = (int)$_POST['rboFlag'];

    $deptcode = getrecord("department", "dept_code", "where comp_code = '$comp_code'");

    if (strtoupper($deptcode) != strtoupper($dept_code)) {
        echo  $query = "insert into department(name,baddress,btel,email_id,cperson,cnumber,cemail_id,rboFlag,dept_code,term_condition,comp_code,added_by,added_date)values('$name','$baddress','$btel','$email_id','$cperson','$cnumber','$cemail_id','$rboFlag','$dept_code','$termcondition','$comp_code','" . $_SESSION['user_id_tmp'] . "','$today')";
        $insert = $Db->query($query);

        header("Location:department_search.php?msg=add");
    } else {
        header("Location:department_search.php?msg=depterror");
    }
    exit;
}
if (strtoupper($_POST['mode']) == "SAVEALL") {
    $dept_id = $_POST['dept_id'];
    $code = $_POST['code'];
    $formDate = ddmmyy_yymmdd($_POST['formDate']);
    $toDate = ddmmyy_yymmdd($_POST['toDate']);
    $comp_code = $_POST['comp_code'];
    $result = $Db->query("select max(id) as id from tbl_deptcode");
    $ft = mysql_fetch_object($result);
    $ids = $ft->id;
    $id = $ids + 1;
    $results = $Db->query("select * from tbl_deptcode  where dept_id='" . $dept_id . "' and code!='" . $code . "' and toDate>='" . $formDate . "'");
    $count = mysql_num_rows($results);
    if ($count <= 0) {
        $query = "insert into tbl_deptcode(id,dept_id,code,formDate,toDate,added_by,added_date,comp_code)values('$id','$dept_id','$code','$formDate','$toDate','" . $_SESSION['user_id_tmp'] . "','$today','$comp_code')";
        $insert = $Db->query($query);
        // $q = $Db->query("update  tbl_deptCode set toDate='".$toDate."' where code='".$code."'");

        header("Location:department_year_search.php?msg=add");
        exit;
    } else {
        header("Location:department_year_search.php?msg=nadd");
    }
    exit;
}