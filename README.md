# Plataforma de Jogos Amaral Carvalho (ELO) — Passo a passo

Aplicação web em **PHP + MySQL (padrão MVC)** com HTML, CSS e Bootstrap.
Perfis: **visitante**, **usuário** (avalia e comenta, só logado) e **administrador** (gerencia jogos, categorias, usuários, comentários e mensagens).

---

## 1. O que você precisa
- **XAMPP** (Apache + PHP 8 ou superior + MySQL/MariaDB): https://www.apachefriends.org
- Navegador atualizado.
- Internet no primeiro acesso (Bootstrap, Font Awesome, Swiper e fonte Inter são carregados por CDN).

## 2. Instalar o projeto
1. Instale o XAMPP.
2. Extraia o `Amaral-Carvalho-MVC.zip`.
3. Copie a pasta **`Amaral-Carvalho-MVC`** para dentro de `C:\xampp\htdocs\`.
   O arquivo principal deve ficar em `C:\xampp\htdocs\Amaral-Carvalho-MVC\index.php`.

## 3. Ligar os serviços
1. Abra o **XAMPP Control Panel**.
2. Clique em **Start** em **Apache** e em **MySQL** (os dois devem ficar verdes).

## 4. Criar o banco de dados
Importe os dois arquivos **nesta ordem**:

1. Acesse http://localhost/phpmyadmin
2. Clique na aba **Importar** → **Escolher arquivo** → selecione
   `BancoDeDados/Amaral_Carvalho_Portifolio_jogos.sql` → **Importar**.
   (Cria o banco `amaral_carvalho` e as tabelas. Atenção: o script apaga e recria o banco.)
3. Importe depois `BancoDeDados/dados_iniciais.sql`
   (categorias, 2 jogos de exemplo e o administrador).

> Se aparecer erro na importação, copie a mensagem completa e envie ao grupo/desenvolvedor.

## 5. Conferir a conexão
Arquivo `Models/Conexao.class.php`. O padrão do projeto é:

| Item | Valor |
|---|---|
| Host | `localhost` |
| Banco | `amaral_carvalho` |
| Usuário | `root` |
| Senha | *(vazia)* |

Se o seu MySQL tiver senha no `root`, altere nesse arquivo.

## 6. Abrir a aplicação
Acesse: **http://localhost/Amaral-Carvalho-MVC/**

As páginas usam o `index.php` como porta de entrada, no formato `index.php?controle=...&metodo=...`.

## 7. Acesso do administrador
| Campo | Valor |
|---|---|
| Usuário / e-mail | veja em `BancoDeDados/dados_iniciais.sql` (usuário `admin`) |
| Senha inicial | `Admin@123` |

**Troque a senha no primeiro acesso** (menu Perfil / configurações).
Depois do login, o administrador é levado ao **painel**.

## 8. Como usar

### Visitante (sem login)
- Navega por **Início**, **Jogos**, **Sobre** e **Contato**.
- Pesquisa jogos por nome e filtra por categoria.
- Abre a descrição de um jogo e lê as avaliações.
- Envia mensagem pelo formulário de **Contato**.
- Para **avaliar** ou comentar, precisa estar logado.

### Usuário (logado)
1. Clique em **Entrar** → **Cadastre-se** e preencha o formulário (nome de usuário, nome completo, e-mail, senha e data de nascimento).
2. Faça login.
3. Na página de um jogo, dê **nota (1 a 5)** e escreva um **comentário**. Cada usuário tem uma avaliação por jogo e pode **editá-la** depois.
4. Clique em **Jogar Agora**: o jogo abre em nova aba e o **tempo de jogo** é registrado. Mantenha a aba original do site aberta enquanto joga.
5. No **Perfil**, veja seus dados e os últimos jogos acessados, com o tempo.

### Administrador
No painel, o menu lateral tem:

| Aba | O que faz |
|---|---|
| **Geral** | Contadores (jogos, comentários, usuários, mensagens) e últimos comentários |
| **Jogos** | Adicionar, editar e excluir jogos (com upload de imagem de capa); acesso às categorias |
| **Usuários** | Adicionar, editar e excluir usuários e definir o cargo |
| **Comentários** | Ver todos, filtrar por jogo e excluir (moderação) |
| **Mensagens** | Ler e excluir as mensagens recebidas pelo formulário de contato |
| **Logout** | Sai do painel |

**Cadastrar um jogo:** Jogos → *Adicionar jogo* → nome, finalidade, categoria, descrição, faixa etária, duração estimada, imagem (JPG/PNG/WEBP/GIF até 3 MB) e **link** do jogo (precisa começar com `http://` ou `https://` para o botão "Jogar Agora" funcionar).

**Observações sobre exclusão:** jogos, usuários e avaliações usam exclusão lógica (campo `deletado_em`). Uma categoria com jogos vinculados não pode ser excluída (FK `RESTRICT`).

## 9. Estrutura do projeto
```
Amaral-Carvalho-MVC/
├── index.php            Front controller (?controle=...&metodo=...)
├── Controllers/         Inicio, Usuario, Jogo, Categoria, Avaliacao, Contato
├── Models/              Entidades, DAOs e Conexao (PDO)
├── Views/               Telas públicas, admin e layout (cabecalho/menu/rodape)
├── Helpers/             util.php (e(), url(), upload...) e Sessao (login, CSRF)
├── assets/              css, js, img
└── BancoDeDados/        SQL do banco e dados iniciais
```

## 10. Segurança já aplicada
Senhas com `password_hash`/`password_verify`, consultas com *prepared statements* (PDO), token CSRF em todo formulário POST, escape de saída com `htmlspecialchars`, lista de controllers permitidos, `session_regenerate_id` no login e upload de imagem validado (tipo real e tamanho).

## 11. Problemas comuns
| Sintoma | O que fazer |
|---|---|
| Página em branco | Veja `C:\xampp\apache\logs\error.log` e envie as últimas linhas |
| "Erro de conexão" / `SQLSTATE` | MySQL desligado, banco não importado ou senha errada em `Conexao.class.php` |
| Porta 80 ou 3306 ocupada | Feche Skype/IIS/outro MySQL ou troque a porta no XAMPP |
| Layout sem estilo / ícones faltando | Sem internet (CDNs bloqueadas); conecte-se e recarregue |
| Upload de imagem falha | Imagem maior que 3 MB ou formato não suportado; confira se a pasta de uploads tem permissão de escrita |
| "Requisição inválida" | Sessão expirada; volte, recarregue a página e envie de novo |
| Tempo de jogo sempre `—` | Jogou sem estar logado, ou fechou o site antes da aba do jogo |

## 12. Limitações conhecidas
- O tempo de jogo é o tempo em que a aba do jogo ficou aberta (o jogo roda em site externo).
- Ranking, login automático de pacientes e relatórios clínicos (do documento do PI) ainda **não** fazem parte desta versão.
- Este passo a passo e as últimas alterações ainda precisam ser validados em MySQL real; reporte qualquer erro.