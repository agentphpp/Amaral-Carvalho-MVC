<?php $titulo = "Jogos"; $secao = "jogos"; require "Views/layout/admin_cabecalho.php"; ?>
<div class="adm-faixa">
    <div class="adm-stat">Jogos Publicados<div class="num"><?= count($jogos) ?></div></div>
    <div class="adm-acoes">
        <a class="adm-btn" href="<?= url("jogo", "inserir") ?>"><i class="fa-solid fa-plus"></i>Adicionar jogo</a>
        <a class="adm-btn" href="<?= url("categoria", "gerenciar") ?>"><i class="fa-solid fa-tags"></i>Categorias</a>
        <a class="adm-btn" href="<?= url("categoria", "inserir") ?>"><i class="fa-solid fa-plus"></i>Adicionar categoria</a>
    </div>
</div>
<div class="adm-conteudo">
<?php if(!$jogos): ?>
    <p class="adm-vazio">Nenhum jogo publicado. Clique em "Adicionar jogo".</p>
<?php endif; ?>
<?php foreach($jogos as $j): ?>
    <div class="adm-jogo">
        <div class="capa"><img src="<?= e($j->getImg()) ?>" alt="<?= e($j->getNome()) ?>"></div>
        <div class="cel"><?= e($j->getNome()) ?></div>
        <div class="cel">Publicado: <?= e(dataBR($j->getCriado_em())) ?></div>
        <div class="cel"><?= e($j->getCategoria()->getNome()) ?></div>
        <div class="cel"><?= e($j->getFinalidade()) ?></div>
        <div class="engrenagem">
            <a href="<?= url("jogo", "editar", array("id" => $j->getId_jogo())) ?>" title="Editar"><i class="fa-solid fa-gear"></i></a>
            <form method="post" action="<?= url("jogo", "excluir") ?>" onsubmit="return confirm('Excluir o jogo <?= e(addslashes($j->getNome())) ?>?')">
                <?= Sessao::campoToken() ?><input type="hidden" name="id" value="<?= $j->getId_jogo() ?>">
                <button type="submit" title="Excluir"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
