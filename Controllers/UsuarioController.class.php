<?php
    require_once "Models/Conexao.class.php";
    require_once "Models/Usuario.class.php";
    require_once "Models/UsuarioDAO.class.php";
    require_once "Models/Categoria.class.php";
    require_once "Models/Jogo.class.php";
    require_once "Models/UsuarioJogo.class.php";
    require_once "Models/UsuarioJogoDAO.class.php";

    class UsuarioController
    {
        // ---------- Visitante ----------
        public function login()
        {
            if(Sessao::logado()) redirecionar("inicio", "inicio");
            $msg = array();
            $identificador = "";
            if($_POST)
            {
                Sessao::validarToken();
                $identificador = trim($_POST["identificador"] ?? "");
                $senha = $_POST["senha"] ?? "";
                if($identificador === "") $msg["identificador"] = "Preencha o nome de usuário ou e-mail";
                if($senha === "") $msg["senha"] = "Preencha a senha";
                if(!$msg)
                {
                    $usuario = (new UsuarioDAO())->buscarPorLogin($identificador);
                    if($usuario && password_verify($senha, $usuario->getSenha()))
                    {
                        session_regenerate_id(true);
                        $_SESSION["id"] = $usuario->getId_usuario();
                        $_SESSION["nome"] = $usuario->getNome_usuario();
                        $_SESSION["cargo"] = $usuario->getTipo_acesso();
                        $_SESSION["avatar"] = $usuario->getAvatar_foto();
                        if($usuario->ehAdmin()) redirecionar("inicio", "painel");
                        redirecionar("inicio", "inicio");
                    }
                    $msg["geral"] = "Verifique suas credenciais";
                }
            }
            require_once "Views/usuario/login.php";
        }
        public function logout()
        {
            $_SESSION = array();
            session_destroy();
            session_start();
            Sessao::mensagem("sucesso", "Você saiu da conta.");
            redirecionar("inicio", "inicio");
        }
        // Cadastro de usuário comum
        public function inserir()
        {
            if(Sessao::logado()) redirecionar("inicio", "inicio");
            $msg = array();
            $dados = array("nome_usuario" => "", "nome_completo" => "", "email" => "", "data_nascimento" => "");
            if($_POST)
            {
                Sessao::validarToken();
                $dados = $this->lerDados();
                $msg = $this->validar($dados, 0, true);
                if(!$msg)
                {
                    $usuario = new Usuario(0, $dados["nome_usuario"], $dados["nome_completo"], $dados["email"],
                        password_hash($_POST["senha"], PASSWORD_DEFAULT), "usuario", null, $dados["data_nascimento"]);
                    if((new UsuarioDAO())->cadastrar($usuario))
                    {
                        Sessao::mensagem("sucesso", "Cadastro realizado! Faça login para continuar.");
                        redirecionar("usuario", "login");
                    }
                    $msg["geral"] = "Erro ao cadastrar. Tente novamente.";
                }
            }
            require_once "Views/usuario/cadastro.php";
        }

        // ---------- Usuário logado ----------
        // Perfil / "configurações": editar os próprios dados, avatar e senha
        public function perfil()
        {
            Sessao::exigirLogin();
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorId(Sessao::id());
            if(!$usuario)
            {
                $_SESSION = array();
                redirecionar("usuario", "login");
            }
            $msg = array();
            $dados = array(
                "nome_usuario" => $usuario->getNome_usuario(), "nome_completo" => $usuario->getNome_completo(),
                "email" => $usuario->getEmail(), "data_nascimento" => substr((string)$usuario->getData_nascimento(), 0, 10)
            );
            if($_POST)
            {
                Sessao::validarToken();
                $dados = $this->lerDados();
                $msg = $this->validar($dados, $usuario->getId_usuario(), false);
                $trocarSenha = ($_POST["senha"] ?? "") !== "";
                if($trocarSenha && !password_verify($_POST["senha_atual"] ?? "", $usuario->getSenha()))
                    $msg["senha_atual"] = "Senha atual incorreta";
                $avatar = $usuario->getAvatar_foto();
                if(!empty($_FILES["avatar"]["name"]))
                {
                    $novo = salvarImagem($_FILES["avatar"], "assets/img/avatars");
                    if($novo === null) $msg["avatar"] = "Imagem inválida (JPG, PNG, WEBP ou GIF de até 3 MB)";
                    else $avatar = $novo;
                }
                if(!$msg)
                {
                    $atualizado = new Usuario($usuario->getId_usuario(), $dados["nome_usuario"], $dados["nome_completo"],
                        $dados["email"], $trocarSenha ? password_hash($_POST["senha"], PASSWORD_DEFAULT) : $usuario->getSenha(),
                        $usuario->getTipo_acesso(), $avatar, $dados["data_nascimento"]);
                    if($dao->atualizar($atualizado, $trocarSenha))
                    {
                        $_SESSION["nome"] = $atualizado->getNome_usuario();
                        $_SESSION["avatar"] = $avatar;
                        Sessao::mensagem("sucesso", "Dados atualizados.");
                        redirecionar("usuario", "perfil");
                    }
                    $msg["geral"] = "Erro ao salvar.";
                }
            }
            $historico = (new UsuarioJogoDAO())->buscarPorUsuario($usuario->getId_usuario(), 8);
            require_once "Views/usuario/perfil.php";
        }

        // ---------- Administrador ----------
        public function gerenciar()
        {
            Sessao::exigirAdmin();
            $usuarios = (new UsuarioDAO())->buscarTodos();
            require_once "Views/usuario/gerenciar.php";
        }
        public function criar()
        {
            Sessao::exigirAdmin();
            $this->formularioAdmin(null);
        }
        public function editar()
        {
            Sessao::exigirAdmin();
            $usuario = (new UsuarioDAO())->buscarPorId((int)($_GET["id"] ?? 0));
            if(!$usuario)
            {
                Sessao::mensagem("erro", "Usuário não encontrado.");
                redirecionar("usuario", "gerenciar");
            }
            $this->formularioAdmin($usuario);
        }
        private function formularioAdmin($usuario)
        {
            $msg = array();
            $dados = array(
                "nome_usuario" => $usuario ? $usuario->getNome_usuario() : "",
                "nome_completo" => $usuario ? $usuario->getNome_completo() : "",
                "email" => $usuario ? $usuario->getEmail() : "",
                "data_nascimento" => $usuario ? substr((string)$usuario->getData_nascimento(), 0, 10) : "",
                "tipo_acesso" => $usuario ? $usuario->getTipo_acesso() : "usuario"
            );
            if($_POST)
            {
                Sessao::validarToken();
                $dados = $this->lerDados();
                $dados["tipo_acesso"] = ($_POST["tipo_acesso"] ?? "") === "admnistrador" ? "admnistrador" : "usuario";
                $id = $usuario ? $usuario->getId_usuario() : 0;
                if($id === Sessao::id()) $dados["tipo_acesso"] = $usuario->getTipo_acesso(); // não rebaixa a si mesmo
                $msg = $this->validar($dados, $id, !$usuario);
                if(!$msg)
                {
                    $trocarSenha = ($_POST["senha"] ?? "") !== "";
                    $senha = $trocarSenha ? password_hash($_POST["senha"], PASSWORD_DEFAULT) : ($usuario ? $usuario->getSenha() : "");
                    $novo = new Usuario($id, $dados["nome_usuario"], $dados["nome_completo"], $dados["email"], $senha,
                        $dados["tipo_acesso"], $usuario ? $usuario->getAvatar_foto() : null, $dados["data_nascimento"]);
                    $dao = new UsuarioDAO();
                    $ok = $usuario ? $dao->atualizar($novo, $trocarSenha) : $dao->cadastrar($novo);
                    if($ok)
                    {
                        Sessao::mensagem("sucesso", $usuario ? "Usuário atualizado." : "Usuário cadastrado.");
                        redirecionar("usuario", "gerenciar");
                    }
                    $msg["geral"] = "Erro ao salvar o usuário.";
                }
            }
            require_once "Views/usuario/formulario.php";
        }
        public function excluir()
        {
            Sessao::exigirAdmin();
            if(!$_POST) redirecionar("usuario", "gerenciar");
            Sessao::validarToken();
            $id = (int)($_POST["id"] ?? 0);
            if($id === Sessao::id()) Sessao::mensagem("erro", "Você não pode excluir a sua própria conta.");
            else
            {
                $ok = (new UsuarioDAO())->excluir($id);
                Sessao::mensagem($ok ? "sucesso" : "erro", $ok ? "Usuário excluído." : "Erro ao excluir o usuário.");
            }
            redirecionar("usuario", "gerenciar");
        }

        // ---------- apoio ----------
        private function lerDados()
        {
            return array(
                "nome_usuario" => trim($_POST["nome_usuario"] ?? ""),
                "nome_completo" => trim($_POST["nome_completo"] ?? ""),
                "email" => trim($_POST["email"] ?? ""),
                "data_nascimento" => trim($_POST["data_nascimento"] ?? "")
            );
        }
        // Validações comuns ao cadastro, perfil e cadastro pelo admin
        private function validar($d, $ignorarId, $senhaObrigatoria)
        {
            $msg = array();
            $dao = new UsuarioDAO();
            if($d["nome_usuario"] === "") $msg["nome_usuario"] = "Preencha o nome de usuário";
            elseif(!preg_match('/^[\p{L}0-9_.-]{3,30}$/u', $d["nome_usuario"])) $msg["nome_usuario"] = "Use 3 a 30 letras, números, ponto, traço ou _";
            elseif($dao->nomeUsuarioExiste($d["nome_usuario"], $ignorarId)) $msg["nome_usuario"] = "Esse nome de usuário já está em uso";
            if($d["nome_completo"] === "") $msg["nome_completo"] = "Preencha o nome completo";
            if($d["email"] === "") $msg["email"] = "Preencha o e-mail";
            elseif(!filter_var($d["email"], FILTER_VALIDATE_EMAIL)) $msg["email"] = "E-mail inválido";
            elseif($dao->emailExiste($d["email"], $ignorarId)) $msg["email"] = "Esse e-mail já está cadastrado";
            $dt = DateTime::createFromFormat("Y-m-d", $d["data_nascimento"]);
            if(!$dt || $dt->format("Y-m-d") !== $d["data_nascimento"]) $msg["data_nascimento"] = "Informe a data de nascimento";
            elseif($dt > new DateTime("today")) $msg["data_nascimento"] = "Data de nascimento inválida";
            $senha = $_POST["senha"] ?? "";
            if($senhaObrigatoria && $senha === "") $msg["senha"] = "Preencha a senha";
            elseif($senha !== "" && strlen($senha) < 6) $msg["senha"] = "A senha precisa de pelo menos 6 caracteres";
            elseif($senha !== "" && $senha !== ($_POST["confirma"] ?? "")) $msg["confirma"] = "As senhas não conferem";
            return $msg;
        }
    }
?>
