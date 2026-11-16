<?php
    $titulo = "Início"; $pagina = "inicio";
    $css = array();
    $scripts = array(
        '<script src="https://cdn.jsdelivr.net/npm/swiper@11.1.14/swiper-bundle.min.js"></script>',
        '<script src="assets/js/carrousel.js"></script>'
    );
    require "Views/layout/cabecalho.php";
?>

<main class="pagina-inicial">
    <section class="apresentacao hero-inicio text-light vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-12 col-md-7 content-hero">
                    <span class="badge-tag mb-3">Hospital Amaral Carvalho</span>
                    <h1>Aprender <span class="highlight-yellow">brincando</span> faz toda a diferença</h1>
                    <p class="hero-descricao">Jogos educativos para tornar o período de tratamento mais leve, acolhedor e divertido.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="<?= url("jogo", "listar") ?>" class="btn btn-warning-custom">Explorar jogos <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        <a href="<?= url("contato", "inserir") ?>" class="btn btn-outline-light-custom">Entrar em contato</a>
                    </div>
                </div>
                <div class="col-12 col-md-5 text-center hero-elo-wrap">
                    <img src="assets/img/ELO2Imagem.jpg" alt="Robô ELO" class="img-fluid hero-elo">
                </div>
            </div>
        </div>
    </section>

    <section id="projeto" class="section-light py-5 proposta-inicio">
        <div class="container text-center">
            <h2 class="section-title mb-4">Uma experiência pensada para cada criança</h2>
            <div class="row g-3 justify-content-center">
                <div class="col-12 col-md-4">
                    <article class="card-proposta h-100 p-4">
                        <div class="icon-box mb-2"><i class="fa-solid fa-robot"></i></div>
                        <h3 class="h5 mb-0">Robô ELO</h3>
                        <button type="button" class="btn texto mt-2" data-bs-toggle="modal" data-bs-target="#modalElo">Saiba mais <i class="fa-solid fa-arrow-right ms-1"></i></button>
                    </article>
                </div>
                <div class="col-12 col-md-4">
                    <article class="card-proposta h-100 p-4">
                        <div class="icon-box mb-2"><i class="fa-regular fa-heart"></i></div>
                        <h3 class="h5 mb-0">Suporte emocional</h3>
                    </article>
                </div>
                <div class="col-12 col-md-4">
                    <article class="card-proposta h-100 p-4">
                        <div class="icon-box mb-2"><i class="fa-solid fa-gamepad"></i></div>
                        <h3 class="h5 mb-0">Jogos educativos</h3>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalElo" tabindex="-1" aria-labelledby="modalEloLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="modalEloLabel">Robô ELO</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="bg-light mb-4 border-0 p-3 rounded-3">
                        <p class="lead fw-bold mb-0">O novo Ursinho Elo é uma versão robótica e tecnológica do projeto original de 2014, desenvolvida pelo Hospital Amaral Carvalho para humanizar o tratamento de crianças com câncer.</p>
                    </div>
                    <div class="bg-light mb-4 border-0 p-4 rounded-3">
                        <div class="row g-4 align-items-center">
                            <article class="col-lg-7 order-lg-1 order-2">
                                <h3 class="h5">Características e Funcionalidades</h3>
                                <ul>
                                    <li><strong>Mobilidade e Autonomia:</strong> o robô possui cerca de 1,5 metros de altura e foi programado para mapear toda a área da pediatria, conseguindo se locomover sozinho até os quartos dos pacientes após receber um comando.</li>
                                    <li><strong>Interação Visual:</strong> possui olhos que piscam e uma tela acoplada onde as crianças podem assistir a vídeos.</li>
                                    <li><strong>Mensagens de Afeto:</strong> traz mensagens em vídeo de familiares e amigos, permitindo que a criança veja e ouça seus entes queridos.</li>
                                    <li><strong>Entretenimento e Jogos:</strong> funciona como um companheiro interativo, sendo capaz de contar histórias, cantar parabéns e participar de jogos como o da memória e o jogo da velha.</li>
                                    <li><strong>Informação:</strong> também é utilizado para apresentar vídeos institucionais e explicar as tarefas e rotinas da pediatria para os pacientes.</li>
                                </ul>
                            </article>
                            <div class="col-lg-5 d-flex justify-content-center">
                                <iframe src="https://www.facebook.com/plugins/video.php?height=476&amp;href=https%3A%2F%2Fwww.facebook.com%2Freel%2F3171788646332981%2F&amp;show_text=false&amp;width=267&amp;t=0" width="267" height="476" style="border:none;overflow:hidden;max-width:100%" scrolling="no" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen class="rounded"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light border-0 p-3 rounded-3">
                        <h3 class="h5">Importância</h3>
                        <ul class="mb-0">
                            <li>A importância do Ursinho Elo reside no cuidado humanizado, focando no bem-estar emocional do paciente e não apenas na cura da doença. O projeto é tão significativo que sua primeira versão conquistou o prêmio Leão de Ouro em Cannes, em 2014.</li>
                            <li>Para os pacientes, como relatado por Théo Manzini, o robô representa a ponte que os une novamente à família e aos amigos, o que é fundamental para enfrentar o isolamento do tratamento.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="quem-somos py-5 section-ultra-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-12 col-md-5">
                    <div class="card-hospital-featured p-4 text-light text-center rounded-4 shadow-sm">
                        <img src="https://cdn.prod.website-files.com/642302a0f023e00b83b9be99/64e34c3e3f1e7e519eb1da1a_whatsapp-image-2017-10-05-at-15-54-09.jpeg" alt="Hospital Amaral Carvalho" class="img-fluid hospital-foto mb-3">
                        <h2 class="h5 mb-3">Hospital Amaral Carvalho</h2>
                        <a href="https://www.amaralcarvalho.org.br/sobre" target="_blank" rel="noopener" class="btn btn-outline-light rounded-pill">Saiba mais <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-7 text-description">
                    <h2 class="title-purple-dark mb-3">Quem somos</h2>
                    <p>O Hospital Amaral Carvalho acredita no poder do cuidado, da tecnologia e do acolhimento para transformar vidas.</p>
                    <p class="mb-0">Com o ELO, unimos saúde, aprendizado e diversão em uma jornada de apoio às crianças em tratamento. A plataforma foi desenvolvida para proporcionar momentos de aprendizado, conforto e descontração durante o período de tratamento.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 border-top-divider jogos-destaque">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h2 class="section-title m-0">Jogos em destaque</h2>
                <a href="<?= url("jogo", "listar") ?>" class="btn-outline-purple-action text-decoration-none">Ver todos os jogos <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
<?php if(!$destaques): ?>
            <p class="text-center text-muted py-4">Em breve novos jogos por aqui!</p>
<?php else: ?>
            <div class="jogos-destaque-carousel">
                <div class="swiper jogos-swiper">
                    <div class="swiper-wrapper card-list">
<?php foreach($destaques as $jogo): ?>
                        <article class="swiper-slide card-item">
                            <div class="card-image-area placeholder-bg">
                                <img class="capa" src="<?= e($jogo->getImg()) ?>" alt="<?= e($jogo->getNome()) ?>">
<?php if($jogo->getMediaAvaliacoes() !== null): ?>
                                <span class="rating"><?= e(number_format($jogo->getMediaAvaliacoes(), 1, ",", "")) ?> ★</span>
<?php endif; ?>
                            </div>
                            <h3 class="card-title-slider"><?= e($jogo->getNome()) ?></h3>
                            <p class="user-profession"><?= e($jogo->getCategoria()->getNome()) ?> · <?= e($jogo->getDuracao_estimada()) ?></p>
                            <a class="message-button" href="<?= url("jogo", "detalhar", array("id" => $jogo->getId_jogo())) ?>">Ver jogo</a>
                        </article>
<?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <button class="swiper-button-prev" type="button" aria-label="Jogos anteriores"></button>
                <button class="swiper-button-next" type="button" aria-label="Próximos jogos"></button>
            </div>
<?php endif; ?>
        </div>
    </section>
</main>

<?php require "Views/layout/rodape.php"; ?>
