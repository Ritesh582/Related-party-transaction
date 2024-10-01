<?php

$companysql="select name,logo_image from tbl_company where company_code='".$comp_code."'";
$companyresult=mysqli_query($connection,$companysql);
$company=mysqli_fetch_array($companyresult);

$companyname=$company[0];


$html="<html>";
$html.="<head>";
$html.="</head>";
$html.="<body>";
$html.="<div class='banner-image'><img src='https://supportgst.com/gst2a/img/".$company[1]."' alt='".$companyname."' /></div>";
$html.="<div class='table-title'><h1>Merging error in Book</h1></div>";
$html.="<div><table>";
$html.="<tr><th></th><th>Single Book</th><th>Merged Book</th><th>Difference</th></tr>";

$html.="<tr><td>Count</td><td>".$singlerows["count"]."</td><td>".$mergedrows["count"]."</td><td></td></tr>";
$taxdiff=round($singlerows["taxvalue"]-$mergedrows["taxvalue"]);
$html.="<tr><td>Tax Value</td><td>".round($singlerows["taxvalue"],2)."</td><td>".round($mergedrows["taxvalue"],2)."</td><td>".$taxdiff."</td></tr>";
$html.="</table></div>";
$html.="<style>";
$html.="
body{
  width:95%;
  height:auto;
  margin:auto;
}
.banner-image{
  text-align:center;
  margin:5% 0;
}
.banner-image img{
  height:100px;
  width:250px;
}
.table-title{
  text-align:center;
  }
table{
  width:100%;
  height:auto;
  border-collapse: collapse;
}
table, th, td {
  border: 1px solid black;
  text-align:center;
  padding: 15px;
}
";
$html.="</style>";
$html.="</body>";
$html.="</html>";
//$to="ashraf@mathia.in";
$to="ashraf@mathia.in,jinans@savvybiz.in,pramod@mathia.in,bhavin.sheth@mathia.in";
$companyname=getrecord("tbl_company","name","where company_code='".$comp_code."'");
$subject="Merging Error in ".$companyname;

sendEmail($to,$subject,$html);
?>
