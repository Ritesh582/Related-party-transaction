
<?php
// First Pie-chart (1st)
$piechartsql1 = "SELECT SUM(net_amount) AS amount, s.name AS status 
                FROM tbl_payu_data p 
                INNER JOIN tbl_status_process1 s ON s.id = p.process_status 
                WHERE  p.comp_code = '" . $_SESSION["comp_code_tmp"] . "' 
                GROUP BY s.name";

$pieresult1 = $Db->query($piechartsql1);

$net_amount1 = array();
$status1 = array();
$strArr1 = ""; // Initialize strArr to store data

while ($pieft1 = mysql_fetch_object($pieresult1)) {
    //print_r($pieft);
    // Using object properties with ->
    $net_amount1[] = round($pieft1->amount, 2);
    $status1[] = $pieft1->status;

    // Append each data pair to strArr
    $strArr1 .= "['" . $pieft1->status . "', " . round($pieft1->amount, 2) . "],";
}

// Remove trailing comma from strArr
 $strArr1 = rtrim($strArr1, ',');

// print_r($strArr1);


// Use json_encode to convert PHP arrays to JSON format (if needed for debugging)
$status_json1 = json_encode($status1);
$amounts_json1 = json_encode($net_amount1);
?>
     <div id="circle-chart1"></div> <!-- Pie chart container -->
    <script>
    // Circle chart 1
    Highcharts.chart('circle-chart1', {
        chart: { type: 'pie', plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false },
        title: { text: 'Top 20 value Unmatched Aging ', align: 'left' },
        tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
        accessibility: { point: { valueSuffix: '%' } },
        plotOptions: {
            pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<span style="font-size: 1.2em"><b>{point.name}</b></span><br>' +
                            '<span style="opacity: 0.6">{point.percentage:.1f} %</span>',
                    connectorColor: 'rgba(128,128,128,0.5)'
                }
            }
        },
        series: [{
            name: 'Share',
            data: [<?=$strArr1;?>
            ]
        }]
    });

    </script>
    