<?php 

require_once __DIR__.'/../model/Grupo.php';
require_once __DIR__.'/../dao/GrupoDAO.php';

class GrupoController {

    private $dao_grupo;

    public function __construct() {
        $this->dao_grupo = new GrupoDAO();
    }   

    public function create() {
        $nome = trim(htmlspecialchars(filter_input(INPUT_POST, 'nome')));
        if (!empty($nome)) {
            $grupo = new Grupo($nome);
            $this->dao_grupo->createGroup($grupo);
        }
    }

    public function allGroups() {
        return $this->dao_grupo->allGroups();
    
    }

    public function getGroupById() {
        $id = trim(htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)));
        return $this->dao_grupo->getGroupById($id);
    }

    public function update() {
        $id = trim(htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)));
        $nome = trim(htmlspecialchars(filter_input(INPUT_POST, 'nome')));
        if (!empty($nome)) {
            $grupo = new Grupo($nome);
            $this->dao_grupo->updateGroup($id, $grupo);
        }
    }

    public function delete() {
        $id = trim(htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)));
        $this->dao_grupo->deleteGroup($id);
    }   
}