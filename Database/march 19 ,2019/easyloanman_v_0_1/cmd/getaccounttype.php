<?php
include "common.php";


$query = "SELECT TYPEID, TYPENAME
		  FROM accounttype";

$ADODB_FETCH_MODE = 2; 

$data = $GLOBALS['conn']->Execute($query);

if ($data === false) {
	error_log($GLOBALS['conn']->ErrorMsg());
}


while ($rec = $data->FetchRow()) { 
   $arr[] = array_change_key_case($rec);		   
} 

echo json_encode($arr);


?>