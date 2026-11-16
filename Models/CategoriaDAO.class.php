<?php
    class CategoriaDAO extends Conexao
    {
        public function __construct($db = null)
        {
            parent::__construct($db);
        }
        private function hidratar($l)
        {
            return new Categoria((int)$l["id_categoria"], $l["nome"], (int)($l["total_jogos"] ?? 0));
        }
        public function cadastrar(Categoria $categoria)
        {
            try
            {
                $stm = $this->db->prepare("INSERT INTO categorias (nome) VALUES (?)");
                $stm->bindValue(1, $categoria->getNome());
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function atualizar(Categoria $categoria)
        {
            try
            {
                $stm = $this->db->prepare("UPDATE categorias SET nome = ? WHERE id_categoria = ?");
                $stm->bindValue(1, $categoria->getNome());
                $stm->bindValue(2, $categoria->getId_categoria());
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        // Só exclui se nenhum jogo usa a categoria (FK ON DELETE RESTRICT)
        public function excluir($id)
        {
            try
            {
                // conta também jogos já excluídos logicamente, pois eles ainda referenciam a categoria
                $uso = $this->db->prepare("SELECT COUNT(*) FROM jogos WHERE categoria_id = ?");
                $uso->execute(array($id));
                if($uso->fetchColumn() > 0) return false;
                $stm = $this->db->prepare("DELETE FROM categorias WHERE id_categoria = ?");
                $stm->bindValue(1, $id);
                $stm->execute();
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        public function buscarTodas()
        {
            $sql = "SELECT c.id_categoria, c.nome,
                        (SELECT COUNT(*) FROM jogos j WHERE j.categoria_id = c.id_categoria AND j.deletado_em IS NULL) AS total_jogos
                    FROM categorias c ORDER BY c.nome";
            try
            {
                $categorias = array();
                foreach($this->db->query($sql)->fetchAll() as $l) $categorias[] = $this->hidratar($l);
                return $categorias;
            }
            catch(PDOException $e){ return array(); }
        }
        public function buscarPorId($id)
        {
            try
            {
                $stm = $this->db->prepare("SELECT id_categoria, nome FROM categorias WHERE id_categoria = ?");
                $stm->bindValue(1, $id);
                $stm->execute();
                $l = $stm->fetch();
                return $l ? $this->hidratar($l) : null;
            }
            catch(PDOException $e){ return null; }
        }
        public function nomeExiste($nome, $ignorarId = 0)
        {
            $stm = $this->db->prepare("SELECT COUNT(*) FROM categorias WHERE LOWER(nome) = LOWER(?) AND id_categoria <> ?");
            $stm->bindValue(1, $nome);
            $stm->bindValue(2, $ignorarId);
            $stm->execute();
            return $stm->fetchColumn() > 0;
        }
    }
?>
