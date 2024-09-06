<?php 

declare(strict_types=1);

class Database {
    
    private string $dbFile = __DIR__.'/./database.sqlite';

    private $connection;

    public function __construct() {
        try {
            
            $dsn = "sqlite:{$this->dbFile}";
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();
            echo "Conectado ao banco de dados";
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }  
    }

    public function getConnection() {
        return $this->connection;
    }

    private function createTables() : void { 
        $sql = "CREATE TABLE IF NOT EXISTS 'grupos' (
                grupo_id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome varchar(255) NOT NULL
            );
            CREATE TABLE IF NOT EXISTS 'produtos' (
                produto_id INTEGER PRIMARY KEY AUTOINCREMENT,
                descricao varchar(255) NOT NULL,
                qtde int(11) NOT NULL,
                preco varchar (255) NOT NULL,
                data_vcto varchar (255) NOT NULL,
                grupo_id INT NOT NULL,
                FOREIGN KEY (grupo_id) REFERENCES grupos (grupo_id)
                ON DELETE SET NULL
                ON UPDATE CASCADE
            );";        
            
        $this->connection->exec($sql);
    }
}

