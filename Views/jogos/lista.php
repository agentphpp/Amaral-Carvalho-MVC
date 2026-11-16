<?php
    $titulo = "Catálogo de Jogos"; $pagina = "jogos"; $css = array("styleCatalogo.css");
    require "Views/layout/cabecalho.php";
?>
<section class="search-container">
    <form method="get" action="index.php" class="search-row">
        <input type="hidden" name="controle" value="jogo">
        <input type="hidden" name="metodo" value="listar">
        <?php if($categoriaSel): ?><input type="hidden" name="categoria" value="<?= (int)$categoriaSel ?>"><?php endif; ?>
        <button class="filter-btn" id="filterBtn" type="submit" aria-label="Pesquisar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <div class="search-bar-wrapper">
            <input type="text" name="q" value="<?= e($pesquisa) ?>" placeholder="pesquisar jogos" class="search-input" aria-label="Pesquisar jogos">
        </div>
    </form>

    <div class="tags-row flex-wrap" id="tagsRow" style="display:flex">
        <a href="<?= url("jogo", "listar", $pesquisa !== "" ? array("q" => $pesquisa) : array()) ?>" class="tag <?= !$categoriaSel ? "active-tag" : "" ?>">Todos</a>
<?php foreach($categorias as $c): ?>
        <a href="<?= url("jogo", "listar", array_filter(array("categoria" => $c->getId_categoria(), "q" => $pesquisa))) ?>"
           class="tag <?= $categoriaSel === $c->getId_categoria() ? "active-tag" : "" ?>"><?= e($c->getNome()) ?></a>
<?php endforeach; ?>
    </div>
</section>

<main class="games-grid container flex-wrap">
<?php if(!$jogos): ?>
    <p class="sem-resultado">Nenhum jogo encontrado.</p>
<?php endif; ?>
<?php foreach($jogos as $jogo): ?>
    <a href="<?= url("jogo", "detalhar", array("id" => $jogo->getId_jogo())) ?>" class="game-card-link">
        <div class="game-card">
            <div class="card-image-area placeholder-bg">
                <img class="capa" src="<?= e($jogo->getImg()) ?>" alt="<?= e($jogo->getNome()) ?>">
<?php if($jogo->getMediaAvaliacoes() !== null): ?>
                <span class="rating"><?= e(number_format($jogo->getMediaAvaliacoes(), 1, ",", "")) ?> ★</span>
<?php endif; ?>
            </div>
            <div class="card-content">
                <span class="game-time"><?= e($jogo->getDuracao_estimada()) ?></span>
                <h3 class="game-title"><?= e($jogo->getNome()) ?></h3>
                <p class="game-desc"><?= e(mb_strimwidth($jogo->getDescricao(), 0, 110, "…")) ?></p>
            </div>
        </div>
    </a>
<?php endforeach; ?>
</main>
<?php require "Views/layout/rodape.php"; ?>
