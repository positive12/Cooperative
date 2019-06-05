<?php
/*$db = mysqli_connect('localhost', 'root', '12345678', 'DB-Login');*/

	require 'connection.php';

	$fname = "";
	$lname = "";
	$mname ="";
	$ename ="";
	$age ="";
	$address ="";
	$type = "";
	$contrib = "";
	$errors = array();
	$_SESSION['success'] = "";

// if button is set post method and the name of the button

	if (isset($_POST['add_user'])) {

		$fname 	   =mysqli_real_escape_string ($connect, $_POST['fname']);
		$lname	   =mysqli_real_escape_string ($connect, $_POST['lname']);
		$mname =	mysqli_real_escape_string ($connect, $_POST['mname']);
		$ename =	mysqli_real_escape_string ($connect, $_POST['ename']);
		$age =		mysqli_real_escape_string ($connect, $_POST['age']);
		$type =		mysqli_real_escape_string ($connect, $_POST['type']);
		$address  =	mysqli_real_escape_string ($connect, $_POST['address']);

		#validation start here
		if(empty($fname)) {array_push($errors, print '<script>alert("Input FirstName must not be empty!");</script>');}
		if(empty($lname)) {array_push($errors, print '<script>alert("Input Lastname must not be empty!");</script>');}
		if(empty($mname)) {array_push($errors, print '<script>alert("Input Middlename must not be empty!");</script>');}
		if(empty($age)) {array_push($errors, print '<script>alert("Input Age must not be empty!");</script>');}
		if(empty($address)) {array_push($errors, print '<script>alert("Input Address must not be empty!");</script>');}


		$select = "SELECT * FROM members WHERE firstname = '$fname' and lastname= '$lname' and middlename = '$mname'";
		$check = mysqli_query($connect, $select);
		if(mysqli_num_rows($check) != 0){
				array_push($errors, print '<script>alert("Sorry FirstName and Lastname already exist!");</script>');}

		if (count($errors)==0) {
			$add = ("INSERT INTO members (Id, firstname, lastname, middlename, exname, address, age, type, date, contrib, withdraw, difference) VALUES
      			(null, '$fname', '$lname', '$mname', '$ename', '$address', '$age', '$type', null , '0', '0' ,'0' )");
      			$adds = mysqli_query($connect, $add);
      		Print '<script>alert("You Have Successfull Created A New Account!");</script>'; //failed
			Print '<script>window.location.assign("../Admin/Dashboard.php");</script>';
		}else{
				Print '<script>window.location.assign("../Admin/Dashboard.php");</script>';
    		}
	}



	if (isset($_POST['add_users'])) {

		$fname 	   =mysqli_real_escape_string ($connect, $_POST['fname']);
		$lname	   =mysqli_real_escape_string ($connect, $_POST['lname']);
		$mname =	mysqli_real_escape_string ($connect, $_POST['mname']);
		$ename =	mysqli_real_escape_string ($connect, $_POST['ename']);
		$age =		mysqli_real_escape_string ($connect, $_POST['age']);
		$type =		mysqli_real_escape_string ($connect, $_POST['type']);
		$address  =	mysqli_real_escape_string ($connect, $_POST['address']);

		#validation start here
		if(empty($fname)) {array_push($errors, print '<script>alert("Input FirstName must not be empty!");</script>');}
		if(empty($lname)) {array_push($errors, print '<script>alert("Input Lastname must not be empty!");</script>');}
		if(empty($mname)) {array_push($errors, print '<script>alert("Input Middlename must not be empty!");</script>');}
		if(empty($age)) {array_push($errors, print '<script>alert("Input Age must not be empty!");</script>');}
		if(empty($address)) {array_push($errors, print '<script>alert("Input Address must not be empty!");</script>');}


		$select = "SELECT * FROM members WHERE firstname = '$fname' and lastname= '$lname' and middlename = '$mname'";
		$check = mysqli_query($connect, $select);
		if(mysqli_num_rows($check) != 0){
				array_push($errors, print '<script>alert("Sorry FirstName and Lastname already exist!");</script>');}

		if (count($errors)==0) {
			$add = ("INSERT INTO members (Id, firstname, lastname, middlename, exname, address, age, type, date, contrib, withdraw, difference) VALUES
      			(null, '$fname', '$lname', '$mname', '$ename', '$address', '$age', '$type', null , '0', '0' ,'0' )");
      			$adds = mysqli_query($connect, $add);
      		Print '<script>alert("You Have Successfull Created A New Account!");</script>'; //failed
			Print '<script>window.location.assign("../User/Dashboard.php");</script>';
		}else{
				Print '<script>window.location.assign("../User/Dashboard.php");</script>';
    		}
	}
?>