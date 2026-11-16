<?php
    class UsuarioJogoDAO extends Conexao
    {
        public function __construct($db = null)
        {
            parent::__construct($db);
        }
        public function registrar(UsuarioJogo $uj)
        {
            try
            {
                $stm = $this->db->prepare("INSERT INTO usuarios_jogos (usuario_id, jogo_id, tempo_duracao) VALUES (?,?,?)");
                $stm->execute(array($uj->getUsuario()->getId_usuario(), $uj->getJogo()->getId_jogo(), $uj->getTempo_duracao()));
                return (int)$this->db->lastInsertId(); // id do acesso (usado para gravar o tempo depois)
            }
            catch(PDOException $e){ return 0; }
        }
        // Grava o tempo (em segundos) de um acesso. Só do dono do acesso e só se o novo valor for maior.
        public function atualizarTempo($idAcesso, $usuarioId, $segundos)
        {
            try
            {
                $stm = $this->db->prepare("UPDATE usuarios_jogos SET tempo_duracao = ?
                                           WHERE id_usuario_jogo = ? AND usuario_id = ? AND tempo_duracao <= ?");
                $stm->execute(array($segundos, $idAcesso, $usuarioId, $segundos));
                return true;
            }
            catch(PDOException $e){ return false; }
        }
        // Últimos jogos acessados por um usuário (tela de perfil)
        public function buscarPorUsuario($usuarioId, $limite = 10)
        {
            $sql = "SELECT uj.*, j.nome AS jogo_nome FROM usuarios_jogos uj
                    INNER JOIN jogos j ON j.id_jogo = uj.jogo_id
                    WHERE uj.usuario_id = ? ORDER BY uj.data_acesso DESC, uj.id_usuario_jogo DESC LIMIT " . (int)$limite;
            $stm = $this->db->prepare($sql);
            $stm->execute(array($usuarioId));
            $lista = array();
            foreach($stm->fetchAll() as $l)
            {
                $lista[] = new UsuarioJogo(
                    (int)$l["id_usuario_jogo"], new Usuario((int)$l["usuario_id"]),
                    new Jogo((int)$l["jogo_id"], $l["jogo_nome"]), (int)$l["tempo_duracao"], $l["data_acesso"]
                );
            }
            return $lista;
        }
    }
?>
