<?php
    class Categoria
    {
        public function __construct(
            private int $id_categoria = 0,
            private string $nome = "",
            // derivado: quantidade de jogos da categoria (não é coluna do banco)
            private int $totalJogos = 0
        ){}
        public function getId_categoria(){ return $this->id_categoria; }
        public function getNome(){ return $this->nome; }
        public function getTotalJogos(){ return $this->totalJogos; }
        public function setId_categoria($id_categoria){ $this->id_categoria = $id_categoria; }
        public function setNome($nome){ $this->nome = $nome; }
    }
?>
