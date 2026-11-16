<?php
    $titulo = "Sobre"; $pagina = "sobre"; $css = array("styleSobre.css");
    require "Views/layout/cabecalho.php";
?>
<main class="container-fluid">
        <!-- Seção Amaral Carvalho -->
        <section class="card card-amaral">
            <h2 class="card-title">Sobre a Amaral Carvalho</h2>
            <div class="conteudo-flex">
                <img src="https://terceirotempo.uol.com.br/imagens/39/01/w640_h426_pdt_ft1_133901.webp"
                    alt="Hospital Amaral Carvalho">
                <p>A Fundação Doutor Amaral Carvalho é uma entidade filantrópica privada e sem fins lucrativos,
                    reconhecida como a terceira maior instituição especializada em oncologia do Brasil. Criada em 1980
                    para unificar e potencializar as organizações de apoio ao Hospital Amaral Carvalho, nossa verdadeira
                    história começou muito antes. Em 1915, os filantropos Domingos Pereira de Carvalho e Anna Marcelina
                    de Carvalho doaram o terreno e os recursos para fundar a Maternidade do Jahu.</p>
            </div>
            <div class="texto-inferior">
                <p>O projeto, que nasceu com o propósito inovador de acolher gestantes e crianças carentes, cresceu
                    junto com as necessidades da população. Hoje, o Hospital Amaral Carvalho transformou-se em um dos
                    maiores complexos de saúde do país, sendo referência nacional em oncologia e transplante de medula
                    óssea.</p>
            </div>

            <h2 class="card-title mt-4">Localização</h2>
            <div class="mapa-container justify-content-center d-flex align-items-center">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d22948.189457630433!2d-48.549902357791666!3d-22.274740276883815!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c758070aeb12ef%3A0x5a970cdd4226ef2d!2sHospital%20Amaral%20Carvalho!5e1!3m2!1spt-BR!2sbr!4v1780340571203!5m2!1spt-BR!2sbr"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <!-- Seção Equipe Dev -->
        <section class="card">
            <h2 class="card-title">Sobre a Equipe Dev</h2>

            <article class="equipe-container">
                <img src="assets/img/time/Guilherme.png" alt="Guilherme" class="img-fluid">
                <div class="equipe-text">
                    <h2>Guilherme</h2>
                    <p class="descricao-legenda">Estudante de Desenvolvimento de Software Multiplataforma na FATEC
                        Jaú, gosto muito da área de tecnologia, tanto software quanto hardware, procuro desenvolver
                        minhas experiências e habilidades.</p>
                </div>
            </article>

            <article class="equipe-container">
                <img src="assets/img/time/Victor.png" alt="Victor" class="img-fluid">
                <div class="equipe-text">
                    <h2>Victor</h2>
                    <p class="descricao-legenda">Estudante de Desenvolvimento de Software e Multiplataforma na
                        Faculdade de Tecnologia de Jahu, com amplo interesse na área de desenvolvimento de programas, e
                        disposto a aprender mais sobre o ramo da tecnologia.</p>
                </div>
            </article>

            <article class="equipe-container">
                <img src="assets/img/time/paulo.png" alt="Paulo" class="img-fluid">
                <div class="equipe-text">
                    <h2>Paulo</h2>
                    <p class="descricao-legenda">Olá, meu nome é Paulo, e estou começando a programar! Estou fazendo
                        graduação de Desenvolvimento de Software Multiplataforma na FATEC.</p>
                </div>
            </article>

            <article class="equipe-container">
                <img src="assets/img/time/Pedro.jpeg" alt="Pedro" class="img-fluid">
                <div class="equipe-text">
                    <h2>Pedro</h2>
                    <p class="descricao-legenda">Estudante de Desenvolvimento de Software Multiplataforma na FATEC
                        Jahu, com interesse nas áreas de tecnologia, desenvolvimento de software e inovação. Possuo
                        experiência em pesquisa científica e em constante busca por aprimoramento profissional e
                        acadêmico.</p>
                </div>
            </article>

            <article class="equipe-container">
                <img src="assets/img/time/Joao.png" alt="João" class="img-fluid">
                <div class="equipe-text">
                    <h2>João</h2>
                    <p class="descricao-legenda">Sou um estudante de Desenvolvimento de Software Multiplataforma na
                        FATEC Jahu, com interesse na área de programação, sou novato na área, mas estou procurando
                        aperfeiçoar meus conhecimentos.</p>
                </div>
            </article>

            <article class="equipe-container">
                <img src="assets/img/time/Matheus.png" alt="Matheus" class="img-fluid">
                <div class="equipe-text">
                    <h2>Matheus</h2>
                    <p class="descricao-legenda">Estudante de Desenvolvimento de Software Multiplataforma na FATEC Jahu, 
                        interessado em tecnologia e desenvolvimento de software. Atualmente, estou focado em aprender, 
                        ganhar experiência e aprimorar minhas habilidades para crescer na área e 
                        enfrentar novos desafios profissionais.</p>
                </div>
            </article>
            <article class="equipe-container">
                <img src="assets/img/time/Geovana.png" alt="Matheus" class="img-fluid">
                <div class="equipe-text">
                    <h2>Geovana</h2>
                    <p class="descricao-legenda">
                        Estudante de Desenvolvimento de Software Multiplataforma na FATEC Jahu e Tecnóloga em Marketing Digital. 
                        Tenho interesse por tecnologia, desenvolvimento de software, dados e inovação, buscando unir
                        meus conhecimentos de tecnologia marketing para criar soluções criativas e eficientes. 
                        Estou constantemente buscando aprender, desenvolver novas habilidades e crescer profissionalmente na área de tecnologia.
                    </p>
                </div>
            </article>
        </section>
    </main>
<?php require "Views/layout/rodape.php"; ?>
