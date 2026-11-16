<?php
    require_once "Models/Conexao.class.php";
    require_once "Models/Usuario.class.php";
    require_once "Models/Categoria.class.php";
    require_once "Models/Jogo.class.php";
    require_once "Models/JogoDAO.class.php";
    require_once "Models/Avaliacao.class.php";
    require_once "Models/AvaliacaoDAO.class.php";

    class AvaliacaoController
    {
        // Comentar/avaliar exige login. Se o usuário já avaliou o jogo, a avaliação é atualizada.
        public function inserir()
        {
            Sessao::exigirLogin();
            if(!$_POST) redirecionar("jogo", "listar");
            Sessao::validarToken();
            $jogoId = (int)($_POST["jogo_id"] ?? 0);
            $nota = (int)($_POST["nota"] ?? 0);
            $comentario = trim($_POST["comentario"] ?? "");
            $jogo = (new JogoDAO())->buscarPorId($jogoId);
            if(!$jogo)
            {
                Sessao::mensagem("erro", "Jogo não encontrado.");
                redirecionar("jogo", "listar");
            }
            if($nota < 1 || $nota > 5) Sessao::mensagem("erro", "Escolha uma nota de 1 a 5 estrelas.");
            elseif($comentario === "") Sessao::mensagem("erro", "Escreva um comentário.");
            elseif(mb_strlen($comentario) > 1000) Sessao::mensagem("erro", "Comentário muito longo (máx. 1000 caracteres).");
            else
            {
                $dao = new AvaliacaoDAO();
                $existente = $dao->buscarDoUsuarioNoJogo(Sessao::id(), $jogoId);
                $a = new Avaliacao($existente ? $existente->getId_avaliacao() : 0, new Usuario(Sessao::id()), $jogo, $nota, $comentario);
                $ok = $existente ? $dao->atualizar($a) : $dao->cadastrar($a);
                Sessao::mensagem($ok ? "sucesso" : "erro", $ok ? ($existente ? "Avaliação atualizada!" : "Avaliação publicada!") : "Erro ao salvar a avaliação.");
            }
            header("Location: " . url("jogo", "detalhar", array("id" => $jogoId)) . "#avaliacoes");
            die();
        }
        // Painel admin: aba "Comentários"
        public function gerenciar()
        {
            Sessao::exigirAdmin();
            $jogoId = (int)($_GET["jogo"] ?? 0);
            $avaliacoes = (new AvaliacaoDAO())->buscarTodas($jogoId);
            $jogos = (new JogoDAO())->buscarTodos();
            require_once "Views/avaliacao/gerenciar.php";
        }
        // Admin remove qualquer comentário; o autor remove o próprio
        public function excluir()
        {
            Sessao::exigirLogin();
            if(!$_POST) redirecionar("inicio", "inicio");
            Sessao::validarToken();
            $dao = new AvaliacaoDAO();
            $a = $dao->buscarPorId((int)($_POST["id"] ?? 0));
            if(!$a || (!Sessao::admin() && $a->getUsuario()->getId_usuario() !== Sessao::id()))
            {
                Sessao::mensagem("erro", "Você não pode excluir este comentário.");
                redirecionar("inicio", "inicio");
            }
            $dao->excluir($a->getId_avaliacao());
            Sessao::mensagem("sucesso", "Comentário excluído.");
            if(Sessao::admin() && ($_POST["origem"] ?? "") === "admin") redirecionar("avaliacao", "gerenciar");
            header("Location: " . url("jogo", "detalhar", array("id" => $a->getJogo()->getId_jogo())) . "#avaliacoes");
            die();
        }
    }
?>
