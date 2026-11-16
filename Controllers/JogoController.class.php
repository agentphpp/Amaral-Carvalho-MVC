<?php
    require_once "Models/Conexao.class.php";
    require_once "Models/Usuario.class.php";
    require_once "Models/Categoria.class.php";
    require_once "Models/CategoriaDAO.class.php";
    require_once "Models/Jogo.class.php";
    require_once "Models/JogoDAO.class.php";
    require_once "Models/Avaliacao.class.php";
    require_once "Models/AvaliacaoDAO.class.php";
    require_once "Models/UsuarioJogo.class.php";
    require_once "Models/UsuarioJogoDAO.class.php";

    class JogoController
    {
        const FINALIDADES = array("Entretenimento", "Didático", "Terapêutico", "Auxílio clínico");

        // Vitrine com pesquisa e filtro por categoria (RF04, RF08, RF12)
        public function listar()
        {
            $pesquisa = trim($_GET["q"] ?? "");
            $categoriaSel = (int)($_GET["categoria"] ?? 0);
            $jogos = (new JogoDAO())->buscarTodos($pesquisa, $categoriaSel);
            $categorias = (new CategoriaDAO())->buscarTodas();
            require_once "Views/jogos/lista.php";
        }
        // Detalhes do jogo + avaliações (RF05, RF07)
        public function detalhar()
        {
            $jogo = (new JogoDAO())->buscarPorId((int)($_GET["id"] ?? 0));
            if(!$jogo)
            {
                Sessao::mensagem("erro", "Jogo não encontrado.");
                redirecionar("jogo", "listar");
            }
            $avaliacaoDAO = new AvaliacaoDAO();
            $avaliacoes = $avaliacaoDAO->buscarPorJogo($jogo->getId_jogo());
            $minha = Sessao::logado() ? $avaliacaoDAO->buscarDoUsuarioNoJogo(Sessao::id(), $jogo->getId_jogo()) : null;
            require_once "Views/jogos/descricao.php";
        }
        // Botão "Jogar agora": registra o acesso (se logado) e abre o jogo (RF06, RF13)
        public function executar()
        {
            $jogo = (new JogoDAO())->buscarPorId((int)($_GET["id"] ?? 0));
            if(!$jogo)
            {
                Sessao::mensagem("erro", "Jogo não encontrado.");
                redirecionar("jogo", "listar");
            }
            $link = $jogo->getLink();
            if(!preg_match('#^https?://#i', $link))
            {
                Sessao::mensagem("aviso", "Este jogo estará disponível em breve!");
                redirecionar("jogo", "detalhar", array("id" => $jogo->getId_jogo()));
            }
            if(Sessao::logado())
                (new UsuarioJogoDAO())->registrar(new UsuarioJogo(0, new Usuario(Sessao::id()), $jogo, 0));
            header("Location: $link");
            die();
        }

        // Chamado pelo JS ao clicar em "Jogar Agora" (usuário logado): registra o acesso e devolve o link
        public function iniciar()
        {
            header("Content-Type: application/json; charset=utf-8");
            if(!$_POST || !Sessao::logado()){ http_response_code(403); die(json_encode(array("ok" => false, "erro" => "Faça login para jogar."))); }
            Sessao::validarToken();
            $jogo = (new JogoDAO())->buscarPorId((int)($_POST["id"] ?? 0));
            if(!$jogo || !preg_match('#^https?://#i', $jogo->getLink()))
                die(json_encode(array("ok" => false, "erro" => "Este jogo estará disponível em breve!")));
            $acesso = (new UsuarioJogoDAO())->registrar(new UsuarioJogo(0, new Usuario(Sessao::id()), $jogo, 0));
            die(json_encode(array("ok" => true, "acesso" => $acesso, "link" => $jogo->getLink())));
        }
        // Recebe (via sendBeacon) o tempo decorrido em segundos e grava em usuarios_jogos.tempo_duracao
        public function finalizar()
        {
            if(!$_POST || !Sessao::logado()){ http_response_code(403); die(); }
            Sessao::validarToken();
            $acesso = (int)($_POST["acesso"] ?? 0);
            $segundos = max(0, min((int)($_POST["segundos"] ?? 0), 4 * 3600)); // limite de 4 horas
            if($acesso > 0) (new UsuarioJogoDAO())->atualizarTempo($acesso, Sessao::id(), $segundos);
            http_response_code(204);
            die();
        }

        // ---------- Administrador ----------
        public function gerenciar()
        {
            Sessao::exigirAdmin();
            $jogos = (new JogoDAO())->buscarTodos();
            require_once "Views/jogos/gerenciar.php";
        }
        public function inserir()
        {
            Sessao::exigirAdmin();
            $this->formulario(null);
        }
        public function editar()
        {
            Sessao::exigirAdmin();
            $jogo = (new JogoDAO())->buscarPorId((int)($_GET["id"] ?? 0));
            if(!$jogo)
            {
                Sessao::mensagem("erro", "Jogo não encontrado.");
                redirecionar("jogo", "gerenciar");
            }
            $this->formulario($jogo);
        }
        // inserir e editar usam o mesmo formulário
        private function formulario($jogo)
        {
            $msg = array();
            $categorias = (new CategoriaDAO())->buscarTodas();
            $dados = array(
                "nome" => $jogo ? $jogo->getNome() : "",
                "finalidade" => $jogo ? $jogo->getFinalidade() : "",
                "categoria_id" => $jogo ? $jogo->getCategoria()->getId_categoria() : 0,
                "descricao" => $jogo ? $jogo->getDescricao() : "",
                "faixa_etaria" => $jogo ? $jogo->getFaixa_etaria() : "",
                "duracao_estimada" => $jogo ? $jogo->getDuracao_estimada() : "",
                "link" => $jogo ? $jogo->getLink() : ""
            );
            if($_POST)
            {
                Sessao::validarToken();
                foreach($dados as $campo => $v) $dados[$campo] = trim($_POST[$campo] ?? "");
                $dados["categoria_id"] = (int)$dados["categoria_id"];
                $categoria = (new CategoriaDAO())->buscarPorId($dados["categoria_id"]);

                if($dados["nome"] === "") $msg["nome"] = "Preencha o nome do jogo";
                if(!in_array($dados["finalidade"], self::FINALIDADES)) $msg["finalidade"] = "Escolha a finalidade";
                if(!$categoria) $msg["categoria_id"] = "Escolha uma categoria";
                if($dados["descricao"] === "") $msg["descricao"] = "Preencha a descrição";
                if($dados["faixa_etaria"] === "") $msg["faixa_etaria"] = "Informe a faixa etária (ex.: 5-12 anos)";
                if($dados["duracao_estimada"] === "") $msg["duracao_estimada"] = "Informe a duração estimada (ex.: 10-20 min)";
                if($dados["link"] === "" ) $msg["link"] = "Informe o link do jogo (use # se ainda não existir)";
                elseif($dados["link"] !== "#" && !preg_match('#^https?://#i', $dados["link"])) $msg["link"] = "O link deve começar com http:// ou https://";

                $img = $jogo ? $jogo->getImg() : "";
                $temUpload = !empty($_FILES["img"]["name"]);
                if($temUpload)
                {
                    $novo = salvarImagem($_FILES["img"], "assets/img/jogos");
                    if($novo === null) $msg["img"] = "Imagem inválida (use JPG, PNG, WEBP ou GIF de até 3 MB)";
                    else $img = $novo;
                }
                elseif($img === "") $msg["img"] = "Escolha uma imagem para o jogo";

                if(!$msg)
                {
                    $link = $dados["link"] === "#" ? "" : $dados["link"];
                    $novoJogo = new Jogo(
                        $jogo ? $jogo->getId_jogo() : 0, $dados["nome"], $dados["finalidade"], $categoria,
                        $dados["descricao"], $dados["faixa_etaria"], $dados["duracao_estimada"], $img, $link
                    );
                    $dao = new JogoDAO();
                    $ok = $jogo ? $dao->atualizar($novoJogo) : $dao->cadastrar($novoJogo);
                    if($ok)
                    {
                        Sessao::mensagem("sucesso", $jogo ? "Jogo atualizado." : "Jogo publicado.");
                        redirecionar("jogo", "gerenciar");
                    }
                    $msg["geral"] = "Erro ao salvar o jogo.";
                }
            }
            $finalidades = self::FINALIDADES;
            require_once "Views/jogos/formulario.php";
        }
        public function excluir()
        {
            Sessao::exigirAdmin();
            if(!$_POST) redirecionar("jogo", "gerenciar");
            Sessao::validarToken();
            $ok = (new JogoDAO())->excluir((int)($_POST["id"] ?? 0));
            Sessao::mensagem($ok ? "sucesso" : "erro", $ok ? "Jogo excluído." : "Erro ao excluir o jogo.");
            redirecionar("jogo", "gerenciar");
        }
    }
?>
