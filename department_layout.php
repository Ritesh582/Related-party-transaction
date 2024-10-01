<? include "includes/header.php"; ?>
<? include "includes/leftmenu.php"; ?>
<div id="page-wrapper" class="gray-bg">
    <? include "includes/sub-header.php"; ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>
                            <? if ($_GET['id'] > 0) { ?> Edit Department
                            <? } else { ?> Add Department
                            <? } ?>
                        </h5>
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
                        <? if ($errmsg != "") {
                            echo "<p class='error'>" . $errmsg . "<span>X</span></p>";
                        } ?>
                        <form name="frm" method="post" action="department.php" class="form-horizontal"
                            id="formDepartment">
                            <div class="form-group"><label class="col-sm-2 control-label">Department Name *</label>
                                <div class="col-sm-10"><input type="text" placeholder="Enter Name" name='name' id='name'
                                        value="<?= $name; ?>" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10"><textarea cols='35' rows='2' name='baddress' id='baddress'
                                        class="form-control"><?= stripslashes($baddress) ?></textarea> </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Contact Person</label>
                                <div class="col-sm-10"><input type='text' name='cperson' id='cperson' size='30'
                                        value="<?= $cperson; ?>" class="form-control"> </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Contact Person Email
                                    ID</label>
                                <div class="col-sm-10"><input type='text' name='cemail_id' id='cemail_id' size='30'
                                        value="<?= $cemail_id; ?>" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Contact Number</label>
                                <div class="col-sm-10"><input type='text' name='cnumber' id='cnumber' size='30'
                                        value="<?= $cnumber; ?>" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Department Code *</label>
                                <div class="col-sm-10"><input type='text' name='dept_code' id='dept_code' size='30'
                                        value="<?= $dept_code; ?>" class="form-control"></div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Term & Condition *</label>
                                <div class="col-sm-10">
                                    <textarea name="term_condition" id="term_condition" class="form-control"
                                        placeholder="Term & condition"><?= $termcondition; ?></textarea>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Is RBO</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name='rboFlag' id='rboFlag' value='1'
                                        <?= strchecked(1, $rboFlag); ?>>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type='hidden' value='<?= $id; ?>' name='id'>
                                    <input type='hidden' value='<?= $mode; ?>' name='mode'>
                                    <input type='hidden' value='<?= $_SESSION['comp_code_tmp']; ?>' name='comp_code'>
                                    <button class="btn btn-white" type="button"
                                        onclick="back_fn('department_search.php');">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include "includes/footer.php"; ?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#formDepartment').validate({
        rules: {
            "name": {
                required: true
            },
            "baddress": {
                required: true
            },
            "cperson": {
                required: true
            },
            "cemail_id": {
                required: true
            },
            "cnumber": {
                required: true
            },
            "dept_code": {
                required: true
            },
            "rboFlag": {
                required: true
            }
        },
        messages: {
            "name": {
                required: "Department Name is required."
            },
            "baddress": {
                required: "Address is required."
            },
            "cperson": {
                required: "Contact Person is required."
            },
            "cemail_id": {
                required: "Contact Email ID is required."
            },
            "cnumber": {
                required: "Contact Number is required"
            },
            "dept_code": {
                required: "Department Code is required"
            },
            "rboFlag": {
                required: "Is RBO is required"
            }
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#startDate").datepicker();
});
</script>
<script>
$(document).ready(function() {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
});
</script>
</body>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 08:05:02 GMT -->

</html>