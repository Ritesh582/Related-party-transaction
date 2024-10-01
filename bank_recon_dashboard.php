<? include "includes/config.php";
   include "includes/session_check.php";
   include "includes/header.php";
   include "includes/bank_recon_leftmenu.php";?>  
        <div id="page-wrapper" class="gray-bg">
        <? include "includes/sub-header.php";?>
            <div class="wrapper wrapper-content">
               <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Pie Chart Report</h5>
                                <div class="pull-right">  
                                </div>
                               
                            </div>
                            <!--<div class="col-sm-4">
                                <select name="process" id="process" class="form-control" onchange="getprocess(this.value)">
                                    <option value="1">Process 1</process>
                                    <option value="2">Process 2</process>
                                </select>
</div>-->


                            <div id="process1">
                            
                           

                          

                   
</div>
                            


                           
                           
                        </div>
                    </div>
       </div>
       </div>
   <? include "includes/footer.php";?>
       </div>
       </div>
      

   
<script>
    function getprocess(data)
    {
        console.log(data);
    }
    </script>
  
</body>
<style>
    body.DTTT_Print {
        background: #67bdf9;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#67bdf9;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #67bdf9;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
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
			scrollX:        true,
            
        
        
        });
 });

   
</script>
</html>
