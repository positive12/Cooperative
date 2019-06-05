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

date_default_timezone_set('Asia/Singapore');
$slno = 1;

while (!$data->EOF) {

	$instalment = $data->fields['AMOUNT'] / $data->fields['TERM'];
	
	
    $duedate = new DateTime($data->fields['STARTDATE']);

	for($i=1; $i <= $data->fields['TERM']; $i++) {				

        error_log($data->fields['STARTDATE']);		
		$duedate->modify("+1 month");       


        $arr[] = array("scheduleid" => $slno,
			           "slno" => $slno,
			           "loanid" => $data->fields['LOANID'],
                       "loan_name" => $data->fields['LOAN_NAME'],
			           "account_name" => $data->fields['ACCOUNT_NAME'],
			           "instalment" => $instalment,
			           "duedate" => $duedate->format('Y-m-d'),
		               "status" => 1);	
	    $slno++;
	}

    $data->MoveNext();

       //$arr[] = array_change_key_case($rec);		   
} 

//$arr = array_change_key_case($arr, CASE_LOWER);

$results['schedules'] = $arr;

echo '({"results":'.json_encode($results).'})';
?>