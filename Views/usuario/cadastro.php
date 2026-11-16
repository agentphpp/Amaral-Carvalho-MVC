<?php
    $titulo = "Cadastrar Conta"; $pagina = ""; $css = array("styleCadastro.css"); $bodyClass = "login-body";
    require "Views/layout/cabecalho.php";
    function campoErro($msg, $campo){ if(isset($msg[$campo])) echo '<div class="erro-campo">' . e($msg[$campo]) . '</div>'; }
?>
<div class="container d-flex align-items-center justify-content-center p-3 flex-grow-1">
    <div class="login-box text-center p-4 p-sm-5 rounded-4 position-relative">
        <h1 class="login-title mb-4">Cadastrar <span class="highlight-magenta">conta</span></h1>

<?php if(isset($msg["geral"])): ?>
        <div class="alert alert-danger alert-login"><?= e($msg["geral"]) ?></div>
<?php endif; ?>

        <form method="post" action="<?= url("usuario", "inserir") ?>" class="mx-auto form-container" novalidate>
            <?= Sessao::campoToken() ?>
            <div class="input-group-custom mb-1 d-flex align-items-center">
                <i class="fa-regular fa-user input-icon"></i>
                <input type="text" name="nome_usuario" value="<?= e($dados["nome_usuario"]) ?>" placeholder="Nome de usuário" class="form-input-line w-100" autocomplete="username">
            </div>
            <?php campoErro($msg, "nome_usuario"); ?>

            <div class="input-group-custom mb-1 mt-3 d-flex align-items-center">
                <i class="fa-regular fa-id-card input-icon"></i>
                <input type="text" name="nome_completo" value="<?= e($dados["nome_completo"]) ?>" placeholder="Nome completo" class="form-input-line w-100" autocomplete="name">
            </div>
            <?php campoErro($msg, "nome_completo"); ?>

            <div class="input-group-custom mb-1 mt-3 d-flex align-items-center">
                <i class="fa-regular fa-envelope input-icon"></i>
                <input type="email" name="email" value="<?= e($dados["email"]) ?>" placeholder="Email" class="form-input-line w-100" autocomplete="email">
            </div>
            <?php campoErro($msg, "email"); ?>

            <div class="input-group-custom mb-1 mt-3 d-flex align-items-center">
                <i class="fa-regular fa-calendar input-icon"></i>
                <input type="date" name="data_nascimento" value="<?= e($dados["data_nascimento"]) ?>" max="<?= date("Y-m-d") ?>" class="form-input-line w-100" aria-label="Data de nascimento">
            </div>
            <?php campoErro($msg, "data_nascimento"); ?>

            <div class="input-group-custom mb-1 mt-3 d-flex align-items-center">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" name="senha" placeholder="Senha (mín. 6 caracteres)" class="form-input-line w-100" autocomplete="new-password">
            </div>
            <?php campoErro($msg, "senha"); ?>

            <div class="input-group-custom mb-1 mt-3 d-flex align-items-center">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" name="confirma" placeholder="Confirmar senha" class="form-input-line w-100" autocomplete="new-password">
            </div>
            <?php campoErro($msg, "confirma"); ?>

            <div class="d-flex flex-column gap-3 align-items-center mt-4">
                <button type="submit" class="btn-login-action btn-confirmar">Confirmar</button>
                <a href="<?= url("usuario", "login") ?>"
                    class="btn-login-action btn-possui-conta text-decoration-none d-flex align-items-center justify-content-center">Possui Conta?</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
