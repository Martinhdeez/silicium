<?php
require_once("../../config/db.php");
// controllers/api/router.php

// Conectar a la base de datos
$database = new Db();
$pdo = $database->connect();

// Obtener la ruta solicitada
$request = trim($_SERVER['REQUEST_URI'], '/');

// Dividir la URL en partes
$url_parts = explode('/', $request);

// Comprobar si se está llamando a la API de "notes"
if ($url_parts[0] === 'notes') {
    // Cargar el controlador correspondiente
    require_once 'NotesController.php';
    $controller = new NotesController($pdo);

    // Determinar el método HTTP
    $method = $_SERVER['REQUEST_METHOD'];
    $user_id = 1;  // Usuario predefinido

    switch ($method) {
        case 'GET':
            if (isset($url_parts[1])) {
                echo json_encode($controller->getNote($user_id, $url_parts[1]));
            } else {
                echo json_encode($controller->getAllNotes($user_id));
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->createNote($user_id, $data));
            break;
        case 'PUT':
            if (isset($url_parts[1])) {
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($controller->updateNote($user_id, $url_parts[1], $data));
            }
            break;
        case 'DELETE':
            if (isset($url_parts[1])) {
                echo json_encode($controller->deleteNote($user_id, $url_parts[1]));
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Recurso no encontrado']);
}
