<?php
	$localhost = "localhost";
	$user = "root";
	$pass = "12345678";
	$db = "DB-Login";

	$connect = mysqli_connect($localhost, $user, $pass, $db);


	#check if database connection is already been established..
	
//	if(!$connect){echo "not connected";}
//		else{echo "okay";}
?>