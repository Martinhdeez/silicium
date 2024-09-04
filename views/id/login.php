<?php
require_once("../../includes/functions.php");
require_once("../../layouts/id_header.php");
?>
    <div class="login-container">
    <form action="../../controllers/id/loginController.php" method="post" class="login-form">
        <h2 class="login-title">User Login</h2>
        <?php
            session_start();
            success();
        ?>
        <div class="input-group">
            <label for="username" class="input-icon">
                <img src="../../public/img/perfil.png" alt="User Icon">
            </label>
            <input type="text" id="username" placeholder="Username" name="username" value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required class="form-input">
        </div>
        <div class="input-group">
            <label for="password" class="input-icon">
                <img src="../../public/img/cerradura.png" alt="Password Icon">
            </label>
            <input type="password" id="password" placeholder="Password" name="password" required class="form-input">
        </div>
        <button type="submit" name="login_submit" class="login-button">Login</button>
        <a href="register.php" class="register-link">You still do not have an account?</a>
    </form>
    </div>

</body>
</html>
