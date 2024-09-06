<?php 

require_once __DIR__.'/../config/database.php';

class ProdutoDAO {
    
    private int $id;

    private PDO $db;

    public function __construct() {
        $connection = new Database();
        $this->db = $connection->getConnection();
    }

    public function createProduto(Produto $produto) {

        $query = $this->db->prepare(
            "INSERT INTO produtos (
                descricao, qtde, preco, data_vcto, grupo_id
            ) 
            VALUES (
                :descricao, :qtde, :preco, :data_vcto, :grupo_id
            )"
        );

        $query->bindParam(':descricao', $produto->descricao);
        $query->bindParam(':qtde', $produto->qtde);
        $query->bindParam(':preco', $produto->preco);
        $query->bindParam(':data_vcto', $produto->data_vcto);
        $query->bindParam(':grupo_id', $produto->grupo_id);
        $query->execute();

        $this->id = $this->db->lastInsertId();

        return $this->id;
    }

    public function allProdutos() {
        $query = $this->db->prepare("SELECT * FROM produto");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProdutosById(int $id) {
        $query = $this->db->prepare("SELECT * FROM produtos WHERE produto_id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateProdutos(int $id, Produto $produto ) : int 
    {
        print_r($produto);
        try {
            $query = $this->db->prepare("UPDATE produtos SET descricao = :descricao,
                qtde = :qtde, preco = :preco,
                data_vcto = :data_vcto,
                grupo_id = :grupo_id
                WHERE produto_id = :id"
            );
            
            $query->bindParam(':descricao', $produto->descricao);
            $query->bindParam(':qtde', $produto->qtde);
            $query->bindParam(':preco', $produto->preco);
            $query->bindParam(':data_vcto', $produto->data_vcto);
            $query->bindParam(':grupo_id', $produto->grupo_id);
            $query->bindParam(':id', $id);

            $query->execute();

            $result = $query->rowCount();
            
            if ($result > 0) {
                $this->id = $this->db->lastInsertId();
            }
            
            return $this->id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function deleteProdutos(int $id) {
        try {
            $query = $this->db->prepare("DELETE FROM produtos WHERE produto_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}