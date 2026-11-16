<?php
    $titulo = $jogo->getNome(); $pagina = "jogos"; $css = array("styleDescricao.css");
    require "Views/layout/cabecalho.php";
    $scripts = array('<script src="assets/js/jogar.js"></script>');
    $link = $jogo->getLink();
    $temLink = preg_match('#^https?://#i', $link);
?>
<main class="container py-5">
    <section class="hero-jogo">
        <div class="hero-imagem">
            <img id="imagem-jogo" src="<?= e($jogo->getImg()) ?>" alt="<?= e($jogo->getNome()) ?>">
        </div>
        <div class="hero-conteudo">
<?php if($jogo->getMediaAvaliacoes() !== null): ?>
            <span class="avaliacao"><?= e(number_format($jogo->getMediaAvaliacoes(), 1, ",", "")) ?> ★ (<?= $jogo->getTotalAvaliacoes() ?>)</span>
<?php endif; ?>
            <h1><?= e($jogo->getNome()) ?></h1>
            <p class="subtitulo"><?= e($jogo->getFinalidade()) ?> · <?= e($jogo->getCategoria()->getNome()) ?></p>
<?php if($temLink): ?>
            <a href="<?= url("jogo", "executar", array("id" => $jogo->getId_jogo())) ?>" class="btn-jogar" target="_blank" rel="noopener"
               <?php if(Sessao::logado()): ?>data-jogar data-jogo="<?= $jogo->getId_jogo() ?>" data-csrf="<?= e(Sessao::token()) ?>"
               data-iniciar="<?= e(url("jogo", "iniciar")) ?>" data-finalizar="<?= e(url("jogo", "finalizar")) ?>"<?php endif; ?>>Jogar Agora</a>
<?php else: ?>
            <a href="#" class="btn-jogar" style="pointer-events:none;background:rgba(255,255,255,.08);border-color:#fff;color:#fff">Em breve....</a>
<?php endif; ?>
        </div>
    </section>

    <section class="informacoes mt-5">
        <div class="info-card">
            <i class="fa-solid fa-child-reaching"></i>
            <h6>Faixa Etária</h6>
            <p><?= e($jogo->getFaixa_etaria()) ?></p>
        </div>
        <div class="info-card">
            <i class="fa-regular fa-clock"></i>
            <h6>Duração</h6>
            <p><?= e($jogo->getDuracao_estimada()) ?></p>
        </div>
        <div class="info-card">
            <i class="fa-solid fa-bullseye"></i>
            <h6>Finalidade</h6>
            <p><?= e($jogo->getFinalidade()) ?></p>
        </div>
    </section>

    <section class="categorias mt-4">
        <span class="categoria"><?= e($jogo->getCategoria()->getNome()) ?></span>
    </section>

    <section class="descricao mt-5">
        <h2>Sobre o jogo</h2>
        <p><?= nl2br(e($jogo->getDescricao())) ?></p>
    </section>

    <section class="avaliar mt-5" id="avaliacoes">
        <h2>Avalie este jogo</h2>
<?php if(Sessao::logado()): ?>
        <form method="post" action="<?= url("avaliacao", "inserir") ?>">
            <?= Sessao::campoToken() ?>
            <input type="hidden" name="jogo_id" value="<?= $jogo->getId_jogo() ?>">
            <div class="estrelas-input mb-2" role="radiogroup" aria-label="Nota">
<?php for($i = 5; $i >= 1; $i--): ?>
                <input type="radio" id="nota<?= $i ?>" name="nota" value="<?= $i ?>" <?= $minha && $minha->getNota() === $i ? "checked" : "" ?>>
                <label for="nota<?= $i ?>" title="<?= $i ?> estrela(s)">★</label>
<?php endfor; ?>
            </div>
            <textarea name="comentario" placeholder="Compartilhe sua experiência..." maxlength="1000" required><?= $minha ? e($minha->getComentario()) : "" ?></textarea>
            <button class="btn-publicar" type="submit"><?= $minha ? "Atualizar Avaliação" : "Publicar Avaliação" ?></button>
        </form>
<?php else: ?>
        <div class="aviso-login">
            Para avaliar e comentar é preciso estar logado.
            <a href="<?= url("usuario", "login") ?>">Entrar</a> ou <a href="<?= url("usuario", "inserir") ?>">cadastrar-se</a>.
        </div>
<?php endif; ?>

        <div class="avaliacoes-lista">
<?php if(!$avaliacoes): ?>
            <p class="text-muted">Ainda não há avaliações. Seja o primeiro!</p>
<?php endif; ?>
<?php foreach($avaliacoes as $a): ?>
            <article class="avaliacao-item">
                <div class="topo">
                    <img class="avatar-mini" src="<?= e($a->getUsuario()->getAvatar_foto() ?: "assets/img/logo.png") ?>" alt="">
                    <strong><?= e($a->getUsuario()->getNome_usuario()) ?></strong>
                    <span class="nota"><?= estrelas($a->getNota()) ?></span>
                    <span class="data"><?= e(dataBR($a->getCriado_em())) ?></span>
<?php if(Sessao::admin() || Sessao::id() === $a->getUsuario()->getId_usuario()): ?>
                    <form method="post" action="<?= url("avaliacao", "excluir") ?>" onsubmit="return confirm('Excluir este comentário?')">
                        <?= Sessao::campoToken() ?>
                        <input type="hidden" name="id" value="<?= $a->getId_avaliacao() ?>">
                        <button class="btn btn-sm btn-outline-danger" type="submit" aria-label="Excluir"><i class="fa-solid fa-trash"></i></button>
                    </form>
<?php endif; ?>
                </div>
                <p><?= nl2br(e($a->getComentario())) ?></p>
            </article>
<?php endforeach; ?>
        </div>
    </section>
</main>
<?php require "Views/layout/rodape.php"; ?>
