<?php include "../php/session.php" ?>
<?php include('../php/register-exec.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../Css/style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('../php/errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>" Placeholder ="Username">
		</div>

		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" id="password"  value="<?php echo $password; ?>" Placeholder = "Password">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="confirm" id="confirm_password" value="<?php echo $confirm; ?>" placeholder ="Confirm Password">
		</div>

		<div class="input-group">
			<label>Type of Acccout</label>
				<select name = "type" id= "select"  value="<?php echo $type ?>" required>
					<option selected="false" value="" disabled="disabled" required><p>Choose Account Type</p></option>
					<option name="1" value="1">Admin</option>
					<option name="2" value="2">User</option>
				</select>
		</div>


		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="../index.php?logout='1'">Sign in</a> | 
			<a href="../Admin/Dashboard.php">Cancel</a> 
		</p>

	</form>


			<script>
				$('#password, #confirm_password').on('keyup', function () {
			    if ($('#password').val() == $('#confirm_password').val()) {
			        $('#message').html('Matching').css('color', 'green');
			    } else 
			        $('#message').html('Not Matching').css('color', 'red');
				});
			 </script>
</body>
</html>