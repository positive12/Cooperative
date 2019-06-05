<?php

function getCompanyType()
{
	$query = "SELECT TYPEID, COMP_TYPENAME
			  FROM companytype";

	//$ADODB_FETCH_MODE = 2; 

    $GLOBALS['conn']->SetFetchMode(2); 

	$data = $GLOBALS['conn']->Execute($query);

	if ($data === false) {
		error_log($GLOBALS['conn']->ErrorMsg());
	}

	return $data;

}
?>