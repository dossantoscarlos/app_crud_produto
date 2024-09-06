<?php 

require_once __DIR__.'/../model/Produto.php';
require_once __DIR__.'/../dao/ProdutoDAO.php';

class ProdutoController 
{

    private ProdutoDAO $dao_produto;

    public function __construct() {
        $this->dao_produto = new ProdutoDAO();
    }

    public function create() {
        
        $descricao = trim(htmlspecialchars(filter_input(INPUT_POST, 'descricao')));
        $qtde = trim(htmlspecialchars(filter_input(INPUT_POST, 'qtde', FILTER_VALIDATE_INT)));
        $preco = trim(htmlspecialchars(filter_input(INPUT_POST, 'preco' )));
        $data_vcto = trim(htmlspecialchars(filter_input(INPUT_POST, 'data_vcto')));
        $grupo_id = trim(htmlspecialchars(filter_input(INPUT_POST, 'grupo_id', FILTER_VALIDATE_INT)));

        if (!empty($descricao) && !empty($qtde) && !empty($preco) && !empty($data_vcto) && !empty($grupo_id)) {

            $produto = new Produto(
                $descricao,
                $qtde,
                $preco,
                $data_vcto,
                $grupo_id
            );

            $produto_id = $this->dao_produto->createProduto($produto);

            if ($produto_id) {
                echo "Produto criado com sucesso!";
            }
        }
    }


    public function getProdutos() {
        $result = $this->dao_produto->allProdutos();
        return $result;
    }

    public function update() {
        $id = trim(htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)));
        $descricao = trim(htmlspecialchars(filter_input(INPUT_POST, 'descricao')));
        $qtde = trim(htmlspecialchars(filter_input(INPUT_POST, 'qtde', FILTER_VALIDATE_INT)));
        $preco = trim(htmlspecialchars(filter_input(INPUT_POST, 'preco' )));
        $data_vcto = trim(htmlspecialchars(filter_input(INPUT_POST, 'data_vcto')));
        $grupo_id = trim(htmlspecialchars(filter_input(INPUT_POST, 'grupo_id', FILTER_VALIDATE_INT)));

        if (!empty($descricao) && !empty($qtde) && !empty($preco) && !empty($data_vcto) && !empty($grupo_id) && !empty($id)) {

            if (sizeof($this->dao_produto->getProdutosById($id)) > 0 ) {
                $produto = new Produto(
                    $descricao,
                    $qtde,
                    $preco,
                    $data_vcto,
                    $grupo_id
                );

                $result = $this->dao_produto->updateProdutos($id, $produto);

                if ($result) {
                    echo "Produto atualizado com sucesso!";
                }
            } else {
                echo "Produto não encontrado!";
            }
        }
    }


    public function delete() {
        try {
            $id = trim(htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)));
            $this->dao_produto->deleteProdutos($id);
        } catch (\PDOException $e) {
            echo "Error ao deletar o registro: ";
        }

    }
}

