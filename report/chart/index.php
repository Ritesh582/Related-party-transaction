
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title:{text: '<?=$title_pie;?>'},
			subtitle:{text: '<?=$sub_title_pie;?>'},
			tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ Math.round((this.percentage*100)/100) +' %';
			}
            },
           plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Math.round((this.percentage*100)/100) +' %';
                        }
                    },showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Implemented Status',
                data: [  
					<?=$strArr;?>
					/*['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]*/


                ]
            }]
        });
    });
    
});
		</script>
	</head>
	<body>
<script src="report/chart/js/highcharts.js"></script>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
