<?php

include "common.php";

$rec = json_decode($_POST['data']);


if ($_POST['action'] == 'delete') {

    //error_log(print_r(json_decode($_POST['data']), 1));
    $delresult = true;

	foreach ($rec as $key=>$val) {

		$query = "DELETE FROM loan WHERE LOANID = ?";
		$parms = array($val);
        $data = $conn->Execute($query, $parms);

		if ($data === false) {
			$delresult = false;
			break;
		}

	}

	if ($delresult === false) {
		error_log($conn->ErrorMsg());
		$arr["success"] = "false";
	} else {

	   $arr["success"] = "true";
	}

} elseif($rec[0]->{'loanid'} != '') {
    $query = "UPDATE loan SET LOAN_NAME = ?, ACCOUNTID = ?, AMOUNT = ?, BALANCE = ?,                                        STARTDATE = ? , TERM = ?
	          WHERE LOANID = ?";

	$parms = array($rec[0]->{'loan_name'}, $rec[0]->{'accountid'}, $rec[0]->{'amount'}, 
		           $rec[0]->{'balance'}, $rec[0]->{'startdate'}, $rec[0]->{'term'}, $rec[0]->{'loanid'});

	$data = $conn->Execute($query, $parms);

    if ($data === false) {
		error_log($conn->ErrorMsg());
        $arr["success"] = "false";
	} else {

	   $arr["success"] = "true";
	}

} else {

	$query = "INSERT INTO loan (LOAN_NAME, ACCOUNTID, AMOUNT, BALANCE, STARTDATE, TERM) ".
		     " VALUES (?,?,?,?,?,?)";

	$parms = array($rec[0]->{'loan_name'}, $rec[0]->{'accountid'}, $rec[0]->{'amount'}, 
		           $rec[0]->{'balance'}, $rec[0]->{'startdate'}, $rec[0]->{'term'});

	$data = $conn->Execute($query, $parms);

	if ($data === false) {
		error_log($query);
		error_log(print_r($parms, 1));
		error_log($conn->ErrorMsg());
        $arr["success"] = "false";
	} else {

	   $arr["success"] = "true";
	}
}

echo json_encode($arr);

?>