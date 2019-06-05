<?php include "../php/session.php" ?>
<?php include('../php/changepass-exc.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cooperative</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../Css/style.css">
</head>
<body>
	<div class="header">
		<h2>Change Password</h2>
	</div>
	
	<form method="post" action="changepass.php">

		<?php include('../php/errors.php'); ?>

		<div class="input-group">
			<!-- <label>Username</label>	 -->
	        	<?php  if (isset($_SESSION['username'])) : ?>
					<input type="hidden" name="username" value="<?php echo $password; ?>" Placeholder ="Username" >
				<?php endif ?>
		</div>

		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" id="password"  value="<?php echo $password; ?>" Placeholder = "Password">
		</div>
		<div class="input-group">
			<label>New password</label>
			<input type="password" name="npassword" id="confirm_password" value="<?php echo $npassword; ?>" placeholder ="Confirm Password">
		</div>

		<div class="input-group">
			<label>Confirm New password</label>
			<input type="password" name="nconfirm" id="confirm_password" value="<?php echo $nconfirm; ?>" placeholder ="Confirm Password">
		</div>


		<div class="input-group">
			<button type="submit" class="btn" name="change_users">Change</button>
		</div>
		<p>
			Not Now? <a href="../User/Dashboard.php">Dashboard</a>
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