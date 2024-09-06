<?php 

require_once __DIR__.'/../config/database.php';

class GrupoDAO 
{

    private PDO $db;
    private int $id;

    public function __construct() {
        try {
            $connection = new Database();
            $this->db = $connection->getConnection();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createGroup(Grupo $grupo) : int 
    {
        try {
            $query = $this->db->prepare("INSERT INTO grupos (nome) VALUES (:nome)");
            $query->bindParam(':nome', $grupo->nome);
            $query->execute();
            $this->id = $this->db->lastInsertId();
            
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $this->id;
    }

    public function allGroups() {
        $query = $this->db->prepare("SELECT * FROM grupos");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getGroupById(int $id) 
    {
        
        try {
            $query = $this->db->prepare("SELECT * FROM grupos WHERE grupo_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $e->getMessage();
        }

        return $result;
    }

    public function updateGroup(int $id, Grupo $grupo) : int 
    {   
        try {
            $query = $this->db->prepare("UPDATE grupos SET nome = :nome WHERE grupo_id = :id");
            $query->bindParam(':nome', $grupo->nome);
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }

        $this->id = $this->db->lastInsertId();
        
        return $this->id;
    }

    public function deleteGroup(int $id) : void 
    {
        try {
            $query = $this->db->prepare("DELETE FROM grupos WHERE grupo_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }
}