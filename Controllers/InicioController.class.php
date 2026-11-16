<?php
    require_once "Models/Conexao.class.php";
    require_once "Models/Categoria.class.php";
    require_once "Models/Jogo.class.php";
    require_once "Models/JogoDAO.class.php";
    require_once "Models/Usuario.class.php";
    require_once "Models/UsuarioDAO.class.php";
    require_once "Models/Avaliacao.class.php";
    require_once "Models/AvaliacaoDAO.class.php";

    class InicioController
    {
        // Página inicial com os jogos em destaque (RF11)
        public function inicio()
        {
            $jogoDAO = new JogoDAO();
            $destaques = $jogoDAO->buscarDestaques(6);
            require_once "Views/inicio/index.php";
        }
        public function sobre()
        {
            require_once "Views/inicio/sobre.php";
        }
        // Painel do administrador: aba "Geral"
        public function painel()
        {
            Sessao::exigirAdmin();
            $totalJogos = (new JogoDAO())->contar();
            $totalComentarios = (new AvaliacaoDAO())->contar();
            $totalUsuarios = (new UsuarioDAO())->contar();
            require_once "Models/Contato.class.php";
            require_once "Models/ContatoDAO.class.php";
            $totalMensagens = (new ContatoDAO())->contar();
            $recentes = array_slice((new AvaliacaoDAO())->buscarTodas(), 0, 5);
            require_once "Views/inicio/painel.php";
        }
    }
?>
