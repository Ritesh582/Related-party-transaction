<?php
include('databaseconfig.php');
ini_set('max_execution_time', '0');
ini_set('memory_limit', '-1');
/*$sql = "update tbl_company_recon_table_master set backup='0' where comp_code='A'";
mysqli_query($connection, $sql);*/
if(date('H:i')>'00:00' && date('H:i')<'09:00'){
echo "hello world";
$sql = "SELECT single_book,merged_book,itc_single_book,itc_merged_book,comp_code,backup_Processflag FROM tbl_company_recon_table_master where backup='0'";
$result = mysqli_query($connection, $sql);
$row=mysqli_fetch_array($result);
if(isset($row["comp_code"]) && !empty($row["comp_code"])){

$comp_code=$row["comp_code"];
$companyname=getrecord("tbl_company","name","where company_code='".$comp_code."'");
$maindir="../backup2a/";
$pathdir=$maindir.$companyname;
$serverpath=$_SERVER["DOCUMENT_ROOT"]."/gst2a/backup2a/".$companyname;

$today=date("Y-m-d");
if(!is_dir($pathdir)){
    mkdir($pathdir);
}

if(count($row)>0 && $row[0]!=""){

  if(!is_dir($pathdir."/".$today)){
      mkdir($pathdir."/".$today);
  }




  // write data on file
  $backup_processflag=$row[5];
  $table =$row[$backup_processflag];
  $filenamezip =$pathdir."/".$today."/".$table.".zip";
  $noofrow=400000;
  $multiplefile=$movdir."/".$table.".sql";
  $myfile = fopen($pathdir."/".$today."/".$table.".sql", "w") or die("Unable to open file!");

  // select Table from database
  $result = mysqli_query($connection,"SELECT count(id) as id FROM $table where 1");
  $rows = mysqli_fetch_array($result);
  $rowcount=$rows["id"];
  $colcount = mysqli_num_fields($result);
  $numberofloop=ceil($rowcount/$noofrow);

  $result2 = mysqli_query($connection,"SHOW CREATE TABLE $table");
  $row2 = mysqli_fetch_row($result2);


  $return1 = "\n\n".$row2[1].";\n\n";
  fwrite($myfile, $return1);
  // show colums heading
  $res = mysqli_query($connection,"SHOW COLUMNS FROM $table");
  $x =0;
  $z=0;
  while($colrow  = mysqli_fetch_row($res)){

      if($z==$colcount-1){
          $coldata .= "`$colrow[$x]`";
      }else{
          $coldata .= "`$colrow[$x]`,";
      }
      $z++;
  }
  // insert query
  //$return2 = "INSERT INTO ($coldata) $table VALUES";

  /*$sql3 = "SELECT * FROM ".$table." WHERE 1 limit 1 ";


             $result3 = mysqli_query($connection,$sql3);

              $tablecolumn="";
              while ($row = mysqli_fetch_array($result3)) {
                  $realnumber=1;
                  foreach($row as $key=>$value){
                      if($realnumber%2==0){
                         if($tablecolumn==""){
                          $tablecolumn=$key;
                         }else{
                             $tablecolumn.=",".$key;
                         }
                      }
                      $realnumber++;
                  }

              }


   */


  // data
   $i=0;
   for($k=0;$k<$numberofloop;$k++){

       if($k!=0){
           $myfile = fopen($pathdir."/".$today."/".$table.$k.".sql", "w") or die("Unable to open file!");
          $tablenames=$movdir."/".$table.$k.".sql";
           $multiplefile=$multiplefile.",".$tablenames;
       }
  $sql3 = "SELECT * FROM ".$table." WHERE 1 LIMIT ".$noofrow." OFFSET ".$k*$noofrow."";

             $result3 =  mysqli_query($connection,$sql3);

              while ($row = mysqli_fetch_array($result3)) {
                 $data="";
                  $realnumber=1;
                  foreach($row as $key=>$value){
                      if($realnumber%2==0){
                         if($data==""){
                          $data="'".addslashes($value)."'";
                         }else{
                          $data.=",'".addslashes($value)."'";
                         }
                      }
                      $realnumber++;
                  }

               $txt = "insert into ".$table." values (".$data.");\n";
               fwrite($myfile, $txt);
  $i++;
  }

  fclose($myfile);
}



if(file_exists($filenamezip)==1){

    if (!unlink($filenamezip)){
       echo ("Error deleting $filenamezip");
    }else{
       $myfile = fopen($filenamezip, "w") or die("Unable to open file!");
       fclose($myfile);
    }

}else{
$myfile = fopen($filenamezip, "w") or die("Unable to open file!");
   fclose($myfile);
}
$str= $serverpath."/".$today."/".$table.".sql";
$zip = new ZipArchive;
if ($zip->open($filenamezip) === TRUE) {
  $str= $serverpath."/".$today."/".$table.".sql";
  $zip->addFile($str, $table.".sql");

  for($k=1;$k<$numberofloop;$k++){
    $str= $serverpath."/".$today."/".$table.$k.".sql";
    $zip->addFile($str, $table.$k.".sql");

    echo 'ok';
  }
  $zip->close();
} else {
    echo 'failed';
}

$filezile=filesize($filenamezip);
if($filezile>0){
//delete file
unlink($serverpath."/".$today."/".$table.".sql");
for($k=1;$k<$numberofloop;$k++){
  unlink($serverpath."/".$today."/".$table.$k.".sql");
}
}

if($backup_processflag<3){
++$backup_processflag;
$updatequery="update tbl_company_recon_table_master set backup_Processflag='".$backup_processflag."' where comp_code='".$comp_code."'";
mysqli_query($connection,$updatequery);

}else{
$updatequery="update tbl_company_recon_table_master set backup_Processflag='0',backup='1' where comp_code='".$comp_code."'";
mysqli_query($connection,$updatequery);


$dir=scandir($serverpath."/".$today);

function human_filesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

$bodyMsg="<html><head><title>GST 2a Backup</title></head><body>";
$bodyMsg.="<table border='1'><tr><td>File Name</td><td>File Size</td></tr>";

foreach($dir as $key=>$value){
    $bodyMsg.="<tr>";
    $bodyMsg.="<td>".$value."</td>";
     $bodyMsg.="<td>".human_filesize(filesize($serverpath."/".$today."/".$value))."</td>";

    $bodyMsg.="</tr>";

}
$bodyMsg.="</table></body></html>";
sendEmail("bhavin.sheth@mathia.in,jinans@savvybiz.in,pramod@mathia.in",$companyname,$bodyMsg);
}
}
}

}

?>
