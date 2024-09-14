<?php

class Db{
    private $servername= "localhost";
    private $username= "root";
    private $password= "";
    private $dbname= "sicilium";
    private $conn;

    
    public function __construct() {
        $this->connect();
    }

    //método para establecer la base de datos
    public function connect() {

        $this->conn = null;

        try {
            // Intentar crear una nueva conexión PDO con los detalles proporcionados
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // Establecer el modo de error de PDO para que lance excepciones
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
            
        } catch(PDOException $e) {
            // Si ocurre un error, captura la excepción y muestra un mensaje de error
            echo 'Connection Error: ' . $e->getMessage();
        }

        // Retorna la conexión establecida (o null si falló)
        return $this->conn;
    }


    //Método para ejecutar una consulta SQL con parámetros opcionales
    public function query($sql, $params=[]){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);//retorna un booleano si la consulta fue exitosa o no
        return $stmt;//boleano
    }

     // Método para ejecutar una consulta y obtener un solo registro
    public function fetch($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        //Retornar un solo regisro como array asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC);/*devuelve el resultado de la consulta, toda la primera fila, 
                                            solo un array y tu después puedes acceder al parámetro que quiera*/
    }

    public function fetchAll($sql, $params = []) {
        //ejecuta la consulta usado query , basicamente preparar y ejecutar la conexión
        $stmt = $this->query($sql, $params);
        //Retornar todos los registros como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);/*en el caso que haya más de una fila en el resultado de consulta SQL 
                                                devuelve una lista de arrays con todos los resultados, un array por fila */ 
    }  


    //funciones Notes
    public function getAllNotes($user_id){
        try {

            $stmt = $this->conn->prepare("SELECT * FROM notes WHERE user_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getNote($user_id, $note_id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM notes WHERE user_id = ? AND id = ?");
            $stmt->execute([$user_id, $note_id]);
            $note = $stmt->fetch(PDO::FETCH_ASSOC); 
            
            // Verifica si se obtuvo una nota
            if ($note) {
                return $note; 
            } else {
                return ['error' => 'Nota no encontrada.']; 
            }
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
    

    public function createNote($user_id, $data){
        try {
            $stmt = $this->conn->prepare("INSERT INTO notes(user_id, title, note) VALUES(?, ?, ?)");
            if ($stmt->execute([$user_id, $data['title'], $data['note']])) {
                return ['id' => $this->conn->lastInsertId(), 'title' => $data['title'], 'note' => $data['note']];
            }
            return null;
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateNote($user_id, $note_id, $data){
        try {
            $stmt = $this->conn->prepare("UPDATE notes SET title = ?, note = ? WHERE user_id = ? AND id = ?");
            if ($stmt->execute([$data['title'], $data['note'], $user_id, $note_id])){
                return ['id'=>$note_id, 'title' => $data['title'], 'note' => $data['note']];
            }
            return null;
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteNote($user_id, $note_id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM notes WHERE user_id = ? AND id = ?");
            return $stmt->execute([$user_id, $note_id]);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }


    //funciones de usuario
    public function getUser($user_id){
        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); 
            
            // Verifica si se obtuvo una nota
            if ($user) {
                return $user; 
            } else {
                return ['error' => 'Usuario no encontrada.']; 
            }
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateUser($username, $email, $password,  $user_id){
         
    if ($password) {
            try {
                $stmt = $this->conn->prepare("UPDATE users SET username = ?, email = ? , password = ? WHERE id = ?");
                if ($stmt->execute([$username, $email, $password, $user_id])) {
                    return ['id'=>$user_id, 'username' => $username ,'email' => $email];
                }
                return null;
            } catch (PDOException $e) {
                return ['error' => $e->getMessage()];
            }
        } else {
            try {

                $stmt = $this->conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                if ($stmt->execute([$username, $email, $user_id])) {
                    return ['id'=>$user_id, 'username' => $username ,'email' => $email];
                }
                return null;
            } catch (PDOException $e) {
                return ['error' => $e->getMessage()];
            }
        }
    }
}



