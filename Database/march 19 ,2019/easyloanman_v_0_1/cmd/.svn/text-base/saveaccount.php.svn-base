<?php

include "common.php";

$rec = json_decode($_POST['data']);

error_log($_POST['data']);

//exit;

error_log(print_r(json_decode($_POST['data']), 1));

//error_log(print_r($_POST['action'], 1));

//error_log($_POST['data']);

/*if (!defined($_POST['account_name']) ||
    !defined($_POST['balance']) || 
	!defined($_POST['duedate']) ||
    !defined($_POST['startdate'])) {
    
	$arr["success"] = "false";

} */

//print $rec[0]->{'account_name'};

if ($_POST['action'] == 'delete') {

    //error_log(print_r(json_decode($_POST['data']), 1));
    $delresult = true;

	foreach ($rec as $key=>$val) {

		$query = "DELETE FROM account WHERE ACCOUNTID = ?";
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

} elseif($rec[0]->{'accountid'} != '') {
    $query = "UPDATE account SET TYPEID = ?, COMPANYID = ?, ACCOUNT_NAME = ?, BALANCE = ?,                                     DUEDATE = ?, STARTDATE = ? 
	          WHERE ACCOUNTID = ?";

	$parms = array($rec[0]->{'typeid'}, $rec[0]->{'companyid'}, $rec[0]->{'account_name'}, 
		           $rec[0]->{'balance'}, $rec[0]->{'duedate'}, $rec[0]->{'startdate'},
		           $rec[0]->{'accountid'});

	$data = $conn->Execute($query, $parms);

    if ($data === false) {
		error_log($conn->ErrorMsg());
        $arr["success"] = "false";
	} else {

	   $arr["success"] = "true";
	}

} else {

	$query = "INSERT INTO account (TYPEID, COMPANYID, ACCOUNT_NAME, BALANCE, DUEDATE,                   STARTDATE)            VALUES (?,?,?,?,?,?)";

	$parms = array($rec[0]->{'typeid'}, $rec[0]->{'companyid'}, $rec[0]->{'account_name'}, 
		           $rec[0]->{'balance'}, $rec[0]->{'duedate'},
				   $rec[0]->{'startdate'});

	$data = $conn->Execute($query, $parms);

	if ($data === false) {
		error_log($conn->ErrorMsg());
        $arr["success"] = "false";
	} else {

	   $arr["success"] = "true";
	}
}

echo json_encode($arr);

?>