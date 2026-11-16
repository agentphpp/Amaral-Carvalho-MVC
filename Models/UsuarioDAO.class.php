<?php
    class UsuarioDAO extends Conexao
    {
        public function __construct($db = null)
        {
            parent::__construct($db);
        }
        private function hidratar($l)
        {
            return new Usuario(
                (int)$l["id_usuario"], $l["nome_usuario"], $l["nome_completo"], $l["email"],
                $l["senha"], $l["tipo_acesso"], $l["avatar_foto"], $l["data_nascimento"], $l["criado_em"]
            );
        }
        public function cadastrar(Usuario $u)
        {
            $sql = "INSERT INTO usuarios (nome_usuario, nome_completo, email, senha, tipo_acesso, avatar_foto, data_nascimento)
                    VALUES (?,?,?,?,?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $u->getNome_usuario());
                $stm->bindValue(2, $u->getNome_completo());
                $stm->bindValue(3, $u->getEmail());
                $stm->bindValue(4, $u->getSenha());
                $stm->bindValue(5, $u->getTipo_acesso());
                $stm->bindValue(6, $u->getAvatar_foto());
                $stm->bindValue(7, $u->getData_nascimento());
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        // Atualiza os dados do usuário; a senha só muda se vier preenchida
        public function atualizar(Usuario $u, $trocarSenha = false)
        {
            $sql = "UPDATE usuarios SET nome_usuario=?, nome_completo=?, email=?, tipo_acesso=?, avatar_foto=?, data_nascimento=?"
                 . ($trocarSenha ? ", senha=?" : "") . " WHERE id_usuario=? AND deletado_em IS NULL";
            try
            {
                $stm = $this->db->prepare($sql);
                $i = 1;
                $stm->bindValue($i++, $u->getNome_usuario());
                $stm->bindValue($i++, $u->getNome_completo());
                $stm->bindValue($i++, $u->getEmail());
                $stm->bindValue($i++, $u->getTipo_acesso());
                $stm->bindValue($i++, $u->getAvatar_foto());
                $stm->bindValue($i++, $u->getData_nascimento());
                if($trocarSenha) $stm->bindValue($i++, $u->getSenha());
                $stm->bindValue($i, $u->getId_usuario());
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function excluir($id)
        {
            try
            {
                $stm = $this->db->prepare("UPDATE usuarios SET deletado_em = CURRENT_TIMESTAMP WHERE id_usuario = ?");
                $stm->execute(array($id));
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        // Aceita nome de usuário ou e-mail no login
        public function buscarPorLogin($identificador)
        {
            try
            {
                $stm = $this->db->prepare("SELECT * FROM usuarios WHERE (nome_usuario = ? OR email = ?) AND deletado_em IS NULL");
                $stm->execute(array($identificador, $identificador));
                $l = $stm->fetch();
                return $l ? $this->hidratar($l) : null;
            }
            catch(PDOException $e){ return null; }
        }
        public function buscarPorId($id)
        {
            try
            {
                $stm = $this->db->prepare("SELECT * FROM usuarios WHERE id_usuario = ? AND deletado_em IS NULL");
                $stm->execute(array($id));
                $l = $stm->fetch();
                return $l ? $this->hidratar($l) : null;
            }
            catch(PDOException $e){ return null; }
        }
        public function buscarTodos()
        {
            try
            {
                $usuarios = array();
                foreach($this->db->query("SELECT * FROM usuarios WHERE deletado_em IS NULL ORDER BY nome_usuario")->fetchAll() as $l)
                    $usuarios[] = $this->hidratar($l);
                return $usuarios;
            }
            catch(PDOException $e){ return array(); }
        }
        // e-mail é UNIQUE no banco (inclui excluídos); nome de usuário validado aqui
        public function emailExiste($email, $ignorarId = 0)
        {
            $stm = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ? AND id_usuario <> ?");
            $stm->execute(array($email, $ignorarId));
            return $stm->fetchColumn() > 0;
        }
        public function nomeUsuarioExiste($nome, $ignorarId = 0)
        {
            $stm = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE nome_usuario = ? AND id_usuario <> ? AND deletado_em IS NULL");
            $stm->execute(array($nome, $ignorarId));
            return $stm->fetchColumn() > 0;
        }
        public function contar()
        {
            return (int)$this->db->query("SELECT COUNT(*) FROM usuarios WHERE deletado_em IS NULL")->fetchColumn();
        }
    }
?>
