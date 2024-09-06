<?php 

class Produto {

    public function __construct(
        public string $descricao,
        public int $qtde,
        public string $preco,
        public string $data_vcto,
        public int $grupo_id,
    ) { }
   
}