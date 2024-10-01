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
      <div id="bar-chart"></div> <!-- Bar chart container -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
// Bar chart
Highcharts.chart('bar-chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Match and Unmatch Amount',
        align: 'left'
    },
    xAxis: {
        categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        crosshair: true,
        accessibility: {
            description: 'Months'
        }
    },
    yAxis: {
        min: 0,
        tickInterval: 50000,
        title: {
            text: 'Amount'
        }
    },
    tooltip: {
        valueSuffix: ' Lakhs '
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Match',
            data: [387749, 280000, 129000, 64300, 54000, 34300, 387749, 280000, 129000, 64300, 54000, 34300]
        },
        {
            name: 'Unmatch',
            data: [45321, 140000, 10000, 140500, 19500, 113500, 387749, 280000, 129000, 64300, 54000, 34300]
        }
    ]
});
</script>
