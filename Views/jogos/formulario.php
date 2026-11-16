<?php
    $editando = $jogo !== null;
    $titulo = $editando ? "Editar jogo" : "Adicionar jogo"; $secao = "jogos";
    require "Views/layout/admin_cabecalho.php";
    function erroJ($msg, $c){ if(isset($msg[$c])) echo '<div class="erro-campo">' . e($msg[$c]) . '</div>'; }
?>
<div class="adm-faixa" style="min-height:80px"><h1 class="h4 fw-bold mb-0"><?= e($titulo) ?></h1>
    <div class="adm-acoes"><a class="adm-btn" href="<?= url("jogo", "gerenciar") ?>"><i class="fa-solid fa-arrow-left"></i>Voltar</a></div></div>
<div class="adm-conteudo">
<form class="adm-form" method="post" enctype="multipart/form-data" novalidate
      action="<?= $editando ? url("jogo", "editar", array("id" => $jogo->getId_jogo())) : url("jogo", "inserir") ?>">
    <?= Sessao::campoToken() ?>
<?php if(isset($msg["geral"])): ?><div class="alert alert-danger"><?= e($msg["geral"]) ?></div><?php endif; ?>
    <div class="row g-3">
        <div class="col-md-8"><label for="nome">Nome</label>
            <input class="form-control" id="nome" name="nome" value="<?= e($dados["nome"]) ?>"><?php erroJ($msg, "nome"); ?></div>
        <div class="col-md-4"><label for="finalidade">Finalidade</label>
            <select class="form-select" id="finalidade" name="finalidade">
                <option value="">Selecione</option>
<?php foreach($finalidades as $f): ?>
                <option <?= $dados["finalidade"] === $f ? "selected" : "" ?>><?= e($f) ?></option>
<?php endforeach; ?>
            </select><?php erroJ($msg, "finalidade"); ?></div>
        <div class="col-md-4"><label for="categoria_id">Categoria</label>
            <select class="form-select" id="categoria_id" name="categoria_id">
                <option value="0">Selecione</option>
<?php foreach($categorias as $c): ?>
                <option value="<?= $c->getId_categoria() ?>" <?= $dados["categoria_id"] === $c->getId_categoria() ? "selected" : "" ?>><?= e($c->getNome()) ?></option>
<?php endforeach; ?>
            </select><?php erroJ($msg, "categoria_id"); ?>
<?php if(!$categorias): ?><div class="erro-campo">Cadastre uma categoria primeiro.</div><?php endif; ?></div>
        <div class="col-md-4"><label for="faixa_etaria">Faixa etária</label>
            <input class="form-control" id="faixa_etaria" name="faixa_etaria" placeholder="5-12 anos" value="<?= e($dados["faixa_etaria"]) ?>"><?php erroJ($msg, "faixa_etaria"); ?></div>
        <div class="col-md-4"><label for="duracao_estimada">Duração estimada</label>
            <input class="form-control" id="duracao_estimada" name="duracao_estimada" placeholder="10-20 min" value="<?= e($dados["duracao_estimada"]) ?>"><?php erroJ($msg, "duracao_estimada"); ?></div>
        <div class="col-12"><label for="descricao">Descrição</label>
            <textarea class="form-control" rows="4" id="descricao" name="descricao"><?= e($dados["descricao"]) ?></textarea><?php erroJ($msg, "descricao"); ?></div>
        <div class="col-md-6"><label for="link">Link do jogo</label>
            <input class="form-control" id="link" name="link" placeholder="https://..." value="<?= e($dados["link"]) ?>">
            <div class="form-text">Use # se o jogo ainda não estiver disponível ("Em breve").</div><?php erroJ($msg, "link"); ?></div>
        <div class="col-md-6"><label for="img">Imagem de capa</label>
            <input class="form-control" type="file" id="img" name="img" accept="image/*"><?php erroJ($msg, "img"); ?>
<?php if($editando && $jogo->getImg() !== ""): ?>
            <img src="<?= e($jogo->getImg()) ?>" alt="" style="height:70px;border-radius:12px;margin-top:8px">
<?php endif; ?></div>
    </div>
    <button type="submit" class="adm-btn mt-4"><i class="fa-solid fa-check"></i><?= $editando ? "Salvar alterações" : "Publicar jogo" ?></button>
</form>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
