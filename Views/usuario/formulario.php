<?php
    $editando = $usuario !== null;
    $titulo = $editando ? "Editar usuário" : "Adicionar usuário"; $secao = "usuarios";
    require "Views/layout/admin_cabecalho.php";
    function erroU($msg, $c){ if(isset($msg[$c])) echo '<div class="erro-campo">' . e($msg[$c]) . '</div>'; }
    $proprio = $editando && $usuario->getId_usuario() === Sessao::id();
?>
<div class="adm-faixa" style="min-height:80px"><h1 class="h4 fw-bold mb-0"><?= e($titulo) ?></h1>
    <div class="adm-acoes"><a class="adm-btn" href="<?= url("usuario", "gerenciar") ?>"><i class="fa-solid fa-arrow-left"></i>Voltar</a></div></div>
<div class="adm-conteudo">
<form class="adm-form" method="post" novalidate
      action="<?= $editando ? url("usuario", "editar", array("id" => $usuario->getId_usuario())) : url("usuario", "criar") ?>">
    <?= Sessao::campoToken() ?>
<?php if(isset($msg["geral"])): ?><div class="alert alert-danger"><?= e($msg["geral"]) ?></div><?php endif; ?>
    <div class="row g-3">
        <div class="col-md-6"><label for="nome_usuario">Nome de usuário</label>
            <input class="form-control" id="nome_usuario" name="nome_usuario" value="<?= e($dados["nome_usuario"]) ?>"><?php erroU($msg, "nome_usuario"); ?></div>
        <div class="col-md-6"><label for="nome_completo">Nome completo</label>
            <input class="form-control" id="nome_completo" name="nome_completo" value="<?= e($dados["nome_completo"]) ?>"><?php erroU($msg, "nome_completo"); ?></div>
        <div class="col-md-6"><label for="email">E-mail</label>
            <input class="form-control" type="email" id="email" name="email" value="<?= e($dados["email"]) ?>"><?php erroU($msg, "email"); ?></div>
        <div class="col-md-3"><label for="data_nascimento">Nascimento</label>
            <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" value="<?= e($dados["data_nascimento"]) ?>"><?php erroU($msg, "data_nascimento"); ?></div>
        <div class="col-md-3"><label for="tipo_acesso">Cargo</label>
            <select class="form-select" id="tipo_acesso" name="tipo_acesso" <?= $proprio ? "disabled" : "" ?>>
                <option value="usuario" <?= $dados["tipo_acesso"] === "usuario" ? "selected" : "" ?>>Usuário</option>
                <option value="admnistrador" <?= $dados["tipo_acesso"] === "admnistrador" ? "selected" : "" ?>>Administrador</option>
            </select></div>
        <div class="col-md-6"><label for="senha">Senha <?= $editando ? "(deixe em branco para manter)" : "" ?></label>
            <input class="form-control" type="password" id="senha" name="senha" autocomplete="new-password"><?php erroU($msg, "senha"); ?></div>
        <div class="col-md-6"><label for="confirma">Confirmar senha</label>
            <input class="form-control" type="password" id="confirma" name="confirma" autocomplete="new-password"><?php erroU($msg, "confirma"); ?></div>
    </div>
    <button type="submit" class="adm-btn mt-4"><i class="fa-solid fa-check"></i>Salvar</button>
</form>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
