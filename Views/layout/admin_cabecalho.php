<?php
    // Variáveis: $titulo, $secao (geral|jogos|usuarios|comentarios)
    $titulo = $titulo ?? "Painel";
    $secao = $secao ?? "geral";
    $flash = Sessao::lerMensagem();
    function itemAdmin($chave, $atual, $icone, $texto, $controle, $metodo)
    {
        $classe = $chave === $atual ? "adm-item ativo" : "adm-item";
        echo '<a class="' . $classe . '" href="' . url($controle, $metodo) . '"><i class="fa-solid ' . $icone . '"></i><span>' . $texto . '</span></a>';
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?> | Painel ELO</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon_io/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styleAdmin.css">
    <link rel="stylesheet" href="assets/css/styleExtra.css">
</head>
<body class="adm">
<div class="adm-topo">
    <a class="adm-logo" href="<?= url("inicio", "inicio") ?>" title="Ver o site"><img src="assets/img/logo.png" alt="Logo ELO"></a>
    <div class="adm-usuario">
        <span><?= e($_SESSION["nome"]) ?></span>
        <small>Administrador</small>
    </div>
</div>
<div class="adm-corpo">
    <aside class="adm-lateral">
        <nav class="adm-menu">
            <?php itemAdmin("geral", $secao, "fa-bars", "Geral", "inicio", "painel"); ?>
            <?php itemAdmin("jogos", $secao, "fa-gamepad", "Jogos", "jogo", "gerenciar"); ?>
            <?php itemAdmin("usuarios", $secao, "fa-users", "Usuários", "usuario", "gerenciar"); ?>
            <?php itemAdmin("comentarios", $secao, "fa-envelope", "Comentários", "avaliacao", "gerenciar"); ?>
            <?php itemAdmin("mensagens", $secao, "fa-inbox", "Mensagens", "contato", "gerenciar"); ?>
        </nav>
        <div class="adm-rodape-lateral">
            <a class="adm-item" href="<?= url("usuario", "perfil") ?>"><i class="fa-solid fa-gear"></i><span>configurações</span></a>
            <a class="adm-logout" href="<?= url("usuario", "logout") ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </aside>
    <div class="adm-principal">
<?php if($flash): ?>
        <div class="adm-aviso"><div class="alert alert-<?= $flash["tipo"] === "sucesso" ? "success" : ($flash["tipo"] === "erro" ? "danger" : "warning") ?> mb-0"><?= e($flash["texto"]) ?></div></div>
<?php endif; ?>
