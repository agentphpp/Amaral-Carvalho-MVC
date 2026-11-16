<?php $pagina = $pagina ?? ""; ?>
<header class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container navbar-container">
        <a class="navbar-brand logo-placeholder" href="index.php">
            <img src="assets/img/logo.png" alt="Logo do ELO" class="img-fluid rounded-circle"
                style="width: 40px; height: 40px; object-fit: cover;">
        </a>

        <nav class="d-flex align-items-center mx-auto menu-principal">
            <ul class="nav-links">
                <li><a href="<?= url("inicio", "inicio") ?>" class="<?= $pagina === "inicio" ? "active" : "" ?>">Início</a></li>
                <li><a href="<?= url("jogo", "listar") ?>" class="<?= $pagina === "jogos" ? "active" : "" ?>">Jogos</a></li>
                <li><a href="<?= url("inicio", "sobre") ?>" class="<?= $pagina === "sobre" ? "active" : "" ?>">Sobre</a></li>
                <li><a href="<?= url("contato", "inserir") ?>" class="<?= $pagina === "contato" ? "active" : "" ?>">Contato</a></li>
            </ul>
        </nav>

<?php if(Sessao::logado()): ?>
        <div class="dropdown">
            <a href="#" class="btn-entrar dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-regular fa-circle-user"></i><?= e($_SESSION["nome"]) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
<?php if(Sessao::admin()): ?>
                <li><a class="dropdown-item" href="<?= url("inicio", "painel") ?>"><i class="fa-solid fa-table-columns me-2"></i>Painel admin</a></li>
<?php endif; ?>
                <li><a class="dropdown-item" href="<?= url("usuario", "perfil") ?>"><i class="fa-solid fa-gear me-2"></i>Meu perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?= url("usuario", "logout") ?>"><i class="fa-solid fa-right-from-bracket me-2"></i>Sair</a></li>
            </ul>
        </div>
<?php else: ?>
        <a href="<?= url("usuario", "login") ?>" class="btn-entrar">
            <i class="fa-solid fa-right-to-bracket"></i>Entrar
        </a>
<?php endif; ?>
    </div>
</header>
