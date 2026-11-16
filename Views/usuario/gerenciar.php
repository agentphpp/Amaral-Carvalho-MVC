<?php $titulo = "Usuários"; $secao = "usuarios"; require "Views/layout/admin_cabecalho.php"; ?>
<div class="adm-faixa">
    <div class="adm-stat">Usuários<div class="num"><?= count($usuarios) ?></div></div>
    <div class="adm-acoes"><a class="adm-btn" href="<?= url("usuario", "criar") ?>"><i class="fa-solid fa-plus"></i>Adicionar usuario</a></div>
</div>
<div class="adm-conteudo">
<?php foreach($usuarios as $u): ?>
    <div class="adm-linha">
        <div><img class="avatar" src="<?= e($u->getAvatar_foto() ?: "assets/img/logo.png") ?>" alt=""></div>
        <div class="nome"><?= e($u->getNome_usuario()) ?><br><small class="fw-normal"><?= e($u->getEmail()) ?></small></div>
        <div class="campo"><?= e(dataBR($u->getCriado_em())) ?></div>
        <div class="campo"><?= $u->ehAdmin() ? "Administrador" : "Usuário" ?></div>
        <div class="engrenagem">
            <a href="<?= url("usuario", "editar", array("id" => $u->getId_usuario())) ?>" title="Editar"><i class="fa-solid fa-gear"></i></a>
<?php if($u->getId_usuario() !== Sessao::id()): ?>
            <form method="post" action="<?= url("usuario", "excluir") ?>" onsubmit="return confirm('Excluir este usuário?')">
                <?= Sessao::campoToken() ?><input type="hidden" name="id" value="<?= $u->getId_usuario() ?>">
                <button type="submit" title="Excluir"><i class="fa-solid fa-trash"></i></button>
            </form>
<?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
