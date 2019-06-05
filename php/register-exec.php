<?php
	/*$db = mysqli_connect('localhost', 'root', '12345678', 'DB-Login');*/

	require 'connection.php';

	#variable Decleration
		$username = '';
		$password = '';
		$confirm = '';
		$type = '';
		$errors = array();
		$_SESSION['success'] = "";


	if (isset($_POST ['reg_user'])) {

		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$confirm = mysqli_real_escape_string ($connect, $_POST['confirm']);
		$type = mysqli_real_escape_string($connect, $_POST['type']);

			#checking stage if input are empty or not
			if (empty($username)) {array_push($errors, "Username is required"); }
			if (empty($password)) {array_push($errors, "Password is required"); }
			if (empty($confirm )) {array_push($errors, "Confirm password is required"); }
			if (empty($type)) {array_push ($errors, "Select an type");}

			# checking for confirm password
			if($password != $confirm) {array_push($errors, "Password does not match"); }

			# checking for username if already exist
			$select = ("SELECT * FROM users where Username ='$username'");
				$check = mysqli_query($connect, $select);
			if(mysqli_num_rows($check) != 0){
				array_push($errors, "Username already used");
			}
/*
					$select =("SELECT * FROM users where username='$username' ");
			$check = mysqli_query($connect,$select);
		if (mysqli_num_rows($check) !=0) {array_push($errors, "Username is already be taken");}*/

			#inserting to database
			if (count($errors) == 0) {
				$password = md5 ($password);
					$insert = ("INSERT INTO users (Id, Username, Password, Role, Date ) VALUES (null, '$username', '$password', '$type', null )");
					$query = mysqli_query($connect, $insert);
						Print '<script>alert("You Have Successfull Created A New Account!");</script>'; //failed
						Print '<script>window.location.assign("../Admin/Dashboard.php");</script>';
			}
	}



?>