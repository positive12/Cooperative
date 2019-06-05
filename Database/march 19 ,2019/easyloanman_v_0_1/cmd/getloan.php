<?php
include "common.php";

$query = "SELECT L.LOANID, L.LOAN_NAME, L.ACCOUNTID, L.AMOUNT, L.BALANCE,
          L.STARTDATE, L.TERM, A.ACCOUNT_NAME
		  FROM loan L, account A, company C
          WHERE A.ACCOUNTID = L.ACCOUNTID
		    AND C.COMPANYID = A.COMPANYID
		  ORDER BY A.ACCOUNT_NAME";

$ADODB_FETCH_MODE = 2; 

$data = $conn->Execute($query);

if ($data === false) {
}

//$arr = $data->GetArray();

while ($rec = $data->FetchRow()) { 
       $arr[] = array_change_key_case($rec);		   
} 

//$arr = array_change_key_case($arr, CASE_LOWER);

$results['loans'] = $arr;

echo '({"results":'.json_encode($results).'})';
?>