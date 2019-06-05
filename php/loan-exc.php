<?php
	include "../php/asession.php";
	require "connection.php";

	if (isset($_POST['loan_exc'])) {
		$date = date('m/d/Y');
		$admembers = mysqli_real_escape_string($connect, $_POST['admembers']);
		$lamounts  = mysqli_real_escape_string($connect, $_POST['lamount']);
		$interests  = mysqli_real_escape_string($connect, $_POST['interest']);
		$terms	   = mysqli_real_escape_string($connect, $_POST['terms']);

			$search =  array('₱' ,',');
			$replace = array('','');
			$lamount = str_replace($search, $replace, $lamounts); 

			#lahi ni sila!

			$intsearch = array('%');
			$intreplace = array('');
			$interest = str_replace($intsearch, $intreplace, $interests );
		

		if (empty($admembers) || $lamount <= 0 || empty($lamount) || empty($interest)|| empty($terms)) {
			header('Location: ../pages/view.php?linput=invalid');
			exit();

		}else{
			$totalint = ($interest / 100) * $lamount; #for interest only
			$tterms = ($terms * $totalint)+ $lamount; # total amount paying
			$hterms = $tterms / $terms; # per monthly paying

			$insert = ("INSERT INTO loan (id, mid, amount, interest, terms, tamount, monthly, tamounts, date) 
					  VALUES (null, '$admembers', '$lamount', '$interest', '$terms', '$tterms', '$hterms', '$tterms','$date' )");
				mysqli_query($connect, $insert);
			
			
			header('location:../Admin/Dashboard.php');
			exit();

		}






	}
	