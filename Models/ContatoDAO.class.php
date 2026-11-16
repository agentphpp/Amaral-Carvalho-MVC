<?php
    class ContatoDAO extends Conexao
    {
        public function __construct($db = null)
        {
            parent::__construct($db);
        }
        public function cadastrar(Contato $c)
        {
            try
            {
                $stm = $this->db->prepare("INSERT INTO contatos (nome, assunto, email, mensagem) VALUES (?,?,?,?)");
                $stm->execute(array($c->getNome(), $c->getAssunto(), $c->getEmail(), $c->getMensagem()));
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        private function hidratar($l)
        {
            return new Contato((int)$l["id_contato"], $l["nome"], $l["assunto"], $l["email"], $l["mensagem"], $l["criado_em"]);
        }
        // Mais recentes primeiro (tela do administrador)
        public function buscarTodos()
        {
            $lista = array();
            foreach($this->db->query("SELECT * FROM contatos ORDER BY criado_em DESC, id_contato DESC")->fetchAll() as $l)
                $lista[] = $this->hidratar($l);
            return $lista;
        }
        public function excluir($id)
        {
            try
            {
                $stm = $this->db->prepare("DELETE FROM contatos WHERE id_contato = ?");
                $stm->execute(array($id));
                return $stm->rowCount() > 0;
            }
            catch(PDOException $e){ return false; }
        }
        public function contar()
        {
            return (int)$this->db->query("SELECT COUNT(*) FROM contatos")->fetchColumn();
        }
    }
?>
