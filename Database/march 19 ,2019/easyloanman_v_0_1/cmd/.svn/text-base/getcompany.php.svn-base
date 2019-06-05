<?php
include "common.php";
include "../lib/db/company.php";



$data = getCompany($more=true);


while ($rec = $data->FetchRow()) { 
       $arr[] = array_change_key_case($rec);		   
} 

$results['companies'] = $arr;

echo '({"results":'.json_encode($results).'})';

?>