<footer class="text-light pt-5 mt-auto">
    <div class="container">
        <div class="row gy-4 align-items-start footer-grid mb-5">
            <div class="col-12 col-md-4 footer-brand px-3 px-md-0">
                <img src="assets/img/logo.png" alt="Logo do ELO" class="img-fluid mb-3"
                    style="width: 60px; height: 60px; object-fit: cover;">
                <hr class="border-light opacity-50">
                <p>Plataforma com jogos educativos voltados à aprendizagem de forma divertida e principalmente para
                    o <strong>acolhimento</strong>.</p>
            </div>

            <div class="col-12 col-sm-6 col-md-3 footer-links footer-column text-center">
                <h4 class="h5 mb-3">Navegação</h4>
                <div class="d-flex flex-column gap-2">
                    <a href="<?= url("inicio", "inicio") ?>" class="text-hover-white">Início</a>
                    <a href="<?= url("jogo", "listar") ?>" class="text-hover-white">Jogos</a>
                    <a href="<?= url("inicio", "sobre") ?>" class="text-hover-white">Sobre</a>
                    <a href="<?= url("contato", "inserir") ?>" class="text-hover-white">Contato</a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 footer-contato footer-column text-center">
                <h4 class="h5 mb-3">Redes Sociais</h4>
                <div class="footer-icons d-flex justify-content-center gap-3 fs-5">
                    <a href="https://www.instagram.com/amaral.carvalho/" target="_blank" rel="noopener" class="footer-social-icon text-hover-white" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="tel:+551436021200" class="footer-social-icon text-hover-white" aria-label="Telefone"><i class="fa-solid fa-phone"></i></a>
                    <a href="mailto:ouvidoria@amaralcarvalho.org.br" class="footer-social-icon text-hover-white" aria-label="E-mail"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="down-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center footer-bottom">
                    <p class="mb-0">&copy; 2026 ELOPLAY. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php foreach(($scripts ?? array()) as $s): ?>
<?= $s . "\n" ?>
<?php endforeach; ?>
</body>
</html>
