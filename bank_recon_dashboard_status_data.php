<?php
include ('includes/config.php');

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
	0 => 'id',
        1 => 'recon_id',
        2 => 'banknarration',
        3 => 'bankamount',
        4 => 'bank_column_varchar',
        5 => 'bank_column_double',
        6 => 'status',
 );

if (isset($_GET["bank_code"]) && !empty($_GET["bank_code"])) {
    $bookbank_code = " and bankcode='" . $_GET["bank_code"] . "'";
    $bank_code = " and bank_code='" . $_GET["bank_code"] . "'";
}

if (isset($_GET["startperoid"]) && isset($_GET["endperoid"]) && !empty($_GET["endperoid"]) && !empty($_GET["startperoid"])) {

    $date = str_replace('/','-',$_GET["startperoid"]);
    $spd = date('d',strtotime($date));
    $spm = date('m',strtotime($date));
    $spy = date('Y',strtotime($date));


    $edate = str_replace('/','-',$_GET["endperoid"]);
    $epd = date('d',strtotime($edate));
    $epm = date('m',strtotime($edate));
    $epy = date('Y',strtotime($edate));
    $btcon = "BETWEEN '" . $spy . "-" . $spm . "-" . $spd . "' And '" . $epy . "-" . $epm . "-" . $epd . "'";
    $bookperiod = " and trandate " . $btcon;
    $bankperiod = " and cheque_date " . $btcon;

    // echo $bookperiod;
    //echo "   ".$bankperiod;
}

// getting total number records without any search
 // $sql = "Select id,recon_id,comp_cheque_no,comp_cheque_amount,bank_column_varchar,bank_column_double,status,flag_status from tbl_book WHERE 1 ".$bookbank_code.$bookperiod." union select recon_id,id,book_column_varchar,book_column_double,cheque_no,cheque_amount,status,flag_status from tbl_bank_statement where flag_status=0".$bank_code.$bankperiod;
 $sql ="Select id,recon_id,banknarration,bankamount,bank_column_varchar,bank_column_double,status,flag_status from tbl_bank_book_statement WHERE 1 and status='".$_GET['status']."' UNION DISTINCT select recon_id,id,book_column_varchar,book_column_double,particulars,transaction_amount,status,flag_status from tbl_bank_bank_statement where flag_status=0 and status='".$_GET['status']."'";
 //echo $sql;
/*if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";

 }
 if($_SESSION['comp_code_tmp']=="")
 {

  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";


 }
  if(isset($_SESSION['dept_code_tmp']) && !empty($_SESSION['dept_code_tmp']))
 {
   $condition .= " and dept_code = '".$_SESSION['dept_code_tmp']."'";
}

   /*if($st_code<>"")
  {
   $cnd1 .= " and dept_code = '".$st_code."'";
  }
 if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
   $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
 }
$sql=$sql.$cnd1;*/

$query=$Db->query($sql);
$totalData = mysql_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows


 /*$sql = "Select id,recon_id,comp_cheque_no,comp_cheque_amount,bank_column_varchar,bank_column_double,status,flag_status from tbl_book WHERE 1".$bookbank_code.$bookperiod." union select recon_id,id,book_column_varchar,book_column_double,cheque_no,cheque_amount,status,flag_status from tbl_bank_statement where flag_status=0".$bank_code.$bankperiod;*/
 // $sql = "Select id,recon_id,comp_cheque_no,comp_cheque_amount,bank_column_varchar,bank_column_double,status,flag_status from tbl_book WHERE 1".$bookbank_code.$bookperiod." union select recon_id,id,book_column_varchar,book_column_double,cheque_no,cheque_amount,status,flag_status from tbl_bank_statement where flag_status=0".$bank_code.$bankperiod;
 $sql = "Select id,recon_id,banknarration,bankamount,bank_column_varchar,bank_column_double,status,flag_status from tbl_bank_book_statement WHERE 1 and status='".$_GET['status']."' UNION DISTINCT select recon_id,id,book_column_varchar,book_column_double,particulars,transaction_amount,status,flag_status from tbl_bank_bank_statement where flag_status=0 and status='".$_GET['status']."'";
/*if($_SESSION['comp_code_tmp'] <>""){
 $cnd1 .= " and comp_code = '".$_SESSION['comp_code_tmp']."'";

 }
 if($_SESSION['comp_code_tmp']=="")
 {

  $cnd1 .= " and comp_code IN(select company_code from tbl_company where group_code= '".$_SESSION['group_code_tmp']."')";


 }
 if(isset($_SESSION['dept_code_tmp']) && !empty($_SESSION['dept_code_tmp']))
 {
   $condition .= " and dept_code = '".$_SESSION['dept_code_tmp']."'";
}

   /*if($st_code<>"")
  {
   $cnd1 .= " and dept_code = '".$st_code."'";
  }*/
 /*if(isset($_SESSION['branch_code_tmp']) && !empty($_SESSION['branch_code_tmp'])){
   $cnd1 .= " and branch_code = '".$_SESSION['branch_code_tmp']."'";
 }
//$sql=$sql.$cnd1;

/*if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( txn_journal_no LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR deposit_slip_no LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR cheque_no LIKE '".$requestData['search']['value']."%' )";
}*/
$query=$Db->query($sql);
$totalFiltered = mysql_num_rows($query);
//$sql.=" ORDER BY cheque_no  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
//echo $requestData['start'];
//// when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
//$requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=$Db->query($sql);

$data = array();
$i=$requestData['start'];
while( $row=mysql_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

        //$status=1;
     $reconid="";
     $i++;
     $status = $row['status'];

    // $nestedData[] = $status;

     /*$status=getrecord('tbl_gstr_2_status2','status',"where gstin='".$row["gstin"]."' and invoice_number='".addslashes($row["invoice_number"])."' and comp_code = '".$_SESSION['comp_code_tmp']."'");
    $reconid=getrecord('tbl_gstr_2_status2','id',"where gstin='".$row["gstin"]."' and invoice_number='".addslashes($row["invoice_number"])."' and comp_code = '".$_SESSION['comp_code_tmp']."'");*/
        //$nestedData[] = $row["id"];

    	//$nestedData[] = $i;

        $nestedData[] = $row['id'];
        $nestedData[] = $row['banknarration'];
        $nestedData[] = $row['bankamount'];
        $nestedData[] = $row['recon_id'];

        $nestedData[]= getrecord("tbl_bank_bank_statement", "particulars", "where id='".$row['recon_id']."'");
		$amt = getrecord("tbl_bank_bank_statement", "transaction_amount", "where id='".$row['recon_id']."'");
        $nestedData[] = $amt;
		$nestedData[] = $row['bankamount']-$amt;
		
		

        if($row['status']==0 && $row["flag_status"]==0){
            $status="UnMatch In Book Statement";
        }else if($row['status']==0 && $row["flag_status"]==1){
            $status="UnMatch In Bank Statement";
        }else{
          $status =  getrecord("bank_recon_status", "name", "where id='".$row['status']."' and comp_code='".$_SESSION['comp_code_tmp']."'")  ;
        }


        //$status =  getrecord("hsbcstatus", "name", "where id = 1");
        $nestedData[] = $status;
        $data[] = $nestedData;

//	$nestedData[] = $row["cheque_amount"];
      //$status =  getrecord("hsbcstatus", "name", "where id=1");
        //$nestedData[] = $status;
	//$nestedData[] = $row["cheque_no"];
	//$nestedData[] = $row["cheque_amount"];
        //$nestedData[] = "<a href='bank_statement_view.php?mode=edit&id=".$row['id']."'><p class='fa fa-pencil' aria-hidden='true'></p></a>";

	/*$nestedData[] = $row["place_of_supply"];
	$nestedData[] =$reconid;
     $gstrstatus = getrecord("tbl_gstrstatus","name","where id='".$status."'");
	$nestedData[] = "<span class='sa'>".$gstrstatus."</span>";
	$condition = " where admin_id ='".$row["updated_by"]."'";
	$updatedBy = getrecord('admin','name',$condition);
	$nestedData[] = $updatedBy;
	$nestedData[] = yymmdd_ddmmyy($row["updated_date"]);*/
	 /* $link="<a  href='gstr.php?mode=edit&id=".$row['id']."'><i class='fa fa-pencil' aria-hidden='true' style='color:#ffffff'></i></a>";
	$nestedData[] = $link;*/




}




$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
