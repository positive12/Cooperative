<?php
include "common.php";

$query = "SELECT A.ACCOUNTID,A.COMPANYID, A.ACCOUNT_NAME, A.TYPEID, T.TYPENAME,
          A.STARTDATE, A.DUEDATE, A.BALANCE,
		  C.COMPANY_NAME
		  FROM account A, accounttype T, company C
          WHERE T.TYPEID = A.TYPEID
		    AND C.COMPANYID = A.COMPANYID
		  ORDER BY T.TYPENAME, A.ACCOUNT_NAME";

$ADODB_FETCH_MODE = 2; 

$data = $conn->Execute($query);

if ($data === false) {
}

//$arr = $data->GetArray();

while ($rec = $data->FetchRow()) { 
       $arr[] = array_change_key_case($rec);		   
} 

//$arr = array_change_key_case($arr, CASE_LOWER);

$results['accounts'] = $arr;

echo '({"results":'.json_encode($results).'})';
?>