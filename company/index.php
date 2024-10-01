<?php
include ('../includes/config.php');
session_regenerate_id();
//if($_SESSION['user_id_tmp'] <> ""){header("location: dashboard.php");exit;}
$_SESSION["previousURL"] = $_SERVER["REQUEST_URI"]; //Added on 15-SEP-2017, Pratik. To re-direct to this page after change password.

if ((int) $_SESSION['user_id_tmp'] > 0 && FL_PATH == $_SESSION['folder_tmp']) {
    header("Location:../main_dashboard.php");
    exit;
}
$showmsg = "";
if ($_GET['err'] == 1)
    $showmsg = "<b>Invalid User Name or Password!</b>";
if ($_GET['err'] == 'out')
    $showmsg = "<b>You have successfully logged out!</b>";
if ($_GET['err'] == 'access')
    $showmsg = "<b>Access denied for " . TIME_PERIOD . " day</b>";
if ($_GET['err'] == 2)
        $showmsg = "<b>Your accout login from another device!</b>";

//$showmsg = "<b>Gst 2a Currently down for maintenance.</b>";

if ($_POST['action'] == 'login_process' && $_POST['Username'] != '' && $_POST['Password'] != '') {
    $user = $_POST['Username'];
    $pwd = $_POST['Password'];
    $comp_code = $_POST['comp_code'];
//$comp_code=69;
    $result = confirmIPAddress($user);
    if ($result == 1) {
        header("location: index.php?err=access");
        exit;
    } else {
        $query = "SELECT * FROM admin WHERE username = '" . $user . "' AND password=AES_ENCRYPT('" . $pwd . "','" . SECURE_KEY . "') and comp_code='" . $comp_code . "' and comp_code!='' and status=1 and compstatus=1";


        $results = $Db->query($query);
        $exist = mysql_fetch_array($results);
        $affected = $Db->num_rows();
        if ($affected > 0) {
            session_start();
            $_SESSION['user_id_tmp1'] = $exist['admin_id'];

            $_SESSION['username_tmp'] = $user;
            $_SESSION['pwd_tmp'] = $pwd;

            $now = date('Y-m-d');   // or your date as well
            $activationdate = $exist['activationdate'];
            $daydiff = floor((abs(strtotime($now) - strtotime($activationdate)) / (60 * 60 * 24)));
            if ($daydiff > 40 && $daydiff < 45) {
                $_SESSION['days_tmp'] = "<b>Your Password is " . $daydiff . " days old Please Change Password</b>";
            }
            if ($daydiff >= 45 || $exist['activation'] == 0) {
                header("location:../change_passwords.php");
                exit;
            }
            $ipaddress = getRealIpAddr();
            $_SESSION[session_ip] = $ipaddress;

            $_SESSION['user_id_tmp'] = $exist['admin_id'];
            $_SESSION['admin_user_tmp'] = $exist['admin_user'];

            $query_loghis = "insert into login_history (`user_id`,`ipaddress`,`macaddress`,`comp_code`) values ('" . $_SESSION['user_id_tmp'] . "' , '$ipaddress', '$macaddress','$comp_code')";
            $query_insert = $Db->query($query_loghis);

            $_SESSION['tmp_rm'] = $exist['rm'];
            $_SESSION['dept_code_tmp'] = ''; //$exist['dept_code'];
            $_SESSION['dept_code_id_tmp'] = $exist['dept_code'];
            $_SESSION['branch_code_tmp'] = $exist['branch_code'];
            $_SESSION['heairachy_id'] = $exist['heairachy_id'];
            $_SESSION['heairachy_details_id'] = $exist['heairachy_details_id'];
            $_SESSION['comp_code_tmp'] = $exist['comp_code'];
            $_SESSION['utype_tmp'] = $exist['utype'];

            $_SESSION['tmp_appr'] = $exist['appr'];
            $_SESSION['tmp_rappr'] = $exist['rappr'];
            $_SESSION['tmp_usr'] = $exist['usr'];
            $_SESSION['tmp_mst'] = $exist['mst'];
            $_SESSION['tmp_rpt'] = $exist['rpt'];

            $_SESSION['tmp_arisk'] = $exist['arisk'];
            $_SESSION['tmp_crisk'] = $exist['crisk'];
            $_SESSION['tmp_drisk'] = $exist['drisk'];
            $_SESSION['tmp_erisk'] = $exist['erisk'];

            $_SESSION['tmp_actrl'] = $exist['actrl'];
            $_SESSION['tmp_ectrl'] = $exist['ectrl'];
            $_SESSION['tmp_tlink'] = $exist['tlink'];
            $_SESSION['Grade_Id_tmp'] = $exist['gradeId'];

            $condition = " WHERE dept_code='" . $_SESSION['dept_code_tmp'] . "' AND comp_code='" . $_SESSION['comp_code_tmp'] . "'";
            $deptid = getrecord('department', 'id', $condition);
            $_SESSION['user_deptid'] = $deptid;

            ### Added on 26-AUG-2017, Pratik. For Displaying Branch / Zone name by Default in "Invoice Upload" file Starts Here ###
            $res = $Db->query("select * from tbl_heariachy_master WHERE id='" . $_SESSION['heairachy_id'] . "'");
            $fetch = mysql_fetch_object($res);
            //$heairachy_name = $fetch->name;
            //if (!empty($heairachy_name))
              //  $_SESSION['heairachy_name'] = $heairachy_name;
            //else
              //  $_SESSION['heairachy_name'] = '';
            //$res=$Db->query("select * from tbl_heariachy_details WHERE id='".$_SESSION['branch_code']."'");
            //$res=$Db->query("select * from tbl_heariachy_details WHERE id='".$_SESSION['heairachy_details_id']."'");//Commented on 16-SEP-2017, Pratik. Currently Not Using it. Now values will be coming from tbl_branch / tbl_zone / tbl_hod
            //Commented on 16-SEP-2017, Pratik. Currently Not Using it. Now values will be coming from tbl_branch / tbl_zone / tbl_hod
            ### Added on 16-SEP-2017, Pratik. To Fetch Branch, Zone, Hod Department Names Starts Here ###
            /*if ($_SESSION['heairachy_id'] == 1)
                $sql_subhrnm = "SELECT * FROM tbl_hod WHERE hod_code='" . $_SESSION['branch_code_tmp'] . "'";
            elseif ($_SESSION['heairachy_id'] == 2)
                $sql_subhrnm = "SELECT * FROM tbl_zone WHERE zone_code='" . $_SESSION['branch_code_tmp'] . "'";
            elseif ($_SESSION['heairachy_id'] == 3)
                $sql_subhrnm = "SELECT * FROM tbl_branch WHERE branch_code='" . $_SESSION['branch_code_tmp'] . "'";*/
            ### To Fetch Branch, Zone, Hod Department Names Ends Here ###
          //  $res = $Db->query($sql_subhrnm);
           // $fetch = mysql_fetch_object($res);
           // $sub_heairachy_name = $fetch->name;
           // if (!empty($heairachy_name))
           //     $_SESSION['sub_heairachy_name'] = $sub_heairachy_name;
           // else
             //   $_SESSION['sub_heairachy_name'] = '';
            ### For Displaying Branch / Zone name by Default in "Invoice Upload" file Ends Here ###
            //$sub_deptid_condition = " WHERE dept_id =".$_SESSION['user_sub_deptid']." AND comp_code=".$_SESSION['comp_code_tmp'];
            //$deptid = getrecord('tbl_sub_department','dept_id',$sub_deptid_condition);
            //$sql_aumx = "SELECT * FROM tbl_authority_matrix WHERE dept_id=".$_SESSION['user_deptid']." AND sub_dept_id=".$_SESSION['user_sub_deptid']." AND desig_id=".$_SESSION['utype_tmp'];
            //echo "SQL AUMX : " . $sql_aumx . "<br/>";
            $temp = explode("/", $_SERVER['PHP_SELF']);
            $_SESSION['folder_tmp'] = $temp[1];
            $token=md5(uniqid(rand(), true));
            $tokenquery = "update admin set token='".$token."' WHERE admin_id = '" . $exist["admin_id"] . "'";
            $Db->query($tokenquery);
            $_SESSION['token']=$token;
            header("location: ../main_dashboard.php");
            exit;
        }
        addLoginAttempt($user, $comp_code);
        header("location: index.php?err=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= CP_TITLE; ?></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/login.css" rel="stylesheet">
        <script src="../js/jquery-2.1.1.js"></script>
        <!-- iCheck -->
        <script src="../js/jquery.validate.min.js"></script>
    </head>
    <body class="gray-bg" >
        <div class="loginColumns animated fadeInDown">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="font-bold">Related Party Transaction</h2>
                    <p>support management</p><br/><br/><br/>
                    <p>This website is best viewed with Internet Explorer Version 11.7 and Above, and latest versions of Google chrome and Mozilla Firefox</p>
                </div>
                <div class="col-md-6">
                    <div class="ibox-content">
<? if ($showmsg != "") {
    echo "<p class='error'>" . $showmsg . "</p>";
} ?>
                        <form class="m-t" id="loginForm"  role="form" method="post" action="index.php" >
                            <div class="form-group">
                                <input type="text" class="form-control" name="Username" placeholder="Username" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="Password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="comp_code" placeholder="Company Code" />
                            </div>
                            <div class="form-group">
                                <img id="imgCaptcha" src="../create_image.php" height="30" width="100"  /><a href="javascript:void(0)" target="_self" onClick="getImage();"><img alt="image" src="../img/refresh.jpg" height="30" width="20"  border="0" /></a>
                            </div>
                            <div class="form-group">
                                <input id="txtCaptcha" type="text" class="form-control"  name="txtCaptcha" value="" class="inputText" />
                            </div>
                            <input type='hidden' value='login_process' name='action'>
                            <button type="submit"  class="btn btn-primary block full-width m-b">Login</button>
                            <p>User will be block after three unsuccessfully attempt</p>
                            <a href="forgotpassword.php" style="float:left">
                                <u> <small>Forgot Password</small></u>
                            </a>
                            <a href="reach_us.php" style="float:right">
                                <u><small>REACH Us</small></u>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div id="footer" align="right">
                <div id="credits"><?= CP_FOOTER; ?></div><br>
            </div>
        </div>
        <script type="text/javascript">
            function getImage() {
                img = document.getElementById('imgCaptcha');
                img.src = '../create_image.php?' + Math.random();
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#loginForm').validate({
                    rules: {
                        "Username": {
                            required: true,
                        },
                        "Password": {
                            required: true,
                        },

                    },
                    messages: {
                        "Username": {
                            required: "Please Enter User Name.",
                        },
                        "Password": {
                            required: "Please Enter Password",
                        },

                    }
                });
            });
        </script>
        <?php
include "../includes/chatbotpage.php";
?>
    </body>
</html>
