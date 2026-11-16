<?php
    class AvaliacaoDAO extends Conexao
    {
        public function __construct($db = null)
        {
            parent::__construct($db);
        }
        private const BASE = "SELECT a.*, u.nome_usuario, u.avatar_foto, u.tipo_acesso, j.nome AS jogo_nome
            FROM avaliacoes a
            INNER JOIN usuarios u ON u.id_usuario = a.usuario_id
            INNER JOIN jogos j ON j.id_jogo = a.jogo_id
            WHERE a.deletado_em IS NULL";

        private function hidratar($l)
        {
            $usuario = new Usuario((int)$l["usuario_id"], $l["nome_usuario"], "", "", "", $l["tipo_acesso"], $l["avatar_foto"]);
            $jogo = new Jogo((int)$l["jogo_id"], $l["jogo_nome"]);
            return new Avaliacao((int)$l["id_avaliacao"], $usuario, $jogo, (int)$l["nota"], $l["comentario"], $l["criado_em"]);
        }
        public function cadastrar(Avaliacao $a)
        {
            try
            {
                $stm = $this->db->prepare("INSERT INTO avaliacoes (usuario_id, jogo_id, nota, comentario) VALUES (?,?,?,?)");
                $stm->execute(array($a->getUsuario()->getId_usuario(), $a->getJogo()->getId_jogo(), $a->getNota(), $a->getComentario()));
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function atualizar(Avaliacao $a)
        {
            try
            {
                $stm = $this->db->prepare("UPDATE avaliacoes SET nota = ?, comentario = ? WHERE id_avaliacao = ? AND deletado_em IS NULL");
                $stm->execute(array($a->getNota(), $a->getComentario(), $a->getId_avaliacao()));
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function excluir($id)
        {
            try
            {
                $stm = $this->db->prepare("UPDATE avaliacoes SET deletado_em = CURRENT_TIMESTAMP WHERE id_avaliacao = ?");
                $stm->execute(array($id));
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function buscarPorId($id)
        {
            $stm = $this->db->prepare(self::BASE . " AND a.id_avaliacao = ?");
            $stm->execute(array($id));
            $l = $stm->fetch();
            return $l ? $this->hidratar($l) : null;
        }
        public function buscarPorJogo($jogoId)
        {
            $stm = $this->db->prepare(self::BASE . " AND a.jogo_id = ? ORDER BY a.criado_em DESC, a.id_avaliacao DESC");
            $stm->execute(array($jogoId));
            $lista = array();
            foreach($stm->fetchAll() as $l) $lista[] = $this->hidratar($l);
            return $lista;
        }
        // Painel admin: todos os comentários, com filtro opcional por jogo
        public function buscarTodas($jogoId = 0)
        {
            $sql = self::BASE . ($jogoId > 0 ? " AND a.jogo_id = ?" : "") . " ORDER BY a.criado_em DESC, a.id_avaliacao DESC";
            $stm = $this->db->prepare($sql);
            $stm->execute($jogoId > 0 ? array($jogoId) : array());
            $lista = array();
            foreach($stm->fetchAll() as $l) $lista[] = $this->hidratar($l);
            return $lista;
        }
        public function buscarDoUsuarioNoJogo($usuarioId, $jogoId)
        {
            $stm = $this->db->prepare(self::BASE . " AND a.usuario_id = ? AND a.jogo_id = ?");
            $stm->execute(array($usuarioId, $jogoId));
            $l = $stm->fetch();
            return $l ? $this->hidratar($l) : null;
        }
        public function contar()
        {
            return (int)$this->db->query("SELECT COUNT(*) FROM avaliacoes WHERE deletado_em IS NULL")->fetchColumn();
        }
    }
?>
