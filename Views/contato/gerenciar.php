<?php $titulo = "Mensagens"; $secao = "mensagens"; require "Views/layout/admin_cabecalho.php"; ?>
<div class="adm-faixa">
    <div class="adm-stat">Mensagens<div class="num"><?= count($contatos) ?></div></div>
</div>
<div class="adm-conteudo">
<?php if(!$contatos): ?><p class="adm-vazio">Nenhuma mensagem recebida.</p><?php endif; ?>
<?php foreach($contatos as $c): ?>
    <div class="adm-comentario">
        <div class="topo">
            <div class="usuario"><?= e($c->getNome()) ?></div>
            <div style="flex:1"><a href="mailto:<?= e($c->getEmail()) ?>"><?= e($c->getEmail()) ?></a> · <strong><?= e($c->getAssunto()) ?></strong></div>
            <div><?= e(dataBR($c->getCriado_em())) ?></div>
            <form method="post" action="<?= url("contato", "excluir") ?>" onsubmit="return confirm('Excluir esta mensagem?')">
                <?= Sessao::campoToken() ?><input type="hidden" name="id" value="<?= $c->getId_contato() ?>">
                <button class="btn btn-outline-danger" type="submit" title="Excluir"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
        <div class="descritivo"><?= nl2br(e($c->getMensagem())) ?></div>
    </div>
<?php endforeach; ?>
</div>
<?php require "Views/layout/admin_rodape.php"; ?>
