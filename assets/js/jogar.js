// Mede o tempo de jogo (usuarios_jogos.tempo_duracao).
// O jogo abre em outra aba; esta página fica aberta e conta o tempo enquanto a aba do jogo existir.
// Visitantes (sem data-jogar) usam o link normal.
(function () {
    var botao = document.querySelector('[data-jogar]');
    if (!botao) return;

    botao.addEventListener('click', function (ev) {
        ev.preventDefault();
        var aba = window.open('', '_blank');          // abre já no clique para o navegador não bloquear
        if (!aba) { window.location.href = botao.href; return; }
        try { aba.opener = null; } catch (e) {}

        var dados = new FormData();
        dados.append('csrf', botao.dataset.csrf);
        dados.append('id', botao.dataset.jogo);

        fetch(botao.dataset.iniciar, { method: 'POST', body: dados, credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (d) {
                if (!d.ok) { aba.close(); alert(d.erro || 'Não foi possível abrir o jogo.'); return; }
                aba.location.href = d.link;
                medir(aba, d.acesso);
            })
            .catch(function () { aba.location.href = botao.href; }); // se falhar, usa o caminho simples (tempo 0)
    });

    function medir(aba, acesso) {
        var inicio = Date.now();
        function enviar() {
            var f = new FormData();
            f.append('csrf', botao.dataset.csrf);
            f.append('acesso', acesso);
            f.append('segundos', Math.round((Date.now() - inicio) / 1000));
            navigator.sendBeacon(botao.dataset.finalizar, f);
        }
        var vigia = setInterval(function () {
            if (aba.closed) { clearInterval(vigia); clearInterval(parcial); enviar(); }
        }, 1000);
        var parcial = setInterval(enviar, 30000);      // grava parcial a cada 30 s (caso esta aba seja fechada antes)
        window.addEventListener('pagehide', enviar);
    }
})();
