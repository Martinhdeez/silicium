<?php

$baseURL = "http://localhost/silicium/api/notes.php";

//funcion notas GET
function getNotes() {

    global $baseURL;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);

}

// Función para obtener una nota específica por ID (GET)
function getNote($id) {
    
    global $baseURL;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseURL . '?id=' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }
    
    curl_close($ch);
    return json_decode($response, true);
}

// Función para crear una nueva nota (POST)
function createNote($data) {
    global $baseURL;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    return json_decode($response, true);
}

// Función para actualizar una nota existente por ID (PUT)
function updateNote($id, $data) {
    global $baseURL;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseURL . '?id=' . $id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    return json_decode($response, true);
}

// Función para eliminar una nota por ID (DELETE)
function deleteNote($id) {
    global $baseURL;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseURL . '?id=' . $id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    return json_decode($response, true);
}
