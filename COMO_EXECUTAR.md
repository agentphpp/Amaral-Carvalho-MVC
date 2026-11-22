<p align="center">
  <a href="README.md">Principal</a> | <b>Como executar</b>
</p>

---

# Plataforma de jogos Amaral Carvalho (ELO) — MVC em PHP

Portfólio de jogos educativos para o robô ELO do Hospital Amaral Carvalho.
PHP (MVC no padrão da "Loja"), MySQL, HTML, CSS (Bootstrap) e um pouco de JS.

## Como rodar (XAMPP)
1. Copie a pasta para `C:\xampp\htdocs\Amaral-Carvalho-MVC`.
2. No XAMPP Control Panel, inicie **Apache** e **MySQL**.
   <img width="588" height="185" alt="Serviços Apache e MySQL no XAMPP" src="https://github.com/user-attachments/assets/875d9243-6193-49b4-94b0-8ad119911c54" />
3. No phpMyAdmin, importe nesta ordem:
   1. `BancoDeDados/Amaral_Carvalho_Portifolio_jogos.sql`
   2. `BancoDeDados/dados_iniciais.sql` (categorias, 2 jogos e o administrador)
   <br>
   <img width="217" height="40" alt="Importação do banco de dados" src="https://github.com/user-attachments/assets/96f21fc7-9036-4d28-be81-38f2b3052f99" /> <br>
   <img width="262" height="94" alt="Banco importado no phpMyAdmin" src="https://github.com/user-attachments/assets/a5de2e8e-1351-4b61-97fe-dc6b3948f452" />
4. Se o seu MySQL tiver senha, ajuste `Models/Conexao.class.php`.
5. Abra `http://localhost/Amaral-Carvalho-MVC/`.
6. Administrador de teste: usuário `admin` · senha `Admin@123` (troque depois!).

## Estrutura
- `index.php` — front controller: `?controle=jogo&metodo=listar`
- `Models/` — entidades (`Jogo`, `Categoria`, `Usuario`, `Avaliacao`, `UsuarioJogo`, `Contato`), DAOs e `Conexao`
- `Controllers/` — `Inicio`, `Usuario`, `Jogo`, `Categoria`, `Avaliacao`, `Contato`
- `Views/` — telas públicas, `layout/` (cabeçalho/menu/rodapé) e telas do painel admin
- `Helpers/` — `Sessao` (login, permissão, CSRF, mensagens) e funções auxiliares

## Relacionamentos (material "Orientação a Objetos")
- Associação unilateral: `Jogo → Categoria`, `Avaliacao → Usuario`, `Avaliacao → Jogo`
- Classe associativa: `UsuarioJogo` (Usuario × Jogo, com tempo e data de acesso)
- Não há composição/agregação: as FKs são `ON DELETE RESTRICT` e a exclusão é lógica (`deletado_em`)

## Regras
- Visitante: vê jogos, pesquisa, filtra, envia contato, cadastra-se.
- Usuário logado: avalia/comenta (uma avaliação por jogo, que pode ser atualizada), perfil, histórico.
- Administrador: painel com CRUD de jogos, categorias e usuários, e moderação de comentários.

## Novidades desta etapa
- **Mensagens de contato (admin):** aba "Mensagens" no painel (`?controle=contato&metodo=gerenciar`) para ler e excluir mensagens enviadas pelo formulário; contador no painel Geral.
- **Tempo real de jogo:** para usuário logado, "Jogar Agora" abre o jogo em nova aba (`jogo/iniciar`), o `assets/js/jogar.js` conta o tempo enquanto a aba do jogo estiver aberta e grava em `usuarios_jogos.tempo_duracao` via `jogo/finalizar` (parcial a cada 30 s, limite de 4 h). O tempo aparece no perfil. Visitantes usam o link normal.
- Painel de jogos sem "Criado por" (o SQL não tem esse campo); mostra data de publicação e finalidade.
- **Troque a senha do admin** (`Admin@123`) logo após o primeiro login (Perfil).
