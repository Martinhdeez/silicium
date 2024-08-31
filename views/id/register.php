<?php
require_once("../../includes/functions.php");
require_once("../../layouts/id_header.php");
session_start();
?>

     <div>
        <form action="../../controllers/id/registerController.php" method="post">
            <h2>User Registration</h2>
            <?php success(); ?>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Username" name="username" value="<?=isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" name="email" value="<?=isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
            </div>
            <button type="submit" name="register_submit">Register</button>
            <a href="login.php">Do you already have an account?</a>
        </form>
    </div>
</body>
</html>
