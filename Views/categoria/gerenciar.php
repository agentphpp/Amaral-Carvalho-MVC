<?php $titulo = "Categorias"; $secao = "jogos"; require "Views/layout/admin_cabecalho.php"; ?>
<div class="adm-faixa">
    <div class="adm-stat">Categorias<div class="num"><?= count($categorias) ?></div></div>
    <div class="adm-acoes">
        <a class="adm-btn" href="<?= url("categoria", "inserir") ?>"><i class="fa-solid fa-plus"></i>Adicionar categoria</a>
        <a class="adm-btn" href="<?= url("jogo", "gerenciar") ?>"><i class="fa-solid fa-arrow-left"></i>Jogos</a>
    </div>
</div>
<div class="adm-conteudo">
<?php if(!$categorias): ?><p class="adm-vazio">Nenhuma categoria cadastrada.</p><?php endif; ?>
<?php foreach($categorias as $c): ?>
    <div class="adm-linha">
        <div class="nome"><?= e($c->getNome()) ?></div>
        <div class="campo"><?= $c->getTotalJogos() ?> jogo(s)</div>
        <div class="engrenagem">
            <a href="<?= url("categoria", "editar", array("id" => $c->getId_categoria())) ?>" title="Editar"><i class="fa-solid fa-gear"></i></a>
            <form method="post" action="<?= url("categoria", "excluir") ?>" onsubmit="return confirm('Excluir esta categoria?')">
                <?= Sessao::campoToken() ?><input type="hidden" name="id" value="<?= $c->getId_categoria() ?>">
                <button type="submit" title="Excluir"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
