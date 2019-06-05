<?php

function getCompany($more=false)
{
	$qrysel = "SELECT C.COMPANYID, C.COMPANY_NAME, C.COMPANY_DESC";

	if ($more) {
		$qrysel .= ",C.TYPEID, CT.COMP_TYPENAME";
	}

	$qryfrm = " FROM company C";

    if ($more) {
		$qryfrm.= ",companytype CT";

	}

    $qrywhr = "";

	if ($more) {
		$qrywhr.= " WHERE CT.TYPEID = C.TYPEID";

	}

    $query = $qrysel . $qryfrm. $qrywhr;


	//$ADODB_FETCH_MODE = 2; 

    $GLOBALS['conn']->SetFetchMode(2); 


	$data = $GLOBALS['conn']->Execute($query);

	if ($data === false) {
		error_log($GLOBALS['conn']->ErrorMsg());
	}

	return $data;
}
?>