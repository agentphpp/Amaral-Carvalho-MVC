<?php
    $titulo = "Início"; $pagina = "inicio";
    $css = array();
    $scripts = array(
        '<script src="https://cdn.jsdelivr.net/npm/swiper@11.1.14/swiper-bundle.min.js"></script>',
        '<script src="assets/js/carrousel.js"></script>'
    );
    require "Views/layout/cabecalho.php";
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.1.14/swiper-bundle.min.css">

<section class="apresentacao text-light py-5">
    <div class="container py-4">
        <div class="row align-items-center gy-4">
            <div class="col-12 col-md-6 content-hero">
                <span class="badge-tag mb-3">Hospital Amaral Carvalho</span>
                <h1 class="display-5 fw-bold">Aprender <span class="highlight-yellow">brincando</span> faz toda a diferença</h1>
                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                    <a href="<?= url("jogo", "listar") ?>" class="btn btn-warning-custom">Explorar jogos</a>
                    <a href="<?= url("contato", "inserir") ?>" class="btn btn-outline-light-custom">Entrar em Contato</a>
                </div>
            </div>
            <div class="col-12 col-md-6 text-center">
                <img src="assets/img/eloImagem.jpg" alt="Robô ELO" class="img-fluid img-hero-custom" style="max-height: 340px;">
            </div>
        </div>
    </div>
</section>

<section class="section-light py-5">
    <div class="container text-center">
        <span class="badge-tag-dark mb-4">Proposta do Projeto:</span>
        <h2 class="section-title mb-5">Uma experiência pensada <span class="text-purple">para cada criança</span></h2>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-4">
                <div class="card-proposta p-4 h-100"><div class="icon-box mb-2"><i class="fa-solid fa-robot"></i></div><h3 class="h5">Robô ELO</h3></div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-proposta p-4 h-100"><div class="icon-box mb-2"><i class="fa-solid fa-heart"></i></div><h3 class="h5">Suporte Emocional</h3></div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-proposta p-4 h-100"><div class="icon-box mb-2"><i class="fa-solid fa-gamepad"></i></div><h3 class="h5">Jogos Educativos</h3></div>
            </div>
        </div>
    </div>
</section>

<section class="section-ultra-light py-5">
    <div class="container">
        <div class="text-center mb-4"><span class="badge-tag-dark">Quem Somos</span></div>
        <div class="row align-items-center gy-4">
            <div class="col-12 col-md-5">
                <div class="card-hospital-featured text-center text-light rounded-4 p-4">
                    <div class="hospital-icon-circle mx-auto mb-3"><i class="fa-solid fa-hospital text-purple"></i></div>
                    <h3 class="h5">Hospital Amaral Carvalho</h3>
                </div>
            </div>
            <div class="col-12 col-md-7 text-description">
                <h2 class="title-purple-dark mb-3">Cuidar vai além <br><span class="text-purple">da medicina</span></h2>
                <p>A Fundação Hospital Amaral Carvalho é referência no tratamento oncológico e no cuidado humanizado aos pacientes. Com uma trajetória marcada pela dedicação, acolhimento e compromisso com a vida, a instituição busca oferecer não apenas tratamento médico de excelência, mas também apoio emocional, social e educacional para crianças e famílias.</p>
                <p>Pensando em tornar o ambiente hospitalar mais leve, acolhedor e educativo, surgiu este projeto: uma plataforma de jogos desenvolvida para proporcionar momentos de aprendizado, diversão e conforto durante o período de tratamento e recuperação.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 border-top-divider jogos-destaque">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <span class="badge-tag-dark fs-5">Jogos em Destaque</span>
            <a href="<?= url("jogo", "listar") ?>" class="btn-outline-purple-action text-decoration-none">Ver todos os jogos <i class="fa-solid fa-arrow-right"></i></a>
        </div>
<?php if(!$destaques): ?>
        <p class="text-center text-muted">Em breve novos jogos por aqui!</p>
<?php else: ?>
        <div class="swiper">
            <div class="swiper-wrapper card-list">
<?php foreach($destaques as $jogo): ?>
                <div class="swiper-slide card-item">
                    <div class="card-image-area placeholder-bg">
                        <img class="capa" src="<?= e($jogo->getImg()) ?>" alt="<?= e($jogo->getNome()) ?>">
<?php if($jogo->getMediaAvaliacoes() !== null): ?>
                        <span class="rating"><?= e(number_format($jogo->getMediaAvaliacoes(), 1, ",", "")) ?> ★</span>
<?php endif; ?>
                    </div>
                    <h3 class="card-title-slider"><?= e($jogo->getNome()) ?></h3>
                    <p class="user-profession"><?= e($jogo->getCategoria()->getNome()) ?> · <?= e($jogo->getDuracao_estimada()) ?></p>
                    <a class="message-button" href="<?= url("jogo", "detalhar", array("id" => $jogo->getId_jogo())) ?>">Ver jogo</a>
                </div>
<?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
<?php endif; ?>
    </div>
</section>

<?php require "Views/layout/rodape.php"; ?>
