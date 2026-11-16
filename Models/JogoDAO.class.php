<?php
    class JogoDAO extends Conexao
    {
        public function __construct($db = null)
        {
            parent::__construct($db);
        }
        // SELECT base: jogo + categoria + média das avaliações
        private const BASE = "SELECT j.*, c.nome AS categoria_nome,
                (SELECT AVG(a.nota) FROM avaliacoes a WHERE a.jogo_id = j.id_jogo AND a.deletado_em IS NULL) AS media,
                (SELECT COUNT(*) FROM avaliacoes a WHERE a.jogo_id = j.id_jogo AND a.deletado_em IS NULL) AS total_avaliacoes
            FROM jogos j INNER JOIN categorias c ON c.id_categoria = j.categoria_id
            WHERE j.deletado_em IS NULL";

        private function hidratar($l)
        {
            return new Jogo(
                (int)$l["id_jogo"], $l["nome"], $l["finalidade"],
                new Categoria((int)$l["categoria_id"], $l["categoria_nome"]),
                $l["descricao"], $l["faixa_etaria"], $l["duracao_estimada"],
                $l["img"], $l["link"], $l["criado_em"],
                $l["media"] !== null ? round((float)$l["media"], 1) : null,
                (int)$l["total_avaliacoes"]
            );
        }
        private function vincular($stm, Jogo $j)
        {
            $stm->bindValue(1, $j->getNome());
            $stm->bindValue(2, $j->getFinalidade());
            $stm->bindValue(3, $j->getCategoria()->getId_categoria());
            $stm->bindValue(4, $j->getDescricao());
            $stm->bindValue(5, $j->getFaixa_etaria());
            $stm->bindValue(6, $j->getDuracao_estimada());
            $stm->bindValue(7, $j->getImg());
            $stm->bindValue(8, $j->getLink());
        }
        public function cadastrar(Jogo $jogo)
        {
            $sql = "INSERT INTO jogos (nome, finalidade, categoria_id, descricao, faixa_etaria, duracao_estimada, img, link)
                    VALUES (?,?,?,?,?,?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $this->vincular($stm, $jogo);
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function atualizar(Jogo $jogo)
        {
            $sql = "UPDATE jogos SET nome=?, finalidade=?, categoria_id=?, descricao=?, faixa_etaria=?,
                    duracao_estimada=?, img=?, link=? WHERE id_jogo = ? AND deletado_em IS NULL";
            try
            {
                $stm = $this->db->prepare($sql);
                $this->vincular($stm, $jogo);
                $stm->bindValue(9, $jogo->getId_jogo());
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        // Exclusão lógica: preenche deletado_em (as FKs são RESTRICT)
        public function excluir($id)
        {
            try
            {
                $stm = $this->db->prepare("UPDATE jogos SET deletado_em = CURRENT_TIMESTAMP WHERE id_jogo = ?");
                $stm->bindValue(1, $id);
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        // Busca com pesquisa por nome e filtro por categoria (RF08, RF12)
        public function buscarTodos($pesquisa = "", $categoriaId = 0)
        {
            $sql = self::BASE;
            $params = array();
            if($pesquisa !== "")
            {
                $sql .= " AND (j.nome LIKE ? OR j.descricao LIKE ?)";
                $params[] = "%$pesquisa%";
                $params[] = "%$pesquisa%";
            }
            if($categoriaId > 0)
            {
                $sql .= " AND j.categoria_id = ?";
                $params[] = $categoriaId;
            }
            $sql .= " ORDER BY j.nome";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->execute($params);
                $jogos = array();
                foreach($stm->fetchAll() as $l) $jogos[] = $this->hidratar($l);
                return $jogos;
            }
            catch(PDOException $e){ return array(); }
        }
        public function buscarPorId($id)
        {
            try
            {
                $stm = $this->db->prepare(self::BASE . " AND j.id_jogo = ?");
                $stm->execute(array($id));
                $l = $stm->fetch();
                return $l ? $this->hidratar($l) : null;
            }
            catch(PDOException $e){ return null; }
        }
        // Mais bem avaliados primeiro (RF11)
        public function buscarDestaques($quantidade = 6)
        {
            $sql = self::BASE . " ORDER BY media DESC, j.criado_em DESC LIMIT " . (int)$quantidade;
            try
            {
                $jogos = array();
                foreach($this->db->query($sql)->fetchAll() as $l) $jogos[] = $this->hidratar($l);
                return $jogos;
            }
            catch(PDOException $e){ return array(); }
        }
        public function contar()
        {
            return (int)$this->db->query("SELECT COUNT(*) FROM jogos WHERE deletado_em IS NULL")->fetchColumn();
        }
    }
?>
