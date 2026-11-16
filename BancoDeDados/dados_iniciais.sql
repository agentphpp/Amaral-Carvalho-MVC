-- Dados iniciais para testar o site (rode DEPOIS de Amaral_Carvalho_Portifolio_jogos.sql)
USE amaral_carvalho;

INSERT INTO categorias (nome) VALUES
('Raciocínio'), ('Lógica'), ('Concentração'), ('Saúde'), ('Storytelling');

-- Administrador padrão -> login: admin | senha: Admin@123  (TROQUE A SENHA depois de entrar!)
INSERT INTO usuarios (nome_usuario, nome_completo, email, senha, tipo_acesso, data_nascimento)
VALUES ('admin', 'Administrador ELO', 'admin@elo.com', '$2y$10$dJNTs0G12DvTcxTiJ7NN7.VKlbLSTu0a6xafhbonq0bifvDJx3oAm', 'admnistrador', '2000-01-01');

INSERT INTO jogos (nome, finalidade, categoria_id, descricao, faixa_etaria, duracao_estimada, img, link) VALUES
('StoryTeller ELO', 'Didático', 5,
 'Monte imagens incríveis e desenvolva habilidades cognitivas através da narrativa. Desenvolva criatividade, atenção e raciocínio através de histórias interativas.',
 '5-12 anos', '10-20 min', 'assets/img/desenho.png', ''),
('Matemática do Elo', 'Didático', 2,
 'Complete desafios matemáticos junto com o Elo. Resolva desafios e desenvolva o pensamento lógico.',
 '6-14 anos', '5-15 min', 'assets/img/game2.png', 'https://agentphpp.github.io/ursinhoElo-matematica-game/');
