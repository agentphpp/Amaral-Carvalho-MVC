<?php
    require_once "Models/Conexao.class.php";
    require_once "Models/Contato.class.php";
    require_once "Models/ContatoDAO.class.php";

    class ContatoController
    {
        public function inserir()
        {
            $msg = array();
            $dados = array("nome" => "", "email" => "", "assunto" => "", "mensagem" => "");
            if($_POST)
            {
                Sessao::validarToken();
                foreach($dados as $campo => $v) $dados[$campo] = trim($_POST[$campo] ?? "");
                if($dados["nome"] === "") $msg["nome"] = "Preencha o seu nome";
                if($dados["email"] === "") $msg["email"] = "Preencha o seu e-mail";
                elseif(!filter_var($dados["email"], FILTER_VALIDATE_EMAIL)) $msg["email"] = "E-mail inválido";
                if($dados["assunto"] === "") $msg["assunto"] = "Preencha o assunto";
                if($dados["mensagem"] === "") $msg["mensagem"] = "Escreva a sua mensagem";
                if(!$msg)
                {
                    $contato = new Contato(0, $dados["nome"], $dados["assunto"], $dados["email"], $dados["mensagem"]);
                    if((new ContatoDAO())->cadastrar($contato))
                    {
                        Sessao::mensagem("sucesso", "Mensagem enviada! Obrigado pelo contato.");
                        redirecionar("contato", "inserir");
                    }
                    $msg["geral"] = "Não foi possível enviar agora. Tente novamente mais tarde.";
                }
            }
            require_once "Views/contato/formulario.php";
        }
        // Painel admin: aba "Mensagens" (contatos recebidos)
        public function gerenciar()
        {
            Sessao::exigirAdmin();
            $contatos = (new ContatoDAO())->buscarTodos();
            require_once "Views/contato/gerenciar.php";
        }
        public function excluir()
        {
            Sessao::exigirAdmin();
            if(!$_POST) redirecionar("contato", "gerenciar");
            Sessao::validarToken();
            $ok = (new ContatoDAO())->excluir((int)($_POST["id"] ?? 0));
            Sessao::mensagem($ok ? "sucesso" : "erro", $ok ? "Mensagem excluída." : "Não foi possível excluir a mensagem.");
            redirecionar("contato", "gerenciar");
        }
    }
?>
