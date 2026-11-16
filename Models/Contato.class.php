<?php
    class Contato
    {
        public function __construct(
            private int $id_contato = 0,
            private string $nome = "",
            private string $assunto = "",
            private string $email = "",
            private string $mensagem = "",
            private ?string $criado_em = null
        ){}
        public function getId_contato(){ return $this->id_contato; }
        public function getNome(){ return $this->nome; }
        public function getAssunto(){ return $this->assunto; }
        public function getEmail(){ return $this->email; }
        public function getMensagem(){ return $this->mensagem; }
        public function getCriado_em(){ return $this->criado_em; }
        public function setNome($nome){ $this->nome = $nome; }
        public function setAssunto($assunto){ $this->assunto = $assunto; }
        public function setEmail($email){ $this->email = $email; }
        public function setMensagem($mensagem){ $this->mensagem = $mensagem; }
    }
?>
