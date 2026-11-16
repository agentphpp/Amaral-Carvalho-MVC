<?php $titulo = "Comentários"; $secao = "comentarios"; require "Views/layout/admin_cabecalho.php"; ?>
<div class="adm-faixa">
    <div class="adm-stat">Comentários<div class="num"><?= count($avaliacoes) ?></div></div>
    <form class="adm-acoes" method="get" action="index.php">
        <input type="hidden" name="controle" value="avaliacao"><input type="hidden" name="metodo" value="gerenciar">
        <select class="adm-filtro" name="jogo" onchange="this.form.submit()" aria-label="Filtrar por jogo">
            <option value="0">Todos os jogos</option>
<?php foreach($jogos as $j): ?>
            <option value="<?= $j->getId_jogo() ?>" <?= $jogoId === $j->getId_jogo() ? "selected" : "" ?>><?= e($j->getNome()) ?></option>
<?php endforeach; ?>
        </select>
        <span class="adm-btn" style="pointer-events:none"><i class="fa-solid fa-filter"></i>Filtro</span>
    </form>
</div>
<div class="adm-conteudo">
<?php if(!$avaliacoes): ?><p class="adm-vazio">Nenhum comentário encontrado.</p><?php endif; ?>
<?php foreach($avaliacoes as $a): ?>
    <div class="adm-comentario">
        <div class="topo">
            <img class="avatar" src="<?= e($a->getUsuario()->getAvatar_foto() ?: "assets/img/logo.png") ?>" alt="">
            <div class="usuario"><?= e($a->getUsuario()->getNome_usuario()) ?></div>
            <div style="flex:1"><?= e($a->getJogo()->getNome()) ?> · <span style="color:#d97706"><?= estrelas($a->getNota()) ?></span></div>
            <div><?= e(dataBR($a->getCriado_em())) ?></div>
            <form method="post" action="<?= url("avaliacao", "excluir") ?>" onsubmit="return confirm('Excluir este comentário?')">
                <?= Sessao::campoToken() ?><input type="hidden" name="id" value="<?= $a->getId_avaliacao() ?>"><input type="hidden" name="origem" value="admin">
                <button class="btn btn-outline-danger" type="submit" title="Excluir"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
        <div class="descritivo"><?= e($a->getComentario()) ?></div>
    </div>
<?php endforeach; ?>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
