<?php include('php/server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Fantastic Member Cooperative</title>
    <link rel="stylesheet" type="text/css" href="Css/style.css">
</head>
<body>

    <div class="header">
        <h3>Fantastic Member Cooperative</h3>
    </div>
    
    <form method="post" action="login.php">

        <?php include('php/errors.php'); ?> 

        <div class="input-group">
            <h3>Username</h3>
            <input type="text" name="username" placeholder="Username" >
        </div>
        <div class="input-group">
            <h3>Password</h3>
            <input type="password" name="password" placeholder="Password"></input>
        </div>
        <div class="input-group">
            <button type="submit" class="button button2" name="login_user">Login</button>
        </div>
    </form>


</body>
</html>