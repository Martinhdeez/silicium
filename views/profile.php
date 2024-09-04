<?php
require_once "../auth/auth.php";
require_once "../config/db.php";

$db = new Db();


$user_id = $_SESSION['user_id'];

$user = $db->getUser($user_id);

// Manejo del formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user =$db->updateUser($username, $email , $password,  $user_id);

    $_SESSION['username'] = $username;

    // Redirige a la misma página para mostrar los cambios
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tu propio CSS aquí -->
</head>
<body>
    <h1>Profile</h1>

    <form action="profile.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div>
            <label for="password">New password :</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <button type="submit">Save changes</button>
        </div>
        <div>
            <a href="index.php">Back to notes</a>
        </div>
    </form>
</body>
</html>
