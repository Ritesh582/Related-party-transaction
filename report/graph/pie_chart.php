
<?php
// First Pie-chart (1st)
 $piechartsql = "SELECT SUM(net_amount) AS amount, s.name AS status 
                FROM tbl_payu_data p 
                INNER JOIN tbl_status_process1 s ON s.id = p.process_status 
                WHERE p.comp_code = '" . $_SESSION["comp_code_tmp"] . "' 
                GROUP BY s.name";

$pieresult = $Db->query($piechartsql);

$net_amount = array();
$status = array();
$strArr = ""; // Initialize strArr to store data

while ($pieft = mysql_fetch_object($pieresult)) {
    //print_r($pieft);
    // Using object properties with ->
    $net_amount[] = round($pieft->amount, 2);
    $status[] = $pieft->status;

    // Append each data pair to strArr
    $strArr .= "['" . $pieft->status . "', " . round($pieft->amount, 2) . "],";
}

// Remove trailing comma from strArr
 $strArr = rtrim($strArr, ',');


// Use json_encode to convert PHP arrays to JSON format (if needed for debugging)
$status_json = json_encode($status);
$amounts_json = json_encode($net_amount);
?>
     <div id="pie-chart" style="width: 95%; height: 130px;">
                                   
                                   </div> <!-- Pie chart container -->
    <script>
 Highcharts.chart('pie-chart', {
        chart: { type: 'pie', plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false },
        title: {
            text: 'Status',
            align: 'center', verticalAlign: 'middle', y: 60,
            style: { fontSize: '16px' }
        },
        tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
        accessibility: { point: { valueSuffix: '%' } },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%'],
                size: '110%'
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            innerSize: '50%',
            data: [
                <?=$strArr;?>
            ]
        }]
    });
    </script>
    