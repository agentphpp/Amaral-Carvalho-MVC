<?php
    class Avaliacao
    {
        public function __construct(
            private int $id_avaliacao = 0,
            // Associações: quem avaliou (Usuario) e qual jogo foi avaliado (Jogo)
            private ?Usuario $usuario = null,
            private ?Jogo $jogo = null,
            private int $nota = 5,
            private string $comentario = "",
            private ?string $criado_em = null
        ){}
        public function getId_avaliacao(){ return $this->id_avaliacao; }
        public function getUsuario(){ return $this->usuario; }
        public function getJogo(){ return $this->jogo; }
        public function getNota(){ return $this->nota; }
        public function getComentario(){ return $this->comentario; }
        public function getCriado_em(){ return $this->criado_em; }
        public function setId_avaliacao($id_avaliacao){ $this->id_avaliacao = $id_avaliacao; }
        public function setUsuario(Usuario $usuario){ $this->usuario = $usuario; }
        public function setJogo(Jogo $jogo){ $this->jogo = $jogo; }
        public function setNota($nota){ $this->nota = $nota; }
        public function setComentario($comentario){ $this->comentario = $comentario; }
    }
?>
