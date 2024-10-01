<? include "includes/config.php";
include "includes/session_check.php";
include "includes/header.php";
include "includes/recon_leftmenu.php"; ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div id="page-wrapper" class="gray-bg">
    <? include "includes/sub-header.php"; ?>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pie Chart Report</h5>
                        <div class="pull-right">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php
                        //	$fileName = "recon_chart_report.php";
                        //	include "report/".$fileName;

                        ?>


                        <div class="row">
                            <?php
                            $fileName = "recon_chart_report.php";
                            //include "report/".$fileName;
                            ?>

                            <div class="col-sm-12">
                                <?php
                                $fileName = "recon_chart_report_book.php";
                                include "report/graph/" . $fileName;
                                ?>
                            </div>
                            <div class="col-sm-12">
                                <?
                                $fileName = "recon_chart_report_itc.php";
                                include "report/graph/" . $fileName;

                                ?>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-sm-6">
                                <?php include "report/graph/state_wise_book_graph_data.php"; ?>
                            </div>

                            <div class="col-sm-6">
                                <?php include "report/graph/itc_ineligible_graph_data.php"; ?>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                include "report/graph/top_vendor_graph.php"; ?>
                            </div>
                            <div id='vendor_graph_book_itc'></div>

                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <?php include "report/graph/reverse_charge_graph.php"; ?>
                            </div>

                            <div class="col-sm-6">
                                <?php include "report/graph/vendor_graph.php"; ?>
                            </div>
                        </div>





                    </div>
                </div>
                <!--<div class="ibox-content">
                              <?php
                                //	$fileName = "recon_chart_report2a.php";
                                //	include "report/".$fileName;

                                ?>
                            </div>-->
            </div>
        </div>
    </div>
    <? include "includes/footer.php"; ?>
</div>
</div>





</body>
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
<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({

            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            },
            scrollX: true,



        });
    });
</script>

</html>