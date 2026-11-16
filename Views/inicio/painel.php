<?php $titulo = "Geral"; $secao = "geral"; require "Views/layout/admin_cabecalho.php"; ?>
<div class="adm-faixa">
    <div class="adm-stat">Jogos Publicados<div class="num"><?= $totalJogos ?></div></div>
    <div class="adm-stat">Comentários<div class="num"><?= $totalComentarios ?></div></div>
    <div class="adm-stat">Usuários<div class="num"><?= $totalUsuarios ?></div></div>
    <div class="adm-stat">Mensagens<div class="num"><?= $totalMensagens ?></div></div>
</div>
<div class="adm-conteudo">
    <h2 class="h5 fw-bold mb-0">Últimos comentários</h2>
<?php if(!$recentes): ?>
    <p class="adm-vazio">Nenhum comentário ainda.</p>
<?php endif; ?>
<?php foreach($recentes as $a): ?>
    <div class="adm-linha">
        <div><img class="avatar" src="<?= e($a->getUsuario()->getAvatar_foto() ?: "assets/img/logo.png") ?>" alt=""></div>
        <div class="nome"><?= e($a->getUsuario()->getNome_usuario()) ?></div>
        <div class="campo"><?= e($a->getJogo()->getNome()) ?></div>
        <div class="campo"><?= estrelas($a->getNota()) ?></div>
        <div class="campo"><?= e(dataBR($a->getCriado_em())) ?></div>
    </div>
<?php endforeach; ?>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
