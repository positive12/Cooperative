<?php
include "common.php";

$query = "SELECT T.tranid, T.LOANID, L.LOAN_NAME, T.AMOUNT, T.TRANDATE,T.TRANTYPE,
          A.ACCOUNT_NAME
		  FROM transaction T, loan L, account A
          WHERE T.LOANID = L.LOANID
		    AND A.ACCOUNTID = L.ACCOUNTID
		  ORDER BY L.LOAN_NAME";

$ADODB_FETCH_MODE = 2; 

$data = $conn->Execute($query);

if ($data === false) {
}

//$arr = $data->GetArray();

while ($rec = $data->FetchRow()) { 
       $arr[] = array_change_key_case($rec);		   
} 

//$arr = array_change_key_case($arr, CASE_LOWER);

$results['transactions'] = $arr;

echo '({"results":'.json_encode($results).'})';
?>