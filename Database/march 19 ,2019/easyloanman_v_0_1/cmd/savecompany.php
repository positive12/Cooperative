<?php

include "common.php";

$rec = json_decode($_POST['data']);

error_log($_POST['data']);
error_log(print_r(json_decode($_POST['data']), 1));


if ($_POST['action'] == 'delete') {
    
    $delresult = true;

	foreach ($rec as $key=>$val) {

		$query = "DELETE FROM company WHERE COMPANYID = ?";
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

} else {
	
    foreach($rec as $key=>$val)
	{
	if($rec[$key]->{'companyid'} != '') {
		$query = "UPDATE company SET COMPANY_NAME = ?, COMPANY_DESC = ?,TYPEID = ?
				  WHERE COMPANYID = ?";

		$parms = array($rec[$key]->{'company_name'}, $rec[$key]->{'company_desc'}, 
					   $rec[$key]->{'typeid'}, $rec[$key]->{'companyid'});

		$data = $conn->Execute($query, $parms);

		if ($data === false) {
			error_log($conn->ErrorMsg());
			$arr["success"] = "false";
		} else {

		   $arr["success"] = "true";
		}

	} else {

		$query = "INSERT INTO company (COMPANY_NAME, COMPANY_DESC, TYPEID) " .
				 " VALUES (?,?,?)";

		$parms = array($rec[$key]->{'company_name'}, $rec[$key]->{'company_desc'}, 
					   $rec[$key]->{'typeid'});

		$data = $conn->Execute($query, $parms);

		if ($data === false) {
			error_log($conn->ErrorMsg());
			$arr["success"] = "false";
		} else {

		   $arr["success"] = "true";
		}
	}
	}
}

echo json_encode($arr);

?>