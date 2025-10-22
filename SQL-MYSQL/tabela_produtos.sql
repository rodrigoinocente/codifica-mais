CREATE TABLE produtos (
  produto_id VARCHAR (100) PRIMARY KEY UNIQUE,
  fornecedor_id VARCHAR (30),
  nome VARCHAR (100),
  descrição VARCHAR (300),
  categoria VARCHAR (30),
  preco DECIMAL (10,2),
  quantidade INT,
  criado_em DATE,
  atualizado_em DATE DEFAULT NULL,
  deletado_em DATE,
  FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(fornecedor_id)
);