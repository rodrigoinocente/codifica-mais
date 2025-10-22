CREATE TABLE fornecedores (
  fornecedor_id VARCHAR (30) PRIMARY KEY UNIQUE,
  razao_social VARCHAR (100),
  cnpj VARCHAR (50) UNIQUE,
  criado_em DATE,
  atualizado_em DATE DEFAULT NULL,
  deletado_em DATE DEFAULT NULL
);