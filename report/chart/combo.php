<?php

        $condition = " where company_code ='".$_SESSION['comp_code_tmp']."'";	
	$comp_name=getrecord('tbl_company','name',$condition);
   $comp_action="Department".$comp_name."Actionable";
   $compstatus=$comp_name."status";
    $compstatus1=$comp_name."Complete status";
   
$qSql = "select count(*) as cnt from tbl_invoice where comp_code='".$_SESSION['comp_code_tmp']."'";
$qTotal =$qSql;
$qTotal = $Db->query($qTotal);
$ftotal = mysql_fetch_object($qTotal);
$totalInvoice = $ftotal->cnt;
if($totalInvoice == 0)$totalInvoice=1;
        
        $qC1 = $Db->query("select dc.code as id ,d.name as name from department d Inner Join tbl_deptCode dc on d.id=dc.dept_id where d.comp_code='".$_SESSION['comp_code_tmp']."' and dc.Formdate <='". ddmmyy_yymmdd($_SESSION['Year_Date_Tmp'])."' and dc.todate >='".ddmmyy_yymmdd($_SESSION['Year_Date_Tmp'])."' order by d.id");
	$cnt1 = $Db->num_rows();
	$i=1;
	$department_list = "";
	while($ftC1 = mysql_fetch_object($qC1)){
		if($i == $cnt1)$department_list .= "'".$ftC1->name."'";
		else $department_list .= "'".$ftC1->name."',";

		$i=$i+1;
	}

	
	$strArrC = "";
	$qC2 = $Db->query("select id,name,color_code from tbl_rstatus order by id");
	$sCnt = $Db->num_rows();
	$i=1;
	while($ftC2 = mysql_fetch_object($qC2)){
		$rstatus_name = $ftC2->name;
		$rstatus_id = $ftC2->id;
		$sQuery = $qSql." and status =".$rstatus_id;
		$sQuery = $Db->query($sQuery);
		$rtotal = mysql_fetch_object($sQuery);
		$rCnt = $rtotal->cnt;	
	//	echo $rCnt.'@@@@@@@@@@@@@@@@ '.$totalAudit.'<br/>';
	
		$rPercentage = ($rCnt/$totalInvoice)*100;	
		//$rPercentage = round($rPercentage,1);
		//echo $rPercentage.'---------------';
		
		$d=1;
		$strArrS = "";		
		$qC1 = $Db->query("select dc.code as dept_code ,d.name as name from department d Inner Join tbl_deptCode dc on d.id=dc.dept_id where d.comp_code='".$_SESSION['comp_code_tmp']."' and dc.Formdate <='". ddmmyy_yymmdd($_SESSION['Year_Date_Tmp'])."' and dc.todate >='".ddmmyy_yymmdd($_SESSION['Year_Date_Tmp'])."' order by d.id");
		$kNum = $Db->num_rows();
		while($ft2 = mysql_fetch_object($qC1)){
			$dept_code = $ft2->dept_code;
			$sQuery = $qSql." and status =".$rstatus_id." and  dept_code='".$dept_code."'";
			$sQuery = $Db->query($sQuery);
			$rtotal = mysql_fetch_object($sQuery);
			$rCnt = $rtotal->cnt;
	//		echo "d : ".$d." kNum :".$kNum."<br />";
			if($d == $kNum){
				$strArrS .=(int)$rCnt;
			}else{
				$strArrS .=(int)$rCnt.',';
			}
			$d=$d+1;
		}
		   $strArrSeries .= "{type: 'column',name: '".$rstatus_name."',data:[".$strArrS."]},";
		if($i == $sCnt){
			 $strArrC .="{name: '".$rstatus_name."',y: $rPercentage,color:'".$ftC2->color_code."'}";				 
	 		//$strArrSeries .= "{type: 'column', name: '".$rstatus_name."',data:[".$strArrS."]}";
		}else{
			$strArrC .="{name: '".$rstatus_name."',y: $rPercentage,color:'".$ftC2->color_code."'},";
			
		}
		$i = $i+1;
	}
?>

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
            title:{ text:'Department Company Actionable'},
            xAxis:{categories: [<?=$department_list;?>]},
            tooltip: {
                formatter: function() {
                    var s;
                    if (this.point.name) { // the pie chart
                        s = ''+
                            this.point.name +': '+ this.y +'% Company Actionable';
                    } else {
                        s = ''+
                            this.x  +': '+ this.y;
                    }
                    return s;
                }
            },
            labels: {
                items: [{
                    html: 'Company Status',
                    style: {
                        left: '40px',
                        top: '8px',
                        color: 'black'
                    }
                }]
            },

            series: [<?=$strArrSeries;?>

			
			/*{
                type: 'spline',
                name: 'Average',
                data: [3, 2.67, 3, 6.33, 3.33]
            },*/
			{
                type: 'pie',
                name: 'Bajaj Completed Status',	
				data: [<?=$strArrC;?>],
                center: [100, 80],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });
    });
    
});
		</script>
	</head>
	<body>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
