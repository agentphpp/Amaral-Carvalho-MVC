<?php
    $editando = $categoria !== null;
    $titulo = $editando ? "Editar categoria" : "Adicionar categoria"; $secao = "jogos";
    require "Views/layout/admin_cabecalho.php";
?>
<div class="adm-faixa" style="min-height:80px"><h1 class="h4 fw-bold mb-0"><?= e($titulo) ?></h1>
    <div class="adm-acoes"><a class="adm-btn" href="<?= url("categoria", "gerenciar") ?>"><i class="fa-solid fa-arrow-left"></i>Voltar</a></div></div>
<div class="adm-conteudo">
<form class="adm-form" method="post" novalidate
      action="<?= $editando ? url("categoria", "editar", array("id" => $categoria->getId_categoria())) : url("categoria", "inserir") ?>">
    <?= Sessao::campoToken() ?>
<?php if(isset($msg["geral"])): ?><div class="alert alert-danger"><?= e($msg["geral"]) ?></div><?php endif; ?>
    <label for="nome">Nome da categoria</label>
    <input class="form-control" id="nome" name="nome" value="<?= e($nome) ?>" maxlength="255">
<?php if(isset($msg["nome"])): ?><div class="erro-campo"><?= e($msg["nome"]) ?></div><?php endif; ?>
    <button type="submit" class="adm-btn mt-4"><i class="fa-solid fa-check"></i>Salvar</button>
</form>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
