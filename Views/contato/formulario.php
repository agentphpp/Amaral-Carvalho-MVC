<?php
    $titulo = "Contato"; $pagina = "contato"; $css = array("styleContato.css");
    require "Views/layout/cabecalho.php";
?>
<main>

        <section class="card redes-sociais-card text-light">
            <h2>Redes Sociais</h2>
            <p>Amaral Carvalho:</p>

            <div class="rede-item">
                <i class="fa-brands fa-instagram"></i>
                <a href="https://www.instagram.com/amaral.carvalho/" target="_blank" rel="noopener">@amaral.carvalho</a>
            </div>

            <div class="rede-item">
                <i class="fa-regular fa-envelope"></i>
                <a href="mailto:ouvidoria@amaralcarvalho.org.br" target="_blank" rel="noopener">ouvidoria</a>
            </div>

            <div class="rede-item">
                <i class="fa-solid fa-phone"></i>
                <span>(14) 3602-1200</span>
            </div>

            <div class="rede-item">
                <i class="fa-solid fa-globe"></i>
                <a href="https://www.amaralcarvalho.org.br/" target="_blank"
                    rel="noopener">www.amaralcarvalho.org.br</a>
            </div>
        </section>

        <section class="card contato-card text-light">
            <h2>Contatos</h2>
            <form method="post" action="<?= url("contato", "inserir") ?>" novalidate>
                <?= Sessao::campoToken() ?>
<?php if(isset($msg["geral"])): ?><div class="alert alert-danger"><?= e($msg["geral"]) ?></div><?php endif; ?>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= e($dados["nome"]) ?>" placeholder="Digite seu nome aqui :D">
                    <?php if(isset($msg["nome"])): ?><div class="erro-campo"><?= e($msg["nome"]) ?></div><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= e($dados["email"]) ?>" placeholder="seu.email@exemplo.com">
                    <?php if(isset($msg["email"])): ?><div class="erro-campo"><?= e($msg["email"]) ?></div><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" id="assunto" name="assunto" value="<?= e($dados["assunto"]) ?>" placeholder="Digite o assunto aqui :D">
                    <?php if(isset($msg["assunto"])): ?><div class="erro-campo"><?= e($msg["assunto"]) ?></div><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" placeholder="Digite uma mensagem aqui :D"><?= e($dados["mensagem"]) ?></textarea>
                    <?php if(isset($msg["mensagem"])): ?><div class="erro-campo"><?= e($msg["mensagem"]) ?></div><?php endif; ?>
                </div>
                <button type="submit" class="btn-enviar">Enviar</button>
            </form>
        </section>

    </main>
<?php require "Views/layout/rodape.php"; ?>
