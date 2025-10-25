SELECT 
produtos.produto_id,
produtos.nome,
produtos.categoria,
fornecedores.razao_social AS nome_do_fornecedor
FROM produtos
RIGHT JOIN fornecedores ON produtos.fornecedor_id = fornecedores.fornecedor_id;