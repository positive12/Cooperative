<?php
include_once "adodb.inc.php";

$conn = &ADONewConnection($dbtype);
if (IsSet($socket) && ($socket!=""))
   $pport=$socket;
else
   $pport=$port;
if (!$conn->PConnect($dbhost.":".$pport,$dbuser,$dbpasswd,$dbname))
{
    $db_error_message = mysql_error()."<br>Cannot connect to Database";

    include "db_error.php";
    exit;
}
$conn->execute("SET CHARACTERSET UTF8");

?>
