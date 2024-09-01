<?php

class NotesController {
        
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAllNotes($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNote($user_id, $note_id){
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE user_id = ? AND id = ?");
        $stmt->execute([$user_id, $note_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNote($user_id, $data){
        $stmt = $this->pdo->prepare("INSERT INTO notes(title, note) VALUES(?, ?) WHERE user_id = ?");
        if ($stmt->execute([$data['title'], $data['note'], $user_id])) {
            return ['id' => $this->pdo->lastInsertId(), 'title' => $data['title'], 'note' => $data['note']];
        }
        return null;
    }

    public function updateNote($user_id, $note_id, $data){
        $stmt = $this->pdo->prepare("UPDATE notes SET title = ?, note = ? WHERE user_id = ? AND id = ?");
        if ($stmt->execute([$data['title'], $data['note'], $user_id, $note_id])){
            return ['id'=>$note_id, 'title' => $data['title'], 'note' => $data['note']];
        }
        return null;
    }

    public function deleteNote($user_id, $note_id){
        $stmt = $this->pdo->prepare("DELETE FROM notes WHERE user_id = ? AND id = ?");
        return $stmt->execute([$user_id, $note_id]);
    }

}