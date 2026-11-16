<?php
    require_once "Models/Conexao.class.php";
    require_once "Models/Categoria.class.php";
    require_once "Models/CategoriaDAO.class.php";

    class CategoriaController
    {
        public function gerenciar()
        {
            Sessao::exigirAdmin();
            $categorias = (new CategoriaDAO())->buscarTodas();
            require_once "Views/categoria/gerenciar.php";
        }
        public function inserir()
        {
            Sessao::exigirAdmin();
            $this->formulario(null);
        }
        public function editar()
        {
            Sessao::exigirAdmin();
            $categoria = (new CategoriaDAO())->buscarPorId((int)($_GET["id"] ?? 0));
            if(!$categoria)
            {
                Sessao::mensagem("erro", "Categoria não encontrada.");
                redirecionar("categoria", "gerenciar");
            }
            $this->formulario($categoria);
        }
        // inserir e editar usam o mesmo formulário
        private function formulario($categoria)
        {
            $msg = array();
            $nome = $categoria ? $categoria->getNome() : "";
            if($_POST)
            {
                Sessao::validarToken();
                $nome = trim($_POST["nome"] ?? "");
                $id = $categoria ? $categoria->getId_categoria() : 0;
                $dao = new CategoriaDAO();
                if($nome === "") $msg["nome"] = "Preencha o nome da categoria";
                elseif(mb_strlen($nome) > 255) $msg["nome"] = "Nome muito longo";
                elseif($dao->nomeExiste($nome, $id)) $msg["nome"] = "Já existe uma categoria com esse nome";
                if(!$msg)
                {
                    $nova = new Categoria($id, $nome);
                    $ok = $categoria ? $dao->atualizar($nova) : $dao->cadastrar($nova);
                    if($ok)
                    {
                        Sessao::mensagem("sucesso", $categoria ? "Categoria atualizada." : "Categoria cadastrada.");
                        redirecionar("categoria", "gerenciar");
                    }
                    $msg["geral"] = "Erro ao salvar a categoria.";
                }
            }
            require_once "Views/categoria/formulario.php";
        }
        public function excluir()
        {
            Sessao::exigirAdmin();
            if(!$_POST) redirecionar("categoria", "gerenciar");
            Sessao::validarToken();
            $ok = (new CategoriaDAO())->excluir((int)($_POST["id"] ?? 0));
            if($ok) Sessao::mensagem("sucesso", "Categoria excluída.");
            else Sessao::mensagem("erro", "Não é possível excluir: existem jogos usando esta categoria.");
            redirecionar("categoria", "gerenciar");
        }
    }
?>
