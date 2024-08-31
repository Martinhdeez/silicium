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

    public function getNote($user_id){
        
    }


}