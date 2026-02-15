CREATE TABLE
  usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL
  );

CREATE TABLE
  categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
  );

CREATE TABLE
  cores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    nome VARCHAR(50) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
  );

CREATE TABLE
  tamanhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    nome VARCHAR(20) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
  );

CREATE TABLE
  marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nome VARCHAR(100) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
  );

CREATE TABLE
  generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    nome VARCHAR(50) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
  );

CREATE TABLE
  segmentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    nome VARCHAR(50) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE
  );

CREATE TABLE
  produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    marca_id INT NOT NULL,
    cor_id INT NOT NULL,
    categoria_id INT NOT NULL,
    tamanho_id INT NOT NULL,
    genero_id INT NOT NULL,
    segmento_id INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    quantidade INT DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deletado_em TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
    FOREIGN KEY (marca_id) REFERENCES marcas (id),
    FOREIGN KEY (cor_id) REFERENCES cores (id),
    FOREIGN KEY (categoria_id) REFERENCES categorias (id),
    FOREIGN KEY (tamanho_id) REFERENCES tamanhos (id),
    FOREIGN KEY (genero_id) REFERENCES generos (id),
    FOREIGN KEY (segmento_id) REFERENCES segmentos (id)
  );

INSERT INTO
  cores (nome, usuario_id)
VALUES
  ('Branco', NULL),
  ('Preto', NULL),
  ('Cinza', NULL),
  ('Bege', NULL),
  ('Marrom', NULL),
  ('Vermelho', NULL),
  ('Bordô', NULL),
  ('Carmesim', NULL),
  ('Rosa', NULL),
  ('Magenta', NULL),
  ('Fúcsia', NULL),
  ('Coral', NULL),
  ('Azul', NULL),
  ('Azul-claro', NULL),
  ('Azul-royal', NULL),
  ('Azul-marinho', NULL),
  ('Turquesa', NULL),
  ('Roxo', NULL),
  ('Violeta', NULL),
  ('Lavanda', NULL),
  ('Verde', NULL),
  ('Verde-claro', NULL),
  ('Verde-esmeralda', NULL),
  ('Verde-bandeira', NULL),
  ('Verde-oliva', NULL),
  ('Verde-militar', NULL),
  ('Menta', NULL),
  ('Amarelo', NULL),
  ('Mostarda', NULL),
  ('Dourado', NULL),
  ('Laranja', NULL),
  ('Terracota', NULL),
  ('Salmão', NULL),
  ('Prata', NULL),
  ('Bronze', NULL),
  ('Cobre', NULL);

INSERT INTO
  tamanhos (nome, usuario_id)
VALUES
  ('PP', NULL),
  ('P', NULL),
  ('M', NULL),
  ('G', NULL),
  ('GG', NULL),
  ('32', NULL),
  ('34', NULL),
  ('36', NULL),
  ('38', NULL),
  ('40', NULL),
  ('42', NULL),
  ('44', NULL),
  ('46', NULL),
  ('Único', NULL);

INSERT INTO
  generos (nome, usuario_id)
VALUES
  ('Masculino', NULL),
  ('Feminino', NULL),
  ('Unisex', NULL),
  ('Outros', NULL);

INSERT INTO
  segmentos (nome, usuario_id)
VALUES
  ('Adulto', NULL),
  ('Infantil', NULL),
  ('Juvenil', NULL),
  ('Bebê', NULL);