SELECT hospedagens.cidade,
TRUNCATE(AVG(preco_noite), 2) AS media_por_dia_das_reservas
FROM hospedagens
GROUP BY cidade;