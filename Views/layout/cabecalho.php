<?php
    // Variáveis esperadas: $titulo, $css (array de arquivos), $pagina (item ativo do menu), $bodyClass (opcional)
    $titulo = $titulo ?? "ELO";
    $css = $css ?? array();
    $bodyClass = $bodyClass ?? "";
    $flash = Sessao::lerMensagem();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?> | ELO</title>

    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon_io/site.webmanifest">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php foreach($css as $arquivo): ?>
    <link rel="stylesheet" href="assets/css/<?= e($arquivo) ?>">
<?php endforeach; ?>
    <link rel="stylesheet" href="assets/css/stylePrincipal.css">
    <link rel="stylesheet" href="assets/css/styleExtra.css">
</head>
<body class="<?= e($bodyClass) ?>">
<?php require "Views/layout/menu.php"; ?>
<?php if($flash): ?>
    <div class="container mt-3">
        <div class="alert alert-<?= $flash["tipo"] === "sucesso" ? "success" : ($flash["tipo"] === "erro" ? "danger" : "warning") ?> mb-0" role="alert">
            <?= e($flash["texto"]) ?>
        </div>
    </div>
<?php endif; ?>
