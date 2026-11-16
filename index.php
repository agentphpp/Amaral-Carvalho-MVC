<?php
    // Front controller (padrão da Loja): index.php?controle=jogo&metodo=listar
    require_once "Helpers/util.php";
    require_once "Helpers/Sessao.class.php";
    Sessao::iniciar();

    // Lista de controllers permitidos (evita incluir arquivos arbitrários pela URL)
    $permitidos = array(
        "inicio"    => "InicioController",
        "usuario"   => "UsuarioController",
        "jogo"      => "JogoController",
        "categoria" => "CategoriaController",
        "avaliacao" => "AvaliacaoController",
        "contato"   => "ContatoController"
    );

    $controle = $_GET["controle"] ?? "inicio";
    $metodo   = $_GET["metodo"] ?? "inicio";

    if(!isset($permitidos[$controle]))
    {
        http_response_code(404);
        die("Página não encontrada.");
    }
    $classe = $permitidos[$controle];
    require_once "Controllers/$classe.class.php";
    $obj = new $classe();

    // só executa métodos públicos do controller
    if(!is_string($metodo) || !method_exists($obj, $metodo) || !(new ReflectionMethod($obj, $metodo))->isPublic())
    {
        http_response_code(404);
        die("Página não encontrada.");
    }
    $obj->$metodo();
?>
