<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'piecontainer3',
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
                name: '<?=$chartName;?>',
				 point: {
				  events: {
					click: function(e) {
					   this.slice();
					   var clicked = this;
					   setTimeout(function(){
						   //alert(clicked.config[2])
						   window.open(Url.decode(clicked.config[2]));
					   }, 500)
					   e.preventDefault();
					}
				 }
			   },

		data: [
			<?=$strArr;?>
                    /*['Firefox', 45.0],
                    ['IE', 26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari', 8.5],
                    ['Opera',  6.2],
                    ['Others', 0.7],*/
                ]
            }]
        });
    });    
});
</script>
<div id="piecontainer3" style="min-width: 100%; height: 400px; margin: 0 auto"></div>