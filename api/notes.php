<?php
require_once "../config/db.php";
require_once "../controllers/api/NotesController.php";

// Configuración de cabeceras para permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inicializar la base de datos y el controlador
$db = new Db();
$notesController = new NotesController($db->connect());

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];
$user_id = $_GET['user_id'] ?? null;
$note_id = $_GET['note_id'] ?? null;

// Manejar las solicitudes según el método HTTP
switch ($method) {
    
    case 'GET':
        if ($note_id) {
            $result = $notesController->getNote($user_id, $note_id);
        } else {
            $result = $notesController->getAllNotes($user_id);
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $notesController->createNote($user_id, $data);
        echo json_encode($result);
        break;

    case 'PUT':
        if ($note_id) {
            $data = json_decode(file_get_contents("php://input"), true);
            $result = $notesController->updateNote($user_id, $note_id, $data);
            echo json_encode($result);
        }
        break;

    case 'DELETE':
        if ($note_id) {
            $result = $notesController->deleteNote($user_id, $note_id);
            echo json_encode($result);
        }
        break;

    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
