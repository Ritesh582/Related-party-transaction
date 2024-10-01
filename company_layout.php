<? include "includes/header.php"; ?>
<? include "includes/leftmenu.php"; ?>

<?php
$res = $Db->query("select company_code from tbl_company order by lastid desc");
$fetch = mysql_fetch_object($res);
$comp_code = $fetch->company_code;
?>
<div id="page-wrapper" class="gray-bg">
    <? include "includes/sub-header.php"; ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><? if ($_GET['id'] > 0) { ?> Edit Company <? } else { ?> Add Company <? } ?></h5>
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
                        <form action="company.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="formCompany">
                            <div class="form-group"><label class="col-sm-2 control-label">Company Code</label>
                                <div class="col-sm-4"><input type="text" name="txt_code" value="<?php if ($company_code <> "") {
                            echo $company_code;
                        } else {
                            echo ++$comp_code;
                        } ?>" readonly="readonly" class="form-control" /></div>
                                <label class="col-sm-2 control-label">Company Name</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Company Name"  name='txt_compname' value="<?= $name; ?>"  class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">GST Number </label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter GST No" name='txt_gstno' value="<?= $gstno; ?>"  class="form-control"></div>
                                <label class="col-sm-2 control-label">Logo</label>
                                <div class="col-sm-4">
                                    <?php
                                    if ($logo_image) {
                                        ?>
                                        <a href="<?= $imagePath . $logo_image; ?>" target=_blank ><?= $logo_image; ?></a><input type="file" name="logo_file" class="form-control" /><br/>
                                        <?
                                    } else {
                                        ?>
                                        <input type="file" name="txt_logo" class="form-control" />
    <?
}
?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">PAN Number </label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Pan No" name='txt_panno' value="<?= $panno; ?>"  class="form-control"></div>
                                <label class="col-sm-2 control-label">Principal Place Of Business</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Principal Place" name='txt_principalPlace' value="<?= $principalPlace; ?>"  class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Whether company Is Domestic?</label>
                                <div class="col-sm-4"><input type="radio" name="Company_status" value="1" <? if ($Company_status == "1") {
    echo $checked = "checked='checked'";
} ?> />DOMESTIC

                                    <input type="radio" name="Company_status" value="2" <? if ($Company_status == "2") {
    echo $checked = "checked='checked'";
} ?>  />OTHER THAN DOMESTIC </div>
                                <label class="col-sm-2 control-label">TAN Number</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Tan No" name='txt_tanno' value="<?= $tanno; ?>"  class="form-control"> </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group"><label class="col-sm-2 control-label">Flat/Door/Block NO</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Flat No." name='txt_flat'  value="<?= $flatno; ?>"  class="form-control"></div>
                                <label class="col-sm-2 control-label">Premises/Building Name</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Contact No." name='txt_premises'  value="<?= $premises; ?>"  class="form-control"></div>

                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Road/Street</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Road Street"  name='txt_roadstreet' value="<?= $roadstreet; ?>"  class="form-control"></div>
                                <label class="col-sm-2 control-label">Area/Locality</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Area"  name='txt_area' value="<?= $area; ?>"  class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Town/City/District</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter City" name='txt_town' value="<?= $town; ?>"  class="form-control"></div>
                                <label class="col-sm-2 control-label">State</label>
                                <div class="col-sm-4"><select name='txt_state' class="form-control"><option value=''>select</option><?= dropdown('tbl_state', $state); ?></select> </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-4"><select name='txt_country' class="form-control"><option value=''>select</option><?= dropdown('tbl_country', $country); ?></select> </div>
                                <label class="col-sm-2 control-label">Pin code</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Pin Code " name='txt_pincode' value="<?= $pincode; ?>"  class="form-control"> </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group"><label class="col-sm-2 control-label">Contact No.</label>
                                <div class="col-sm-4"><input type="number" placeholder="Enter Contact No." name='txt_teliphoneno'  value="<?= $teliphoneno; ?>"  class="form-control"></div>
                                <label class="col-sm-2 control-label">Mobile No</label>
                                <div class="col-sm-4"><input type="number" placeholder="Enter Contact No." name='txt_mobile'  value="<?= $mobileno; ?>"  class="form-control"></div>

                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4"><select name='txt_status' class="form-control"><option value=''>select</option><?= dropdown('tbl_status', $status); ?></select> </div>
                                <label class="col-sm-2 control-label">Email Id</label>
                                <div class="col-sm-4"><input type="text" placeholder="Enter Emial Id"  name='txt_email' value="<?= $comp_email; ?>"  class="form-control"></div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Authorized</label>
                                <div class="col-sm-4"><input type="text" name="txt_authorized" size="40" value="<?php echo $authorized; ?>" class="form-control" /> </div>
                                <label class="col-sm-2 control-label">Registration Number</label>
                                <div class="col-sm-4"><input type="text" name="randomNo" size="40" value="<?php echo $randomNo; ?>" class="form-control" /> </div>
                            </div>
                            <div class="accessModules">
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Access Modules</label>
                                    <div class="col-sm-10">
                                        <label class="checkbox-inline col-sm-4">
                                            <input type='checkbox' name='yesNo' id="yesNo" value='1'>Check All / Uncheck All
                                        </label>
                                    </div>
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                            <label class="checkbox-inline col-sm-2">
                                            <input type='checkbox' name='Bank_Recon_Module'  value='1' <?= strchecked(1, $Bank_Recon_Module); ?>>Related Party Transaction
                                        </label>
                                     
                                    </div>
                                    
                            
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type='hidden' value='<?= $id; ?>' name='id'>
                                    <input type='hidden' value='<?= $mode; ?>' name='mode'>
                                    <button class="btn btn-white" type="button" onclick="back_fn('company_search.php');">Cancel</button>
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
    $(document).ready(function () {

        $('#formCompany').validate({
            rules: {

                "txt_compname": {
                    required: true,

                },
                "txt_email": {
                    required: true,
                    email: true,
                },
                "txt_panno": {required: true},
                "txt_gstno": {required: true},
                "txt_logo": {required: true},
                "txt_principalPlace": {required: true},
                "txt_mobile": {required: true},
                "txt_tanno": {required: true},
                "txt_authorized": {required: true},
                "randomNo": {required: true},

            },
            messages: {

                "name": {
                    required: "Name Field is required.",

                },

                "email": {
                    required: "Email Id is required.",
                    email: "Please Enter Valid Email Id.",
                }


            }

        });
    });


</script>

<script type="text/javascript">
    $(function () {
        $(".accessModules #yesNo").click(function () {
            if ($(".accessModules #yesNo").is(':checked')) {
                $(".accessModules input[type=checkbox]").each(function () {
                    $(this).prop("checked", true);
                });

            } else {
                $(".accessModules input[type=checkbox]").each(function () {
                    $(this).prop("checked", false);
                });
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $("#startDate").datepicker();

    });
</script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 08:05:02 GMT -->
</html>
