-- Banco de dados enxuto apenas para atender os requisitos selecionados e necessarios para esse semestre, com o passar do tempo vamos aumentando e adicionando coisas novas
-- Paulo Henrique Pereira Lontra


-- usuarios(id_usuario, nome, senha, email, cargo, avatar_foto)
-- jogos(id_jogo, nome ,finalidade, categoria_id, descricao, faixa_etaria, modalidade, duracao_estimada, img, link)
-- categoria(id_categoria, nome)
-- usuarios_jogos(id_dado_usuario_jogo, usuario_id, jogo_id, tempo_utilizacao) -- pontuacao, progresso nao vamos utilizar por enquanto
-- avaliacoes(id_avaliacao, avaliador_id, jogo_avaliado_id, nota, comentario)

-- contatos(id_contato, nome, email, assunto, mensagem)

DROP DATABASE IF EXISTS amaral_carvalho;

CREATE DATABASE IF NOT EXISTS amaral_carvalho
	CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    
USE amaral_carvalho;

CREATE TABLE IF NOT EXISTS categorias(
	id_categoria BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL

);

CREATE TABLE IF NOT EXISTS usuarios(
	id_usuario BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(255) NOT NULL,
    nome_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_acesso ENUM('usuario','admnistrador') NOT NULL DEFAULT 'usuario',
    avatar_foto VARCHAR(255),
    data_nascimento DATETIME NOT NULL,
    
    -- logs
	criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    alterado_em DATETIME
		DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
	deletado_em DATETIME NULL
    
    

);


CREATE TABLE IF NOT EXISTS jogos(
	id_jogo BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    finalidade VARCHAR(50) NOT NULL,
    categoria_id BIGINT UNSIGNED NOT NULL,
    descricao TEXT NOT NULL,
    faixa_etaria VARCHAR(30) NOT NULL,
    duracao_estimada VARCHAR(50) NOT NULL,
    img VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    -- nao usaremos modalidade pois não tem função nenhuma no nosso projeto

	-- logs
	criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    alterado_em DATETIME
		DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
	deletado_em DATETIME NULL,
    
	CONSTRAINT fk_jogos_tipo FOREIGN KEY (categoria_id)
		REFERENCES categorias(id_categoria)
        ON DELETE RESTRICT
        ON UPDATE CASCADE

);




CREATE TABLE IF NOT EXISTS  usuarios_jogos(
	id_usuario_jogo BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    jogo_id BIGINT UNSIGNED  NOT NULL,
    tempo_duracao INT UNSIGNED NOT NULL, -- Duração em segundos,
    data_acesso DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_usuarios_jogos_usuario
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id_usuario)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_usuarios_jogos_jogo
        FOREIGN KEY (jogo_id) REFERENCES jogos (id_jogo)
        ON DELETE RESTRICT
        ON UPDATE CASCADE

);


CREATE TABLE IF NOT EXISTS  avaliacoes(
	id_avaliacao BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    jogo_id BIGINT UNSIGNED NOT NULL,
    nota TINYINT NOT NULL CHECK (nota BETWEEN 1 AND 5),
    comentario TEXT NOT NULL,
    
    CONSTRAINT fk_avaliacoes_usuario FOREIGN KEY (usuario_id)
		REFERENCES usuarios(id_usuario) 
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
        
        
	CONSTRAINT fk_avaliacoes_jogo FOREIGN KEY (jogo_id)
		REFERENCES jogos(id_jogo)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
        
        
	-- logs
        
	criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    alterado_em DATETIME
		DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
	deletado_em DATETIME NULL
	

);


CREATE TABLE IF NOT EXISTS contatos(
	id_contato BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    assunto VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mensagem TEXT NOT NULL,

    
    	-- logs
	criado_em DATETIME DEFAULT CURRENT_TIMESTAMP

);

