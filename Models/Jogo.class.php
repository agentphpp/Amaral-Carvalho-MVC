<?php
    class Jogo
    {
        public function __construct(
            private int $id_jogo = 0,
            private string $nome = "",
            private string $finalidade = "",
            // Associação unilateral: o jogo conhece a sua categoria (N jogos : 1 categoria)
            private ?Categoria $categoria = null,
            private string $descricao = "",
            private string $faixa_etaria = "",
            private string $duracao_estimada = "",
            private string $img = "",
            private string $link = "",
            private ?string $criado_em = null,
            // derivado: média das notas das avaliações (não é coluna do banco)
            private ?float $mediaAvaliacoes = null,
            private int $totalAvaliacoes = 0
        ){}
        public function getId_jogo(){ return $this->id_jogo; }
        public function getNome(){ return $this->nome; }
        public function getFinalidade(){ return $this->finalidade; }
        public function getCategoria(){ return $this->categoria; }
        public function getDescricao(){ return $this->descricao; }
        public function getFaixa_etaria(){ return $this->faixa_etaria; }
        public function getDuracao_estimada(){ return $this->duracao_estimada; }
        public function getImg(){ return $this->img; }
        public function getLink(){ return $this->link; }
        public function getCriado_em(){ return $this->criado_em; }
        public function getMediaAvaliacoes(){ return $this->mediaAvaliacoes; }
        public function getTotalAvaliacoes(){ return $this->totalAvaliacoes; }
        public function setId_jogo($id_jogo){ $this->id_jogo = $id_jogo; }
        public function setNome($nome){ $this->nome = $nome; }
        public function setFinalidade($finalidade){ $this->finalidade = $finalidade; }
        public function setCategoria(Categoria $categoria){ $this->categoria = $categoria; }
        public function setDescricao($descricao){ $this->descricao = $descricao; }
        public function setFaixa_etaria($faixa_etaria){ $this->faixa_etaria = $faixa_etaria; }
        public function setDuracao_estimada($duracao_estimada){ $this->duracao_estimada = $duracao_estimada; }
        public function setImg($img){ $this->img = $img; }
        public function setLink($link){ $this->link = $link; }
    }
?>
