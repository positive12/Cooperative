<?php
/*	$db = mysqli_connect('localhost', 'root', '12345678', 'DB-Login');*/
	require 'connection.php';


		#variable Decleration
			$username = '';
			$password = '';
			$npassword = '';
			$nconfirm = '';
			$errors = array();
			$_SESSION['success'] = "";

			if (isset($_POST ['change_user'])) {
						$username = mysqli_real_escape_string ($connect,  $_SESSION['username']);
						$password = mysqli_real_escape_string ($connect, $_POST['password']);
						$npassword = mysqli_real_escape_string ($connect, $_POST['npassword']);
						$nconfirm = mysqli_real_escape_string ($connect, $_POST['nconfirm']);

					if (empty($username)) {array_push($errors, "Username is required"); }
					if (empty($password)) {array_push($errors, "Password is required"); }
					if (empty($npassword )) {array_push($errors, "New password is required"); }
					if (empty($nconfirm)) {array_push ($errors, "Confirm new password");}

					if($npassword != $nconfirm) {array_push($errors, "New Password does not match"); }

					if (count($errors)==0 ) {
						$password = md5($password);
						$select = ("SELECT * FROM users WHERE Username='$username' AND Password='$password' ");
						$check = mysqli_query($connect, $select);

						if (mysqli_num_rows($check) == 1) {
							$update = "UPDATE users set password = MD5('$npassword') where username = '$username'";
							$checks = mysqli_query($connect, $update);
							
							Print '<script>alert("You Have Successfull Created A New Account!");</script>'; //failed
							Print '<script>window.location.assign("../Admin/Dashboard.php");</script>';

						}else{
							Print '<script>alert("Sorry Username and Password Does now Exist!");</script>'; //failed
							Print '<script>window.location.assign("changepass.php");</script>';  
					}
			}
		}



 ?>
 <?php
	/*$db = mysqli_connect('localhost', 'root', '12345678', 'DB-Login');*/
	require 'connection.php';



		#variable Decleration
			$username = '';
			$password = '';
			$npassword = '';
			$nconfirm = '';
			$errors = array();
			$_SESSION['success'] = "";

			if (isset($_POST ['change_users'])) {
						$username = mysqli_real_escape_string ($connect,  $_SESSION['username']);
						$password = mysqli_real_escape_string ($connect, $_POST['password']);
						$npassword = mysqli_real_escape_string ($connect, $_POST['npassword']);
						$nconfirm = mysqli_real_escape_string ($connect, $_POST['nconfirm']);

					if (empty($username)) {array_push($errors, "Username is required"); }
					if (empty($password)) {array_push($errors, "Password is required"); }
					if (empty($npassword )) {array_push($errors, "New password is required"); }
					if (empty($nconfirm)) {array_push ($errors, "Confirm new password");}

					if($npassword != $nconfirm) {array_push($errors, "New Password does not match"); }

					if (count($errors)==0 ) {
						$password = md5($password);
						$select = ("SELECT * FROM users WHERE Username='$username' AND Password='$password' ");
						$check = mysqli_query($connect, $select);

						if (mysqli_num_rows($check) == 1) {
							$update = "UPDATE users set password = MD5('$npassword') where username = '$username'";
							$checks = mysqli_query($connect, $update);
							
							Print '<script>alert("You Have Successfull Created A New Account!");</script>'; //failed
							Print '<script>window.location.assign("../User/Dashboard.php");</script>';

						}else{
							Print '<script>alert("Sorry Username and Password Does now Exist!");</script>'; //failed
							Print '<script>window.location.assign("changepass.php");</script>';
					}
			}
		}



 ?>