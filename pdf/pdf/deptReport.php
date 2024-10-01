<style type="text/css">
.inv-dtl, .inv-item-dtl{font-size:11px;}
.padding_class_right{padding-right:5px;}
.border{border-style:solid;border-color:#000;}
table{font-size: 14px; COLOR: #000000;FONT-FAMILY:Arial;}
</style>

<page backtop="20mm" backbottom="25mm" backleft="5mm" backright="10mm">
<?php include "pdf/pdf_header.php";?>
<table style="width: 100%; margin: 0px 0px;line-height:16px;">
<tbody><tr><td>
<TABLE style="width:700px;border: solid 1px #5544DD; border-collapse: collapse" border=1 align="center">
<TR style="color:#FFFFFF; font-size:10px; font-weight:bold; background-color:#055483;">
<Td style="width:60px; text-align: left; padding-left:5px;" height="25"><B>Department</B></Td>
<Td style='width:50x; text-align: left; padding-left:5px;'  height="25"><B>No. of Actionables</B></Td>
<?
	$q1 = $Db->query("select id,name from tbl_status order by id");
	while($ft1 = mysql_fetch_object($q1)){
		echo "<Td style='width:55px;text-align:left;padding:5px;'><B>".$ft1->name."</B></Td>";
		$status_arr[] = array($ft1->id);
	}
	$cnt = count($status_arr);
?>
</TR>

<?php
$at = 0;
$status_t = array();
if($_SESSION['tmp_cm'] > 0){
	$q = $Db->query("select id,name from department order by name");
}else{
	$q = $Db->query("select id,name from department where id='".$_SESSION['dept_id_tmp']."'");
}
while($ft = mysql_fetch_object($q)){
	$qSql = "select count(*) as tcnt from tbl_compliancem c,tbl_compliance_r_item rc where c.id=rc.cid and c.dept_id=".$ft->id;
	
	$qTotal = $Db->query($qSql);
	$ftotal = mysql_fetch_object($qTotal);
	$at +=$ftotal->tcnt; 
	echo "<TR><td class='inv-item-dtl'>".$ft->name."</td><td align='center' class='inv-item-dtl'>".$ftotal->tcnt."</td>";
	for($i=0;$i<$cnt;$i++){	
		$qStatus = $qSql." and pstatus=".$status_arr[$i][0];
		$qCnt = $Db->query($qStatus);
		$fs = mysql_fetch_object($qCnt);
		$status_t[$i] +=$fs->tcnt;
		echo "<td align='center' class='inv-item-dtl'>".$fs->tcnt."</td>";
	}
	echo "</tr>";
}
echo "<TR><td><B>Total</B></td><td align='center' class='inv-item-dtl'><b>".$at."</b></td>";
for($k=0;$k<$cnt;$k++){
	echo "<td align='center' class='inv-item-dtl'><B>".$status_t[$k]."</b></td>";
}
echo "</tr>";
?>
</TABLE>
</td></tr></tbody></table>
</page>