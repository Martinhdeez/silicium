<?php
require_once("../../layouts/header.php");
require_once("../../includes/functions.php");
?>
    <div>
        <form action="" method="post">
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
