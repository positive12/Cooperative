<?php

include "common.php";

$rec = json_decode($_POST['data']);


if ($_POST['action'] == 'delete') {

    //error_log(print_r(json_decode($_POST['data']), 1));
    $delresult = true;

	foreach ($rec as $key=>$val) {

		$query = "DELETE FROM transaction WHERE TRANID = ?";
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

} elseif($rec[0]->{'tranid'} != '') {
    $query = "UPDATE transaction SET LOANID = ?, TRANTYPE = ?,                                              TRANDATE = ? , AMOUNT = ?
	          WHERE TRANID = ?";

	$parms = array($rec[0]->{'loanid'}, $rec[0]->{'trantype'}, $rec[0]->{'trandate'}, 
		           $rec[0]->{'amount'}, $rec[0]->{'tranid'});

	$data = $conn->Execute($query, $parms);

    if ($data === false) {
		error_log($conn->ErrorMsg());
        $arr["success"] = "false";
	} else {

	   $arr["success"] = "true";
	}

} else {

	$query = "INSERT INTO transaction (LOANID, TRANTYPE, TRANDATE, AMOUNT) ".
		     " VALUES (?,?,?,?)";

	$parms = array($rec[0]->{'loanid'}, $rec[0]->{'trantype'}, $rec[0]->{'trandate'}, 
				   $rec[0]->{'amount'});

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