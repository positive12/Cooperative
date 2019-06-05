<?php

function getAccountType()
{
	$query = "SELECT TYPEID, TYPENAME
			  FROM accounttype";

	$ADODB_FETCH_MODE = 2; 

	$data = $GLOBALS['conn']->Execute($query);

	if ($data === false) {
		error_log($GLOBALS['conn']->ErrorMsg());
	}
	

	return $data;
}
?>