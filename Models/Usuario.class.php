<?php
    class Usuario
    {
        public function __construct(
            private int $id_usuario = 0,
            private string $nome_usuario = "",
            private string $nome_completo = "",
            private string $email = "",
            private string $senha = "",
            private string $tipo_acesso = "usuario",
            private ?string $avatar_foto = null,
            private ?string $data_nascimento = null,
            private ?string $criado_em = null
        ){}
        public function getId_usuario(){ return $this->id_usuario; }
        public function getNome_usuario(){ return $this->nome_usuario; }
        public function getNome_completo(){ return $this->nome_completo; }
        public function getEmail(){ return $this->email; }
        public function getSenha(){ return $this->senha; }
        public function getTipo_acesso(){ return $this->tipo_acesso; }
        public function getAvatar_foto(){ return $this->avatar_foto; }
        public function getData_nascimento(){ return $this->data_nascimento; }
        public function getCriado_em(){ return $this->criado_em; }
        public function ehAdmin(){ return $this->tipo_acesso === "admnistrador"; }
        public function setId_usuario($id_usuario){ $this->id_usuario = $id_usuario; }
        public function setNome_usuario($nome_usuario){ $this->nome_usuario = $nome_usuario; }
        public function setNome_completo($nome_completo){ $this->nome_completo = $nome_completo; }
        public function setEmail($email){ $this->email = $email; }
        public function setSenha($senha){ $this->senha = $senha; }
        public function setTipo_acesso($tipo_acesso){ $this->tipo_acesso = $tipo_acesso; }
        public function setAvatar_foto($avatar_foto){ $this->avatar_foto = $avatar_foto; }
        public function setData_nascimento($data_nascimento){ $this->data_nascimento = $data_nascimento; }
    }
?>
