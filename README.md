<p align="center">

&#x20; <b>Principal</b> | <a href="COMO\_EXECUTAR.md">Como executar</a>

</p>
<p align="left" style="font-size:28px;"><strong><em>Documentação PI do Amaral Carvalho</em></strong></p>

\--Equipe 4-- <br><br>
Geovana <br>
Guilherme Nogueira <br>
João Pedro P Rampo <br>
Matheus Molan <br>
Paulo Henrique <br>
Pedro Augusto <br>
Victor Gabriel <br>

<details>
<summary><strong>Sumário</strong></summary>

* [1. Introdução](#1-introdução)
* [Objetivos](#-objetivos)
* [Metodologia](#-metodologia)
* [2. Requisitos](#2-requisitos)
* [Requisitos funcionais](#-requisitos-funcionais)
* [Requisitos não funcionais](#-requisitos-não-funcionais)
* [3. Modelo de casos de uso](#3-modelo-de-casos-de-uso)
* [4. Modelo do banco de dados](#4-modelo-do-banco-de-dados)
* [5. Banco de dados](#5-banco-de-dados)
* [6. Diagrama de classes](#6-diagrama-de-classes)
* [7. Estudo de viabilidade](#7-estudo-de-viabilidade)
* [8. Regras de negócio (Modelo canvas)](#8-regras-de-negócio-modelo-canvas)
* [9. Design](#9-design)
* [10. Protótipo](#10-protótipo)
* [11. Aplicação](#11-aplicação)
* [12. Considerações finais](#12-considerações-finais)
* [13. Referências](#13-referências)

</details>

Para cada semestre, do 1º ao 6º, iremos utilizar este template para documentar o PI - incrementalmente.

# 1\. Introdução

Contexto: O hospital Amaral Carvalho possui um robô chamado elo, que foi um investimento do Hospital, porém não está sendo utilizado 100% do tempo.

Justificativa: Sabendo disso iremos criar um site que irá acolher as crianças que estão em tratamento no hospital e que irá dar mais utilidade para o robô.

## • Objetivos

Desenvolver um site no qual será adicionado os jogos já existentes da empresa e adicionar jogos criados por nós ou possivelmente por outras pessoas.

## • Metodologia

Modelo: modelo incremental <br>
Com o que? HTML, CSS, JS + Trello (para organização) <br>
Onde? ambiente web <br>
Quando? durante o semestre <br>
Quem? Crianças <br>

Cronograma: https://trello.com/b/0X0gK4rd/pi

# 2\. Requisitos

## • Requisitos funcionais

RF01 – O sistema deve permitir que usuários realizem cadastro e login: Nome, E-mail, Senha e Confirmação de senha. <br>
RF02 – O sistema deve permitir navegação entre as páginas: Início, Sobre, Jogos, Contato. Login/cadastro e Equipe. <br>
RF03 – O sistema deve permitir que administradores publiquem e removam jogos na plataforma: Nome, Categoria, Descrição, Imagem de capa, Arquivo ou link do jogo. <br>
RF04 – O sistema deve possuir uma vitrina para exibição dos jogos disponíveis: Nome do jogo, Imagem/capa, Categoria, Descrição resumida, Avaliação média. <br>
RF05 – O sistema deve permitir que o usuário visualize os detalhes de um jogo ao selecioná-lo. <br>
RF06 - O sistema deve permitir que os jogos sejam executados diretamente no navegador: Botão "Jogar", Carregamento do jogo na própria plataforma. <br>
RF07 – O sistema deve permitir que usuários enviem feedbacks sobre os jogos. <br>
RF08 – O sistema deve permitir que usuários avaliem os jogos por meio de notas: Nota de 1 a 5 estrelas, Comentário textual <br>
RF09 – O sistema deve possuir um sistema de pesquisa por nome do jogo: Campo de pesquisa, Exibição dos resultados encontrados. <br>
RF10 – O sistema deve apresentar uma página de Contato com formulário para envio de dúvidas e links para redes sociais: Nome, E-mail, Assunto, Mensagem, Link para redes sociais. <br>
RF11 – O sistema deve permitir a visualização das equipes responsáveis pelo projeto: Nome dos integrantes, Função ou participação no projeto, Foto (opcional). <br>
RF12 – O sistema deve exibir os jogos mais bem avaliados ou em destaque: Jogos mais acessados, Jogos mais bem avaliados. <br>
RF13 – O sistema deve permitir a filtragem de jogos: Categoria, Avaliação, Ordem alfabética. <br>
RF14 - O sistema deve coletar e armazenar dados através dos jogos desenvolvidos para a plataforma. <br>

## • Requisitos não funcionais

**Requisitos de produto:** <br>
RNF01 – O sistema deve possuir interface simples, intuitiva e de fácil compreensão para usuários em geral, incluindo crianças. <br>
RNF02 – O sistema deve apresentar tempo de resposta de até 3 segundos para carregamento das páginas e jogos. <br>
RNF03 – O sistema deve ser responsivo, adaptando-se a diferentes tamanhos de tela. <br>
RNF04 – O sistema deve permitir fácil navegação entre as funcionalidades. <br>

**Requisitos de organização:** <br>
RNF05 – O desenvolvimento do sistema deve ser organizado utilizando a ferramenta Trello para gerenciamento de tarefas. <br>
RNF06 – O projeto deve seguir um modelo de desenvolvimento incremental, com entregas parciais ao longo do tempo. <br>

**Requisitos de confiabilidade:** <br>
RNF07 – O sistema deve evitar falhas durante a execução dos jogos. <br>
RNF08 – O sistema deve garantir funcionamento contínuo, sem travamentos frequentes. <br>

**Requisito de implementação:** <br>
RNF09 – O sistema deve ser desenvolvido utilizando HTML, CSS e JavaScript. <br>
RNF10 – O sistema deve ser executado diretamente em navegadores web, sem necessidade de instalação. <br>

**Requisito de padrões:** <br>
RNF11 – O código deve ser organizado e comentado para facilitar manutenção. <br>

**Requisitos de interoperabilidade:** <br>
RNF12 – O sistema deve ser compatível com navegadores modernos como Google Chrome, Mozilla Firefox e Microsoft Edge. <br>
RNF13 – O sistema deve funcionar em diferentes dispositivos (desktop e mobile). <br>

# 3\. Modelo de casos de uso

O diagrama de casos de uso apresenta as principais funcionalidades da plataforma e a interação dos atores com o sistema. São três atores: o **Visitante** (não autenticado), que se cadastra, faz login, consulta a vitrine, os destaques, os detalhes dos jogos e a equipe, e envia mensagens de contato; o **Usuário** (autenticado), que herda as funções do Visitante e ainda executa e avalia jogos; e o **Administrador**, que herda as do Usuário e gerencia jogos e categorias. Cada caso de uso indica o requisito funcional correspondente.

<img width="600" alt="Diagrama de casos de uso" src="imagens/casos-de-uso.jpg" />

# 4\. Modelo do banco de dados

## • Modelo conceitual

Representa as entidades do sistema (usuários, jogos, categorias, avaliações, acessos aos jogos e contatos) e os relacionamentos entre elas.

<img width="600" alt="Modelo conceitual do banco de dados" src="imagens/modelo-conceitual.jpg" />

## • Modelo lógico

Detalha as tabelas USUARIOS, JOGOS, CATEGORIAS, CATEGORIAS\_JOGOS, USUARIOS\_JOGOS, AVALIACOES e CONTATOS, com seus campos, chaves primárias e estrangeiras.

<img width="600" alt="Modelo lógico do banco de dados" src="imagens/modelo-logico.jpg" />

# 5\. Banco de dados

O banco de dados foi desenvolvido conforme os requisitos da aplicação, para armazenar as informações de forma organizada, eficiente e consistente. Foi definido o uso do MySQL como sistema gerenciador, em conjunto com o PHP, e as senhas dos usuários devem ser armazenadas de forma criptografada (hash).

* **USUARIOS:** dados de cadastro e tipo de acesso (ex.: administrador);
* **JOGOS:** informações exibidas na vitrine (nome, finalidade, descrição, faixa etária, duração estimada, imagem e link);
* **CATEGORIAS** e **CATEGORIAS\_JOGOS:** categorias de classificação e a associação com os jogos;
* **USUARIOS\_JOGOS:** registro de cada acesso de um usuário a um jogo (tempo de duração e data);
* **AVALIACOES:** nota e comentário dados pelos usuários;
* **CONTATOS:** mensagens enviadas pelo formulário de contato.

# 6\. Diagrama de classes

O diagrama de classes mostra a estrutura da plataforma, composta pelas classes Usuário, Jogo, Categoria, Avaliação, UsuarioJogo e Contato, com seus atributos, métodos e relacionamentos. Uma categoria classifica zero ou muitos jogos; um jogo recebe zero ou muitas avaliações; um usuário realiza zero ou muitas avaliações; e usuários e jogos se relacionam pela classe UsuarioJogo, que registra cada acesso. A classe Contato é independente das demais.

<img width="650" alt="Diagrama de classes" src="imagens/diagrama-de-classes.jpg" />

# 7\. Estudo de viabilidade

Análise detalhada das viabilidades técnica, operacional, de mercado e financeira para a implementação do projeto.

\---

### 7.1. Viabilidade Técnica

* **Compatibilidade:** O sistema será totalmente Web, compatível com os principais navegadores do mercado (Google Chrome, Microsoft Edge, Mozilla Firefox).
* **Recursos Tecnológicos:**

  * Utilização de dispositivos eletrônicos pessoais dos próprios desenvolvedores (notebooks e computadores).
  * Suporte e uso da infraestrutura física e tecnológica da **Fatec**.
  * Ferramentas gratuitas de gestão e organização, como o **Trello**.

\---

### 7.2. Viabilidade Operacional

* **Metodologia de Gerenciamento:** O projeto adotará o modelo de desenvolvimento incremental, com entregas parciais e contínuas ao longo do semestre.
* **Organização da Equipe:**

  * Divisão clara de tarefas entre os integrantes do grupo.
  * Acompanhamento diário e gestão do fluxo de trabalho centralizados no Trello.
* **Manutenção:** O código-fonte será estruturado, organizado e devidamente comentado. Isso garante que o sistema seja simples de manter e atualizar, permitindo que futuras equipes realizem modificações sem dificuldades.

\---

### 7.3. Viabilidade de Mercado

* **Análise de Cenário:** Existe um crescimento constante no mercado de plataformas digitais focadas em entretenimento e aprendizado infantil. Contudo, nota-se uma escassez crônica de soluções voltadas especificamente para o ambiente hospitalar e crianças sob tratamento de saúde.
* **Público-Alvo:**

  * Crianças em tratamento hospitalar.
  * Instituições de saúde e hospitais.
  * Educadores, acompanhantes e familiares.
* **Concorrência:** Embora existam plataformas de jogos semelhantes no mercado, o projeto se diferencia e ganha força por ser uma plataforma integrada e chancelada como canal oficial do próprio hospital.
* **Diferenciais Estratégicos:**

  * **Foco no Ambiente Hospitalar:** Desenvolvido sob medida para crianças internadas que enfrentam momentos de fragilidade (espera, tratamento e recuperação).
  * **Interface Simples e Acessível:** Design totalmente voltado à experiência infantil, sendo intuitivo e fácil de usar.
  * **Inclusão Dinâmica de Jogos:** Flexibilidade para adicionar novos jogos, criar soluções próprias e, futuramente, aceitar contribuições de jogos desenvolvidos por terceiros.
* **Projeção de Retorno:** O retorno do projeto é estritamente social e humanitário, focado no apoio emocional e no benefício educacional das crianças assistidas, com potencial para expansão para outras instituições de saúde no futuro.

\---

### 7.4. Viabilidade Financeira

* **Modelo de Custos:** Por se tratar de um projeto puramente educacional e de responsabilidade social, ele possui custo financeiro direto baixíssimo e não visa lucro.
* **Custos de Desenvolvimento:**

  * **Equipe:** Custos intangíveis focados em consumo de energia e horas de dedicação (hora-homem).
  * **Licenciamento:** Custo zero, priorizando ferramentas de código aberto (*open-source*) ou planos gratuitos.
  * **Hospedagem Inicial:** Realizada de forma gratuita através do **GitHub Pages**.
* **Custos Futuros:** Caso o hospital decida internalizar a plataforma em seus servidores próprios no futuro, o único custo gerado será o de manutenção da hospedagem e do domínio do site.

# 8\. Regras de negócio (Modelo canvas)

<img width="700" alt="Modelo de negócio canvas" src="imagens/canvas.jpg" />

### 8.1. O que será elaborado?

**Proposta de valor:**

* Acolhimento às crianças do hospital Amaral Carvalho;
* Portfólio, apresentando algumas informações do Hospital, sobre o robô Elo, ou queira conhecer os jogos disponíveis que trazem acolhimento;

\---

### 8.2. Como será elaborado?

**Parcerias principais:**

* Fatec;
* Hospital Amaral Carvalho.

**Atividades principais:**

* Entender o problema do hospital;
* Levantar os requisitos;
* Elaborar o protótipo;
* Desenvolver o código do repositório on-line para o compartilhamento e manutenção de jogos educativos;

**Recursos principais:**

* Notebook da Fatec, equipamentos pessoais;
* Ferramentas de desenvolvimento: HTML, CSS, JS;
* Ferramentas de organização: Trello;

\---

### 8.3. Para quem será elaborado?

**Segmento de clientes:**

* Crianças em tratamento hospitalar;
* Educadores, acompanhantes, visitantes e pessoas interessadas em projetos de responsabilidade social;

**Relacionamento com o cliente:**

* Direto: Feedback integrado na plataforma (avaliação de jogos e comentários e formulários);

**Canais:**

* Plataforma Web (acesso via navegador em desktop ou dispositivo móveis);
* Redes sociais do hospital;
* Outros sites do hospital;

\---

### 8.4. Quanto custará?

**Estrutura de custos:**

* Energia;
* Hora homem;
* Hospedagem do site;

**Fontes de receitas:**

* Não haverá fontes de receita no momento, talvez possua parcerias futuras.

# 9\. Design

O design da plataforma busca transmitir acolhimento, leveza e simplicidade, características adequadas ao público infantil e ao ambiente hospitalar.

## Tipografia:

* Inter: Fonte principal utilizada em toda a aplicação (títulos, textos gerais, fluxos de login/cadastro e demais componentes de interface)

<img width="300" alt="Tipografia Inter" src="imagens/tipografia.jpg" />

## Logo:

O logo é um brasão circular com o urso ELO, segurando um balão dourado em formato de coração, cercado por estrelas e ramos de louro, com uma faixa contendo o nome ELO.

<img width="600" alt="Logo" src="imagens/logo.jpg" />

## Modelo de navegação:

Mostra o caminho entre as páginas: da página inicial o usuário acessa Sobre, Contato, Login, Cadastro e Jogos; após o login chega à página inicial logada, com acesso ao Perfil e às Configurações; na página de Jogos seleciona um jogo, vê a descrição e acessa o jogo.

<img width="600" alt="Modelo de navegação" src="imagens/modelo-de-navegacao.jpg" />

## Wireframes:

### Cadastro

<img width="550" alt="Wireframe da página de cadastro" src="imagens/wireframe-cadastro.jpg" />

### Login

<img width="550" alt="Wireframe da página de login" src="imagens/wireframe-login.jpg" />

### Página inicial

<img width="320" alt="Wireframe da página inicial" src="imagens/wireframe-inicial.jpg" />

### Jogos

<img width="320" alt="Wireframe da página de jogos" src="imagens/wireframe-jogos.jpg" />

### Contatos

<img width="550" alt="Wireframe da página de contatos" src="imagens/wireframe-contatos.jpg" />

### Descrição dos jogos

<img width="400" alt="Wireframe da página de descrição dos jogos" src="imagens/wireframe-descricao-jogos.jpg" />

### Sobre

<img width="320" alt="Wireframe da página sobre" src="imagens/wireframe-sobre.jpg" />

### Perfil

<img width="550" alt="Wireframe da página de perfil" src="imagens/wireframe-perfil.jpg" />

### Login Admin

<img width="550" alt="Wireframe da página de login admin" src="imagens/wireframe-login-admin.jpg" />

### Jogos Admin

<img width="550" alt="Wireframe da página de jogos admin" src="imagens/wireframe-jogos-admin.jpg" />

### Geral Admin

<img width="550" alt="Wireframe da página geral admin" src="imagens/wireframe-geral-admin.jpg" />

### Comentários Admin

<img width="550" alt="Wireframe da página de comentários admin" src="imagens/wireframe-comentarios-admin.jpg" />

### Usuários Admin

<img width="550" alt="Wireframe da página de usuários admin" src="imagens/wireframe-usuarios-admin.jpg" />

# 10\. Protótipo

O protótipo foi criado no Figma e pode ser acessado no link abaixo:

https://www.figma.com/proto/vyH992W0mgX97MzCJwBxla/amaral-Rascunho?node-id=4-791\&p=f\&viewport=437%2C130%2C0.27\&t=jHiE7U6EP4UkJCGz-1\&scaling=scale-down\&content-scaling=fixed\&starting-point-node-id=4%3A791\&page-id=0%3A1

# 11\. Aplicação

A aplicação está publicada em ambiente web e o código-fonte está disponível no GitHub.

* Aplicação: https://amaralelo.netlify.app/
* Repositório: https://github.com/jppiress/Amaral-Carvalho

A tela inicial reúne o menu de navegação (Início, Jogo, Sobre, Contato e Entrar), a chamada "Aprender, brincar e se divertir", um texto de apresentação do portal de jogos educativos do Hospital Amaral Carvalho, os botões "Explorar Jogos" e "Saiba mais" e a imagem do robô ELO.

<img width="700" alt="Tela inicial da aplicação" src="imagens/aplicacao-tela-inicial.jpg" />

# 12\. Considerações finais

Neste semestre, a equipe concluiu a etapa de levantamento e documentação da Plataforma de Jogos Amaral Carvalho, definindo os requisitos, os casos de uso, o diagrama de classes, o modelo do banco de dados, a identidade visual, o modelo de navegação e o protótipo no Figma. Também foi disponibilizada uma primeira versão da aplicação, com a tela inicial publicada em ambiente web.

Como próximos passos, pretende-se implementar o back-end com PHP e MySQL, o login automático dos pacientes, o ranking semanal, os jogos de auxílio clínico e os relatórios por área, evoluindo o projeto de forma incremental.

# 13\. Referências

* BOOTSTRAP. Framework CSS para desenvolvimento front-end responsivo. Disponível em: https://getbootstrap.com/
* BRASIL. Lei nº 13.709, de 14 de agosto de 2018. Lei Geral de Proteção de Dados Pessoais (LGPD). Disponível em: https://www.planalto.gov.br/ccivil\_03/\_ato2015-2018/2018/lei/l13709.htm
* FIGMA. Plataforma de design colaborativo online. Disponível em: https://www.figma.com/
* GITHUB. Plataforma de hospedagem de código-fonte e controle de versão. Disponível em: https://github.com/
* GOOGLE FONTS. Inter. Disponível em: https://fonts.google.com/specimen/Inter
* MDN WEB DOCS. Documentação de HTML, CSS e JavaScript. Disponível em: https://developer.mozilla.org/pt-BR/
* MYSQL. Sistema de gerenciamento de banco de dados relacional. Disponível em: https://www.mysql.com/
* NETLIFY. Plataforma de hospedagem de aplicações web. Disponível em: https://www.netlify.com/
* PHP. PHP: Hypertext Preprocessor. Disponível em: https://www.php.net/
* SCHWABER, Ken; SUTHERLAND, Jeff. The Scrum Guide. Disponível em: https://scrumguides.org/
* TRELLO. Plataforma de gestão de projetos e colaboração. Disponível em: https://trello.com/
* W3C. Web Content Accessibility Guidelines (WCAG) 2.1. Disponível em: https://www.w3.org/TR/WCAG21/

