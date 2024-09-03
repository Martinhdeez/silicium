<?php
//require_once "../../config/db.php";

class NotesController {
    
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllNotes($user_id){
        try {

            $stmt = $this->db->prepare("SELECT * FROM notes WHERE user_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getNote($user_id, $note_id){
        try {
            $stmt = $this->db->prepare("SELECT * FROM notes WHERE user_id = ? AND id = ?");
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
            $stmt = $this->db->prepare("INSERT INTO notes(user_id, title, note) VALUES(?, ?, ?)");
            if ($stmt->execute([$user_id, $data['title'], $data['note']])) {
                return ['id' => $this->db->lastInsertId(), 'title' => $data['title'], 'note' => $data['note']];
            }
            return null;
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateNote($user_id, $note_id, $data){
        try {
            $stmt = $this->db->prepare("UPDATE notes SET title = ?, note = ? WHERE user_id = ? AND id = ?");
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
            $stmt = $this->db->prepare("DELETE FROM notes WHERE user_id = ? AND id = ?");
            return $stmt->execute([$user_id, $note_id]);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
