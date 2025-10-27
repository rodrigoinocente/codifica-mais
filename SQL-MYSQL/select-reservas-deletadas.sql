SELECT reservas.id_reserva,
hospedes.nome_completo AS nome_hospede,
anfitrioes.nome_completo AS nome_anfitirao,
hospedagens.titulo AS titulo_hospedagem,
reservas.deletado_em AS reservas_deletadas_em
FROM reservas
LEFT JOIN hospedes on hospedes.id_hospede = reservas.id_hospede
JOIN hospedagens ON hospedagens.id_hospedagem = reservas.id_hospedagem
JOIN anfitrioes ON anfitrioes.id_anfitriao = hospedagens.id_anfitriao
WHERE reservas.deletado_em IS NOT NUll;