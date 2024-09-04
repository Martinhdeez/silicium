<?php
require_once("../../includes/functions.php");
require_once("../../layouts/id_header.php");
session_start();
?>
 <div class="register-container">
    <form action="../../controllers/id/registerController.php" method="post" class="register-form">
        <h2 class="register-title">User Registration</h2>
        <?php success(); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Username" name="username" value="<?= isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required class="form-input">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" name="email" value="<?= isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required class="form-input">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password" required class="form-input">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required class="form-input">
        </div>
        <button type="submit" name="register_submit" class="register-button">Register</button>
        <a href="login.php" class="login-link">Do you already have an account?</a>
    </form>
</div>

</body>
</html>
