<?php
include ('includes/config.php');

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'name', 
	1 => 'email_id',
	2=> 'mobile_no',
	3=> 'username',
	4=> 'utype',
	5=> 'status',
);

// getting total number records without any search
$sql = "SELECT name,email_id,mobile_no,username,utype,status";
$sql.=" FROM admin";
$query=$Db->query($sql);
$totalData = mysql_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT name,email_id,mobile_no,username,utype,status";
$sql.=" FROM admin WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR email_id LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR mobile_no LIKE '".$requestData['search']['value']."%' )";
}
$query=$Db->query($sql);
$totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=$Db->query($sql);

$data = array();
$i=0;
while( $row=mysql_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$i++;
	$uypes="";
    $nestedData[] = $i;
	$nestedData[] = $row["name"];
	$nestedData[] = $row["email_id"];
	$nestedData[] = $row["mobile_no"];
	$nestedData[] = $row["username"];
	$array=explode(',',$row['utype']);
 foreach($array as $uType) {
     if($uType){
         $condition = " where id =".$uType;	
	$uypes.= getrecord('tbl_role','name',$condition)."|";
     }
}
	$nestedData[] = $uypes;
	$nestedData[] = status($row['status']);
	$nestedData[] = "<a  href='user_search.php'>Test</a>";
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
