<?php
include "common.php";
include "../lib/db/companytype.php";

$data = getCompanyType();

while ($rec = $data->FetchRow()) { 
   $arr[] = array_change_key_case($rec);		   
} 

echo json_encode($arr);


?>