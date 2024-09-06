<?php 

require_once __DIR__ . '/controllers/ProdutoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/produto/save') {
    $controller = new ProdutoController();
    $controller->create();
} else {
    require_once __DIR__ . '/../views/form-produto.php';
}
