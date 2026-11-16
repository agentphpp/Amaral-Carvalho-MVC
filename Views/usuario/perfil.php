<?php
    $titulo = "Meu Perfil"; $pagina = "";
    require "Views/layout/cabecalho.php";
    function erroPerfil($msg, $campo){ if(isset($msg[$campo])) echo '<div class="erro-campo">' . e($msg[$campo]) . '</div>'; }
?>
<main class="container py-5">
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="perfil-card">
                <h1 class="h3 mb-4">Meu perfil</h1>
<?php if(isset($msg["geral"])): ?><div class="alert alert-danger"><?= e($msg["geral"]) ?></div><?php endif; ?>
                <form method="post" action="<?= url("usuario", "perfil") ?>" enctype="multipart/form-data" class="form-roxo" novalidate>
                    <?= Sessao::campoToken() ?>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img class="perfil-avatar" src="<?= e($usuario->getAvatar_foto() ?: "assets/img/logo.png") ?>" alt="Avatar">
                        <div>
                            <label for="avatar">Foto de perfil</label>
                            <input class="form-control" type="file" id="avatar" name="avatar" accept="image/*">
                            <?php erroPerfil($msg, "avatar"); ?>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome_usuario">Nome de usuário</label>
                            <input class="form-control" id="nome_usuario" name="nome_usuario" value="<?= e($dados["nome_usuario"]) ?>">
                            <?php erroPerfil($msg, "nome_usuario"); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="nome_completo">Nome completo</label>
                            <input class="form-control" id="nome_completo" name="nome_completo" value="<?= e($dados["nome_completo"]) ?>">
                            <?php erroPerfil($msg, "nome_completo"); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" id="email" name="email" value="<?= e($dados["email"]) ?>">
                            <?php erroPerfil($msg, "email"); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="data_nascimento">Data de nascimento</label>
                            <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" value="<?= e($dados["data_nascimento"]) ?>" max="<?= date("Y-m-d") ?>">
                            <?php erroPerfil($msg, "data_nascimento"); ?>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h2 class="h5">Trocar senha <small class="text-muted fw-normal">(opcional)</small></h2>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="senha_atual">Senha atual</label>
                            <input class="form-control" type="password" id="senha_atual" name="senha_atual" autocomplete="current-password">
                            <?php erroPerfil($msg, "senha_atual"); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="senha">Nova senha</label>
                            <input class="form-control" type="password" id="senha" name="senha" autocomplete="new-password">
                            <?php erroPerfil($msg, "senha"); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="confirma">Confirmar nova senha</label>
                            <input class="form-control" type="password" id="confirma" name="confirma" autocomplete="new-password">
                            <?php erroPerfil($msg, "confirma"); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn-roxo mt-4">Salvar alterações</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="perfil-card">
                <h2 class="h5 mb-3">Últimos jogos acessados</h2>
<?php if(!$historico): ?>
                <p class="text-muted mb-0">Você ainda não jogou nada. <a href="<?= url("jogo", "listar") ?>">Veja os jogos</a>.</p>
<?php endif; ?>
                <ul class="list-unstyled mb-0">
<?php foreach($historico as $h): ?>
                    <li class="d-flex justify-content-between border-bottom py-2">
                        <a href="<?= url("jogo", "detalhar", array("id" => $h->getJogo()->getId_jogo())) ?>"><?= e($h->getJogo()->getNome()) ?></a>
                        <small class="text-muted"><?= e(dataBR($h->getData_acesso())) ?> · <?= e(duracaoBR($h->getTempo_duracao())) ?></small>
                    </li>
<?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php require "Views/layout/rodape.php"; ?>
