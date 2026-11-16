<?php
    $titulo = "Entrar na Conta"; $pagina = ""; $css = array("styleLogin.css"); $bodyClass = "login-body";
    require "Views/layout/cabecalho.php";
?>
<div class="container d-flex align-items-center justify-content-center p-3 flex-grow-1">
    <div class="login-box text-center p-4 p-sm-5 rounded-4 position-relative">
        <h1 class="login-title mb-4">Entrar na <span class="highlight-purple-light">conta</span></h1>

        <div class="logo-container mx-auto mb-4">
            <img src="assets/img/logo.png" alt="Logo do ELO" class="img-fluid logo-img w-100">
        </div>

<?php if(isset($msg["geral"])): ?>
        <div class="alert alert-danger alert-login"><?= e($msg["geral"]) ?></div>
<?php endif; ?>

        <form method="post" action="<?= url("usuario", "login") ?>" class="mx-auto form-container" novalidate>
            <?= Sessao::campoToken() ?>
            <div class="input-group-custom mb-2 d-flex align-items-center">
                <i class="fa-regular fa-user input-icon"></i>
                <input type="text" name="identificador" value="<?= e($identificador) ?>" placeholder="Nome de usuário ou e-mail" class="form-input-line w-100" autocomplete="username">
            </div>
            <?php if(isset($msg["identificador"])): ?><div class="erro-campo"><?= e($msg["identificador"]) ?></div><?php endif; ?>

            <div class="input-group-custom mb-2 mt-4 d-flex align-items-center">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" name="senha" placeholder="Senha" class="form-input-line w-100" autocomplete="current-password">
            </div>
            <?php if(isset($msg["senha"])): ?><div class="erro-campo"><?= e($msg["senha"]) ?></div><?php endif; ?>

            <div class="d-flex flex-column gap-3 align-items-center mt-5">
                <button type="submit" class="btn-login-action btn-confirmar">Confirmar</button>
                <a href="<?= url("usuario", "inserir") ?>"
                    class="btn-login-action btn-cadastro text-decoration-none d-flex align-items-center justify-content-center">Cadastro</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
