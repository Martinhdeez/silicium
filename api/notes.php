<?php
require_once "../auth/auth.php";
require_once "../config/db.php";


// Configuración de cabeceras para permitir solicitudes desde cualquier origen (CORS)
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: http://localhost/silicium"); 
header("Access-Control-Allow-Credentials: true");

// Inicializar la base de datos y el controlador
$db = new Db();
$notesController = new NotesController($db->connect());


$method = $_SERVER['REQUEST_METHOD'];
//$note_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$note_id = isset($_GET['id']) ? $_GET['id'] : null;

// if (isset($_SESSION['user_id'])) {
//     $user_id = $_SESSION['user_id'];
// } else {
//     echo json_encode(array('error'=> 'USER ID NOT FOUND'));
//     exit;
// }
$user_id = 3;


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
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
