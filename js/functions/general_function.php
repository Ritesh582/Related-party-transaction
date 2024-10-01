<?php
$dropdown_Arr = array(
	'yesno'=>array('0'=>'No','1'=>'Yes'),
	'status'=>array('0'=>'No','1'=>'Yes'),
	'approved'=>array('0'=>'No','1'=>'Yes'),
	'approval'=>array('0'=>'NA','1'=>'Yes','2'=>'Reject','3'=>'No'),
	'approvalD'=>array('1'=>'Yes','2'=>'Reject'),
	'closure'=>array('0'=>'Open','1'=>'Closed'),
	'master'=>array('department'=>'Department','tbl_response'=>'Management Response','tbl_rstatus'=>'Implement Status','admin'=>'User System'),
	'process'=>array('d'=>'Delete','u'=>'Update'),
);
$userType = array(1=>'HEAD',2=>'Others') ;
$admin_user =array(1=>'Technicals',2=>'Accountants',3=>'Admin');
function pageAccess($r){
    if($r == 0){?>
        <html><script>alert("Access Prohibited");window.location = 'main_dashboard.php';</script></html>
    <?phpexit;
    }return 1;
}
function getdropdownvalue($Module,$id){
    global $dropdown_Arr;
    return $dropdown_Arr[$Module][$id];
}
function wordWrapper($str,$limit){
    if( strlen($str) > $limit){
        return substr($str,0,$limit).'...';
    }else{return $str;}
}
function create_htmloption($dropdown_Arr,$Module,$selected)
{
    $values = $dropdown_Arr[$Module];
    $formatedarray='';
    while (list($key, $value) = each($values)) {
        $formatedarray .= "<option value='".$key."' ".strselected($key,$selected).">".$value."</option> "; 
	/*if($key == $selected && $selected!=" "){
            $formatedarray .= "<option value='".$key."' selected>".$value."</option> "; 
	}else{
            $formatedarray .= "<option value='".$key."'>".$value."</option> "; 
	}*/
    } 
    return $formatedarray;
}

function strselected($first , $second){
    if(strtoupper($first) == strtoupper($second)){
        return " Selected ";
    }
}
function strchecked($first , $second)
{
    if(strtoupper($first) == strtoupper($second))
    {
        return " checked ";
    }
}
function generatePassword($length=9, $strength=0) {
    $vowels = 'aeuy';
    $consonants = '1234567890bdghjmnpqrstvz';
    if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
            $vowels .= "AEUY";
    }
    if ($strength & 4) {
            $consonants .= '23456789';
    }
    if ($strength & 8) {
            $consonants .= '@#$%';
    }
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}
function rightcheck($pg){
    if((int)$_SESSION['admin_user'] == 0){
        $pg = 'tmp_'.$pg;
        if((int)$_SESSION[$pg] == 0){return "disabled";exit;}		
    }
}
function dropdown($tablename,$sid="",$cnd=""){
    global $Db;
    $q = "select id,name from ".$tablename;
    $q .= $cnd;
    $result =	$Db->query($q);
    $str = "";
    while($ft = mysql_fetch_object($result)){
            $str .="<option value='".$ft->id."' ".strselected($ft->id,$sid).">".wordWrapper($ft->name,150)."</option>";
    }
    return $str;
}
function getrecord($tablename,$fieldname,$condition){
    $myDb_8 = new DB();
    $sql_query = "SELECT ".$fieldname." from ".$tablename." ".$condition;
    $result = $myDb_8->query($sql_query);
    $row_name = mysql_fetch_array($result);
    return $row_name[$fieldname];  
}
function message($act){
    switch($act){
        case 'disabled':
            $message = "Record Disabled Successfully";
            break;
        case 'upd':
            $message = "Record Updated Successfully";
            break;
        case 'add':
            $message = "Record Saved Successfully";
            break;
        case 'open':
            $message = "Day Open Successfully";
            break;
        case 'close':
            $message = "Day Close Successfully";
            break;
        case 'del':
            $message = "Record Deleted Successfully";
            break;
        case 'ndel':
            $message = "Record Cannot be Deleted, please contact Administrator.";
            break;
        case 'pwdg':
            $message = "Password Generated.";
            break;
        case 'fupload':
            $message = "Please upload file";
            break;
        case 'rtdate':
            $message = "Target Date is required for selected status";
            break;
        case 'aumxerr':
            $message = "Error Saving Data, please try again.";
            break;
    }
    return $message;
}
function status_dropdown($selected_id = ""){
    $return_value = "<select name='status'><option value=''>Status</option>
    <option value='1' ".strselected(1,$selected_id).">Enabled</option>
    <option value='0' ".strselected(0,$selected_id).">Disabled</option>
    </select>";
    return $return_value;
}
function status($val){
    if($val==0){
        return 'Disabled';
    }else if($val==1){
        return 'Enabled'; 
    }	
}
function mmddyy_yymmdd($date){
    if($date!=''){
        $dt = explode('/',$date);
        return $dt[2].'-'.$dt[0].'-'.$dt[1];
    }
}
function yymmdd_mmddyy($date){
    if($date!=''){
        $dt = explode('-',$date);
        return $dt[1].'/'.$dt[2].'/'.$dt[0];
    }
}
function ddmmyy_yymmdd($date){
    if($date!=''){
        $dt = explode('/',$date);
        return $dt[2].'-'.$dt[1].'-'.$dt[0];
    }
}
function yymmdd_ddmmyy($date){
    if($date!=''  && $date!='0000-00-00'){
        $dt = explode('-',$date);
        return $dt[2].'/'.$dt[1].'/'.$dt[0];
    }
}
function yymmdd_ddmmyy_his($date){
    //$newdt = date_format(date_create($date), 'd-m-Y H:i:s');
    $newdt = date("d-m-Y H:i:s",strtotime($date));
    return $newdt;
}
/*
function dropdown_q($q,$sid=""){
	global $Db;
	$result = $Db->query($q);
	$selected = explode(',',$selected);
	while($ft = mysql_fetch_object($result)){$str .="<option value='".$ft->id."' ".strselected($ft->id,$sid).">".$ft->name."</option>";}
	return $str;
}
*/
function dropdown_q($q,$selected=''){
    global $Db;
    $selected = explode(',',$selected);
    $str = "";
    $q = $Db->query($q);
    while($ft = mysql_fetch_object($q)){
        if(in_array($ft->id,$selected)){
                $str .= "<option value='".$ft->id."' selected>".$ft->name."</option>";
        }else{
                $str .= "<option value='".$ft->id."'>".$ft->name."</option>";
        }
    }
    return $str;
}

function dropdown_id($q, $selected=''){
    global $Db;
    $selected = explode(',',$selected);
    $str = "";
    $q = $Db->query($q);
    while($ft = mysql_fetch_object($q)){
        if(in_array($ft->id,$selected)){
                $str .= "<option value='".$ft->id."' selected>".$ft->id." - ".$ft->name."</option>";
        }else{
                $str .= "<option value='".$ft->id."'>".$ft->id." - ".$ft->name."</option>";
        }
    }
    return $str;
}

function getPreviousData($id){
    if($id > 0){
        global $Db;
        $q = $Db->query("select * from tbl_acontrol where aid=$id order by system_date desc limit 1");
        if($Db->num_rows() > 0){
            $ft = mysql_fetch_object($q);
            return $ft->implementation_status.'~'.$ft->tdate;
        }
    }
    return "";
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function addLoginAttempt($value,$comp_code) {
    global $Db;
    // increase number of attempts
    // set last login attempt time if required    
    $q = "SELECT * FROM  login_attempts WHERE ip = '$value' AND comp_code=".$comp_code; //Modified on 19-SEP-2017, Pratik. Added condtion "AND comp_code=".$comp_code;"
    $result =  $Db->query($q);
    $data = mysql_fetch_array($result);
    if($data)
    {
        $attempts = $data["attempts"]+1;
        if($attempts==3) {
            $q = "UPDATE  login_attempts SET attempts=".$attempts.", lastlogin=CURDATE() WHERE ip = '$value'";
            $result =  $Db->query($q);
        }else{
            $q = "UPDATE  login_attempts SET attempts=".$attempts." WHERE ip = '$value'";
            $result =  $Db->query($q);
        }
    }else{
        $q = "INSERT INTO  login_attempts (attempts,IP,lastlogin,comp_code) values (1, '$value',CURDATE(),'$comp_code')";
        $result =  $Db->query($q);
    }
}
	
 function confirmIPAddress($value) {
    global $Db;
    $q = "SELECT attempts, (CASE when lastlogin is not NULL and DATE_ADD(LastLogin, INTERVAL ".TIME_PERIOD." DAY)>CURDATE() then 1 else 0 end) as Denied "." FROM login_attempts WHERE ip = '$value'";
    $results = $Db->query($q);
    $data = mysql_fetch_array($results);
    //Verify that at least one login attempt is in database

    if (!$data) {
        return 0;
    }
    if ($data["attempts"] >= ATTEMPTS_NUMBER)
    {
        if($data["Denied"] == 1)
        {
            return 1;
        }else{
            clearLoginAttempts($value);
            return 0;
        }
   }
   return 0;  
}
   
function clearLoginAttempts($value) {
    global $Db;
    $q = "UPDATE login_attempts SET attempts = 0 WHERE ip = '$value'"; 
    return   $Db->query($q);
}
function checkDayStatus() {
    global $Db;
    $q = "select * from  tbl_daystatus  WHERE dates = CURDATE()"; 
    $results = $Db->query($q);
    $data = mysql_fetch_array($results);
    if (!$data) {
        return 0;
    }else{
        return $data['status'];
    }
}
function dropdown_allLocations($selected='') //Added on 17-SEP-2017, Pratik. This function will fill dropdown having all branches, zones, hod's who's status is "Enable" i.e. "Visible"
{
    global $Db;
    $str    = "";
    $sql_br = "SELECT branch_code as id,name FROM tbl_branch WHERE status=1 AND comp_code ='".$_SESSION['comp_code_tmp']."' ORDER BY id ASC";
    $res_br = $Db->query($sql_br);
    while($row_br = mysql_fetch_array($res_br)){
        $br_arr[] = array('id'=>$row_br['id'], 'name'=>$row_br['name']);
    }
    $sql_zn = "SELECT zone_code as id,name FROM tbl_zone WHERE status=1 AND comp_code ='".$_SESSION['comp_code_tmp']."' ORDER BY id ASC";
    $res_zn = $Db->query($sql_zn);
    while($row_zn = mysql_fetch_array($res_zn)){
        $zn_arr[] = array('id'=>$row_zn['id'], 'name'=>$row_zn['name']);
    }
    $sql_ho = "SELECT hod_code as id,name FROM tbl_hod WHERE status=1 AND comp_code ='".$_SESSION['comp_code_tmp']."' ORDER BY id ASC";
    $res_ho = $Db->query($sql_ho);
    while($row_ho = mysql_fetch_array($res_ho)){
        $ho_arr[] = array('id'=>$row_ho['id'], 'name'=>$row_ho['name']);
    }
    $uploadtoArr = array_merge($br_arr, $zn_arr, $ho_arr);
    foreach ($uploadtoArr as $arrVal) {
        //if(in_array($arrVal['id'],$selected)){
        if($arrVal['id'] == $selected){
            $str .= "<option value='".$arrVal['id']."' selected>".$arrVal['id']." - ".$arrVal['name']."</option>";
        }else{
            $str .= "<option value='".$arrVal['id']."'>".$arrVal['id']." - ".$arrVal['name']."</option>";
        }
    }
    return $str;
}
?>