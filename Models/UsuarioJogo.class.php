<?php
    // Classe associativa entre Usuario e Jogo (igual ao exemplo Atuacao: Filme x Ator).
    // Guarda os dados do relacionamento: tempo de uso e data do acesso.
    class UsuarioJogo
    {
        public function __construct(
            private int $id_usuario_jogo = 0,
            private ?Usuario $usuario = null,
            private ?Jogo $jogo = null,
            private int $tempo_duracao = 0,
            private ?string $data_acesso = null
        ){}
        public function getId_usuario_jogo(){ return $this->id_usuario_jogo; }
        public function getUsuario(){ return $this->usuario; }
        public function getJogo(){ return $this->jogo; }
        public function getTempo_duracao(){ return $this->tempo_duracao; }
        public function getData_acesso(){ return $this->data_acesso; }
        public function setId_usuario_jogo($id){ $this->id_usuario_jogo = $id; }
        public function setUsuario(Usuario $usuario){ $this->usuario = $usuario; }
        public function setJogo(Jogo $jogo){ $this->jogo = $jogo; }
        public function setTempo_duracao($tempo_duracao){ $this->tempo_duracao = $tempo_duracao; }
    }
?>
