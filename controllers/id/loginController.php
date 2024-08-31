<?php
// Incluir los archivos necesarios
require_once '../../config/db.php';
require_once '../../models/User.php';
session_start(); // Iniciar la sesión

// Verificar si el formulario de login fue enviado
if (isset($_POST['login_submit'])) {
    // Crear una instancia de la clase Database y establecer la conexión
    $database = new Db();
    $db = $database->connect();

    if ($db) { // Asegurarse de que la conexión se estableció correctamente
        // Crear una instancia del modelo User
        $user = new User($db);
        // Asignar los valores del formulario a las propiedades del modelo User
        $user->username = trim($_POST['username']);
        $user->password = trim($_POST['password']);

        // Guardar los datos del formulario en la sesión
        $_SESSION['form_data'] = [
            'username' => $_POST['username']
        ];

        // Llamar al método login del modelo User
        $result = $user->login();

        // Verificar si el login fue exitoso
        if ($result === true) {
            // Limpiar los datos del formulario de la sesión
            unset($_SESSION['form_data']);
            // Almacenar datos en sesión
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            // Redirigir al usuario a la página de inicio
            header("Location: ../../views/index.php");
            exit();
        } else {
            // Almacenar el mensaje de error en la sesión
            $_SESSION['error'] = $result;
        }
    } else {
        $_SESSION['error'] = "Failed to connect to the database.";
    }
    // Redirigir de vuelta a la página de login para mostrar el mensaje de error
    header("Location: ../../views/id/login.php");
    exit();
} else {
    header("Location: ../../views/id/login.php");
    exit();
}