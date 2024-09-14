<?php
// Incluir los archivos necesarios
require_once '../../config/db.php';
require_once '../../models/User.php';
session_start(); // Iniciar la sesión

// Verificar si el formulario fue enviado
if (isset($_POST['register_submit'])) {
    // Crear una instancia de la clase Database y establecer la conexión
    $database = new Db();
    $db = $database->connect();

    if ($db) { // Asegurarse de que la conexión se estableció correctamente
        // Crear una instancia del modelo User
        $user = new User($db);
        // Asignar los valores del formulario a las propiedades del modelo User
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $confirmPass = $_POST['confirm_password'];

        // Almacenar los datos del formulario en la sesión
        $_SESSION['form_data'] = [
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ];

        // Verificar si las contraseñas coinciden
        if ($user->password === $confirmPass) {
            // Llamar al método register del modelo User
            $result = $user->register();

            // Verificar si el registro fue exitoso
            if ($result === true) {
                // Limpiar los datos del formulario de la sesión
                unset($_SESSION['form_data']);
                // Redirigir al usuario a la página de inicio de sesión con un mensaje de éxito
                $_SESSION['success'] = "¡Registro exitoso! Por favor, inicia sesión.";
                header("Location: ../../views/id/login.php?registration=success");
                exit();
            } else {
                // Almacenar el mensaje de error en la sesión
                $_SESSION['error'] = $result;
            }
        } else {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
        }
    } else {
        $_SESSION['error'] = "Error al conectar con la base de datos."; // Mensaje de error si la conexión falla
    }

    header("Location: ../../views/id/register.php"); // Redirigir de vuelta a la página de registro para mostrar el mensaje
    exit();
}
?>