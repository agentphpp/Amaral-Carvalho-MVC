
<footer class="site-footer text-light mt-auto">
    <div class="container footer-container py-4">
        <div class="footer-grid">

            <div class="footer-brand">
                <img src="assets/img/logo-amaral-carvalho.png"
                     alt="Hospital Amaral Carvalho"
                     class="footer-logo-hospital">

                <p class="mb-0 mt-2">
                    Aprender também é cuidar.
                </p>
            </div>

            <div class="footer-links">
                <h2 class="h6 mb-3">Navegação</h2>

                <div class="d-flex flex-column gap-2">
                    <a href="<?= url("inicio", "inicio") ?>">Início</a>
                    <a href="<?= url("jogo", "listar") ?>">Jogos</a>
                    <a href="<?= url("inicio", "sobre") ?>">Sobre</a>
                    <a href="<?= url("contato", "inserir") ?>">Contato</a>
                </div>
            </div>

            <div class="footer-contato">
                <h2 class="h6 mb-3">Acompanhe</h2>

                <div class="footer-icons">
                    <a href="https://www.instagram.com/amaral.carvalho/"
                       target="_blank" rel="noopener"
                       aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="tel:+551436021200" aria-label="Telefone">
                        <i class="fa-solid fa-phone"></i>
                    </a>

                    <a href="mailto:ouvidoria@amaralcarvalho.org.br"
                       aria-label="E-mail">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="down-footer">
        <div class="container text-center py-3">
            <small>
                &copy; <?= date("Y") ?> Hospital Amaral Carvalho.
                Todos os direitos reservados.
            </small>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php foreach(($scripts ?? array()) as $s): ?>
<?= $s . "\n" ?>
<?php endforeach; ?>
</body>
</html>
