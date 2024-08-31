<?php
require_once("../../includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silicium</title>
    <link rel="stylesheet" href="../../public/css/id_styles.css">
</head>
<body>
    <div>
        <form id="loginForm" action="" method="post" class="form">
            <h2>User Login</h2>
            <?php
                session_start();
                success();
            ?>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Username" name="username" value="" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password" required>
            </div>
            <button type="submit" name="login_submit">Login</button>
            <a href="register.php">You still do not have an account?</a>
        </form>
    </div>
</body>
</html>
